
<?php
class Blog extends CI_Controller{
    public function index(){
       /* echo "hi I am here";
        echo "</br>";
        echo "I am a new user in codigniter";*/
      //$this->load->view("welcome_message");
        $this->content();
        /*$this->load->view("header");

        $this->load->view("left_side");

        $this->load->view("right_side");
        $this->load->view("main_content");
       $this->load->view("footer");*/
    }

    public function content(){
        $this->load->view("public/header");

        $this->load->view("public/left_side");

        $this->load->view("public/right_side");
        $this->load->view("public/main_content");
        $this->load->view("public/footer");
    }
    public function home(){
        $this->load->view("public/header");

        $this->load->view("public/left_side");

        $this->load->view("public/right_side");
        $this->load->view("public/main_content");
        $this->load->view("public/footer");
    }
    public function catalog(){
        $this->load->view("public/header");
        echo "This is a catalog";
        $this->load->view("public/left_side");

        $this->load->view("public/right_side");
        $this->load->view("public/main_content");
        $this->load->view("public/footer");
    }
    public function about(){
        /*$this->load->view("header");

        $this->load->view("left_side");

        $this->load->view("right_side");
        $this->load->view("main_content");
        $this->load->view("footer");*/
        $this->load->view("welcome_message");
    }
}

?>

