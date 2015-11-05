
<?php
  class Products extends CI_Controller {

    var $path;
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->path = realpath(APPPATH."../images/products/");
        $this->load->model('admin/M_manufacturer');
        $this->load->model('admin/M_tax_class');
        $this->load->model('admin/M_language');
        $this->load->model('admin/M_products');


        $this->data['manufacturers'] = $this->M_manufacturer->getAll();
        $this->data['taxclasses'] = $this->M_tax_class->getAll();
        $this->data['languages'] = $this->M_language->getAll();
        $this->data['parent_category'] = $this->uri->segment(4);
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }

    }

      public function add()
      {

          if(isset($_POST['product_quantity'],$_POST['product_price']))
          {
                      $cat_id = $this->uri->segment(4);
                      $data = array(
                          'category_id'      => $cat_id,
                          'product_quantity' => $_POST['product_quantity'],
                          'product_model'    => $_POST['product_model'],
                          'product_price'    => $_POST['product_price'],
                          'date_available'   => $_POST['date_available'],
                          'product_weight'   => $_POST['product_weight'],
                          'product_status'   => $_POST['product_status'],
                          'tax_class_id'     => $_POST['tax_class'],
                          'manufacturer_id'  => $_POST['manufacturer']
                      );
                      $product_id = $this->M_products->insertProduct($data);
                      //redirect('admin/manufacturer');

                      if($this->data['languages'])
                      {
                          foreach($this->data['languages'] as $l)
                          {
                              $pro_des = array(
                                  'product_id'              => $product_id,
                                  'language_id'             => $l->language_id,
                                  'product_name'            => $_POST['product_'.$l->language_id],
                                  'product_description'     => $_POST['description_'.$l->language_id]
                              );
                              $this->M_products->insertProductDescription($pro_des);
                          }
                      }

                  //print_r($data);
              redirect(base_url("admin/categories_products/index/$cat_id"));
              //redirect($_SERVER['HTTP_REFERER']);
          }
          else
          {
                $this->data['action'] = 'add';
                $product_id = $this->uri->segment(5);
                $this->data['product_id'] = $product_id;
                $this->load->view('admin/products',$this->data);
          }

      }

      public function edit()
      {
          if(isset($_POST['product_quantity'],$_POST['product_price']))
          {
              $product_id = $this->uri->segment(5);
              $cat_id     = $this->uri->segment(4);
              $data = array(
                  'product_quantity' => $_POST['product_quantity'],
                  'product_model'    => $_POST['product_model'],
                  'product_price'    => $_POST['product_price'],
                  'date_available'   => $_POST['date_available'],
                  'product_weight'   => $_POST['product_weight'],
                  'product_status'   => $_POST['product_status'],
                  'tax_class_id'     => $_POST['tax_class'],
                  'manufacturer_id'  => $_POST['manufacturer']
              );
              if($_POST['date_available'] =="")
              {
                  unset($data[3]);
              }
              $this->M_products->updateProduct($product_id,$data);
              if($this->data['languages'])
              {
                  foreach($this->data['languages'] as $l)
                  {
                      $pro_des = array(
                          'product_name'           => $_POST['product_'.$l->language_id],
                          'product_description'    => $_POST['description_'.$l->language_id]
                      );
                      $language_id = $l->language_id;
                      $this->M_products->updateProductDescription($pro_des,$product_id,$language_id);
                  }
              }
              redirect("admin/categories_products/index/$cat_id");
              //redirect($_SERVER['HTTP_REFERER']);
          }
          else
          {
              $this->data['action'] = 'edit';
              $product_id = $this->uri->segment(5);
              $this->data['product_id'] = $product_id;
              $this->load->model('admin/M_products');
              $product_info = $this->M_products->getById($product_id);
              $product_des = $this->M_products->getProductDescription($product_id);

              if($product_des)
              {
                  foreach($product_des as $p_d)
                  {
                      $this->data['product_'.$p_d->language_id] = $p_d->product_name;
                      $this->data['description_'.$p_d->language_id] = $p_d->product_description;
                  }
              }
              if($product_info)
              {
                  foreach($product_info as $p_f)
                  {
                      $this->data['product_quantity'] = $p_f->product_quantity;
                      $this->data['product_weight'] = $p_f->product_weight;
                      $this->data['date_available'] = $p_f->date_available;
                      $this->data['product_price'] = $p_f->product_price;
                      $this->data['manufacturer_id'] = $p_f->manufacturer_id;
                      $this->data['tax_class_id'] = $p_f->tax_class_id;
                      $this->data['product_model'] = $p_f->product_model;
                      if($p_f->product_status == 1)
                      {
                          $this->data['product_status'] = true;
                      }
                      else
                      {
                          $this->data['product_status'] = false;
                      }

                  }
              }
              $this->load->view('admin/products',$this->data);

          }

      }

      public function delete()
      {
          $product_id = $this->uri->segment(5);
          deleteProduct($product_id);
          redirect($_SERVER['HTTP_REFERER']);
      }

  }