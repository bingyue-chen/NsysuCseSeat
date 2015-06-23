<?php 
namespace MyApp;
require_once('Class.seat.php');
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $seat_map;
    protected $pic_url;
    private $record = [];

	public function __construct(){
        define("INIT"         , 0);
        define("IN_SEAT"      , 1) ;
        define("NEW_SEAT"     , 2);
        define("LEAVE_SEAT"   , 3);
        define("CHAT_MSG"     , 4);
        define("Q_MSG"        , 5);
        define("CLOSE_CONN"   , 100);
        define("FAIL_IN_SEAT" , 404);
		$this->clients = new \SplObjectStorage;
        $this->seat_map = new \Seat( 31 );
	}

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach( $conn );

    	echo "New connection : $conn->resourceId \n";
        $msg = [
            'type' => INIT ,
            'data' => $this->seat_map->get_seat()
        ];
        $pic_url = "../img/in_seat.jpg";
        $conn->send(json_encode($msg));
        foreach ($this->record as $key => $msg) {
            $conn->send(json_encode($msg));
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $json = json_decode( $msg ) ;
        if( $json->type == IN_SEAT ){
            $index = $json->data->index;
            $img = $json->data->img;
			$link = $json->data->link;
            if( $this->seat_map->insert_seat( $index , $from->resourceId , $img , $link ) ){
                foreach ($this->clients as $client ) {
                    if( $from !== $client ){
						$user_data = $this->seat_map->get_img_url( $from->resourceId );
                        $imgurl = $user_data[0];
						$other_link = $user_data[1];
                        $msg =  [ 'type' => NEW_SEAT , 'data' => [ $index , $from->resourceId , $imgurl , $other_link ] ];
                        $client->send( json_encode( $msg ));
                    }
                }
                $msg = [ 'type' => IN_SEAT, 'data' => [ $index , $link] ];
            }
            else{
                $msg = [ 'type' => FAIL_IN_SEAT, 'data' => [] ];   
            }
            $from->send( json_encode( $msg ) );
        }
        else if( $json->type == INIT ){
            $pic_url = $json->data->url;
        }
        else if($json->type == CHAT_MSG || $json->type == Q_MSG){
            $name = $from->resourceId;
            if(isset($_SESSION['FULLNAME'])){
                $name = $_SESSION['FULLNAME'];
            }
            $msg = [ 'type' => $json->type , 'data' => $name.' : '.$json->message ];
            array_push($this->record, $msg);
            foreach ($this->clients as $client ) {
                $client->send( json_encode( $msg ));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        foreach ($this->clients as $client ) {
            if( $conn !== $client ){
                $msg =  [ 'type' => LEAVE_SEAT , 'data' => [ $conn->resourceId ] ];
                $client->send( json_encode( $msg ));
            }
        }

        $this->seat_map->remove_seat( $conn->resourceId );
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}
