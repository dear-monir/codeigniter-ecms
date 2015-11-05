<?php $this->load->view('admin/header');?>

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
                                <option value="<?php echo $p->product_id;?>" <?php if(isset($selected_product_id) && $selected_product_id == $p->product_id){echo 'selected="selected"';}?>>
                                    <?php echo $p->product_name; echo ' ('.$p->product_price.') ';?>
                                </option>
                            <?php endforeach;endif;?>
                        </select>
                    </span>
               <label>Special Price:</label>
                <input type="text" id="special_price" name="special_price" <?php if($action == 'edit'){echo "value=\"$special_price\"";}?>/>

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
                <a id="submit_button" class="button button-save">Save</a>
                <!--<input type="submit" class="button button-save" value="Save"/>-->
                <a class="button button-cancel" href="<?php echo base_url().'admin/specials/';?>">Cancel</a>
                <br/><br/>
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
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Status</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
            <?php if($special_products): foreach($special_products as $s_p):?>
                    <tr>
                        <td><?php echo $s_p->product_name;?></td>
                        <td><?php echo $s_p->product_price;?></td>
                        <td><?php if($s_p->status == 1){echo 'Active';}else{echo 'Inactive';}?></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url().'admin/specials/edit/'.$s_p->product_id;?>">Edit</a>
                            <a class="button delete_button delete" href="<?php echo base_url().'admin/specials/delete/'.$s_p->product_id;?>">Delete</a>
                        </td>
                    </tr>
             <?php endforeach;endif;?>
            </table>

                <a class="button button-add-new" href="<?php echo base_url().'admin/specials/add';?>">Add New</a>
         <?php endif;?>
        </div>
    </div>
</div>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#adminmenu').accordion({fillSpace : false,active : 1 });
            $('#expire_date').datepicker({ dateFormat: 'yy-mm-dd' });
            var action = "<?php echo $action;?>";
            if(action == "edit")
            {
                $('#selected_option').attr('disabled','disabled');
            }
            //$("#my_table").tablesorter();

            $("#my_form").validity(function() {

                $("#special_price").require()
                    .match(/^[0-9]*\.?[0-9]*\??$/, "Price must be a value.");
            });
        });

    </script>
</body>
</html>