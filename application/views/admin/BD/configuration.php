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
            $('#adminmenu').accordion({fillSpace : false,active : 0 });
            $('table#common').Sortables();
        });

    </script>
</head>
<body>
<div id="adminmenu">
    <h3>Configuration</h3>
    <div>
        <?php if($config_menus): foreach($config_menus as $c_menu):?>
            <li>
                <a href="<?php echo base_url().'admin/configure/index/'.$c_menu->configuration_group_id;?>">
                   <?php echo $c_menu->configuration_group_title; ?>
                </a>
            </li>
        <?php endforeach;endif; ?>
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
    <table>
        <thead>
            <td>Title</td>
            <td>Value</td>
            <td>Action</td>
        </thead>
    <?php if(isset($config_options)): foreach($config_options as $con_opt):?>
        <tr>
            <td><?php echo $con_opt->configuration_title;?></td>
            <td>
                <?php if(isset($config_id) && $config_id == $con_opt->configuration_id):?>
                <form id="my_form" method="post" action="<?php echo base_url().'admin/configure/edit/'.$config_group_id.'/'.$con_opt->configuration_id;?>" >
                    <?php if($con_opt->configuration_value == 'true' || $con_opt->configuration_value == 'false'): ?>
                        <input type="radio" name="config_value" value="true" <?php if($con_opt->configuration_value == 'true'){echo 'selected="selected"';}?> />true
                        <input type="radio" name="config_value" value="false" <?php if($con_opt->configuration_value == 'false'){echo 'selected="selected"';}?> />false
                        <?php else: ?>
                    <input type="text" name="config_value"  value="<?php echo htmlentities($con_opt->configuration_value);?>"/>
                        <?php endif;?>
                </form>
                <?php else: echo htmlentities($con_opt->configuration_value); endif;?>
            </td>
            <td>
                <?php if(isset($config_id) && $config_id == $con_opt->configuration_id):?>
                    <a class="button" id="submit_button">Save</a>
                    <a class="button" href="<?php echo base_url().'admin/configure/index/'.$config_group_id;?>">Cancel</a>
                <?php else:?>
                    <a href="<?php echo base_url().'admin/configure/index/'.$config_group_id.'/'.$con_opt->configuration_id;?>">Edit</a>
               <?php endif;?>

            </td>
        </tr>
        <?php endforeach;endif;?>
    </table>
</div>

</body>
</html>