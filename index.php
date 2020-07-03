<?php 
require_once 'lib/database.php';

$db = Database::getInstance();
$sql = "SELECT name, caption FROM images WHERE location = 'slider'";
$result = $db->query($sql);
$slider = $result->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
    <title><?php echo SITENAME; ?></title>
</head>

<body>

<div id="page-wrapper">

	<!-- Header -->
	<div id="header">
		<img id="cover" src="<?php echo URLROOT ?>/assets/images/074.jpg" alt="cover" srcset="">
		<!-- Inner -->
		<div class="inner">
			<header>
				<h1><a href="/" id="logo">GOOD SAMARITAN</a></h1>
				<hr />
				<p>Fountain of hope ministries</p>
			</header>
			<footer>
				<a href="#banner" class="button circled scrolly">Start</a>
			</footer>
		</div>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li><a href="<?php echo URLROOT; ?>/about.php">About</a></li>
				<li><a href="<?php echo URLROOT; ?>/gallery.php">Gallery</a></li>
			</ul>
		</nav>

	</div>

	<!-- Banner -->
	<section id="banner">
		<header>

			<p id="quote">
				Whoever is generous to the poor lends to the Lord, and he will repay him for his deed.</br>
				PROVERBS 19:17
			</p>
		</header>
	</section>

	<!-- Carousel -->
	<section class="carousel">
		<div class="reel">
			<?php foreach ($slider as $image) : ?>
				<article>
					<a class="image featured" href="#"><img src="<?php echo URLROOT; ?>/assets/images/<?php echo $image->name; ?>" alt="" /></a>
					<p><?php echo $image->caption;?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- Main -->
	<div class="wrapper style2">

		<article id="main" class="container special">
			<header>
				<h3><a href="#">About Church</a></h3>

			</header>
			<p>
				Good Samaritan Fountain of Hope is a Gospel Christian Church, located at the foot of Ngong hills in upper Matasia, Olkeri ward, Kajiado north constituency, Kajiado county
			</p>
			<footer>
				<a href="#" class="button">Continue Reading</a>
			</footer>
		</article>

	</div>

	<!-- Features -->
	<div class="wrapper style1">

		<section id="features" class="container special">
			<div id="vision">
				<h3>Vision</h3>
				<p>OUR CHURCH VISION is to preach the gospel world wide and give hope to the hopeless through community service. This entails caring for the less fortunate in society, sharing food staff, clothing to children and aged peoples . We are currently sponsoring 15 children with their school fees.</p>
			</div>
			<hr>
			<header>
				<h3>SERVICES</h3>
			</header>
			<div class="services">
				<article class="card">
					<header>
						<h3>BIBLE STUDY</h3>
					</header>
					<p>
						Bible study runs from 8:30AM -10:00AM every Sunday
					</p>
				</article>
				<article class="card">
					<header>
						<h3>SUNDAY SCHOOL</h3>
					</header>
					<p>
						Sunday school happens every Sunday from 10:00AM – 11:00AM</p>
				</article>
				<article class="card">
					<header>
						<h3>MAIN SERVICE</h3>
					</header>
					<p>Happens every Sunday from 10AM – 1PM</p>
				</article>
				<article class="card">
					<header>
						<h3>HOME FELLOWSHIP</h3>
					</header>
					<p>
						Happens every Tuesday from 3:00PM – 4:30PM
					</p>
				</article>
				<article class="card">
					<header>
						<h3>PRAYER WEEK AND FASTING</h3>
					</header>
					<p>
						Happens every last week of the month
					</p>
				</article>
				<article class="card">
					<header>
						<h3>OVERNIGHT PRAYERS</h3>
					</header>
					<p>
						Happens every Friday on the week of fasting
					</p>
				</article>
			</div>
		</section>

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
							<li>ADMIN: <a href="login.php">Login</a></li>
						</ul>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo URLROOT; ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/browser.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/jquery.dropotron.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/jquery.scrollex.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/jquery.scrolly.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/breakpoints.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/util.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/main.js"></script>
 </body>

</html>