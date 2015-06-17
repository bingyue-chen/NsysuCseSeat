<?php 

class Seat {
    protected $max_index;
    protected $seat_map;

    public function __construct( $index ){
        $this->max_index = $index;
        $this->seat_map = array();
        for( $i = 0 ; $i < $index ; ++$i )
            $this->seat_map[$i]  = [0];
    }
    /* 
     * Struct about seat 
     * A seat is compose of one id and one string about profile link
     * So , the seat is  : 
     *              [ $id , $profile ]
     * if $id == 0 , then the seat is empty
     * if $profile == "" , then the user has not logged in 
     */
    public function insert_seat( $index , $id ){

        if( $this->seat_map[$index][0] == 0 ){
            $this->remove_seat( $id );
            $this->seat_map[$index] = [ $id , "../img/in_seat.jpg" ];
        }
        else {
            return false;
        }
        return true;
    }

    public function remove_seat(  $id ){
        for( $i = 0 ; $i < $this->max_index ; ++$i )
            if( $this->seat_map[$i][0] == $id )
                $this->seat_map[$i][0] = 0;            
    }

    public function get_seat(){
        return $this->seat_map;
    }    

}
