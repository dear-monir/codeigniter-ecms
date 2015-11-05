<head>

    <title> Image Upload </title>

</head>

<body>

<div id="container">

    <?php echo  form_open_multipart('public/upload/uploadImage')?>

   <!-- <input type="file" name="userfile" />-->




    <?php
    $file=array(
        'name'=>'userfile'
    );
    echo form_upload($file)
    ?>

    <p><input type="submit" name="submit" value="submit" /></p>

    <?php echo form_close();?>

</div>

</body>

</html>