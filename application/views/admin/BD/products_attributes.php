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
            $('#selected_option').change(function(){
                var selected_index = $(this).val();

                var url = "<?php  echo base_url().'admin/products_attributes/index/';?>";
                window.location.href = url + selected_index;
            });

            $('#option').change(function(){
                var selected_index = $(this).val();
                $.post('<?php echo base_url()."admin/Products_attributes/getAllOptionName";?>',{option_id:selected_index,product_id:<?php echo $selected_product_id;?>},function(data){
                     $('#option_name').html('');
                     $('#option_name').append(data);
                   //document.write(data);

                });
            });
		

          // $('#option').selectedIndex(2);
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
            <h2>
                Attributes  Of Product
                <span>
                    <select id="selected_option">
                        <?php  if($products):foreach($products as $p):?>
                            <option value="<?php echo $p->product_id;?>" <?php if($selected_product_id == $p->product_id){echo 'selected="selected"';}?>>
                                <?php echo $p->product_name;?>
                            </option>
                        <?php endforeach;endif;?>
                    </select>
                </span>
            </h2>
            <table>
                <thead>


                <tr>
                    <td>Option Name</td>
                    <td>Option Value</td>
                    <td>Value Price</td>
                    <td>Operation</td>
                    <td>
                        Action
                    </td>
                </tr>
                </thead>
                <?php if($product_attributes):foreach($product_attributes as $p_a):?>
                    <tr>
                        <td>
                            <?php echo ${'option_name_'.$p_a->prodcut_attribute_id};?>
                        </td>

                        <td>
                            <?php echo ${'option_value_'.$p_a->prodcut_attribute_id};?>
                        </td>
                        <td>
                            <?php if(isset($prodcut_attribute_id) && $prodcut_attribute_id == $p_a->prodcut_attribute_id): ?>
                                <form action="<?php echo base_url().'admin/products_attributes/edit/'.$selected_product_id.'/'.$p_a->prodcut_attribute_id;?>" method="post">
                                <input type="text" name="option_price" value="<?php echo $p_a->option_value_price;?>"/>
                            <?php else: echo $p_a->option_value_price;endif; ?>
                        </td>
                        <td>
                            <?php if(isset($prodcut_attribute_id) && $prodcut_attribute_id == $p_a->prodcut_attribute_id):?>
                                <select name="price_prefix">
                                    <option value="+" <?php if($p_a->price_prefix == '+'){echo 'selected="selected"';}?> >+(Plus)</option>
                                    <option value="-" <?php if($p_a->price_prefix == '-'){echo 'selected="selected"';}?> >-(Minus)</option>
                                </select>
                            <?php else: echo $p_a->price_prefix; endif;?>
                        </td>
                        <td>
                            <?php if(isset($prodcut_attribute_id) && $prodcut_attribute_id == $p_a->prodcut_attribute_id):?>
                                <input type="submit" value="Save" class="button" name="submit"/>
                                <a class="button" href="<?php echo base_url().'admin/products_attributes/index/'.$selected_product_id;?>">Cancel</a>
                                </form>
                            <?php else: ?>
                                <a class="button" href="<?php echo base_url().'admin/products_attributes/edit/'.$selected_product_id.'/'.$p_a->prodcut_attribute_id;?>">Edit</a>
                                <a class="button delete_button" href="<?php echo base_url().'admin/products_attributes/delete/'.$selected_product_id.'/'.$p_a->prodcut_attribute_id;?>" >Delete</a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;endif;?>
                <tr>
                    <form action="<?php echo base_url().'admin/products_attributes/add/'.$selected_product_id;?>" method="post" id="my_form">
                        <td>
                           <select id="option" name="option">
                               <?php if($options):foreach($options as $op):?>
                                    <option value="<?php echo $op->product_option_id?>">
                                      <?php echo  $op->product_option_name;?>
                                    </option>
                                <?php endforeach;endif;?>
                            </select>
                        </td>

                        <td>
                            <select id="option_name" name="option_name">

                            </select>
                        </td>
                        <td>
                            <input type="text" name="option_price"/>
                        </td>
                        <td>
                            <select name="price_prefix">
                                <option value="+">
                                    +(plus)
                                </option>
                                <option value="-">
                                    -(minus)
                                </option>
                            </select>
                        </td>
                        <td>
                            <a class="button" id="submit_button">Add New</a>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>