<?php $this->load->view('admin/header');?>

<div id="content">
    <div>
        <div id="option_column">
            <h2>Product Option</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Option Name</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <?php if($options):foreach($options as $op):
                    if(isset($option_id) && $option_id == $op->product_option_id){
                 ?>
                        <form action="#" method="post" id="my_form">
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
                                    <input type="submit" name="submit" class="button button-save" value="Save"/>
                                    <a class="button button-cancel" href="<?php echo base_url().'admin/products_options/index';?>">Cancel</a>
                                </td>
                            </tr>
                        </form>
                  <?php }else{?>
                    <tr>
                        <td><?php echo $op->product_option_id;?></td>
                        <td><?php echo $op->product_option_name;?></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url().'admin/products_options/edit/'.$op->product_option_id;?>">Edit</a>
                            <a class="button delete_button delete" href="<?php echo base_url().'admin/products_options/delete/'.$op->product_option_id;?>">Delete</a>
                        </td>

                    </tr>
                <?php }endforeach;endif;?>
                <tr>
                    <?php if($action != "edit"):?>
                    <form action="<?php echo base_url().'admin/products_options/add';?>" method="post" id="my_form">
                        <td></td>
                        <td>
                            <?php if($languages):foreach($languages as $l):?>
                                <?php echo $l->code;?>: <input type="text" name="<?php echo 'option_'.$l->language_id;?>"/><br/>
                            <?php endforeach; endif;?>
                        </td>
                        <td>
                            <a class="button button-add-new" id="submit_button">Add New</a>
                        </td>
                    </form>
                    <?php endif;?>
                </tr>
            </table>
        </div>
</div>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#adminmenu').accordion({fillSpace : false,active : 1 });

            $("#my_form").validity(function() {
                $("input[type='text']").require()
                                       .minLength(2, "Must contain at least 2 character.");
            });
        });

    </script>
</div>
</html>