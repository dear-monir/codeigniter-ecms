<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/4/14
 * Time: 9:18 PM
 */
class Order extends CI_Controller
{
    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata['is_logged_in'] != 1 || $this->cart->total() <1)
        {
            redirect(base_url().'public/customer');
        }
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_product_info');
        $this->load->model('admin/M_product_figures');
        $this->load->model('public/M_search');

        $this->load->model('public/m_order');
        $this->load->model('admin/m_state');

        $this->load->model('admin/m_products_attributes');
        $this->load->model('admin/m_currencies');

    }

    public function confirm()
    {

        if(isset($_POST['continue']) && $_POST['continue'])
        {
            if(isset($_POST['payment_method']) && !empty($_POST['payment_method']))
            {
                $this->session->set_userdata(
                    array(
                        'payment_method' => $_POST['payment_method']
                    )
                );
            }
            else
            {
                redirect(base_url().'public/shipping/payment_method');
            }
        }
        elseif($this->session->userdata('payment_method') == '')
        {
            redirect(base_url().'public/shipping/payment_method');
        }

        $this->calculate_cost();
        $this->data['cart_contents'] = $this->cart->contents();
        $currency_id = get_currentcy_id();
        $this->data['currency_code'] = $this->m_currencies->getById($currency_id)->code;
        require_once(APPPATH."public_view.php");

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/confirm");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");

    }

    public function calculate_cost($order_confirm = false)
    {
        $products = array();
        $products_options = array();
        $cart_items  = $this->cart->contents();
        $total_items = $this->cart->total_items();

        $shipping_method_id    = $this->session->userdata('selected_shipping_method_id');
        $state_id  = $this->session->userdata('state_id');
        $country_id = $this->session->userdata('country_id');
        $shipping_info = $this->m_state->getByRegion($state_id,$shipping_method_id);
        $total       = 0;
        $total_tax   = 0;
        $shipping_cost = 0;
        foreach($cart_items as $item)
        {
            $product_id = $item['id'];
            $subtotal   = $item['subtotal'];
            if(count($item['options']) > 0)
            {
                foreach($item['options'] as $option_key=>$option)
                {
                    $option_name_id = @end(explode('_',$option_key));
                    $option_value = explode('_',$option);
                    //$additional_price = @end(explode('_',$option));
                    $additional_price = $option_value[1];
                    $subtotal = $subtotal + ($additional_price * $item['qty']);
                    if($order_confirm)
                    {
                        $prefix = substr($additional_price,0,1);
                        $optional_price = substr($additional_price,1);
                        $product_options = $this->m_products_attributes->getAttributeInfo($option_name_id,$option_value[0]);
                        $products_options[] = array(
                            'product_id' => $product_id,
                            'product_option' =>$product_options[0]->product_option_name,
                            'product_option_value'=>$product_options[0]->product_option_value_name,
                            'product_option_value_price'=>$optional_price,
                            'product_option_value_prefix'=>$prefix

                        );
                    }

                }
            }

            $tax_rate = $this->m_order->getTaxRate($product_id,$country_id)->tax_rate;
            if(is_null($tax_rate) || empty($tax_rate))
            {
                $tax_rate = 100;
            }
            $tax = ($tax_rate)/100 * $subtotal;
            $total_tax += $tax;
            $total += $subtotal;

            $products[] = array(
                'product_id'       => $product_id,
                'product_name'     => $item['name'],
                'product_price'    => $item['price'],
                'product_tax'      => $tax,
                'product_quantity' => $item['qty'],
                'total_price'      => $subtotal + $tax
            );
        }

        if($shipping_info->configuration_key == "FLAT_RATE")
        {
            $shipping_cost = $shipping_info->shipping_cost;
        }
        else if($shipping_info->configuration_key == "PER_ITEM")
        {
            $shipping_cost = $shipping_info->shipping_cost * $total_items;
        }

        $this->data['shipping_cost'] = $shipping_cost;
        $this->data['subtotal']      = $total;
        $this->data['totaltax']           = $total_tax;
        $this->data['total'] = $shipping_cost + $total + $total_tax;

        if($order_confirm)
        {
            return array($products,$products_options);
        }
    }

    public function thanks()
    {
        $customer_id  = $this->session->userdata('customer_id');
        $is_logged_in = $this->session->userdata('is_logged_in');
        $active       = $this->session->userdata('active');
        $this->load->model('admin/m_currencies');
        $isorderconfirmed = false;
        $ispayondelivery = $this->session->userdata('payment_method') == 'PAY_ON_DELIVERY';
        if($this->session->userdata('payment_method') == 'PAYPAL')
        {
            $isorderconfirmed = true;
        }
        else if(isset($_POST['total']) && $ispayondelivery)
        {
            $isorderconfirmed = true;
        }
        if($isorderconfirmed)
        {
            $currency_id = get_currentcy_id();
            $currency = $this->m_currencies->getById($currency_id);

            list($order_products,$order_products_options) = $this->calculate_cost(true);

            $orders = array(
                'customer_id' => $customer_id,
                'delivery_fname' =>$this->session->userdata('fname'),
                'delivery_lname'=>$this->session->userdata('lname'),
                'delivery_gender'=>$this->session->userdata('gender'),
                'delivery_street_address'=>$this->session->userdata('saddress'),
                'delivery_postcode' =>$this->session->userdata('postcode'),
                'delivery_city'=>$this->session->userdata('city'),
                'delivery_state'=>$this->session->userdata('state'),
                'delivery_country'=>$this->session->userdata('country'),
                'currency'=>$currency->code,
                'currency_value'=>$currency->value,
                'shipping_cost' => $this->data['shipping_cost'],
                'status' => 1,
                'total'  => $this->data['total']
            );

            if($this->m_order->confirm($orders,$order_products,$order_products_options))
            {
                //$this->session->sess_destroy();
                $this->cart->destroy();
//                $this->session->set_userdata(array(
//                    'customer_id'  => $customer_id,
//                    'is_logged_in' => $is_logged_in,
//                    'active'       => $active
//
//                ));
                require_once(APPPATH."public_view.php");

                $this->load->view("public/{$this->user_language}/header",$this->data);
                $this->load->view("public/{$this->user_language}/left_sidebar");
                $this->load->view("public/{$this->user_language}/thanks");
                $this->load->view("public/{$this->user_language}/right_sidebar");
                $this->load->view("public/{$this->user_language}/footer");
            }
        }
    }

}
