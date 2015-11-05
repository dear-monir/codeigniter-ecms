<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 2:22 PM
 * To change this template use File | Settings | File Templates.
 */
//print_r($cart_contents);
?>
              </div>
              <div id="footer" class="fix">&copy;OS-Commerce 2013-2014</div>
        </div>
        <script type="text/javascript">

            $(document).ready(function(){
                $('#manu_fact_drop_down').change(function(){
                    selected_val = $(this).val();
                    if(selected_val != 0)
                    {
                        var url = "<?php  echo base_url().'public/manu_products/index/';?>";
                        window.location.href = url + selected_val + "/0";
                    }
                });

                $('#currency_dropdown').change(function(){
                    selected_val = $(this).val();
                    if(selected_val != 0)
                    {
                        var url = "<?php  echo base_url().'public/Currency/index/';?>";
                        window.location.href = url + selected_val;
                    }
                });

                $("#product_info_form").submit(function(e){
                    $("#add_to_cart_btn").prop('disabled', true);
                    e.preventDefault(e);

                    $.post(
                        '<?php  if(isset($product_id)){echo base_url()."public/cart/index/$product_id";}?>',
                        $("#product_info_form").serialize(),
                        function(data){
                            if(data.length >10)
                            {
                                alert(data);
                            }
                            else
                            {
                                window.location.href = window.location;
                            }
                            $("#add_to_cart_btn").prop('disabled', false);

                        }
                    );
                });

                $(".update_qty_form").bind('submit',function(e){
                    $(".change_qty_btn").prop('disabled', true);
                    $.post(
                        '<?php echo base_url()."public/cart/update";?>',
                        $(this).serialize(),
                        function(data){
                            $(".change_qty_btn").prop('disabled', false);
                            if(data.length > 5)
                            {
                                alert(data);
                            }
                            window.location.href = window.location;
                        }
                    );
                    e.preventDefault(e);
                });

                $('.delete_item_form').bind('submit',function(e){
                    e.preventDefault(e);
                    answer = confirm("Are You Sure You Want To Delete It?");
                    if(answer == true)
                    {
                        $.post(
                            '<?php echo base_url()."public/cart/delete";?>',
                            $(this).serialize(),
                            function(data){
                               // alert(data);
                                window.location.href = window.location;
                            }
                        );

                    }
                });

                $("#search_product").autocomplete({
                    source: "<?php echo base_url()."public/search/get_suggestion";?>",
                    minLength: 1,//search after two characters
                    select: function(event,ui){
                        //do something
                    }
                });
                /*var autocompleteurl = "<?php //echo base_url().'public/search/get_suggestion/';?>";
                $("#search_product").autocomplete({
                 source: function (request,response){
                     var url = autocompleteurl + request.term;
                     $.get(url,{},function(data){
                         response(data);
                         //alert(data);
                     });
                 },
                 minLength: 1,//search after two characters
                 select: function(event,ui){
                 //do something
                 }
                 });*/

                $("#search_form").submit(function(e){
                    term = $("#search_product").val();
                    window.location = "<?php echo base_url()."public/search/get_all_suggested_products/";?>" + term;
                    e.preventDefault(e)
                    return false;
                });
            });

        </script>
    </body>
</html>