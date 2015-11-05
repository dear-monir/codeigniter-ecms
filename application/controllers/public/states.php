<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/4/14
 * Time: 11:27 AM
 */
class States extends CI_Controller
{
    public function index()
    {
        $country_id = $this->uri->segment(4);
        $this->load->model('admin/m_shipping_region');
        $states = $this->m_shipping_region->getByCountry($country_id);
        /*$options = '';
        foreach($states as $state)
        {
            $options.= '<option id="'.$state->id.'">'.$state->name.'</option>';
        }
        echo $options;*/
        echo json_encode($states);
    }
}