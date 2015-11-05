<?php
class Upload extends CI_Controller

{

function __construct()

{

parent::__construct();

$this->load->helper('form');

$this->load->helper('url');

}

function index()

{

$this->load->view('public/upload_view');

}

//Upload Image function

function uploadImage()

{

$config['upload_path']   =   "uploads/";

$config['allowed_types'] =   "gif|jpg|jpeg|png";

$config['max_size']      =   "5000";

$config['max_width']     =   "1907";

$config['max_height']    =   "1280";

$this->load->library('upload',$config);

if(!$this->upload->do_upload())

{

echo $this->upload->display_error();

}

else

{

$finfo=$this->upload->data();

$this->_createThumbnail($finfo['file_name']);

$data['uploadInfo'] = $finfo;

$data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];

$this->load->view('public/upload_success',$data);

// You can view content of the $finfo with the code block below

/*echo '<pre>';

           print_r($finfo);

           echo '</pre>';*/

}

}

//Create Thumbnail function

function _createThumbnail($filename)

{

$config['image_library']    = "gd2";

$config['source_image']     = "uploads/" .$filename;

$config['create_thumb']     = TRUE;

$config['maintain_ratio']   = TRUE;

$config['width'] = "80";

$config['height'] = "80";

$this->load->library('image_lib',$config);

if(!$this->image_lib->resize())

{

echo $this->image_lib->display_errors();

}

}

}

?>