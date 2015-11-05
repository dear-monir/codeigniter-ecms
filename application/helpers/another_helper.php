<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/5/13
 * Time: 3:51 PM
 * To change this template use File | Settings | File Templates.
 */
//$CI =& get_instance();

function get_message()
{
    echo 'message';
}

function get_language()
{
    $lan_code = get_cookie('lan_code');
    if(!empty($lan_code))
    {
        return $lan_code;
    }
    else
    {
        return "en";
    }

}

function get_language_id()
{
    $lan_id = get_cookie('lan_id');
    if(!empty($lan_id))
    {
        return $lan_id;
    }
    else
    {
        $CI =& get_instance();
        $CI->load->model('admin/M_adminCommon');
        $lan_id =  $CI->M_adminCommon->getConfiguration('DEFAULT_LANGUAGE')->configuration_value;
        $cookie = array(
            'name'   => 'lan_id',
            'value'  => $lan_id,
            'expire' => '86500'
        );

        $CI->input->set_cookie($cookie);
        return $lan_id;
    }
}

function get_currentcy_id()
{
    $cur_id = get_cookie('cur_id');
    if(!empty($cur_id))
    {
        return $cur_id;
    }
    else
    {
        $CI =& get_instance();
        $CI->load->model('admin/M_adminCommon');
        $cur_id =  $CI->M_adminCommon->getConfiguration('DEFAULT_CURRENCY')->configuration_value;
        $cookie = array(
            'name'   => 'cur_id',
            'value'  => $cur_id,
            'expire' => '86500'
        );
        $CI->input->set_cookie($cookie);
        return $cur_id;
    }
}

/*
function getDefaultCurrencyId()
{
    $CI =& get_instance();
    $CI->load->model('admin/M_adminCommon');
    $cur_id =  $CI->M_adminCommon->getConfiguration('DEFAULT_CURRENCY')->configuration_value;
    return $cur_id;
}

*/
function getCartContents()
{
    $CI =& get_instance();
    return $CI->cart->contents();

}

function getCartTotal()
{
    $CI =& get_instance();
    return $CI->cart->total();
}

function displaySidebarModules($modules)
{

}

function deleteCategory($cat_id)
{
    $CI =& get_instance();
    $CI->load->model('admin/M_categories_product');
    $query = "delete from categories where category_id = $cat_id";
    $CI->db->query($query);
    $query = "delete from categories_description where category_id = $cat_id";
    $CI->db->query($query);
    $products = $CI->M_categories_product->getAllProduct($cat_id);
    if(!empty($products))
    {
        foreach($products as $product)
        {
            deleteProduct($product->product_id);
        }

    }
}

function deleteProduct($product_id)
{
    $CI =& get_instance();
    $query = "delete from products where product_id = $product_id";
    $CI->db->query($query);
    $query = "delete from products_description where product_id = $product_id";
    $CI->db->query($query);
    $query = "delete from products_attributes where product_id = $product_id";
    $CI->db->query($query);
    $query = "delete from specials where product_id = $product_id";
    $CI->db->query($query);
    $query = "delete from reviews where product_id = $product_id";
    $CI->db->query($query);
    deleteAllProductImage($product_id);
}

function deleteAllProductImage($product_id)
{
    $imagePath = realpath(APPPATH."../images/products_images/");
    $CI =& get_instance();
    $CI->load->model('admin/M_product_figures');
    $figures = $CI->M_product_figures->getAllProductFigure($product_id);
    if(!empty($figures))
    {
        foreach($figures as $figure)
        {
            $file = $imagePath ."/". $figure->image_id ."." . $figure->image_ext;
            unlink($file);
            $CI->M_product_figures->deleteFigure($figure->image_id);
        }
    }
}

function getAllSubCat($cat_id)
{
    $CI =& get_instance();
    $CI->load->model('admin/M_categories_product');
    $sub_category = $CI->M_categories_product->getSubCategory($cat_id);
    if(!empty($sub_category))
    {
        foreach($sub_category as $sub_cat)
        {
            $sub_cat_id[] = $sub_cat->category_id;
            $this->getAllSubCat($sub_cat->category_id);
        }
        return $this->sub_cat_id;
    }

}


function displayNav($nav,$show_count)
{
    if($show_count)
    {
        $CI =& get_instance();
        $CI->load->model('admin/M_category');
        //$product_count = $CI->M_category->countProductPerCat();
    }
    $output = "";
    if(!empty($nav))
    {
        foreach($nav as $key => $value)
        {
            $array = explode("/",$key);
            $cat_id = end(explode("_",end($array)));
            if(is_array($value))
            {
                //{$CI->M_category->countProductPerCat(end('_',$array))}

                //print_r($array);
                $output .= "<li><a href=". base_url()."public/category/index/$array[1]".">".$array[0];
                if($show_count)
                {
                    $output .= " (".countProductPerCat($cat_id).")";
                }

                $output .= displayNav($value,$show_count)."</a></li>";
            }
            else
            {
                $output .= "<li><a href=". base_url()."public/category/index/$array[0]".">".$value;
                if($show_count)
                {
                    $output .= " (".countProductPerCat($cat_id).")";
                }

                $output .= "</a></li>";
            }

        }
    }

    return "<ul class='cat_menu'>".$output."</ul>";

}

function getConfigVal($config_val_title)
{
    $CI =& get_instance();
    $query = "select configuration_value from configuration where  configuration_title = '$config_val_title'";
    $q     = $CI->db->query($query);
    if($q->num_rows()>0)
    {

        $row = $q->row_array();
        if($row['configuration_value'] == "true")
        {
            return true;
        }
        if($row['configuration_value'] == "false")
        {
            return false;
        }
        else
        {
            return $row['configuration_value'];
        }

    }
}

function countProductPerCat($cat_id)
{
    $CI =& get_instance();
    $query = "select count(*) as product_count from products where category_id = $cat_id and date_available <= curdate() and product_status = 1";
    $q     = $CI->db->query($query);
    if($q->num_rows()>0)
    {
        $row = $q->row_array();
        return $row['product_count'];
    }
}

function getProductInfo($p_id)
{
    $CI =& get_instance();
    $query = "select product_name from products_description
                  where  product_id = $p_id and language_id = ".get_language_id();
    $q     = $CI->db->query($query);
    if($q->num_rows()>0)
    {
        $row = $q->row_array();
        return $row['product_name'];
    }
}

function getOptions($option_id,$opt_val_id)
{
    $CI =& get_instance();
    $query = "select product_option_name,product_option_value_name
                       from product_option_description, products_options_values
                       where product_option_value_id = $opt_val_id and product_option_description.product_option_id = $option_id
                       and product_option_description.language_id = ".get_language_id()." and products_options_values.language_id = ".get_language_id();

    $q     = $CI->db->query($query);
    if($q->num_rows()>0)
    {
        $row = $q->row_array();
        return $row;
    }
}

function get_price($orginal_price,$per_unit_price,$symbol,$symbol_position,$decimal_places,$decimal_point,$thousands_point)
{
    $value = $orginal_price * $per_unit_price;
    $value = number_format($value,$decimal_places,$decimal_point,$thousands_point);
    if($symbol_position == "L")
    {
        return $symbol . " " . $value;
    }
    else
    {
        return   $value . " " . $symbol;
    }
}

function getUserCurrencyInfo()
{
    $default_cur_id = get_currentcy_id();
    $CI =& get_instance();
    $CI->load->model('admin/m_currencies');
    return $CI->m_currencies->getById($default_cur_id);
}

