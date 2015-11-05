<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 6/19/14
 * Time: 10:57 PM
 */
$this->load->model('admin/M_adminCommon');

$this->load->library('pagination');
$this->data['prev_next_nav_location'] = $this->M_adminCommon->getConfiguration('PREV_NEXT_NAV_LOCATION')->configuration_value;
$config['per_page'] = $this->M_adminCommon->getConfiguration('SHOW_PRODUCT_PER_PAGE')->configuration_value;
$config['next_link'] = '&gt;';
$config['prev_link'] = '&lt;';
$config['cur_tag_open'] = '<b>';
$config['cur_tag_close'] = '</b>';