<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 11:35 AM
 * To change this template use File | Settings | File Templates.
 */

class New_products extends CI_Controller
{

    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_new_products');

    }
    public function index()
    {
        require_once(APPPATH."default_pagination.php");

        $config['base_url'] = base_url()."public/new_products/index/";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->M_new_products->count_product();

        $offset = $this->uri->segment(4)== '' ? 0: $this->uri->segment(4);

        require_once(APPPATH."public_view.php");
        //get_message();

        $this->data['products'] = $this->M_new_products->getAllProduct($offset,$config['per_page']);

        $this->pagination->initialize($config);

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/new_products");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

}