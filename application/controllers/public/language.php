<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/22/13
 * Time: 11:30 PM
 * To change this template use File | Settings | File Templates.
 */

class Language extends CI_Controller
{

     public function __construct()
     {
         parent::__construct();
         $this->load->model('public/M_language');

     }

    public function index()
    {

        $lan_id = $this->uri->segment(4);
        $lan_code = strtolower($this->uri->segment(5));
        $cookie = array(
            'name'   => 'lan_id',
            'value'  => $lan_id,
            'expire' => '86500'
        );

        $this->input->set_cookie($cookie);

        $cookie = array(
            'name'   => 'lan_code',
            'value'  => $lan_code,
            'expire' => '86500'
        );

        $this->input->set_cookie($cookie);
        /*$cart_items = $this->cart->contents();
        if(!empty($cart_items))
        {
            foreach($cart_items as $item)
            {
                $product_name = getProductInfo($item['id']);
                echo  $item['rowid'];
                $this->cart->update(array(
                    'rowid' => $item['rowid'],
                    'name'  => 'abc'
                ));
            }
        }
        print_r($this->cart->contents());
        die;*/
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get()
    {
        echo get_cookie('lan_code'); //$this->input->get_cookie("cookie_name");
    }
}
?>
