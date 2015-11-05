<?php

/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 11/20/13
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */

class Search extends CI_Controller
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
       $this->load->model('public/M_search');
    }

    public function index()
    {
        $price = $this->M_search->get_min_max_price();
        if(isset($price))
        {
            foreach($price as $p)
            {
                $this->data['min_price'] = $p->min_price;
                $this->data['max_price'] = $p->max_price;
                break;
            }

        }
        require_once(APPPATH."public_view.php");

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/search");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

    public function get_suggestion()
    {
        $product_name = trim($_GET['term'],' ');
        //$product_name   = $this->uri->segment(4);
        $suggested_product_names = $this->M_search->suggested_product_names($product_name);
        echo json_encode($suggested_product_names);
    }

    public function get_all_suggested_products()
    {
        $product_name = urldecode(trim($this->uri->segment(4),' '));
        require_once(APPPATH."default_pagination.php");

        $config['base_url'] = base_url()."public/search/get_all_suggested_products/".$this->uri->segment(4)."/";
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->M_search->count_suggested_product($product_name);

        $offset = $this->uri->segment(5)== '' ? 0: $this->uri->segment(5);
        if(strlen($product_name) > 0)
        {
            $suggested_product_names = $this->M_search->get_all_suggested_product($product_name,$offset,$config['per_page']);
        }
        else
        {
            $suggested_product_names = array();
        }
        $this->pagination->initialize($config);
        require_once(APPPATH."public_view.php");
        //get_message();

        $this->data['products'] = $suggested_product_names;
        $this->data['search_term'] = $product_name;
        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/search");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }
}
?>
