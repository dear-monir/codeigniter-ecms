<?php
class Catalog extends CI_Controller{
    public function index(){
        /* echo "hi I am here";
         echo "</br>";
         echo "I am a new user in codigniter";*/
        //$this->load->view("welcome_message");
        $this->load->view("public/header");

        $this->load->view("public/left_side");

        $this->load->view("public/right_side");
        $this->load->view("public/main_content");
        $this->load->view("public/footer");
    }

}
?>
