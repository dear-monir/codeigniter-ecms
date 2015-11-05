<!DOCTYPE html5>
<html>
<head>
    <title>Admin/<?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/a_style.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin.js"></script>
    <script type="text/javascript">
        function add()
        {

        }
       /* $(document).ready(function(){
            $('#addnew').click(function(){
                if($('#new').length == 0 )
                {
                    var row = $('<tr>').attr('id','new').appendTo('#common');
                    row.append($('<td>').html('<input type="text" id="lan" placeholder="Language Name"/>'));
                    row.append($('<td>').html('<input type="text" id="lan" placeholder="Language Code"/>'));
                    row.append($('<td>').html('<input type="text" id="lan" placeholder="Sort Order"/>'));
                    row.append($('<td>').html('<input type="file" id="lan"/>'));
                    row.append($('<td>').append('<a class="button">Save</a>/<a  class="button" id="newcancel">Cancel</a>'));

                    $('#newcancel').on('click',function(event){
                        $('#new').hide();
                    });
                }
                else if($('#new').is(':hidden'))
                {
                    $('#new').show();
                }

            });


        });*/

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
        <li><a href="<?php echo base_url()?>admin/language">Languages</a></li>
        <li><a href="<?php echo base_url()?>admin/currencies/">Currencies</a></li>
    </div>
    <h3>Reports</h3>
    <div>
    </div>
    <h3>Tools</h3>
    <div>
    </div>

</div>