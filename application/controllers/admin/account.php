<?php
class Account extends CI_Controller
{

    var $data;

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/M_mystore');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('admin/M_account');
    }

    public function index()
    {
        $this->login();
    }

    public function login($message = '')
    {
        if ($this->session->userdata('admin_logged_in') === 1) {
            redirect(base_url('admin/account/dashboard'));
        } else {
            $data['message'] = $message;
            $this->data['title'] = 'Admin Login';
            $this->load->view('admin/head', $this->data);
            $this->load->view('admin/login', $data);
            $this->load->view('admin/footer');
        }

    }

    public function validate_credential()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|md5');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            $result = $this->M_account->get_admin_login_info($data);
            // print_r($result);
            if ($result != NULL) {
                $sessionData = array(
                    'admin_logged_in' => 1,
                    'email' => $result['email'],
                    'first_name' => $result['first_name']

                );
                $this->session->set_userdata($sessionData);
                redirect(base_url('admin/account/dashboard'));
            } else {
                $this->login('Sorry your credential didn\'t match');
            }

        }
    }

    public function dashboard()
    {
        if ($this->session->userdata('admin_logged_in') === 1) {
            redirect(base_url("admin/mystore/index/"));
        } else {
            redirect(base_url('admin/account/login'));
        }

    }


    public function verify_email()
    {

        if ($this->session->userdata('admin_logged_in') !== 1) {
            $this->data['title'] = 'Retrieve Password';
            $this->load->view('admin/head', $this->data);
            $this->load->view('admin/verify_email');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url("admin/mystore/index/"));
        }
    }

    public function send_mail($email = '', $msg = '')
    {
        $email = $email;
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('manozcsejust@gmail.com', 'Manoz');
        $this->email->to($email);
        $this->email->subject('Verification your email to os_commerce');
        $message = $msg;
        $this->email->message($message);
        try {
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $ex) {
            echo 'There may be some problem to connect your email';
        }


    }

    public function validate_email($str)
    {
        $where = array(
            'email' => $str
        );
        $result = $this->M_account->check_email_exist($where);
        if ($result != NULL) {
            return TRUE;
        } else {

            $this->form_validation->set_message('validate_email', 'The email didn\'t exist');
            return FALSE;
        }
    }

    public function validate_key($key)
    {
        $where = array(
            'email_key' => $key
        );
        $result = $this->M_account->check_key_exist($where);
        if ($result != NULL) {
            return TRUE;
        } else {

            $this->form_validation->set_message('validate_key', 'The key did not match please copy the key from your email that have been send');
            return FALSE;
        }
    }

    public function update_password()
    {
        $this->form_validation->set_rules('key', 'Key', 'trim|required|callback_validate_key');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]|md5');
        $this->form_validation->set_rules('cpassword', 'Conform Password', 'required|md5');
        if ($this->form_validation->run() == FALSE) {
            $this->retrieve_password();
        } else {
            $data = array(
                'password' => $this->input->post('password')
            );
            $where=array(
                'email_key'=>$this->input->post('key')
            );
            $update = $this->M_account->update_data($data, $where);
            if($update){
                $this->login('Your password has been changed please login to access your dashboard');
            }
        }
    }

    public function retrieve_password($key = '')
    {
        $data['key'] = $key;
        $this->data['message']=$this->session->flashdata('message');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            $this->data['title'] = 'Retrieve Password';
            $this->load->view('admin/head', $this->data);
            $this->load->view('admin/retrieve_password', $data);
            $this->load->view('admin/footer');
        } else {
            redirect(base_url("admin/mystore/index/"));
        }
    }

    public function check_email_exist()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_validate_email');
        if ($this->form_validation->run() == FALSE) {
            $this->verify_email();
        } else {

            $email = $this->input->post('email');
            $key = md5($email . time());
            $message = "<p>Copy this key and : $key  </br</br>or <a href='" . base_url() . "admin/account/retrieve_password/$key'>Click Here to reset your account password</a></p>";
            $is_mail_send = $this->send_mail($email, $message);
            if ($is_mail_send) {
                $data = array(
                    'email_key' => $key
                );
                $where = array(
                    'email' => $email
                );
                $update = $this->M_account->update_data($data, $where);
                $this->session->set_flashdata('message', 'A key is sent to your email </br>Please copy the key from your email and past it to the key field');
                redirect(base_url("admin/account/retrieve_password/"));
            }

        }
    }
    public function logout()
    {
        if ($this->session->userdata('admin_logged_in') === 1) {

            $sessionData = array(
                'admin_logged_in' => 0,
                'email' => '',
                'first_name' =>''
            );
            $this->session->unset_userdata($sessionData);
            redirect(base_url('admin/account/login'));
        }
    }

}