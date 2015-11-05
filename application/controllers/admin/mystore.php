<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/27/13
 * Time: 7:35 PM
 * To change this template use File | Settings | File Templates.
 */
class Mystore extends CI_Controller {

    /** Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_mystore');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
        $data['rows'] = $this->M_mystore->getAll(1);
        $data['action'] = "view";
        $this->load->view('admin/mystore',$data);
    }

    public function edit()
    {
        if($_POST)
        {
            $config_id = $this->uri->segment(4);
            $data = array();
            foreach($_POST as $key=>$value)
            {
                $data[$key] = $value;
            }
            $this->M_mystore->update($data,$config_id);
            redirect("admin/mystore/index/");
            //redirect($_SERVER['HTTP_REFERER']);

        }
        else
        {
            $config_id = $this->uri->segment(4);
            $data['rows'] = $this->M_mystore->getById($config_id);
            $data['action'] = "edit";
            $data['config_id'] = $config_id;
            $this->load->view('admin/mystore',$data);
        }

    }

}
