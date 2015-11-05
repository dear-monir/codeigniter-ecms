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
            $('#adminmenu').accordion({fillSpace : false,active : 4 });
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
    <h2>Tax Classes</h2>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Tax Class Title</th>
                <th>Description</th>
                <th>Last Modified(YYYY-MM-DD H:M:S)</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->tax_class_title;?></td>
                    <td><?php echo $r->tax_class_description;?></td>
                    <td><?php echo $r->last_modified;?></td>

                    <td>
                        <a class="button" href="<?php echo base_url();?>admin/tax_class/edit/<?php echo $r->tax_class_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button" href="<?php echo base_url();?>admin/tax_class/delete/<?php echo $r->tax_class_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>
        <?php if($action == 'view'):?>
            <div id="add_new">
                <a class="button" id="addnew" href="<?php echo base_url();?>admin/tax_class/add">New Tax Class</a>
            </div>
        <?php endif;?>
    </div>

    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/tax_class/'.$action;?>" method="post"  id="my_form">
                <p><label>Tax Class name<label><input type="text" id="tax_class_title" name="tax_class_title" value="<?php echo $tax_class_title;?>"/></p>
                <p>
                    <label>Description</label>
                    <textarea id="tax_class_description" name="tax_class_description" rows="10" cols="25">
                        <?php echo $tax_class_description;?>
                    </textarea>
                </p>

                <p><a class="button" id="submit_button">Save</a>&nbsp;<a class="button" href="<?php echo base_url();?>admin/tax_class">Cancel</a></p>

            </form>
        </div>
    <?php endif;?>

</div>

</body>
</html>