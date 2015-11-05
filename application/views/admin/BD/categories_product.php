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
            $('table#common').Sortables();
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
    <h2>Categories/Products</h2>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Categories/Product</th>

                <th>Action</th>

            </tr>
            </thead>
            <?php if($categories_products):foreach($categories_products as $c_p):  ?>
                <?php if(!is_null($c_p->category_id) &&($c_p->category_id != 0) && ($c_p->product_id == 0)):?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/categories_products/index/'.$c_p->category_id;?>"><?php echo $c_p->category_name;?></a></td>
                    <td>
                        <a class="button" href="<?php echo base_url().'admin/categories_products/edit/'.$c_p->category_id;?>">Edit</a>&nbsp;
                        <a class="button" href="<?php echo base_url().'admin/categories_products/move/'.$c_p->category_id;?>">Move</a>&nbsp;
                        <a class="button delete_button" href="<?php echo base_url().'admin/categories_products/delete/'.$c_p->category_id;?>">Delete</a>

                    </td>

                </tr>
                <?php endif; if(!is_null($c_p->product_id) && ($c_p->category_id != 0) && ($c_p->product_id != 0)):?>
                    <tr>
                        <td><a href="<?php echo base_url().'admin/products/edit/'.$parent_category_id."/".$c_p->product_id;?>"><?php echo $c_p->category_name;?></a></td>
                        <td>
                            <a class="button" href="<?php echo base_url().'admin/products/edit/'.$parent_category_id."/".$c_p->product_id;?>">Edit</a>&nbsp;
                            <a class="button" href="<?php echo base_url().'admin/categories_products/move/'.$parent_category_id."/".$c_p->product_id;?>">Move</a>&nbsp;
                            <a class="button delete_button" href="<?php echo base_url().'admin/categories_products/delete/'.$parent_category_id.'/'.$c_p->product_id;?>">Delete</a>
                        </td>

                    </tr>
            <?php endif; endforeach; endif;?>
        </table>
        <?php if($action == 'view'):?>
            <div id="add_new">
                <a class="button" id="addnew" href="<?php echo base_url().'admin/categories_products/add/'.$parent_category_id;?>">New Category</a>
                <?php if($parent_category_id!=0):?>
                    <a class="button" id="addProduct" href="<?php echo base_url().'admin/products/add/'.$parent_category_id;?>">New Products</a>
                <?php endif;?>
            </div>
        <?php endif;?>
    </div>

    <?php if($action != 'view' && $action != "move"):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/categories_products/'.$action ."/". $category_id;?>" method="post" enctype="multipart/form-data" id="my_form">
                <h3><?php echo $category_name;?></h3>
                <p>
                    <label><h3>Category Name:</h3><label>
                </p>
                <?php if($languages):foreach($languages as $l): $src=base_url().'images/languages/'.$l->language_id.".".$l->image_ext;?>
                <p>

                        <img src="<?php echo $src;?>" width="30" height="25"/><br/>
                        <input type="text" id="<?php echo 'language_'.$l->language_id;?>" name="<?php echo 'language_'.$l->language_id;?>" value='<?php if($action=='edit'){echo ${"Language_".$l->language_id};}?>' placeholder="<?php echo $l->name;?>"/>

                </p>
                <?php endforeach;endif;?>
                <p>
                    <label>Flag(image)</label>
                    <input type="file" id="image_file" name="image_file"/>
                </p>

                <p class="error">*Allowed types are jpg,jpeg,png,gif.</p>

                <p>
                    <label>Sort Order<label>
                    <input type="text" id="sort_order" name="sort_order" value="<?php if($action='edit'){echo $sort_order;}?>"/>
                </p>

                <p>
                    <a class="button" id="submit_button">Save</a>
                    <a class="button" href="<?php echo base_url().'admin/categories_products/index/'.$parent_category_id;?>">Cancel</a>
                </p>
            </form>
        </div>
    <?php endif;if($action == 'move'):
            if(isset($product_id))
            {
                $action_url = base_url()."admin/categories_products/move/$category_id/$product_id";
             }
            else
            {
                $action_url = base_url()."admin/categories_products/move/$category_id";
            }
    ?>
    <div id="side_bar">
        <h3><?php echo $category_name;?></h3>
        <span>To</span>
        <form name="my_form" id="my_form" action="<?php echo $action_url;?>" method="post">
            <select name="moveable_category">
                <?php if(!isset($product_id)):?>
                <option value="0">Top</option>
                <?php endif;if($move_able_category): foreach($move_able_category as $m_a_c):?>
                    <option value="<?php echo $m_a_c->category_id; ?>">
                        <?php echo $m_a_c->category_name;?>
                    </option>
                <?php endforeach;endif;?>
            </select>
        </form>
        <a class="button" id="submit_button">Save</a>
        <a class="button" href="<?php echo base_url().'admin/categories_products/index/'.$parent_category_id;?>">Cancel</a>
    </div>
    <?php endif;?>

</div>

</body>
</html>