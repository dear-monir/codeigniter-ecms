<?php $this->load->view('admin/header');?>

<div id="content">
    <div>
        <div id="option_column">
            <h2>
                Product Option Value Of
                <span>
                    <select id="selected_option">
                       <?php  if($options):foreach($options as $op):?>
                        <option value="<?php echo $op->product_option_id;?>" <?php if($selected_option_id == $op->product_option_id){echo 'selected="selected"';}?> >
                            <?php echo $op->product_option_name;?>
                        </option>
                        <?php endforeach;endif;?>
                    </select>
                </span>
            </h2>
            <table>
                <thead>


                <tr>
                    <th>ID</th>
                    <th>Option Value Name</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <?php if($options_values):foreach($options_values as $op):
                    if(isset($option_value_id) && $option_value_id == $op->product_option_value_id){
                        ?>
                        <form action="<?php echo base_url()."admin/option_values/edit/{$selected_option_id}/{$op->product_option_value_id}";?>" method="post" id="my_form">
                            <tr>
                                <td><?php echo $op->product_option_value_id;?></td>
                                <td>
                                    <?php if($languages):foreach($languages as $l):?>
                                        <?php echo $l->code;?>:
                                        <input type="text" name="<?php echo 'option_'.$l->language_id;?>" value="<?php echo ${'option_'.$op->product_option_id.'_'.$l->language_id};?>"/>
                                        <br/>
                                    <?php endforeach; endif;?>
                                </td>
                                <td>
                                    <input type="submit" name="submit" class="button button-save" value="Save"/>
                                    <a class="button button-cancel" href="<?php echo base_url().'admin/option_values/index/'.$selected_option_id;?>">Cancel</a>
                                </td>
                            </tr>
                        </form>
                    <?php }else{?>
                        <tr>
                            <td><?php echo $op->product_option_value_id;?></td>
                            <td><?php echo $op->product_option_value_name;?></td>
                            <td>
                                <a class="button button-edit" href="<?php echo base_url().'admin/option_values/edit/'.$selected_option_id.'/'.$op->product_option_value_id;?>">Edit</a>
                                <a class="button delete_button delete" href="<?php echo base_url().'admin/option_values/delete/'.$selected_option_id.'/'.$op->product_option_value_id;?>">Delete</a>
                            </td>

                        </tr>
                    <?php }endforeach;endif;?>

                <tr>
                    <?php if($action != "edit"):?>
                    <form action="<?php echo base_url().'admin/option_values/add/'.$selected_option_id;?>" method="post" id="my_form">
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
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 1 });
        $('#selected_option').change(function(){
            var selected_index = $(this).val();

            var url = "<?php  echo base_url().'admin/option_values/index/';?>";
            window.location.href = url + selected_index;
        });

        $("#my_form").validity(function() {
            $("input[type='text']").require();
        });
    });

</script>
</body>
</html>