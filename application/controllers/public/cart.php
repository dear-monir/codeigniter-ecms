<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/14/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */
class Cart extends CI_Controller { // Our Cart class extends the Controller class

    function __construct()
    {
        parent::__construct(); // We define the the Controller class is the parent.
        //$this->load->library('cart');
        $this->load->model('public/M_cart');
    }

    public function index()
    {

        $prodict_id = $this->uri->segment(4);
        $available_product_qty = $this->M_cart->getNumProduct($prodict_id);

        //$prodict_price = array_shift($_POST);

        //$prodict_price = $_POST[0];
        //
        //reset($_POST);
        $count = 0;
        $data = array();
        foreach($_POST as $key=>$value)
        {
            ++$count;
            $data[] = $value;
            unset($_POST[$key]);
                if($count == 2)
                {
                    break;
                }
        }
        //print_r($_POST);
        $prodict_price = $data[0];
        $prodict_name = $data[1];
        $options = array();
        $cart = $this->cart->contents();
        $product_found = false;
        $row_id = 0;
        $qty    = 0;
        $product_quantity = 0;

        foreach($_POST as $opt_id => $value)
        {
            $array = explode('_',$value);
           // echo $opt_name;
            $options["$opt_id"."_$array[0]"] = $array[1];
        }
        foreach($cart as $item)
        {

            if($item['id'] == $prodict_id && $item['options'] == $_POST)
            {
                $product_found = true;
                $row_id        = $item['rowid'];
                $qty           = $item['qty'] + 1;

            }
            if($item['id'] == $prodict_id )
            {

                $product_quantity = $product_quantity + $item['qty'];
            }

        }

        if( $product_found == true && $product_quantity < $available_product_qty )
        {
            // Create an array with the products rowid's and quantities.
            $data = array(
                'rowid' => $row_id,
                'qty'   => $qty
            );

            // Update the cart with the new information
            $this->cart->update($data);
        }
        else if( $product_found == false && $product_quantity < $available_product_qty)
        {
            $additional_price = 0;
            foreach($options as $opt_val)
            {
                $additional_price = $additional_price + ($opt_val);
            }

            $product = array(
                'id'        => $prodict_id,
                "name"      => $prodict_name,
                "qty"     => 1,
                "price"     => $prodict_price + $additional_price,
                "options"   => $_POST
            );
            //print_r($product);
             $this->cart->insert($product);
        }
        else if($product_quantity == $available_product_qty)
        {
            echo "You already have the maximum amount of available product.";
        }

        //echo $product_found;
    }

    public function view()
    {
        print_r($this->cart->contents());
    }

    public function destroy()
    {
        $this->cart->destroy();
        redirect('public/view_cart/');
    }

    public function delete()
    {
        $row_id = $_POST['row_id'];
        $data = array(
            'rowid' => $row_id,
            'qty'   => 0
        );
        $this->cart->update($data);
        //print_r($_POST);
    }

    public function update()
    {
        $row_id = $_POST['row_id'];
        $product_id = $_POST['product_id'];
        $item_qty   = $_POST['item_quantity'];

        $quantity=0;

        $available_product_qty = $this->M_cart->getNumProduct($product_id);
        $cart = $this->cart->contents();
        foreach($cart as $item)
        {
            if($product_id == $item['id'] && $row_id != $item['rowid'])
            {
                $quantity = $quantity + $item['qty'];
            }
        }

        $remain_qty = $available_product_qty - $quantity;
        if($remain_qty >= $item_qty)
        {
            $data = array(
                'rowid' => $row_id,
                'qty'   => $item_qty
            );
            $this->cart->update($data);
        }

        else{
            $data = array(
                'rowid' => $row_id,
                'qty'   => $remain_qty
            );
            $this->cart->update($data);
            echo "Only $remain_qty products are available.";
        }

    }
}