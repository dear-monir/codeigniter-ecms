<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categories_products extends CI_Controller {

    var $path;
    var $data;
    var $sub_cat_id = array();
    public function __construct()
    {
        parent::__construct();
        $this->path = realpath(APPPATH."../images/categories/");
        $this->load->model('admin/M_categories_product');
        $this->load->model('admin/M_language');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }

    }
    public function index(){
        $title['title']="categories/product";
        $id = $this->uri->segment(4);
        $this->dispaly('view',$id);
        $this->load->view('admin/categories_product',$this->data);
        //echo "category_product";
    }
    public function add()
    {
        $title['title']="categories/product";
        $id = 0;
        if($this->uri->segment(4) != false)
        {
            $id = $this->uri->segment(4);
            $parent_category_id = $this->getParentCategoryId($id);
        }
        else
        {
            $parent_category_id = 0;
        }
        if( !empty($_POST) )
             {


                     $data = array(
                         'sort_order' => $_POST['sort_order'],
                          'parent_id' => $id

                     );
                   $inserted_id = $this->M_categories_product->insert_categories($data);
                   $languages = $this->M_language->getAll();
                     if($languages)
                     {
                         foreach($languages as $l)
                         {
                             $field_name = "language_".$l->language_id;
                             $category_name = $_POST[$field_name];
                             $cat_des = array(
                                 'category_id'=>$inserted_id,
                                 'language_id'=>$l->language_id,
                                 'category_name'=>$category_name
                             );
                            $this->M_categories_product->insert_catDescription($cat_des);
                         }
                     }

                   redirect("admin/categories_products/index/$id");
                 //redirect($_SERVER['HTTP_REFERER']);

           }
           else if( $this->uri->segment(3) == 'add')
           {
                 $title['title']="categories/product";
                 $parent_category_id = 0;
                 $id=0;
                 if($this->uri->segment(4) != false)
                 {
                     $id = $this->uri->segment(4);
                     $parent_category_id =  $this->getParentCategoryId($id);
                 }
                  $this->dispaly('add',$id);
                 $category = $this->M_categories_product->getParentCategory($id);
                 $this->data['category_name'] = 'Add Category To "<span>Top</span>"';
                 if($category)
                 {
                     foreach($category as $c)
                     {
                         $this->data['category_name'] = 'Add Category To "<span>'. $c->category_name . '</span>"';
                     }
                 }

                 $this->data['category_id'] = $id;
                 $this->data['languages'] = $this->M_language->getAll();
                 $this->data['sort_order'] = '';
                 $this->load->view('admin/categories_product',$this->data);

             }
             else
             {
                 $this->index();
             }
         }

    public function edit()
    {
        $id = $this->uri->segment(4);
        if($id!=0)
        {
             $parent_category_id = $this->getParentCategoryId($id);
        }
        else
        {
            $parent_category_id = $id;
        }
        if(isset($_POST['sort_order']))
        {

            $data = array(
                'sort_order' => $_POST['sort_order']
            );
            $this->M_categories_product->update_categories($data,$id);

            $languages = $this->M_language->getAll();
            if($languages)
            {
                foreach($languages as $l)
                {
                    $field_name = "language_".$l->language_id;
                    $category_name = $_POST[$field_name];
                    $cat_des = array(
                        'category_name'=>$category_name
                    );
                    $lan_id = $l->language_id;
                    //print_r($cat_des);
                   $this->M_categories_product->update_catDescription($cat_des,$id,$lan_id);
                }
            }
            redirect("admin/categories_products/index/$parent_category_id");
        }
        else if( $this->uri->segment(3) == 'edit' && $this->uri->segment(4))
        {

            $parent_category_id = 0;

            if($this->uri->segment(4) != false)
            {
                $parent_category_id = $this->getParentCategoryId($this->uri->segment(4));
                $cat_id = $this->uri->segment(4);
            }
            //$data['categories'] = $this->M_categories_product->getAllCategory($parent_category_id);
            $this->dispaly('edit',$parent_category_id);
            $category = $this->M_categories_product->getById($cat_id);
            $this->data['languages'] = $this->M_language->getAll();
            $cat_info = $this->M_categories_product->getAllCatDescription($cat_id);
            foreach($cat_info as $c_info)
            {
                $this->data["Language_".$c_info->language_id] = $c_info->category_name;
            }
            //$data['category_name'] = "Top";
            $cat_s_ord = $this->M_categories_product->getCatById($cat_id);
            if($category)
            {
                foreach($category as $c)
                {
                    $this->data['category_name'] = 'Edit Category  "<span>'. $c->category_name . '</span>"';
                }
            }
            if($cat_s_ord)
            {
                foreach($cat_s_ord as $c)
                {
                    $this->data['sort_order'] = $c->sort_order;
                    break;
                }
            }
            $this->data['category_id'] = $id;
           $this->load->view('admin/categories_product',$this->data);
            //redirect("admin/categories_products/index/$parent_category_id",$this->data);
        }

    }


    public function move()
    {
        $old_cat_id = $this->uri->segment(4);
        if(isset($_POST['moveable_category']))
        {
            $new_cat_id =  $_POST['moveable_category'];

            $parent_category_id = $this->getParentCategoryId($old_cat_id);
            if($this->uri->segment(5))
            {
                $prodcut_id = $this->uri->segment(5);
                $data = array(
                    'category_id' => $new_cat_id
                );
                $this->M_categories_product->moveProduct($prodcut_id,$data);
            }
            else
            {
                $data = array(
                    'parent_id' => $new_cat_id
                );
                $this->M_categories_product->update_categories($data,$old_cat_id);
            }

            redirect("admin/categories_products/index/$parent_category_id");

        }
        $parent_category_id = 0;
        if($this->uri->segment(4) != false)
        {
            $cat_id = $this->uri->segment(4);
            if($this->uri->segment(5)!= false)
            {
                $parent_category_id = $cat_id;
                $this->data['product_id'] = $this->uri->segment(5);
            }
            else
            {
                $parent_category_id = $this->getParentCategoryId($this->uri->segment(4));
            }
        }
        //$parent_category_id;
        $this->data['category_id'] = $cat_id;
        $this->dispaly('move',$parent_category_id);
        if($this->uri->segment(5)== false)
        {
            $category = $this->M_categories_product->getById($cat_id);
            if($category)
            {
                foreach($category as $c)
                {
                    $this->data['category_name'] = 'Move Category  "<span>'. $c->category_name . '</span>"';
                }
            }
        }
        else
        {
            $prodcut = $this->M_categories_product->getProductById($this->uri->segment(5));
            if($prodcut)
            {
                foreach($prodcut as $p)
                {
                    $this->data['category_name'] = 'Move Product  "<span>'. $p->product_name . '</span>"';
                }
            }
        }
        $this->data['languages'] = $this->M_language->getAll();
        $cat_info = $this->M_categories_product->getAllCatDescription($cat_id);
        foreach($cat_info as $c_info)
        {
            $this->data["Language_".$c_info->language_id] = $c_info->category_name;
        }
        //$data['category_name'] = "Top";
        //$cat_s_ord = $this->M_categories_product->getCatById($cat_id,$parent_category_id);
     /*   if($cat_s_ord)
        {
            foreach($cat_s_ord as $c)
            {
                $data['sort_order'] = $c->sort_order;
                break;
            }
        }*/
        if($this->uri->segment(5))
        {
            $this->data['move_able_category'] = $this->M_categories_product->moveAbleCategory($old_cat_id);

        }
        else
        {
            //$this->data['move_able_category'] = $this->M_categories_product->moveAbleCategory($parent_category_id);
            $this->data['move_able_category'] = $this->M_categories_product->moveAbleCategory($old_cat_id);
            $sub_cat = $this->getAllSubCat($old_cat_id);
            if(!empty( $this->data['move_able_category']))
            {
                foreach($this->data['move_able_category'] as $key => $mv_cat)
                {
                    if(in_array($mv_cat->category_id,$sub_cat))
                    {
                        unset($this->data['move_able_category'][$key]);
                    }

                }
            }

        }

        //print_r($this->data['move_able_category']);
         $this->load->view('admin/categories_product',$this->data);

    }


    public function getParentCategoryId($childId)
    {
        $p_cat_id = $this->M_categories_product->getParentCategory($childId);
        foreach($p_cat_id as $p)
        {

            return $p->parent_id;
        }
    }

    public function dispaly($action,$id)
    {
        $parent_category_id = 0;
        $this->data['action'] = $action;
       /* if($id!=0)
        {
            $this->data['parent_category_id'] = $this->getParentCategoryId($id);
        }
        else
        {
            $this->data['parent_category_id'] = 0;
        }*/
        $this->data['parent_category_id'] = $id;
        $this->data['categories_products'] = $this->M_categories_product->getAllCategoryAndProduct($id);
        //$this->data['category_id'] = $id;
        //$parent_category_id
        $this->data['products'] = $this->M_categories_product->getAllProduct($id);

    }

    public function delete()
    {
        $cat_id = $this->uri->segment(4);
        //$products = $this->M_categories_product->getAllProduct($cat_id);
        $sub_cat = $this->getAllSubCat($cat_id);
        deleteCategory($cat_id);
        if(!empty($sub_cat))
        {
            foreach($sub_cat as $s_cat)
            {
                if(isset($s_cat->category_id))
                {
                    deleteCategory($s_cat->category_id);
                }

            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getAllSubCat($cat_id)
    {
        $sub_category = $this->M_categories_product->getSubCategory($cat_id);
        if(!empty($sub_category))
        {
            foreach($sub_category as $sub_cat)
            {
                $this->sub_cat_id[] = $sub_cat->category_id;
                $this->getAllSubCat($sub_cat->category_id);
            }
            return $this->sub_cat_id;
        }

    }
}
