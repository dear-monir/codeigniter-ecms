<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 10:09 PM
 * To change this template use File | Settings | File Templates.
 */


class M_common extends CI_Model
{
    var $user_language;
    var $user_language_id;
    var $user_currency_id;
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
        $this->user_language = get_language();
        $this->user_language_id = get_language_id();

    }

    public function getAllCategory($id=0)
    {
        $query = "select categories.category_id as category_id,category_name
                  from categories,categories_description
                  where categories.category_id = categories_description.category_id and
                        language_id = {$this->user_language_id}";
        if($id == 0)
        {
            $query .= " and parent_id = 0 order by category_name";
        }
        else
        {
            $query .= " and parent_id = {$id} order by category_name";
        }

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function getAllManufacturer($id=0)
    {
        $query = "select manufacturer_id,manufacturer_name
                  from manufacturers";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function whatsnew()
    {
        $query = "select products.product_id as product_id,product_name,image_id,image_ext
                  from products,products_description,products_images
                  where products.product_id = products_description.product_id and language_id = {$this->user_language_id} and
                        products.product_id = products_images.product_id
                  order by rand() limit 1";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function getAllLanguage()
    {
        $query = "select language_id,name,image_ext,code
                  from languages order by sort_order";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function getAllCurrencies()
    {
        $query = "select * from currencies";
        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function getAllSpecialProduct($limit=1,$offset=0)
    {
        $query = " select tbl1.product_id,product_price,special_price,product_name,image_id,image_ext
                   from
                        (
                          select products_description.product_id as product_id,special_price,product_name,product_price
                          from products_description,specials,products
                          where specials.product_id = products_description.product_id and products_description.language_id = {$this->user_language_id}
                          and specials.product_id = products.product_id and  (expire_date > now() or expire_date = '0000-00-00') and status = 1
                        ) as tbl1

                    left join

                    (
                      select products_images.product_id as product_id,min(image_id)as image_id,image_ext
                      from products_images, specials
                      where products_images.product_id = specials.product_id
                      group by product_id
                    ) as tbl2

                    on tbl1.product_id = tbl2.product_id ";
        if($limit == 1)
        {
            $query .= " order by rand() ";
        }
        $query .= " limit $offset,$limit";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function count_special_product()
    {
        $query = "SELECT count(*)as count FROM products,specials WHERE product_status = 1 and  date_available <= curdate() and products.product_id = specials.product_id and (expire_date > now() or expire_date = '0000-00-00') and status = 1";
        $q = $this->db->query($query);
        //print_r($q);
        if($q->num_rows()>0)
        {
            foreach($q->result_array() as $row)
            {
                return $row['count'];
            }
        }
    }

    public function getAllReview($id=0,$limit=1,$offset=0)
    {
        $query = "select review_id,tbl1.product_id as product_id,customer_id,review_rating,date_added,review_description,image_id,image_ext
                  from
                    (
                      select reviews.review_id as review_id,product_id,customer_id, review_rating, date_added,  review_description
                      from reviews,reviews_description
                      where reviews.review_id = reviews_description.review_id and language_id =  {$this->user_language_id}
                     ) as tbl1

                  left join

                  (
                    select reviews.product_id as product_id,min(image_id)as image_id,image_ext
                    from products_images, reviews
                    where products_images.product_id = reviews.product_id
                    group by product_id
                   ) as tbl2
                  on tbl1.product_id = tbl2.product_id";
         if($id != 0)
          {
                $query .= " and product_id = $id  order by rand()  ";
          }

        $query .= " limit $offset,$limit";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getSidebarModules($group_id=0)
    {
        $query = "select * from configuration
                  where configuration_group_id = $group_id
                  order by sort_order";
        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getCatById($id)
    {
        $query = "select * from categories_description where language_id ={$this->user_language_id}  and category_id = ?";
        $q     = $this->db->query($query,$id);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

}