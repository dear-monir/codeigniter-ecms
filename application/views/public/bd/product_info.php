<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 3:31 PM
 * To change this template use File | Settings | File Templates.
 */
$count=0;
$user_currency_info = getUserCurrencyInfo();
foreach($product_info as $p_info)
{
    $product_price = $p_info->product_price;
    $special_price = $p_info->special_price;
    $product_description = $p_info->product_description;
    $product_model = $p_info->product_model;
    $product_name = $p_info->product_name;
}
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <div class="fix-float">

        <div id="product_image" class="float-left">
            <h3><?php echo $product_name;?></h3>
            <figure>
                <?php if (!empty($product_images)):foreach($product_images as $product_image):
                    $image = base_url()."images/products_images/{$product_image->image_id}.{$product_image->image_ext}";
                    $count++;
                 ?>
                    <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo $image;?>" <?php if($count >1){echo 'style="display:none;';}?>>
                        <img src="<?php echo $image;?>" alt="" />
                    </a>
                <?php endforeach;endif;?>
                <figcaption>Model:<?php echo $product_model;?></figcaption>
            </figure>
        </div>
        <div id="product_options" class="float-right">
           <!-- <p>Price:</p> -->
            <div>
                <h3>
                    <?php  //echo $product_price;
                    $regular_price =  get_price(
                            $product_price,
                            $user_currency_info->value,
                            $user_currency_info->symbol,
                            $user_currency_info->symbol_position,
                            $user_currency_info->decimal_places,
                            $user_currency_info->decimal_point,
                            $user_currency_info->thousands_point

                        );
                    if(is_null($special_price))
                    {
                        echo $regular_price;
                    }
                    else
                    {
                        $product_price = $special_price;

                        $special_price =  get_price(
                            $special_price,
                            $user_currency_info->value,
                            $user_currency_info->symbol,
                            $user_currency_info->symbol_position,
                            $user_currency_info->decimal_places,
                            $user_currency_info->decimal_point,
                            $user_currency_info->thousands_point

                        );
                        echo "<s>".$regular_price."</s>&nbsp;&nbsp;";
                        echo "<b>".$special_price."</b>";
                    }

                    ?>
                </h3>
                <?php if(count($product_options)>0):?><h4>Available Options</h4><?php endif;?>
                <form method="post" action="<?php echo base_url()."public/cart/index/{$product_id}";?>" name="product_info" id="product_info_form">
                    <input type="hidden" value="<?php echo $product_price;?>" name="product_price"/>
                    <input type="hidden" value="<?php echo $product_name;?>" name="product_name"/>
            </div>

            <table>
                <tbody>

            <?php if (!empty($product_options)):foreach($product_options as $p_opt):?>
                    <tr>

                        <td><?php echo $p_opt->product_option_name;?></td>
                        <td>
                            <select name="<?php echo /*$p_opt->product_option_id;*/ "option_".$p_opt->product_option_id;?>">
                                <?php if (!empty($option_values)):foreach($option_values as $opt_val):?>
                                    <?php
                                        if($opt_val->product_option_id == $p_opt->product_option_id):
                                            $option_value_price = get_price(
                                                $opt_val->option_value_price,
                                                $user_currency_info->value,
                                                $user_currency_info->symbol,
                                                $user_currency_info->symbol_position,
                                                $user_currency_info->decimal_places,
                                                $user_currency_info->decimal_point,
                                                $user_currency_info->thousands_point

                                            );
                                    ?>
                                    <option value="<?php echo "{$opt_val->product_option_value_id}_{$opt_val->price_prefix}{$opt_val->option_value_price}";//$opt_val->product_option_value_id;?>">
                                        <?php echo $opt_val->product_option_value_name."({$opt_val->price_prefix}{$option_value_price})";?>
                                    </option>
                                        <?php endif;?>
                                <?php endforeach;endif;?>
                            </select>
                        </td>
                    </tr>


            <?php endforeach;endif;?>
                <tr>
                    <td>
                        <a href="#">Back</a>
                    </td>
                    <td>
                        <input type="submit" value="Add To Cart" id="add_to_cart_btn"/>
                    </td>
                </tr>
                </tbody>
            </table>

            </form>
        </div>

    </div>

    <div id="product_description">
        <h3>Description:</h3>
        <?php echo $product_description;?>
    </div>
    <?php
    //print_r($product_info);
    //print_r($product_options);
   // print_r($option_values);
    //print_r($product_images);
    ?>
</div>