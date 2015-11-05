<?php $this->load->view('admin/header');?>

<div id="product_content">
    <?php
        if($action == 'add')
        {
            $action_url =  base_url().'admin/products/add/'.$parent_category;
        }
        else
        {
            $action_url = base_url()."admin/products/edit/$parent_category/$product_id";
        }
    ?>
    <form id="my_form" name="my_form" method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data" >
        <fieldset>
            <legend>Product Name:</legend>
            <?php if($languages): foreach($languages as $l):?>
                <p>
                    <?php echo $l->code;?>:
                    <input class="p_name" type="text" name="<?php echo 'product_'.$l->language_id ?>" value="<?php if($action == 'edit'){echo ${'product_'.$l->language_id};}?>"/>
                </p>
            <?php  endforeach;endif;?>
        </fieldset>

        <p>Product status:
            <input type="radio" name="product_status" <?php if($action =='edit' && $product_status == 1){echo "checked=\"true\"";}elseif($action !='edit'){echo "checked=\"true\"";}?>" value="1"/>In Stock
            <input type="radio" name="product_status" <?php if($action =='edit' && $product_status == 0){echo "checked=\"true\"";}?>" value="0"/>Out of  Stock
        </p>
        <p>Date Available:
            <input type="text" name="date_available" id="date_available"  readonly value="<?php if($action == 'edit'){echo $date_available;}?>"/>(YYYY/MM/DD)
        </p>
        <p>Product Manufacturer:
            <select name="manufacturer">
                <option value="0">--none--</option>
                <?php if($manufacturers): foreach($manufacturers as $mf):?>
                    <option <?php if($action=='edit' && $mf->manufacturer_id== $manufacturer_id){echo 'selected="selected"';} ?>value="<?php echo $mf->manufacturer_id;?>" ><?php echo $mf->manufacturer_name;?></option>
                <?php endforeach;endif;?>
            </select>
        </p>
        <p>Tax Class:

            <select name="tax_class">
                <option value="0">--none--</option>
                <?php if($taxclasses): foreach($taxclasses as $tc):?>
                    <option value="<?php echo $tc->tax_class_id; ?>" <?php if($action=='edit' && $tc->tax_class_id == $tax_class_id){echo 'selected="selected"';} ?> ><?php echo $tc->tax_class_title;?></option>
                <?php endforeach;endif;?>
            </select>
        </p>
        <p>
            Product Price:
            <input id="product_price" type="text" name="product_price" value="<?php if($action == 'edit'){echo $product_price;}?>"/>
        </p>
        <fieldset>
            <legend>Product Description:</legend>
            <?php if($languages): foreach($languages as $l):?>
                <p>
                    <?php echo $l->code;?>: <textarea name="<?php echo 'description_'.$l->language_id ?>" rows="11" cols="50" class="product-description">
                        <?php
                        if($action == 'edit')
                        {
                            echo ${'description_'.$l->language_id};
                        }
                        ?>
                    </textarea>
                </p>
            <?php  endforeach;endif;?>
        </fieldset>


        <p>
            Product Quantity:
            <input type="text" id="product_quantity" name="product_quantity" value="<?php if($action == 'edit'){echo $product_quantity;}?>"/>
        </p>

        <p>
            Product Model:
            <input type="text" name="product_model" value="<?php if($action == 'edit'){echo $product_model;}?>"/>
        </p>

        <p>
            Product Weight
            <input type="text" name="product_weight" value="<?php if($action == 'edit'){echo $product_weight;}?>"/>
        </p>
        <p>
            <a class="button" id="submit_button">Save</a>
            <a class="button" href="<?php echo  base_url().'admin/categories_products/index/'.$parent_category?>" >Cancel</a>
        </p>
    </form>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 1 });
        $('#date_available').datepicker({ dateFormat: 'yy-mm-dd' });

        $("#my_form").validity(function() {
            $(".p_name").require()
                        .minLength(3, "Must contain at least 3 character.");
            $("#date_available").require();
            $("#product_price").require()
                               .match(/^[0-9]*\.?[0-9]*$/, "Price must be a value.");
            $("#product_quantity").require()
                                  .match('integer');
            $(".product-description").require()
                                     .minLength(3, "Must contain at least 15 character.");
        });
    });

</script>
</body>
</html>