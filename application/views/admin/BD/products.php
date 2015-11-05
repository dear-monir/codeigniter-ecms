<!DOCTYPE html5>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/a_style.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#adminmenu').accordion({fillSpace : false,active : 1 });
            $('#date_available').datepicker({ dateFormat: 'yy-mm-dd' });
        });

    </script>
</head>
<body>
<div id="adminmenu">
    <h3>Configuration</h3>
    <div>

    </div>

    <h3>Catalog</h3>
    <div>
        <li><a href="<?php echo base_url().'admin/categories_products/index/0';?>">Categories/Products</a></li>
        <li><a href="<?php echo base_url().'admin/products_options/index/0';?>">Products Options</a></li>
        <li><a href="<?php echo base_url().'admin/option_values/index/0';?>">Products Options Values</a></li>
        <li><a href="<?php echo base_url().'admin/products_attributes/index/0';?>">Products Attributes</a></li>
        <li><a href="<?php echo base_url().'admin/product_figures/index/0';?>">Products Figures</a></li>
        <li><a href="<?php echo base_url().'admin/manufacturer';?>">Manufacturers</a></li>
        <li><a href="">Reviews</a></li>
        <li><a href="">Specials</a></li>
        <li><a href="">Products Expected</a></li>
    </div>

    <h3>Modules</h3>
    <div>
    </div>

    <h3>Customers</h3>
    <div>
    </div>

    <h3>Location/Taxes</h3>
    <div>
        <li><a href="<?php echo base_url().'admin/country';?>">Countries</a></li>
        <li><a href="<?php echo base_url().'admin/tax_class';?>">Tax Classes</a></li>
        <li><a href="<?php echo base_url().'admin/tax_rate';?>">Tax Rates</a></li>
    </div>

    <h3>Localization</h3>
    <div>
        <li><a href="<?php echo base_url().'admin/language';?>">Languages</a></li>
        <li><a href="<?php echo base_url().'admin/categories_products/index/0';?>">Currencies</a></li>
    </div>
    <h3>Reports</h3>
    <div>
    </div>
    <h3>Tools</h3>
    <div>
    </div>

</div>

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
                    <input type="text" name="<?php echo 'product_'.$l->language_id ?>" value="<?php if($action == 'edit'){echo ${'product_'.$l->language_id};}?>"/>
                </p>
            <?php  endforeach;endif;?>
        </fieldset>

        <p>Product status:
            <input type="radio" name="product_status" checked="<?php if($action =='edit' && $product_status == true){echo true;}?>" value="1"/>In Stock
            <input type="radio" name="product_status" checked="<?php if($action =='edit' && $product_status == true){echo true;}?>" value="0"/>Out of  Stock
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
            <input type="text" name="product_price" value="<?php if($action == 'edit'){echo $product_price;}?>"/>
        </p>
        <fieldset>
            <legend>Product Description:</legend>
            <?php if($languages): foreach($languages as $l):?>
                <p>
                    <?php echo $l->code;?>: <textarea name="<?php echo 'description_'.$l->language_id ?>" rows="11" cols="50">
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
            <input type="text" name="product_quantity" value="<?php if($action == 'edit'){echo $product_quantity;}?>"/>
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

</body>
</html>