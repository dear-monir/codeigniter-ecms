<?php $this->load->view('admin/header');?>

<div id="content">
    <div>
        <div id="option_column">
            <h2>
                Reviews  Of Product
                <span>
                    <select id="selected_product_id_review">
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
                    <th>Option Name</th>
                    <th>Option Value</th>
                    <th>Value Price</th>
                    <th>Operation</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 1 });
        $('#selected_product_id_review').change(function(){
            var selected_index = $(this).val();

            var url = "<?php  echo base_url().'admin/reviews/index/';?>";
            window.location.href = url + selected_index;
        });

    });

</script>
</body>
</html>