<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/6/14
 * Time: 9:35 PM
 */

class Report  extends CI_Controller
{
    var $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_report');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }
    public function pending()
    {
        $this->data['status_type']='Pending';
        $this->data['orders'] = $this->m_report->getAllOrder(1);
        $this->load->view('admin/report',$this->data);
    }

    public function delivered()
    {
        $this->data['status_type']='Delivered';
        $this->data['orders'] = $this->m_report->getAllOrder(2);
        $this->load->view('admin/report',$this->data);
    }

    public function details()
    {
        $this->load->model('public/m_customers');
        $order_id = $this->uri->segment(4);
        $this->data['order_info'] = $this->m_report->getById($order_id);
        $this->data['order_details'] = $this->m_report->details($order_id);
        $customer_id = $this->data['order_info']->customer_id;
        $this->data['customer_info'] = $this->m_customers->getById($customer_id);
        $this->load->view('admin/report_details',$this->data);
    }

    public function update_status()
    {
        $order_id = $this->uri->segment(4);
        if(isset($_POST['status']))
        {
            $status = $_POST['status'];
            $this->m_report->update_order(array('status' => $status),$order_id);
            if($status == 2)
            {
                $action = 'delivered';
            }
            else
            {
                $action = 'pending';
            }
            redirect(base_url().'admin/report/'.$action.'/'.$status);
        }
    }
} 