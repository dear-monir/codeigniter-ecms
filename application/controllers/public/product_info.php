<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 12:22 PM
 * To change this template use File | Settings | File Templates.
 */

class product_info extends CI_Controller
{

    var $user_language;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_product_info');
        $this->load->model('admin/M_product_figures');

    }
    public function index()
    {
        require_once(APPPATH."public_view.php");
        //get_message();
        if($this->uri->segment(4))
        {
            $product_id = $this->uri->segment(4);
            $this->data['product_info'] = $this->M_product_info->getProductInfo($product_id);
            $this->data['product_options'] = $this->M_product_info->getProductOptions($product_id);
            $this->data['option_values'] = $this->M_product_info->getOptionValues($product_id);
            $this->data['product_id']    = $product_id;
            $this->data['product_images'] = $this->M_product_figures->getAllProductFigure($product_id);
        }


        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/product_info");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

}