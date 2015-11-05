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

        });

    </script>
</head>
<body>
<div id="adminmenu">
    <h3>Configuration</h3>
    <div>
        dsfdg
        fdg
    </div>

    <h3>Catalog</h3>
    <div>
        <li><a href="">Categories/Products</a></li>
        <li><a href="">Products Attributes</a></li>
        <li><a href="">Manufacturers</a></li>
        <li><a href="">Reviews</a></li>
        <li><a href="">Specials</a></li>
        <li><a href="">Products Expected</a></li>
    </div>

    <h3>Modules</h3>
    <div>
        dfgdfgf
    </div>

    <h3>Customers</h3>
    <div>
    </div>

    <h3>Location/Taxes</h3>
    <div>
    </div>

    <h3>Localization</h3>
    <div>
        <li><a href="">Languages</a></li>
        <li><a href="">Currencies</a></li>
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
            <?php if($categories):foreach($categories as $c):?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/categories_products/index/'.$c->category_id;?>"><?php echo $c->category_name;?></a></td>
                    <td><a class="button" href="<?php echo base_url().'admin/';?>">Edit</a>&nbsp;
                    <a class="button" href="<?php echo base_url();?>admin/">Delete</a></td>

                </tr>
            <?php endforeach; endif;?>

            <?php if($products):foreach($products as $p):?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/categories_products/index/'.$p->product_id;?>"><?php echo $p->product_name;?></a></td>
                    <td><a class="button" href="<?php echo base_url().'admin/';?>">Edit</a>&nbsp;
                        <a class="button" href="<?php echo base_url();?>admin/">Delete</a></td>

                </tr>
            <?php endforeach; endif;?>
        </table>

        <div id="add_new">
            <a class="button" id="addnew" href="<?php echo base_url().'admin/categories_products/add/'.$parent_category_id;?>">New Category</a>
            <?php if($parent_category_id!=0):?>
                <a class="button" id="addProduct" href="<?php echo base_url();?>admin/">New Products</a>
            <?php endif;?>
        </div>
    </div>
</div>
<?php if($action != 'view'):?>
    <div id="side_bar">
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" >
            <p align="center"><h3>Add New Category</h3></p>
            <p>
                <label><h3>Category Name:</h3><label>
            </p>
            <p>
                <input type="text" id="" name="" value=""/>
            </p>


            <p>
                <label>Flag(image)</label>
                <input type="file" id="image_file" name="image_file"/>
            </p>
            <p class="error">*Allowed types are jpg,jpeg,png,gif.</p>
            <p>
                <label>Sort Order<label>
                <input type="text" id="sort_order" name="sort_order" value=""/>
            </p>
            <p><input type="submit" value="Save" name="save"/><a class="button" href="<?php echo base_url();?>admin/categories_products">Cancel</a></p>

        </form>
    </div>
<?php endif;?>


</div>

</body>
</html>