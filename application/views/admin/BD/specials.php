<!DOCTYPE html5>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/a_style.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.widgets.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#adminmenu').accordion({fillSpace : false,active : 1 });
            $('#expire_date').datepicker({ dateFormat: 'yy-mm-dd' });
            var action = "<?php echo $action;?>";
            if(action == "edit")
            {
                $('#selected_option').attr('disabled','disabled');
            }
            $("#my_table").tablesorter();
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
            <h2>Specials</h2>
            <?php if($action != 'view'):?>
            <?php
                if($action == 'edit')
                {
                    $url = base_url().'admin/specials/edit/'.$selected_product_id;
                }
                else
                {
                    $url = base_url().'admin/specials/add';
                }
             ?>
            <form action="<?php echo $url;?>" method="post" id="my_form">
                <label>Product:</label>
                    <span>
                        <select id="selected_option" name="selected_product_id">
                            <?php  if($products):foreach($products as $p):?>
                                <option value="<?php echo $p->product_id;?>" <? if(isset($selected_product_id) && $selected_product_id == $p->product_id){echo 'selected="selected"';}?>>
                                    <?php echo $p->product_name; echo ' ('.$p->product_price.') ';?>
                                </option>
                            <?php endforeach;endif;?>
                        </select>
                    </span>
               <label>Special Price:</label>
                <input type="text" name="special_price" <?php if($action == 'edit'){echo "value=\"$special_price\"";}?>/>

                <label>Expire  Date:</label>
                <input type="text" name="expire_date" id="expire_date" <?php if($action == 'edit'){echo "value=\"$expire_date\"";}?>/>
                <label>Status:</label>
                <select name="status" >
                    <option value="1" <?php if($action == 'edit' && $status == 1){echo 'selected="selected"'; }?>>
                        Active
                    </option >
                    <option value="0" <?php if($action == 'edit' && $status == 0){echo 'selected="selected"'; }?>>
                        Inactive
                    </option>
                </select>
                <br/>
                <br/>
                <a id="submit_button" class="button">Save</a>
                <a class="button" href="<?php echo base_url().'admin/specials/';?>">Cancel</a>
                <br/>
                <h2>Special Notes:</h2>
                <ul>
                    <li>
                        You can enter a percentage to deduct in the Specials Price field, for example: 10%.
                    </li>
                    <li>
                        Leave the expiry date empty for no expiration.
                    </li>
                </ul>
            </form>
            <?php endif; if($action == 'view'):?>
            <table id="my_table">

                <thead>
                <tr>
                    <td>Product Name</td>
                    <td>Product Price</td>
                    <td>Status</td>
                    <td>
                        Action
                    </td>
                </tr>
                </thead>
            <?php if($special_products):foreach($special_products as $s_p):?>
                    <tr>
                        <td><?php echo $s_p->product_name;?></td>
                        <td><?php echo $s_p->product_price;?></td>
                        <td><?php if($s_p->status == 1){echo 'Active';}else{echo 'Inactive';}?></td>
                        <td>
                            <a class="button" href="<?php echo base_url().'admin/specials/edit/'.$s_p->product_id;?>">Edit</a>
                            <a class="button delete_button" href="<?php echo base_url().'admin/specials/delete/'.$s_p->product_id;?>">Delete</a>
                        </td>
                    </tr>
             <?endforeach;endif;?>
            </table>

                <a class="button" href="<?php echo base_url().'admin/specials/add';?>">Add New</a>
            <?php endif;?>
        </div>
    </div>
</div>
</body>
</html>