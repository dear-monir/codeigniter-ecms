
<?php
class Products_attributes extends CI_Controller
{
    var $data;
    var $product_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_products_options');
        $this->load->model('admin/M_language');
        $this->load->model('admin/M_option_values');
        $this->load->model('admin/M_products_attributes');
        $this->data['languages'] = $this->M_language->getAll();
        $this->data['options']   = $this->M_products_options->getAllOption();
        $this->data['products']  = $this->M_products_attributes->getAllProduct();


        if($this->uri->segment(4) == false || $this->uri->segment(4) == 0)
        {
            if($this->data['products'])
            {
                foreach($this->data['products'] as $p)
                {
                    $this->option_id = $p->product_id;
					//redirect(base_url().'admin/products_attributes/index/'.$p->product_id);
                    break;
                }
            }
        }
        else
        {
            $this->product_id = $this->uri->segment(4);
        }
        $this->data['selected_product_id']  = $this->product_id;
        //$this->data['options_values']   = $this->M_option_values->getAllOptionValues($this->option_id);
        $this->data['product_attributes'] = $this->M_products_attributes->getAllAttribute($this->product_id);
        if($this->data['product_attributes'])
        {
            foreach($this->data['product_attributes'] as $p_a)
            {
                $info = $this->M_products_attributes->getAttributeInfo($p_a->product_option_id,$p_a->product_option_value_id);
                //print_r($info);
                foreach($info as $inf)
                {
                    $this->data['option_name_'.$p_a->prodcut_attribute_id] = $inf->product_option_name;
                    $this->data['option_value_'.$p_a->prodcut_attribute_id] = $inf->product_option_value_name;
                }

            }
        }

        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
		if($this->uri->segment(4) == 0)
		{
			redirect(base_url().'admin/products_attributes/index/'.$this->option_id);
		}
		else
		{
			$this->load->view('admin/products_attributes',$this->data);
		}
      
       //print_r($this->data['product_attributes']);
    }

    public function add()
    {
        $data = array(
            'product_option_id'           => $_POST['option'],
            'product_option_value_id'     => $_POST['option_name'],
            'product_id'                  => $this->product_id,
            'option_value_price '         => $_POST['option_price'],
            'price_prefix'                => $_POST['price_prefix']
        );
        $this->M_products_attributes->insertAttribute($data);
        redirect(base_url().'admin/products_attributes/index/'.$this->product_id);
    }

    public function edit()
    {
        $product_attr_id = $this->uri->segment(5);
        if(isset($_POST['option_price']) && isset($_POST['price_prefix']))
        {
            $data = array(
                'option_value_price '         => $_POST['option_price'],
                'price_prefix'                => $_POST['price_prefix']
            );
            $this->M_products_attributes->updateAttribute($product_attr_id,$data);
            redirect(base_url().'admin/products_attributes/index/'.$this->product_id);
        }
        else
        {
            $this->data['prodcut_attribute_id'] = $product_attr_id;
            $this->load->view('admin/products_attributes',$this->data);
        }

    }

    public function getAllOptionName()
    {

        $options = $this->M_option_values->getOptionValuesById($_POST['option_id'],$_POST['product_id']);
        if($options)
        {
            foreach($options as $op)
            {
               echo '<option value="'.$op->product_option_value_id.'">'.$op->product_option_value_name.'</option>';

            }
        }

    }

    public function delete()
    {
        $product_id = $this->uri->segment(4);
        $product_attr_id = $this->uri->segment(5);
        $this->M_products_attributes->deleteAttribute($product_attr_id);
        redirect(base_url().'admin/products_attributes/index/'.$this->product_id);
    }

}