<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 4:12 PM
 * To change this template use File | Settings | File Templates.
 */
//print_r($sidebar_modules);

$user_currency_info = getUserCurrencyInfo();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">

        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.10.1.custom.min.js"></script>
        <!-- fancyBox -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.fancybox.css?v=2.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.pack.js?v=2.0.5"></script>

        <!-- fancyBox button helpers -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.fancybox-buttons.css?v=2.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-buttons.js?v=2.0.5"></script>

        <!-- fancyBox thumbnail helpers -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.fancybox-thumbs.css?v=2.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-thumbs.js?v=2.0.5"></script>

        <script type="text/javascript" src="<?php echo base_url();?>js/jQAllRangeSliders-min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>css/iThing.css" type="text/css" />

        <link rel="stylesheet" href="<?php echo base_url();?>js/development-bundle/themes/ui-lightness/jquery.ui.theme.css">


        <script type="text/javascript">
            $(document).ready(function(){
                $(".fancybox-thumb").fancybox({
                    openEffect: 'elastic',
                    closeEffect: 'elastic',
                    prevEffect	: 'changeIn',
                    nextEffect	: 'changeIn',
                    helpers	: {
                        title	: {
                            type: 'outside'
                        },
                        thumbs	: {
                            width	: 50,
                            height	: 50
                        }
                    }
                });
            });
        </script>


        <script type="text/javascript" src="<?php echo base_url();?>js/public.js"></script>


    </head>
    <body>
        <div id="wrapper" class="fix">
            <div id="header" class="fix-float fix">
                <div id="shop-logo" class="fix float-left">
                    <a href="<?php echo base_url()."public/home/";?>">
                        <img src="<?php echo base_url()."images/store/logo.png";?>">
                    </a>
                </div>

                <div id="header-right" class="float-right fix">
                    <ul id="header-menu">
                        <li id="my-account"><a class="" href="<?php echo base_url() . "public/customer" ?>">My
                                Account</a>
                            <?php
                            if (isset($this->session->userdata['is_logged_in']) && $this->session->userdata['is_logged_in'] === 1 && isset($this->session->userdata['active']) && $this->session->userdata['active'] === 1) {

                                ?>
                                <ul class="" id="settings">
                                    <li><a href="<?php echo base_url()."public/customer/account"?>">Settings</a></li>
                                    <li><a href="<?php echo base_url()."public/customer/logout"?>">Log Off</a></li>
                                </ul>
                            <?php
                            }
                            ?>
                        </li>
                        <li id="cart-menu">
                            <a  href="<?php echo base_url()."public/view_cart/";?>">
                                Cart (
                                <span>
                                   <?php  if(empty($cart_contents)):
                                                echo "empty";
                                          else:
                                                $suffix = count($cart_contents) > 1 ? "s" : "";
                                                echo count($cart_contents) ." Product$suffix";
                                          endif;
                                   ?>
                                </span>
                                )
                            </a>
                            <ul class="" id="cart-contents">
                                <!--<li><a href='#home'>Home</a></li>
                                <li><a href='#about'>About</a></li>
                                <li><a href='#services'>Services</a></li>
                                <li><a href='#contact'>Contact</a></li>-->
                                <table style="width: 100%">
                                <?php  if(!empty($cart_contents)):foreach($cart_contents as $item):?>
                                        <li>
                                            <tr>
                                                <td valign="top">
                                                    <?php echo $item['qty']."x";?>
                                                </td>
                                                <td valign="top">
                                                    <b><?php echo getProductInfo($item['id']);//echo $item['name'];?></b>
                                                    <ul>
                                                        <?php if(!empty($item['options'])):foreach($item['options'] as $option => $option_val):?>
                                                            <li>
                                                                <?php
                                                                //$opt_val = explode('_',$option_val);
                                                                //echo $option.": ".$opt_val[0];

                                                                $opt_id = explode('_',$option);

                                                                $opt_val_id = explode('_',$option_val);
                                                                //echo $option .": " .$opt_val[0];
                                                                $row = getOptions($opt_id[1],$option_val[0]);
                                                                echo $row['product_option_name']." : ".$row['product_option_value_name'];
                                                                ?>
                                                            </li>
                                                        <?php endforeach;endif;?>
                                                </td>
                                                <td valign="top">
                                                   <?php
                                                        $price = $item['price'];
                                                        echo   get_price(
                                                            $price,
                                                           $user_currency_info->value,
                                                           $user_currency_info->symbol,
                                                           $user_currency_info->symbol_position,
                                                           $user_currency_info->decimal_places,
                                                           $user_currency_info->decimal_point,
                                                           $user_currency_info->thousands_point

                                                        );
                                                    ?>
                                                </td>
                                                <td valign="top">
                                                    <form action="<?php base_url()."public/cart/delete";?>" method="post" class="delete_item_form">
                                                        <input type="hidden" name="row_id" value="<?php echo $item['rowid'];?>"/>
                                                        <input type="submit" value="delete" class="delete-black hide-text"/>
                                                    </form>
                                                </td>
                                            </tr>
                                        </li>
                                <?php endforeach;endif;?>
                                    <tr>
                                        <td colspan="2" align="left">
                                            Total:&nbsp;
                                        </td>
                                        <td>

                                            <?php
                                                echo   get_price(
                                                    $total_price,
                                                    $user_currency_info->value,
                                                    $user_currency_info->symbol,
                                                    $user_currency_info->symbol_position,
                                                    $user_currency_info->decimal_places,
                                                    $user_currency_info->decimal_point,
                                                    $user_currency_info->thousands_point

                                                );
                                            ?>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">
                                            <a href="<?php echo base_url().'public/shipping/'?>">Check Out</a>
                                        </td>
                                    </tr>
                                </table>
                            </ul>
                        </li>
                    </ul>

                </div>
                <div></div>
            </div>
            <div id="content" class="fix fix-float">
