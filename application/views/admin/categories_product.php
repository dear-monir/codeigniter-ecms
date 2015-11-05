<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Categories/Products</h2>
    <?php if($action == 'view'):?>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Categories/Product</th>

                <th>Action</th>

            </tr>
            </thead>
            <?php if($categories_products):foreach($categories_products as $c_p):  ?>
                <?php if(!is_null($c_p->category_id) &&($c_p->category_id != 0)):?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/categories_products/index/'.$c_p->category_id;?>"><?php echo $c_p->category_name;?></a></td>
                    <td>
                        <a class="button button-edit" href="<?php echo base_url().'admin/categories_products/edit/'.$c_p->category_id;?>">Edit</a>&nbsp;
                        <a class="button button-move" href="<?php echo base_url().'admin/categories_products/move/'.$c_p->category_id;?>">Move</a>&nbsp;
                        <a class="button delete_button delete" href="<?php echo base_url().'admin/categories_products/delete/'.$c_p->category_id;?>">Delete</a>

                    </td>

                </tr>
            <?php endif; endforeach; endif;?>

            <?php if($products):foreach($products as $c_p): ?>

                <?php if(!is_null($c_p->product_id)  && ($c_p->product_id != 0)):?>
                    <tr>
                        <td><a href="<?php echo base_url().'admin/products/edit/'.$parent_category_id."/".$c_p->product_id;?>"><?php echo $c_p->product_name;?></a></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url().'admin/products/edit/'.$parent_category_id."/".$c_p->product_id;?>">Edit</a>&nbsp;
                            <a class="button button-move" href="<?php echo base_url().'admin/categories_products/move/'.$parent_category_id."/".$c_p->product_id;?>">Move</a>&nbsp;
                            <a class="button delete_button delete" href="<?php echo base_url().'admin/products/delete/'.$parent_category_id.'/'.$c_p->product_id;?>">Delete</a>
                        </td>

                    </tr>
                <?php endif; endforeach; endif;?>
        </table>
            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url().'admin/categories_products/add/'.$parent_category_id;?>">New Category</a>
                <?php if($parent_category_id!=0):?>
                    <a class="button button-add-new" id="addProduct" href="<?php echo base_url().'admin/products/add/'.$parent_category_id;?>">New Products</a>
                <?php endif;?>
            </div>

    </div>
    <?php endif;?>
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
                        <input class="language_des" type="text" id="<?php echo 'language_'.$l->language_id;?>" name="<?php echo 'language_'.$l->language_id;?>" value='<?php if($action=='edit'){echo ${"Language_".$l->language_id};}?>' placeholder="<?php echo $l->name;?>"/>

                </p>
                <?php endforeach;endif;?>

                <p>
                    <label>Sort Order<label>
                    <input type="text" id="sort_order" name="sort_order" value="<?php if($action='edit'){echo $sort_order;}?>"/>
                </p>

                <p>
                    <a class="button button-save" id="submit_button">Save</a>
                    <a class="button button-cancel" href="<?php echo base_url().'admin/categories_products/index/'.$parent_category_id;?>">Cancel</a>
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
        <span>To:</span>
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
        <a class="button button-save" id="submit_button">Save</a>
        <a class="button button-cancel" href="<?php echo base_url().'admin/categories_products/index/'.$parent_category_id;?>">Cancel</a>
    </div>
    <?php endif;?>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 1 });
        $('table#common').Sortables();

        $("#my_form").validity(function() {
            $("input[type='text']").require();
        });
    });

</script>
</body>
</html>