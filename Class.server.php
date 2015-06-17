<?php 
namespace MyApp;
require_once('Class.seat.php');
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $seat_map;
    protected $pic_url;

	public function __construct(){
        define("INIT" , 0 );
        define("IN_SEAT" , 1) ;
        define("NEW_SEAT" , 2 );
        define("CLOSE_CONN" , 100);
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
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $json = json_decode( $msg ) ;
        if( $json->type == IN_SEAT ){
            $index = $json->data->index;
            if( $this->seat_map->insert_seat( $index , $from->resourceId ) ){
                foreach ($this->clients as $client ) {
                    if( $from !== $client ){
                        $msg =  [ 'type' => NEW_SEAT , 'data' => [ $index , $from->resourceId ] ];
                        $client->send( json_encode( $msg ));
                    }
                }
                $msg = [ 'type' => IN_SEAT, 'data' => [ $index ] ];
            }
            else{
                $msg = [ 'type' => FAIL_IN_SEAT, 'data' => [] ];   
            }
            $from->send( json_encode( $msg ) );
        }
        else if( $json->type == INIT ){
            $pic_url = $json->data->url;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->seat_map->remove_seat( $conn->resourceId );
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}
