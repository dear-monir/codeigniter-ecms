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

<div id="content">
    <div>
        <div id="option_column">
            <h2>Product Option</h2>
            <table>
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Option Name</td>
                    <td>
                        Action
                    </td>
                </tr>
                </thead>
                <?php if($options):foreach($options as $op):
                    if(isset($option_id) && $option_id == $op->product_option_id){
                 ?>
                        <form action="#" method="post">
                            <tr>
                                <td><?php echo $op->product_option_id;?></td>
                                <td>
                                    <?php if($languages):foreach($languages as $l):?>
                                        <?php echo $l->code;?>:
                                        <input type="text" name="<?php echo 'option_'.$l->language_id;?>" value="<?php echo ${'option_'.$op->product_option_id.'_'.$l->language_id};?>"/>
                                        <br/>
                                    <?php endforeach; endif;?>
                                </td>
                                <td>
                                    <input type="submit" name="submit" class="button" value="Save"/>
                                    <a class="button" href="<?php echo base_url().'admin/products_options/index';?>">Cancel</a>
                                </td>
                            </tr>
                        </form>
                  <?php }else{?>
                    <tr>
                        <td><?php echo $op->product_option_id;?></td>
                        <td><?php echo $op->product_option_name;?></td>
                        <td>
                            <a class="button" href="<?php echo base_url().'admin/products_options/edit/'.$op->product_option_id;?>">Edit</a>
                            <a class="button">Delete</a>
                        </td>

                    </tr>
                <?php }endforeach;endif;?>
                <tr>
                    <form action="<?php echo base_url().'admin/products_options/add';?>" method="post" id="my_form">
                        <td></td>
                        <td>
                            <?php if($languages):foreach($languages as $l):?>
                                <?php echo $l->code;?>: <input type="text" name="<?php echo 'option_'.$l->language_id;?>"/><br/>
                            <?php endforeach; endif;?>
                        </td>
                        <td>
                            <a class="button" id="submit_button">Add New</a>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
</div>

</body>
</html>