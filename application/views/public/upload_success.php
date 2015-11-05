<html>

<head>

    <title> Image Upload </title>

</head>

<body>

<div id="container">

    <dl>

        <dt>

            File Name:

        </dt>

        <dd>

            <?php echo $uploadInfo['file_name'];?>

        </dd>

        <dt>

            File Size:

        </dt>

        <dd>

            <?php echo $uploadInfo['file_size'];?>

        </dd>

        <dt>

            File Extension:

        </dt>

        <dd>

            <?php echo $uploadInfo['file_ext'];?>

        </dd>

        <br />

        <p>The Image:</p>


       <!-- <img alt="Your uploaded image" src="<?=base_url(). 'uploads/' . $uploadInfo['file_name'];?>">-->

        <p>The Image:</p>

        <img alt="Your Thumbnail image" src="<?=base_url(). 'uploads/' . $thumbnail_name;?>">

    </dl>

</div>

</body>

</html>