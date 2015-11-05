<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/5/13
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */

class Text extends CI_Controller
{
    public function index(){
        echo anchor('blog/comments', 'Click Here');
        display_message();
    }
}