<?php
    class UsersService {
        
        // echo ("GET method called with ID: ");
        public function get( $id = null ) {
            if($id) {
                return "GET method called with ID: " ;
            }else {
                return "GET method called without ID";
            }
        }
    }
?>