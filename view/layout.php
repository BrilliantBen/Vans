<!DOCTYPE html>
<html class="no-js">
<head>
	<title>Vans loves Sharpie</title>
	<meta charset="utf-8"/>
	<meta name="author" content="Benoit Schrijnemakers"/>
	<meta name="keywords" content="Major"/>
	<meta name="description" content="Major Three"/>
	<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen"/>

		<script>
		WebFontConfig = {
			custom: {
				families: ['sean', 'bitter'],
				urls: ['fonts/sean/sean.css', 'fonts/bitter/bitter.css'],
			}
		};

		(function() {
			var wf = document.createElement('script');
			wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1.5.6/webfont.js';
			// wf.src = 'js/vendor/webfontloader/webfontloader.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>
</head>




<body>
	<div class="container">
			<?php if(!empty ($_SESSION['error'])){ ?>
			<p class="error">  <?php echo $_SESSION['error']; ?> </p>
			<?php } ?>
<?php if(!empty ($_SESSION['info'])){ ?>
			<p class="info"> <?php echo $_SESSION['info']; ?> </p>
			<?php } ?>

		<header class="header">
			<h1>Vans loves Sharpie</h1>
			<h2>Express yourself</h2>

			<div class="subnav">


				<div class="like">
				</div>

				<div class="logos">
					<a href="http://www.sharpie.com"><span>sharpie</span></a>
					<a href="http://www.vans.com"><span>vans</span></a>
				</div>
			</div>
			<div class="pen"></div>
		<nav>
			<ul>
				<li <?php if($_GET['page'] == 'home'){ echo "class='active'"; } ?>>
					<a href="index.php?page=home">Home</a>
				</li>
				<li <?php if($_GET['page'] == 'design'){ echo "class='active'"; } ?>>
					<a href="index.php?page=design">Design</a>
				</li>
				<li <?php if($_GET['page'] == 'gallery' ){ echo "class='active'"; } ?>>
					<a href="index.php?page=gallery&p=1&size=37">Galerij</a>
				</li>
			</ul>
		</nav>
		</header>

		<?php echo $content; ?>

	</div>
	<script src="js/vendor/fallback/fallback.min.js"></script>
	<script src="js/dist/script.dist.js"></script>
</body>
</html>
