<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 10:21 AM
 * To change this template use File | Settings | File Templates.
 */

class Manu_products extends CI_Controller
{

    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_manu_products');

    }

    public function index()
    {
        require_once(APPPATH."public_view.php");
        //get_message();
        if($this->uri->segment(4) != false)
        {
            $manu_fact_id = $this->uri->segment(4);
            require_once(APPPATH."default_pagination.php");

            $config['base_url'] = base_url()."public/manu_products/index/".$manu_fact_id."/";
            $config['uri_segment'] = 5;
            $config['total_rows'] = $this->M_manu_products->countAllProduct($manu_fact_id);

            $offset = $this->uri->segment(5)== '' ? 0: $this->uri->segment(5);
            $this->data['products'] = $this->M_manu_products->getAllProduct($manu_fact_id,$offset,$config['per_page']);
            $this->data['selected_manu_id'] = $manu_fact_id;
        }

        $this->pagination->initialize($config);

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/manu_products");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }
}