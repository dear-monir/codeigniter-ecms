<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/12/13
 * Time: 12:53 PM
 * To change this template use File | Settings | File Templates.
 */

class Category extends CI_Controller
{

    var $user_language;
    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_category');
        $this->categories = explode("_",$this->uri->segment(4));
    }


    public function index()
    {
        require_once(APPPATH."public_view.php");
        //get_message();
        if($this->uri->segment(4) != false)
        {
            //$cat_id = $this->uri->segment(4);
            $cat_id = end($this->categories);
            require_once(APPPATH."default_pagination.php");

            $config['base_url'] = base_url()."public/category/index/".$this->uri->segment(4)."/";
            $config['uri_segment'] = 5;
            $config['total_rows'] = countProductPerCat($cat_id);

            $offset = $this->uri->segment(5)== '' ? 0: $this->uri->segment(5);
            $this->data['products'] = $this->M_category->getAllProduct($cat_id,$offset,$config['per_page']);
            if(empty($this->data['products']))
            {
                $this->data['sub_categories'] = $this->M_common->getAllCategory($cat_id);
            }

        }


        //print_r($this->categories);
        $nav = $this->fetchCat($this->categories[0]);
        $this->data['nav_cat'] = $nav;
        $this->data['page'] = "category";
        //echo $this->displayNav($nav);
        $cat_name = $this->M_common->getCatById(end($this->categories));
        //print_r($cat_name);
        $this->data['cat_name'] = $cat_name;

        $this->pagination->initialize($config);

        $this->load->view("public/{$this->user_language}/header",$this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/category");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

    public function fetchCat($cat_id,$path="")
    {

        $cat= $this->M_common->getAllCategory($cat_id);
        //print_r($cat);
        $array = array();
        if(!empty($path))
        {
            $path = $path;
        }
        else
        {
            $path = $cat_id;
        }

        if(!empty($cat))
        {
            //echo "true";
            foreach($cat as $c)
            {
                //$pt
                $url = $path."_".$c->category_id;
                if(in_array($c->category_id,$this->categories))
                {
                    // echo "true";
                    //$this->category_nav[$c->category_name] = $this->fetchCat($c->category_id);

                    $array[$c->category_name."/".$url] = $this->fetchCat($c->category_id,$url);


                }
                else
                {
                    //$this->category_nav[] = $c->category_name;
                    $array[$url] = $c->category_name;
                }

            }
            //$this->category_nav[] = $array;

        }
        return $array;
        //return $this->category_nav;
    }

}