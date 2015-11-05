<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/19/13
 * Time: 11:27 AM
 * To change this template use File | Settings | File Templates.
 */
?>


    <?php if(!empty($sidebar_modules)):foreach($sidebar_modules as $module):
        $val = explode('_',$module->configuration_value);
        $is_display = $val[0];
        $column    = $val[1];
        $show_count = (bool)(getConfigVal("Show Category Counts"));
     ?>
        <?php if($is_display == "true" && $column == $column_field && $module->configuration_title == "Categories"):?>
            <div class="sidebar-box fix">
                <h4>Categories</h4>
                <?php if(isset($page) && $page == "category"):

                    echo displayNav($nav_cat,$show_count);
                 ?>
                <?php else:?>
                <ul class="cat_menu">
                    <?php if(isset($main_category)):foreach($main_category as $main_cat):?>
                        <li>
                            <a href="<?php echo base_url()."public/category/index/0_".$main_cat->category_id;?>">
                                <?php echo $main_cat->category_name;if($show_count){echo " (".countProductPerCat($main_cat->category_id).")";}?>
                            </a>
                        </li>
                    <?php endforeach;endif;?>
                </ul>
                <?php endif;?>

            </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Manufacturers"):?>
                <div class="sidebar-box fix">
                    <h4>Manufacturers</h4>
                    <select id="manu_fact_drop_down" class="full-width">
                        <option value="0">--Please Select One--</option>
                        <?php if(isset($manufacturers)):foreach($manufacturers as $manu_fact):?>
                            <option value="<?php echo $manu_fact->manufacturer_id;?>"
                                <?php if(isset($selected_manu_id) && $selected_manu_id == $manu_fact->manufacturer_id ){echo 'selected="selected"';} ?>
                                >
                                <?php echo $manu_fact->manufacturer_name;?>
                            </option>
                        <?php endforeach;endif;?>
                    </select>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Search"):?>
                <div class="sidebar-box fix">
                    <h4>Search</h4>
                    <form action="#" method="post">
                        <input type="text" class="full-width"/>
                        <p class="text-center">
                            <input type="submit" value="Quick Search"/>
                        </p>
                    </form>
                    Use keywords to find the product you are looking for.
                    <p class="text-center"><a href="#">Advance Search</a></p>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "What's New"):?>
                <div class="sidebar-box fix">
                    <h4>What's New?</h4>
                    <?php if(isset($whats_new)):foreach($whats_new as $what_new):?>
                        <figure>
                            <a href="<?php echo base_url()."public/product_info/index/$what_new->product_id";?>">
                                <img src="<?php echo base_url()."images/products_images/{$what_new->image_id}.{$what_new->image_ext}";?>"
                                     alt="<?php $what_new->product_name;?>"/>
                            </a>
                            <figcaption>
                                <a href="<?php echo base_url()."public/product_info/index/$what_new->product_id";?>">
                                    <?php echo $what_new->product_name;?>
                                </a>
                            </figcaption>
                        </figure>
                        <p class="text-center">
                            <a  href="<?php echo base_url()."public/new_products/index/0";?>">&lt;&lt;view all&gt;&gt;</a>
                        </p>
                    <?php endforeach;endif;?>

                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Information"):?>
                <div class="sidebar-box fix">
                    <h4>Information</h4>

                    <ul id="shop-info">
                        <li><a href="#">Delivery</a></li>
                        <li><a href="#">Legal Notice</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Secure Payment</a></li>
                        <li><a href="#">Our Store</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Shopping_cart"):?>
                <div class="sidebar-box fix">
                    <h4>Shopping Carts</h4>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Specials"):?>
                <div class="sidebar-box fix">
                    <h4>Specials</h4>

                    <figure>
                        <?php if(isset($special_products) && !is_null($special_products)):foreach($special_products as $special_product):?>
                            <a href="<?php echo base_url()."public/product_info/index/$special_product->product_id";?>">
                                <img src="<?php echo base_url()."images/products_images/{$special_product->image_id}.$special_product->image_ext";?>"
                                     alt=""/>
                            </a>

                        <figcaption>
                            <a href="<?php echo base_url()."public/product_info/index/$special_product->product_id";?>">
                            <?php echo $special_product->product_name;?></figcaption>
                        </a>
                    </figure>
                    <p class="text-center">
                        <?php $user_currency_info= getUserCurrencyInfo();?>
                        <s>
                            <?php //echo $special_product->special_price;
                                echo get_price(
                                    $special_product->product_price,
                                    $user_currency_info->value,
                                    $user_currency_info->symbol,
                                    $user_currency_info->symbol_position,
                                    $user_currency_info->decimal_places,
                                    $user_currency_info->decimal_point,
                                    $user_currency_info->thousands_point

                                );
                            ?>
                        </s>
                        <br/>
                            <span>
                               <?php //echo $special_product->product_price;

                               echo get_price(
                                   $special_product->special_price,
                                   $user_currency_info->value,
                                   $user_currency_info->symbol,
                                   $user_currency_info->symbol_position,
                                   $user_currency_info->decimal_places,
                                   $user_currency_info->decimal_point,
                                   $user_currency_info->thousands_point

                               );
                               ?>
                            </span>
                    </p>
                    <p class="text-center">
                        <a href="<?php echo base_url()."public/special_products/index/0";?>">&lt;&lt;view all&gt;&gt;</a>
                    </p>
                    <?php endforeach;endif;?>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Reviews"):?>
                <div class="sidebar-box fix">
                    <h4>Reviews</h4>

                    <?php if(isset($reviews)):foreach($reviews as $review):?>
                        <figure>
                            <img src="<?php echo base_url()."images/products_images/{$review->image_id}.$review->image_ext";?>"
                                 alt=""/>
                        </figure>
                        <p class="text-center"><?php echo $review->review_description;?></p>
                        <p class="review-rating-<?php echo $review->review_rating;?> ,text-center" ></p>
                    <?php endforeach;endif;?>

                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Language"):?>
                <div class="sidebar-box fix">
                    <h4>Language</h4>
                    <?php if(isset($languages)):foreach($languages as $lang):?>
                        <a href="<?php echo base_url()."public/Language/index/{$lang->language_id}/{$lang->code}";?>">
                            <img src="<?php echo base_url()."images/languages/{$lang->language_id}.{$lang->image_ext}";?>"
                                 alt="<?php $lang->name;?>" class="language"/>
                        </a>

                    <?php endforeach;endif;?>
                </div>
        <?php elseif($is_display == "true" && $column == $column_field && $module->configuration_title == "Currencies"):?>
            <div class="sidebar-box fix">
                <h4>Currencies</h4>
                <?php $user_currency_id = get_currentcy_id();?>
                <select id="currency_dropdown">
                    <?php if(isset($currencies)):foreach($currencies as $cur):?>
                     <option value="<?php echo $cur->currency_id;?>"
                         <?php if($cur->currency_id == $user_currency_id )
                                {
                                    echo 'selected = "selected"';
                                }?>
                     >
                         <?php echo $cur->title;?>
                     </option>
                    <?php endforeach;endif;?>
                </select>

            </div>
        <?php endif;?>

     <?php   endforeach;endif;?>

