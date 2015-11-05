
<?php
class Specials extends CI_Controller
{
    var $data;
    var $product_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_specials');
        $this->load->model('admin/M_products');

        if($this->uri->segment(4))
        {
            $this->data['special_products'] = $this->M_specials->getAllSpecialProduct($this->uri->segment(4));
            $this->data['products']  = $this->M_specials->getAllProduct($this->uri->segment(4));
            $this->data['selected_product_id'] = $this->uri->segment(4);
        }
        else
        {
            $this->data['special_products'] = $this->M_specials->getAllSpecialProduct();
            $this->data['products']  = $this->M_specials->getAllProduct();
        }
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }

    }

    public function index()
    {
        $this->data['action'] = 'view';
        $this->load->view('admin/specials',$this->data);
    }

    public function add()
    {
       $this->data['action'] = 'add';
       if(isset($_POST['selected_product_id']))
       {
           $data = array(
               'product_id' => $_POST['selected_product_id'],
               'special_price' => $this->calSpecialPrice(trim($_POST['special_price']),$_POST['selected_product_id']),
               'expire_date'    => $_POST['expire_date'],
               'status'         => $_POST['status']
           );
           $this->M_specials->insertSpecialProduct($data);
           redirect(base_url().'admin/specials/');
       }
        $this->load->view('admin/specials',$this->data);
    }

    public function edit()
    {
        if(isset($_POST['special_price']))
        {
            $data = array(
                'special_price' => $this->calSpecialPrice(trim($_POST['special_price']),$this->uri->segment(4)),
                'expire_date'    => $_POST['expire_date'],
                'status'         => $_POST['status']
            );
            $this->M_specials->editSpecial($this->uri->segment(4),$data);
            redirect(base_url().'admin/specials/');
            //print_r($data);
        }
        else
        {
            $this->data['action'] = 'edit';
            if($this->data['special_products'])
            {
                foreach($this->data['special_products'] as $s_p)
                {
                    $this->data['special_price'] = $s_p->special_price;
                    $this->data['expire_date'] = $s_p->expire_date;
                    $this->data['status'] = $s_p->status;
                }
            }
            $this->load->view('admin/specials',$this->data);
        }

    }

    public function delete()
    {
        $this->M_specials->deleteSpecial($this->uri->segment(4));
        redirect(base_url().'admin/specials/');
    }

    protected function calSpecialPrice($special_price,$product_id)
    {
        if(preg_match('/^\d+\%$/',$special_price))
        {
            $price = preg_replace('/%/','',$special_price);
            $old_price = 0;
            $product_info = $this->M_products->getById($product_id);
            foreach($product_info as $p_i)
            {
                $old_price  = $p_i->product_price;
                return $old_price * (1 - $price / 100);
            }

        }
        else
        {
            return $special_price;
        }
    }
}