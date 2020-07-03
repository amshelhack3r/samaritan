<?php
require_once 'lib/database.php'; 


$db = Database::getInstance();
$sql = "SELECT * FROM images";
$result = $db->query($sql);
$images = $result->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
    <link href="https://unpkg.com/nanogallery2@2.4.2/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">

    <title><?php echo SITENAME; ?></title>
</head>

<body>


    <!-- Header -->
    <nav id="nav" class="sticky">
        <ul>
            <li><a href="<?php echo URLROOT; ?>">Home</a></li>
            <li><a href="<?php echo URLROOT; ?>/about.php">About</a></li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div id="nanogallery2" data-nanogallery2='{
                        "thumbnailHeight":  auto,
                        "thumbnailWidth":   "300"
                      }'>
            <?php foreach ($images as $image) : ?>
                <a href="<?php echo URLROOT; ?>/assets/images/<?php echo $image->name; ?>" data-ngThumb="<?php echo URLROOT; ?>/assets/images/<?php echo $image->name; ?>">
                    <?php echo $image->caption; ?> </a>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Contact -->
                    <section class="contact">
                        <p>we believe helping the need people it's god's willing, </br>we welcome all well wishers to join us to this great commission which our lord jesus commanded us .</p>
                        <ul class="icons">
                            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        </ul>
                    </section>

                    <!-- Copyright -->
                    <div class="copyright">
                        <ul class="menu">
                            <li>&copy; 2020. All rights reserved.</li>
                            <!-- <li>Template Credits: <a href="http://html5up.net" target="_blank" rel="noreferrer">HTML5 UP</a></li> -->
                            <li>Developer: <a href="http://portfolio.mutalldevs.co.ke" target="_blank" rel="noreferrer">AMSHEL</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo URLROOT; ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/nanogallery2@2.4.2/dist/jquery.nanogallery2.min.js"></script>


</body>

</html>