<?php
/*
$CI = get_instance();
$CI->load->model('admin/M_language');
$langages = $CI->M_language->getAll();
echo "This from helper method.";
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <meta http-equiv="Content-Type" content="text/html;
charset=UTF-8"/>

    <link type="text/css" rel="stylesheet"
          href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/a_style.css">
    <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>js/jquery.validity.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.10.1.custom.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validity.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/admin.js"></script>

</head>
<body>
<div class="admin_header">
    <div id="header_left">
        <h2 style="margin: 0px;padding: 0px;">Welcome to dashboard</h2>

        <h3 style="margin: 0px"> <a href="<?php echo base_url() . "public/home" ?>" target="_blank">View Site</a></h3>
    </div>
    <div id="header_right">
        <div style="text-align: right">
            <p style="margin: 0px"> <?php echo $this->session->userdata('first_name')?></p>
            <a href="<?php echo base_url() . 'admin/account/logout' ?>">Log Out</a>
        </div>

    </div>
    <div style="clear: both;"></div>

</div>
<div class="clear"></div>
<div id="adminmenu">
    <h3>Configuration</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/mystore'; ?>">My Store</a></li>
    </div>

    <h3>Catalog</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/categories_products/index/0'; ?>">Categories/Products</a></li>
        <li><a href="<?php echo base_url() . 'admin/products_options/index/0'; ?>">Products Options</a></li>
        <li><a href="<?php echo base_url() . 'admin/option_values/index/0'; ?>">Products Options Values</a></li>
        <li><a href="<?php echo base_url() . 'admin/products_attributes/index/0'; ?>">Products Attributes</a></li>
        <li><a href="<?php echo base_url() . 'admin/product_figures/index/0'; ?>">Products Figures</a></li>
        <li><a href="<?php echo base_url() . 'admin/manufacturer'; ?>">Manufacturers</a></li>
        <li><a href="<?php echo base_url() . 'admin/reviews/index/0'; ?>">Reviews</a></li>
        <li><a href="<?php echo base_url() . 'admin/specials/index/0'; ?>">Speials</a></li>
        <li><a href="">Products Expected</a></li>
    </div>

    <h3>Modules</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/boxes/index/9'; ?>">Boxes</a></li>
        <li><a href="<?php echo base_url() . 'admin/shipping/index/7'; ?>">Shipping Method</a></li>
        <li><a href="<?php echo base_url() . 'admin/shipping_region/index'; ?>">Shipping Region</a></li>
    </div>

    <h3>Customers</h3>

    <div>
    </div>

    <h3>Location/Taxes</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/country'; ?>">Countries</a></li>
        <li><a href="<?php echo base_url() . 'admin/states'; ?>">States/Zones</a></li>
        <li><a href="<?php echo base_url() . 'admin/tax_class'; ?>">Tax Classes</a></li>
        <li><a href="<?php echo base_url() . 'admin/tax_rate'; ?>">Tax Rates</a></li>
    </div>

    <h3>Localization</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/language'; ?>">Languages</a></li>
        <li><a href="<?php echo base_url() . 'admin/currencies/index/'; ?>">Currencies</a></li>
    </div>
    <h3>Reports</h3>

    <div>
        <li><a href="<?php echo base_url() . 'admin/report/pending/'; ?>">Pending Orders</a></li>
        <li><a href="<?php echo base_url() . 'admin/report/delivered/'; ?>">Delivered Orders</a></li>
    </div>
    <h3>Tools</h3>

    <div>
    </div>

</div>
