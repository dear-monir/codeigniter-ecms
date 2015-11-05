<?php $this->load->view('admin/header');?>

<div id="content">
    <div>
        <div id="option_column">
            <h2>
                Figures  Of Product
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
                    <th>Figure ID</th>
                    <th>Figure</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <?php if($figures):foreach($figures as $fg):?>
                <tr>
                    <td><?php echo $fg->image_id;?></td>
                    <td>
                        <img src="<?php echo $path.$fg->image_id.'.'.$fg->image_ext;?>" width="80" height="50"/>
                    </td>
                    <td>
                        <a class="button delete_button delete" href="<?php echo base_url().'admin/product_figures/delete/'.$selected_product_id.'/'.$fg->image_id;?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; endif;?>
            </table>
            <br/>
            <form action="<?php echo base_url().'admin/product_figures/add/'.$selected_product_id;?>" method="post" enctype="multipart/form-data">
                Upload Product Figure:(jpg/jpeg/png/gif)<input type="file" name="image_file[]" multiple="multiple"/>
              <!--  <a class="button" id="submit_button">Upload</a> -->
                <input type="submit" class="button" value="Upload"/>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#adminmenu').accordion({fillSpace : false,active : 1 });
            $('#selected_option').change(function(){
                var selected_index = $(this).val();

                var url = "<?php  echo base_url().'admin/product_figures/index/';?>";
                window.location.href = url + selected_index;
            });

            $('#option').change(function(){
                var selected_index = $(this).val();
                $.post('<?php echo base_url()."admin/Products_attributes/getAllOptionName"?>',{option_id:selected_index,product_id:<?php echo $selected_product_id;?>},function(data){
                    $('#option_name').html('');
                    $('#option_name').append(data);
                    //document.write(data);

                });
            });

            // $('#option').selectedIndex(2);
        });

    </script>
</body>
</html>