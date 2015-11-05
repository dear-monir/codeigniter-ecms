<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 6/30/14
 * Time: 10:36 PM
 */
class Shipping extends CI_Controller
{
    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['is_logged_in'] != 1 || $this->cart->total_items() <1)
        {
            redirect(base_url().'public/customer');
        }
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_product_info');
        $this->load->model('admin/M_product_figures');
        $this->load->model('public/M_search');
    }

    public function index()
    {
        $this->load->model('admin/m_shipping_region');
        $this->data['shipping_address'] = $this->getShippingAddress();
        $region_id = $this->session->userdata('state_id');
        $selected_shipping_method_id = $this->session->userdata('selected_shipping_method_id');
        $this->data['selected_shipping_method_id'] = $selected_shipping_method_id;
        $this->data['shipping_methods'] = $this->m_shipping_region->getShippingMethodByRegion($region_id);
        $this->data['number_of_items'] = $this->cart->total_items();

        require_once(APPPATH."public_view.php");

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/shipping");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

    public function new_shipping_address()
    {
        if(isset($_POST['lname']))
        {
            $this->load->model('admin/m_shipping_region');
            $shipping_address_info = $this->m_shipping_region->getCountryRegion($_POST['country'],$_POST['state']);
            $newdata = array(
                'gender' => $_POST['gender'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'saddress' => $_POST['saddress'],
                'postcode' => $_POST['postcode'],
                'city' => $_POST['city'],
                'state_id' => $_POST['state'],
                'country_id' => $_POST['country'],
                'selected_shipping_method_id'=> 0,
                'state' => $shipping_address_info->region_name,
                'country' => $shipping_address_info->country_name
            );

            $this->setShippingAddress($newdata);
            redirect('public/shipping');
        }
        else
        {
            $this->load->model('admin/m_country');
            $this->data['countries'] = $this->m_country->getAll();
            require_once(APPPATH."public_view.php");

            $this->load->view("public/{$this->user_language}/header",$this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/new_shipping_address");
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        }

    }

    public function payment_method()
    {
        if(isset($_POST['continue']) && $_POST['continue'])
        {
            if(isset($_POST['shipping_method_id']) && $_POST['shipping_method_id'] !=0)
            {
                $this->setShippingAddress(
                    array(
                    'selected_shipping_method_id' => $_POST['shipping_method_id']
                    )
                );
            }
            else
            {
                redirect(base_url().'public/shipping/unavailable');
            }
        }
        else if($this->session->userdata('selected_shipping_method_id') == 0)
        {
            redirect(base_url().'public/shipping');
        }
        require_once(APPPATH."public_view.php");

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/payment_method");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

    private  function setShippingAddress($newdata)
    {
        $this->session->set_userdata($newdata);
    }
    public function get()
    {
        print_r($this->session->all_userdata());
    }

    public function destroy()
    {
        $this->session->sess_destroy();
    }

    public function getShippingAddress()
    {
        $lname = $this->session->userdata('lname');
        if(empty($lname))
        {
            $this->load->model('public/m_customers');
            $customer_id = $this->session->userdata['customer_id'];
            $cust_shipping_info = $this->m_customers->getById($customer_id);
            $newdata = array(
                'gender' => $cust_shipping_info->customer_gender,
                'fname' => $cust_shipping_info->customer_firstname,
                'lname' => $cust_shipping_info->customer_lastname,
                'saddress' => $cust_shipping_info->customer_street,
                'postcode' => $cust_shipping_info->customer_postcode,
                'city' => $cust_shipping_info->customer_city,
                'state' => $cust_shipping_info->name,
                'country' => $cust_shipping_info->country_name,
                'state_id' => $cust_shipping_info->customer_state_id,
                'country_id' => $cust_shipping_info->customer_country_id
            );

            $this->setShippingAddress($newdata);
        }
        $shipping_address = array(
            'gender' => $this->session->userdata('gender'),
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'saddress' => $this->session->userdata('saddress'),
            'postcode' => $this->session->userdata('postcode'),
            'city' => $this->session->userdata('city'),
            'state' => $this->session->userdata('state'),
            'country' => $this->session->userdata('country'),
            'state_id' => $this->session->userdata('state_id'),
            'country_id' => $this->session->userdata('country_id')
        );
        return $shipping_address;
    }

    public function unavailable()
    {
        require_once(APPPATH."public_view.php");

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/no_shipping");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }
}
?>