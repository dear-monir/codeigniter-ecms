<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 10:38 AM
 * To change this template use File | Settings | File Templates.
 */


class Reviews extends CI_Controller
{
    var $data;
    var $product_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_language');
        $this->load->model('admin/M_option_values');
        $this->load->model('admin/M_products_attributes');
        $this->data['languages'] = $this->M_language->getAll();
        $this->data['products']  = $this->M_products_attributes->getAllProduct();

        if($this->uri->segment(4) == false || $this->uri->segment(4) == 0)
        {
            if($this->data['products'])
            {
                foreach($this->data['products'] as $p)
                {
                    $this->product_id = $p->product_id;
                    redirect(base_url().'admin/reviews/index/'.$p->product_id);
                    break;
                }
            }
        }
        else
        {
            $this->product_id = $this->uri->segment(4);
        }
        $this->data['selected_product_id']  = $this->product_id;
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
        $this->load->view('admin/reviews',$this->data);
    }
}