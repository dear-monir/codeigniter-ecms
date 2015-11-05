
<?php
class Option_values extends CI_Controller
{
    var $data;
    var $option_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_products_options');
        $this->load->model('admin/M_language');
        $this->load->model('admin/M_option_values');
        $this->data['languages'] = $this->M_language->getAll();
        $this->data['options']   = $this->M_products_options->getAllOption();

        if($this->uri->segment(4) == false || $this->uri->segment(4) == 0)
        {
            if($this->data['options'])
            {
                foreach($this->data['options'] as $op)
                {
                    $this->option_id = $op->product_option_id;
                    break;
                }
            }
        }
       else
       {
           $this->option_id = $this->uri->segment(4);
       }
        $this->data['selected_option_id']  = $this->option_id;
        $this->data['options_values']   = $this->M_option_values->getAllOptionValues($this->option_id);
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }

    }

    public function index()
    {
        $this->data['action']  = "view";
        $this->load->view('admin/option_values',$this->data);
    }

    public function add()
    {
        $option_id = $this->uri->segment(4);
        $product_option_value_id = $this->M_option_values->insertOptionValue(array('product_option_id' => $option_id ));
        if( $this->data['languages'])
        {
            foreach($this->data['languages'] as $l)
            {
                $option_name = $_POST['option_'.$l->language_id];

                $opt_data = array(
                    'product_option_id'          => $option_id,
                    'language_id'                => $l->language_id,
                    'product_option_value_name'  => $option_name,
                    'product_option_value_id'    => $product_option_value_id
                );
                $this->M_option_values->insertOptionValues($opt_data);
            }
        }
        redirect("admin/option_values/index/$option_id");
    }

    public function edit()
    {
        $opt_id = $this->uri->segment(4);
        $option_value_id = $this->uri->segment(5);
        if(isset($_POST['submit']))
        {

            if( $this->data['languages'])
            {
                foreach($this->data['languages'] as $l)
                {
                    $option_name = $_POST['option_'.$l->language_id];
                    $opt_data = array(
                        'product_option_value_name'  =>  $option_name
                    );
                    $this->M_option_values->updateOptionValues($opt_data,$opt_id,$l->language_id,$option_value_id);
                }
            }
            redirect("admin/option_values/index/$opt_id");
        }
        else
        {
            $this->data['option_value_id'] = $option_value_id;
            $editable_option = $this->M_option_values->getAllOptionValues($opt_id,$option_value_id);
            if($editable_option)
            {
                foreach($editable_option as $e_p)
                {
                    $this->data['option_'.$e_p->product_option_id.'_'.$e_p->language_id] = $e_p->product_option_value_name;
                }
            }

            $this->data['action']  = "edit";
            $this->load->view('admin/option_values',$this->data);
           //print_r($this->data);
        }


    }

    public function delete()
    {
        $opt_id = $this->uri->segment(4);
        $opt_val_id = $this->uri->segment(5);
        $this->M_option_values->deleteOptionValue($opt_val_id);
        redirect("admin/option_values/index/$opt_id");
    }

}