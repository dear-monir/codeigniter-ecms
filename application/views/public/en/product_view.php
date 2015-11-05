<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 6/19/14
 * Time: 11:33 PM
 */
?>

<?php if($prev_next_nav_location == 'top' || $prev_next_nav_location == 'both'):
    echo $this->pagination->create_links();
endif;
?>
<table style="width: 100%" class="display-product">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Product Name</th>
        <th>Price($)</th>
        <th>Buy Now</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($products as $product):?>
        <tr>
            <td>
                <a href="<?php echo base_url()."public/product_info/index/{$product->product_id}";?>">
                    <img src="<?php echo base_url()."images/products_images/{$product->image_id}.{$product->image_ext}";?>">
                </a>

            </td>
            <td>
                <a href="<?php echo base_url()."public/product_info/index/{$product->product_id}";?>">
                    <?php echo $product->product_name;?>
                </a>
            </td>
            <td>
                <?php
                if (is_null($product->special_price))
                {
                    echo get_price(
                        $product->product_price,
                        $user_currency_info->value,
                        $user_currency_info->symbol,
                        $user_currency_info->symbol_position,
                        $user_currency_info->decimal_places,
                        $user_currency_info->decimal_point,
                        $user_currency_info->thousands_point

                    );
                }
                else
                {
                    $regular_price =  get_price(
                        $product->product_price,
                        $user_currency_info->value,
                        $user_currency_info->symbol,
                        $user_currency_info->symbol_position,
                        $user_currency_info->decimal_places,
                        $user_currency_info->decimal_point,
                        $user_currency_info->thousands_point

                    );
                    $special_price =  get_price(
                        $product->special_price,
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
            </td>
            <td>
                <a href="<?php echo base_url()."public/product_info/index/{$product->product_id}";?>">Buy Now</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php if($prev_next_nav_location == 'bottom' || $prev_next_nav_location == 'both'):
        echo $this->pagination->create_links();
    endif;
?>