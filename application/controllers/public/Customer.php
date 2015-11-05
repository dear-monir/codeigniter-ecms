<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR,Manoz
 * Date: 9/8/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

class Customer extends CI_Controller
{

    var $user_language;
    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->user_language = get_language();
        $this->load->model('public/M_common');
        $this->load->model('public/M_home');
        $this->load->model('public/M_customers');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function index()
    {
//
        //  if ($this->session->userdata('is_logged_in') === 1 && $this->session->userdata('active') === 1) {
        //  $this->account();
        // } else {
        $this->myAccount();
        // }

    }

    public function myAccount($message = '')
    {
        //echo 'you are logged in';
        $this->data['message'] = $message;
        $data = array(
            'message' => $message
        );
        if ($this->session->userdata('is_logged_in') === 1 && $this->session->userdata('active') === 1) {
            //$id = $this->session->userdata['customer_id'];
            // $email = $this->session->userdata['customer_email'];
            redirect(base_url('public/customer/account'));
        } else {
            require_once(APPPATH . "public_view.php");
            //get_message();
            $this->data['title'] = "Login/Sign in";
            $this->load->view("public/{$this->user_language}/header", $this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/login", $data);
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        }
    }

    public function account($message = '')
    {
        if ($this->session->userdata('is_logged_in') != 1) {
            //$this->myAccount();
            redirect(base_url('public/customer/myAccount'));
        } else {
            $data = array(
                'customer_id' => $this->session->userdata['customer_id'],
                'customer_email' => $this->session->userdata['customer_email']
            );
            $result = $this->M_customers->getCustomerInfo('customers', $data);
            if ($result != null) {
                $this->data['message'] = $message;
                require_once(APPPATH . "public_view.php");
                //get_message();
                // $this->data['title'] = $result['customers_firstname'];
                $this->load->view("public/{$this->user_language}/header", $this->data);
                $this->load->view("public/{$this->user_language}/left_sidebar");
                $this->load->view("public/{$this->user_language}/customers_account", $result);
                $this->load->view("public/{$this->user_language}/right_sidebar");
                $this->load->view("public/{$this->user_language}/footer");
            }
        }
    }

    public function signUp()
    {
        /**
         * Loads the customer registration page eg. customers_registration
         */
        // $is_logged_in=$this->session->userdata('is_logged_in');

        if (($this->session->userdata('is_logged_in')) !== 1) {
            $this->load->model('admin/m_country');
            $this->data['countries'] = $this->m_country->getAll();
            require_once(APPPATH . "public_view.php");
            //get_message();
            $this->data['title'] = "Registration";
            $this->load->view("public/{$this->user_language}/header", $this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/customers_registration");
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        } else if ($this->session->userdata('is_logged_in') === 1) {
            //$this->account();
            redirect(base_url('public/customer/account'));
        }

    }

    public function login()
    {
        if (($this->session->userdata('is_logged_in')) != 1) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|md5');
            if ($this->form_validation->run() == FALSE) {
                redirect(base_url('public/customer/index'));
            } else {
                $data = array(
                    'customer_email' => $this->input->post('email'),
                    'customer_password' => md5($this->input->post('password'))
                );

                $customers_info = $this->M_customers->customer_login_info('customers', $data);

                if ($customers_info != null) {
                    if ($customers_info['active'] != 1) {
                        $this->myAccount('You have not verify your email,Please go to your email and verify your email');
                    } else {
                        $data = array(
                            'logged_in' => 1
                        );
                        $customersId = $customers_info['customer_id'];
                        $update_login_info = $this->M_customers->update_customer_info($data, $customersId);
                        $sessionData = array(
                            'customer_id' => $customers_info['customer_id'],
                            'customer_email' => $customers_info['customer_email'],
                            'is_logged_in' => 1,
                            'active' => 1
                        );
                        $this->session->set_userdata($sessionData);
                        redirect(base_url('public/customer/account'));
                    }

                } else {
                    $this->myAccount('Your email/password combination didn\'t match');
                }

            }
        } else if ($this->session->userdata('is_logged_in') === 1) {
            $this->account();
            redirect(base_url('public/customer/account'));
        }
    }

    public function register_customer($key = NULL)
    {
        if ($key === NULL OR $key === '') {
            $this->myAccount('The query didn\'t have a valid key');
        } else {
            $data = array(
                'key' => $key
            );
            $result = $this->M_customers->confirm_key('customers', $data);

            $data['customer_id'] = $result['customer_id'];
            $data['customer_email'] = $result['customer_email'];
            $data['active'] = $result['active'];

            if ($result['active'] != 1) {
                if ($result != null && $result['key'] == $key) {
                    $active = $this->M_customers->activate_customer('customers', $data);
                    $sessionData = array(
                        'customer_id' => $result['customer_id'],
                        'customer_email' => $result['customer_email'],
                        'is_logged_in' => 0,
                        'active' => 0
                    );
                    $this->session->set_userdata($sessionData);
                    //$this->session->set_flashdata('message', 'Your account has been activated please login to your account');
                    //redirect('/public/customers/customer/account');
                    $this->myAccount('Your account has been activated please login to your account');
                } else {

                    $this->myAccount('The query didn\'t have a valid key');
                }
            } else {
                $this->myAccount('Your account have already activated please login to your account');
            }

        }

    }

    public function send_mail($email = '', $msg = '')
    {
        $email = $email;
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('manozcsejust@gmail.com', 'Manoz');
        $this->email->to($email);
        $this->email->subject('Conform Your account');
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

    public function validate_customer()
    {
        if (($this->session->userdata('is_logged_in')) !== 1) {

            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[customers.customer_email]');
            $this->form_validation->set_rules('company', 'Company Name', 'trim');
            $this->form_validation->set_rules('street', 'Street Name', 'required|trim');
            $this->form_validation->set_rules('suburb', 'Suburb Address', 'required|trim');
            $this->form_validation->set_rules('post', 'Post Code', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('state', 'State', 'required|trim');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
            $this->form_validation->set_rules('country', 'country', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conform_password]|md5');
            $this->form_validation->set_rules('conform_password', 'Password Confirmation', 'trim|required');

            $this->form_validation->set_message('is_unique', 'This email already exist ');
            if ($this->form_validation->run() == FALSE) {
                $this->signup();
            } else {
                $email = $this->input->post('email');
                $key = md5(uniqid());
                $data = array(
                    'customer_gender' => $this->input->post('gender'),
                    'customer_firstname' => $this->input->post('firstname'),
                    'customer_lastname' => $this->input->post('lastname'),
                    'customer_dob' => $this->input->post('dob'),
                    'customer_email' => $this->input->post('email'),
                    'customer_company' => $this->input->post('company'),
                    'customer_street' => $this->input->post('street'),
                    'customer_suburb' => $this->input->post('suburb'),
                    'customer_postcode' => $this->input->post('post'),
                    'customer_city' => $this->input->post('city'),
                    'customer_state_id' => $this->input->post('state'),
                    'customer_country_id' => $this->input->post('country'),
                    'customer_telephone_no' => $this->input->post('telephone'),
                    'customer_mobile_no' => $this->input->post('mobile'),
                    'customer_password' => md5($this->input->post('password')),
                    'logged_in' => 0,
                    'active' => 0,
                    'key' => $key
                );
                //print_r($data);
                $is_insert_id = $this->M_customers->insertCustomerInfo('customers', $data);
                if ($is_insert_id) {
                    $sessionData = array(
                        'customer_id' => $is_insert_id,
                        'customer_email' => $email,
                        'key' => $key,
                        'is_logged_in' => 0,
                        'active' => 0
                    );
                    $this->session->set_userdata($sessionData);

                    try {
                        $message = "<p>Thank You for signing up</p>";
                        $message .= "<p><a href='" . base_url() . "public/customer/register_customer/$key'>Click Here to active  your account</a></p>";

                        $is_mail_sent = $this->send_mail($email, $message);
                        if ($is_mail_sent) {
                            redirect(base_url('public/customer/verify_account/success'));
                        } else {
                            redirect(base_url('public/customer/verify_account/failure'));
                        }
                    } catch (Exception $ex) {
                        echo 'Email sending failed please try again letter';
                    }

                } else {
                    echo 'Something goes wrong';
                }
            }
        } else if ($this->session->userdata('is_logged_in') === 1) {
            $this->account();
            redirect(base_url('public/customer/account'));
        }
    }

    public function verify_account($confirm)
    {
        if ($confirm === 'success' OR $confirm === 'failure') {
            $customerId = $this->session->userdata['customer_id'];
            $email = $this->session->userdata['customer_email'];
            $data = array(
                'customer_id' => $customerId,
                'customer_email' => $email
            );
            $result = $this->M_customers->getCustomerInfo('customers', $data);
            if ($confirm === 'success') {
                if ($result != null) {
                    $data = array(
                        'message' => 'A email is sent to your email please check to validate your account',
                        'key' => $result['key']
                    );

                }
            } else {
                if ($result != null) {
                    $data = array(
                        'message' => "<p>Email sending failed </br><a target='_blank' href='" . base_url() . "public/customer/resend_mail'>Click Here to resend e-mail</a></p>",
                        'key' => $this->session->userdata['key']
                    );

                }
            }


            if (($this->session->userdata('is_logged_in') !== 1) && ($this->session->userdata('active') !== 1)) {
                require_once(APPPATH . "public_view.php");
                //get_message();
                $this->data['title'] = "Activate account";
                $this->load->view("public/{$this->user_language}/header", $this->data);
                $this->load->view("public/{$this->user_language}/left_sidebar");
                $this->load->view("public/{$this->user_language}/customers_home", $data);
                $this->load->view("public/{$this->user_language}/right_sidebar");
                $this->load->view("public/{$this->user_language}/footer");
            }
        } else {
            echo '404 error page not found';
        }
    }

    public function resend_mail()
    {
        $email = $this->session->userdata('email');
        $key = $this->session->userdata('key');
        $message = "<p>Thank You for signing up</p>";
        $message .= "<p><a href='" . base_url() . "public/customer/register_customer/$key'>Click Here to active  your account</a></p>";
        $this->send_mail($email, $message);
    }

    public function view_my_account()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {
            $where = array(
                'customer_id' => $this->session->userdata['customer_id'],
                'customer_email' => $this->session->userdata['customer_email']
            );
            $selected_data = 'customer_id,customer_gender,customer_firstname,customer_lastname,customer_dob,customer_email,customer_mobile_no';
            $result = $this->M_customers->get_customer_account_info($selected_data, $where);
            require_once(APPPATH . "public_view.php");
            //get_message();
            $this->data['title'] = "Change Information";
            $this->load->view("public/{$this->user_language}/header", $this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/customer_info_edit", $result);
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        }
    }

    public function change_my_account()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {

            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email]');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
            //$this->form_validation->set_message('is_unique', 'This email already exist ');
            if ($this->form_validation->run() == FALSE) {
                $this->view_my_account();
            } else {
                $data = array(
                    'customer_gender' => $this->input->post('gender'),
                    'customer_firstname' => $this->input->post('firstname'),
                    'customer_lastname' => $this->input->post('lastname'),
                    'customer_dob' => $this->input->post('dob'),
                    'customer_email' => $this->input->post('email'),
                    'customer_mobile_no' => $this->input->post('mobile'),

                );
                $customersId = $this->session->userdata['customer_id'];
                $message = 'Dear ' . $this->input->post('firstname') . ' Your os-commerce account has been updated';
                $is_mail_sent = $this->send_mail($this->input->post('email'), $message);
                if ($is_mail_sent) {
                    $result = $this->M_customers->update_customer_info($data, $customersId);
                    $this->account('Your account has been updated successfully ');
                } else {
                    $this->view_my_account();
                }
            }

        }
    }

    public function view_address_book()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {
            $where = array(
                'customer_id' => $this->session->userdata['customer_id'],
                'customer_email' => $this->session->userdata['customer_email']
            );
            $selected_data = 'customer_id,customer_company,customer_street,customer_suburb,customer_postcode,customer_city,customer_state_id,customer_country,customer_telephone_no';
            $result = $this->M_customers->get_customer_address_info($selected_data, $where);
            require_once(APPPATH . "public_view.php");
            //get_message();
            $this->data['title'] = "Change Information";
            $this->load->view("public/{$this->user_language}/header", $this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/customer_address_edit", $result);
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        }

    }

    public function change_address_book()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {

            $this->form_validation->set_rules('street', 'Street', 'required|trim');
            $this->form_validation->set_rules('suburb', 'Suburb', 'required|trim');
            $this->form_validation->set_rules('post', 'Post', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('state', 'state', 'trim|required');
            $this->form_validation->set_rules('country', 'country', 'required|trim');
            //$this->form_validation->set_message('is_unique', 'This email already exist ');
            if ($this->form_validation->run() == FALSE) {
                $this->view_address_book();
            } else {
                $data = array(
                    'customer_company' => $this->input->post('company'),
                    'customer_street' => $this->input->post('street'),
                    'customer_suburb' => $this->input->post('suburb'),
                    'customer_postcode' => $this->input->post('post'),
                    'customer_city' => $this->input->post('city'),
                    'customer_state' => $this->input->post('state'),
                    'customer_country' => $this->input->post('country'),
                    'customer_telephone_no' => $this->input->post('telephone'),

                );
                $customersId = $this->session->userdata['customer_id'];
                $message = 'Dear ' . ' Your address from os-commerce account has been updated';
                $is_mail_sent = $this->send_mail($this->session->userdata['customer_email'], $message);
                if ($is_mail_sent) {
                    $result = $this->M_customers->update_customer_info($data, $customersId);
                    $this->account('Your account has been updated successfully ');
                } else {
                    $this->view_address_book();
                }
            }

        }

    }

    public function view_password()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {
            $where = array(
                'customer_id' => $this->session->userdata['customer_id'],
                'customer_email' => $this->session->userdata['customer_email']
            );
            $result = $this->M_customers->getCustomerInfo('customers', $where);
            require_once(APPPATH . "public_view.php");
            //get_message();
            $this->data['title'] = "Change Information";
            $this->load->view("public/{$this->user_language}/header", $this->data);
            $this->load->view("public/{$this->user_language}/left_sidebar");
            $this->load->view("public/{$this->user_language}/customer_change_password", $result);
            $this->load->view("public/{$this->user_language}/right_sidebar");
            $this->load->view("public/{$this->user_language}/footer");
        }

    }

    public function validate_password($str)
    {
        $where = array(
            'customer_id' => $this->session->userdata['customer_id'],
            'customer_email' => $this->session->userdata['customer_email']
        );
        $result = $this->M_customers->getCustomerInfo('customers', $where);
        if (md5($str) !== $result['customer_password']) {
            $this->form_validation->set_message('validate_password', 'The current password you type didn\'t match to the existing password');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function change_password()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {


            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|md5|callback_validate_password');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|matches[conform_password]|md5');
            $this->form_validation->set_rules('conform_password', 'Conform Password', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $this->view_password();
            } else {

                $data = array(
                    'customer_password' => md5($this->input->post('new_password'))
                );
                $customersId = $this->session->userdata['customer_id'];
                $message = "Dear Your Password from os-commerce account has been changed to '" . $this->input->post('conform_password') . '\'';
                try {
                    $is_mail_sent = $this->send_mail($this->session->userdata['customer_email'], $message);
                    if ($is_mail_sent) {
                        $result = $this->M_customers->update_customer_info($data, $customersId);
                        $this->account('Your account has been updated successfully ');
                    } else {
                        $this->view_password();
                    }
                } catch (Exception $ex) {
                    echo 'Something problem to the server';
                }

            }

        }

    }

    public function logout()
    {
        if (($this->session->userdata('is_logged_in') === 1) && ($this->session->userdata('active') === 1)) {
            $customersId = $this->session->userdata['customer_id'];
            $data = array();
            $data = array(
                'logged_in' => 0
            );
            $update_login_info = $this->M_customers->update_customer_info($data, $customersId);
            $sessionData = array(
                'customer_id' => '',
                'customer_email' => '',
                'is_logged_in' => 0,
                'active' => 0
            );
//            $this->session->unset_userdata($sessionData);
            $this->session->sess_destroy();
            redirect(base_url('public/customer/index'));
        }
    }

    public function view_orders()
    {
        if($this->session->userdata['is_logged_in'] != 1)
        {
            redirect(base_url().'public/customer');
        }
        $customersId = $this->session->userdata['customer_id'];
        $this->load->model('admin/m_report');
        $this->data['order_info'] = $this->m_report->getCustomerOrder($customersId);
        require_once(APPPATH . "public_view.php");
        //get_message();
        $this->data['title'] = "Change Information";
        $this->load->view("public/{$this->user_language}/header", $this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/order");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

    public function order_details()
    {
        if($this->session->userdata['is_logged_in'] != 1)
        {
            redirect(base_url().'public/customer');
        }
        $this->load->model('admin/m_report');
        $order_id = $this->uri->segment(4);
        $this->data['order_info'] = $this->m_report->getById($order_id);
        $this->data['order_details'] = $this->m_report->details($order_id);
        $customer_id = $this->session->userdata['customer_id'];

        require_once(APPPATH . "public_view.php");

        $this->load->view("public/{$this->user_language}/header", $this->data);
        $this->load->view("public/{$this->user_language}/left_sidebar");
        $this->load->view("public/{$this->user_language}/order_details");
        $this->load->view("public/{$this->user_language}/right_sidebar");
        $this->load->view("public/{$this->user_language}/footer");
    }

}