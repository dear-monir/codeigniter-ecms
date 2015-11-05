<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 1/2/14
 * Time: 11:16 AM
 * To change this template use File | Settings | File Templates.
 */

class Currency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $cur_id = $this->uri->segment(4);
        $cookie = array(
            'name'   => 'cur_id',
            'value'  => $cur_id,
            'expire' => '86500'
        );

        $this->input->set_cookie($cookie);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get()
    {
        echo get_cookie('cur_id');
    }
}
?>
