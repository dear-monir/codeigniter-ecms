<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/26/13
 * Time: 9:47 PM
 * To change this template use File | Settings | File Templates.
 */

class Test extends CI_Controller
{

    var $user_language;
    var $data;
    var $category_nav;
    var $categories = array();

    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_category');
        $this->categories = explode("_",$this->uri->segment(4));
        //print_r($this->categories);
        $nav = $this->fetchCat($this->categories[0]);
        echo $this->displayNav($nav);

    }

    public function displayNav($nav)
    {
        $output = "";
        if(!empty($nav))
        {
            foreach($nav as $key => $value)
            {
                $array = explode("/",$key);
                if(is_array($value))
                {
//print_r($value);
                    $output .= "<li><a href=". base_url()."public/test/index/$array[1]".">".$array[0]." " .$this->displayNav($value)."</a></li>";
                }
                else
                {
                    $output .= "<li><a href=". base_url()."public/test/index/$array[0]".">".$value."</a></li>";
                }

            }
        }

        return "<ul>$output</ul>";

    }
    public function index()
    {
       /* $this->data['main_category'] = $this->M_common->getAllCategory();

        //get_message();
        if($this->uri->segment(4) != false)
        {
            $cat_id = $this->uri->segment(4);
            $this->data['products'] = $this->M_category->getAllProduct($cat_id,0,20);
            if(empty($this->data['products']))
            {
                $this->data['sub_categories'] = $this->M_common->getAllCategory($cat_id);
            }

        }
*/
        $this->data['category_nav'] = $this->category_nav;
        $this->load->view("public/{$this->user_language}/test",$this->data);
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