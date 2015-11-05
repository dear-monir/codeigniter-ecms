<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currencies extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_currencies');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }

    }

    public function index()
    {
        $data ['currencies'] = $this->M_currencies->getAll();
        $default_currency_id = $this->M_adminCommon->getConfiguration('DEFAULT_CURRENCY')->configuration_value;
        $data ['action'] = "view";
        $data['default_currency_id'] = $default_currency_id;
        $this->load->view("admin/currencies",$data);
    }

    public function add()
    {
        if(isset($_POST['value']))
        {
            $data = array(
                'title' => $_POST['currency_title'],
                'code' => $_POST['currency_code'],
                'symbol' => $_POST['currency_symbol'],
                'symbol_position' => $_POST['symbol_position'],
                'value' => $_POST['value'],
                'decimal_point' => $_POST['decimal_point'],
                'thousands_point' => $_POST['thousand_point'],
                'decimal_places' => $_POST['decimal_places'],
            );
           $currency_id = $this->M_currencies->insert($data);
            if(isset($_POST['default_currency']) && $_POST['default_currency']== 'on')
            {
                if($currency_id)
                {
                    $this->M_adminCommon->setConfiguration('DEFAULT_CURRENCY',array('configuration_value'=>$currency_id));
                }
            }
            redirect("admin/currencies");
        }
        else
        {
            $data = array(
                'title'           => '',
                'code'            => '',
                'symbol'          => '',
                'symbol_position' => 'L',
                'value'           => 1.00000000,
                'decimal_point'   => '.',
                'thousands_point' => ',',
                'decimal_places'  => 2

            );
            $data ['action'] = "add";

            $this->load->view("admin/currencies",$data);
        }
    }

    public function edit()
    {
        $currency_id = (int)$this->uri->segment(4);
        if(isset($_POST['value']))
        {

            $data = array(
                'title' => $_POST['currency_title'],
                'code' => $_POST['currency_code'],
                'symbol' => $_POST['currency_symbol'],
                'symbol_position' => $_POST['symbol_position'],
                'value' => $_POST['value'],
                'decimal_point' => $_POST['decimal_point'],
                'thousands_point' => $_POST['thousand_point'],
                'decimal_places' => $_POST['decimal_places'],
            );
            $currency_id = $this->M_currencies->update($currency_id,$data);


            if(isset($_POST['default_currency']) && $_POST['default_currency']== 'on')
            {
                if($currency_id)
                {
                    $this->M_adminCommon->setConfiguration('DEFAULT_CURRENCY',array('configuration_value'=>$currency_id));
                }

            }
            redirect("admin/currencies");
        }
        else
        {
            $currency    = $this->M_currencies->getById($currency_id);
            $default_currency_id = $this->M_adminCommon->getConfiguration('DEFAULT_CURRENCY')->configuration_value;
            $data = array(
                'title'           => $currency->title,
                'code'            => $currency->code,
                'symbol'          => $currency->symbol,
                'symbol_position' => $currency->symbol_position,
                'value'           => $currency->value,
                'decimal_point'   => $currency->decimal_point,
                'thousands_point' => $currency->thousands_point,
                'decimal_places'  => $currency->decimal_places

            );
            $data ['action'] = "edit/$currency_id";
            $data['show_default_currency_option'] = ($default_currency_id == $currency_id)? false : true;
            $this->load->view("admin/currencies",$data);
        }


    }

    public function delete()
    {
        $currency_id = (int)$this->uri->segment(4);
        $this->M_currencies->delete($currency_id);
        redirect("admin/currencies");
    }


}
