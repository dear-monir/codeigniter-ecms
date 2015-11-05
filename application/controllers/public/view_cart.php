<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/15/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */
class View_cart extends CI_Controller
{

    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
       // $this->load->library('cart');

    }
    public function index()
    {
        require_once(APPPATH."public_view.php");
        //get_message();

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/view_cart");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

}