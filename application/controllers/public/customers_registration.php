<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

class Customers_registration extends CI_Controller
{

    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_home');

    }
    public function index()
    {
//        require_once(APPPATH."public_view.php");
//        //get_message();
//        $this->data['title'] ="Registraton";
//        $this->load->view("public/{$this->user_language}/header",$this->data);
//        $this->load->view("public/{$this->user_language}/left_sidebar");
//        $this->load->view("public/{$this->user_language}/customers_registration");
//        $this->load->view("public/{$this->user_language}/right_sidebar");
//        $this->load->view("public/{$this->user_language}/footer");
    }

}