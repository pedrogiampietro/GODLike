<?php
if(!defined('INITIALIZED'))
	exit;

$playersOnline = $config['status']['serverStatus_players'];
$casts = $SQL->query("SELECT COUNT(1), IFNULL(SUM(`spectators`), 0) FROM `live_casts`;")->fetch();

$cacheSec = 30;
$cacheFile = 'cache/topplayers.tmp';
if (file_exists($cacheFile) && filemtime($cacheFile) > (time() - $cacheSec)) {
	$topData = file_get_contents($cacheFile);
} else {
	$topData = '';
	$i = 0;
	foreach($SQL->query("SELECT `name`, `level` FROM `players` WHERE `group_id` < 2 AND `account_id` != 3 ORDER BY `level` DESC LIMIT 5")->fetchAll() as $player) {
		$i++;
		$topData .= '<tr>
		<td style="width: 80%"><strong>'.$i.'.</strong> 
		<a href="?subtopic=characters&name='.urlencode($player['name']).'">'.$player['name'].'</a>
		</td>
		<td>
		<span class="label label-primary">Lvl. '.$player['level'].'</span>
		</td></tr>';
	}

	file_put_contents($cacheFile, $topData);
}

$today = strtotime('today 10:00');
$tomorrow = strtotime('tomorrow 10:00');
$now = time();
$remaining = ($now > $today ? $tomorrow : $today) - $now;
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="_nK">
    <title>GODLIKE | MMORPG | Low Rates | Dedicated</title>
    <link rel="icon" type="image/png" href="<?php echo $layout_name; ?>/assets/images/favicon.png">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/bower_components/fontawesome/css/font-awesome.min.css">

    <!-- IonIcons -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/bower_components/ionicons/css/ionicons.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/navigation.css">

    <!-- Flickity -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/bower_components/flickity/dist/flickity.min.css">

    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/bower_components/photoswipe/dist/default-skin/default-skin.css">

    <!-- DateTimePicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/plugins/revolution/css/navigation.css">

    <!-- Prism -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/bower_components/prism/themes/prism-tomorrow.css">

    <!-- Summernote -->
    <link rel="stylesheet" type="text/css" href="<?php echo $layout_name; ?>/assets/bower_components/summernote/dist/summernote.css">

    <!-- GODLIKE -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/godlike.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/custom.css">

    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="<?php echo $layout_name; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>



</head>


<!--
    Additional Classes:
        .nk-page-boxed
-->

<body>
<!-- START: Page Preloader -->
<div class="nk-preloader">
    <!--
     Preloader animation
     data-close-... data used for closing preloader
     data-open-...  data used for opening preloader
-->
    <div class="nk-preloader-bg" style="background-color: #000;" data-close-frames="23" data-close-speed="1.2" data-close-sprites="./<?php echo $layout_name; ?>/assets/images/preloader-bg.png" data-open-frames="23" data-open-speed="1.2" data-open-sprites="./<?php echo $layout_name; ?>/assets/images/preloader-bg-bw.png">
    </div>

    <div class="nk-preloader-content">
        <div>
            <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/logo.png" alt="GodLike - MMORPG | Low Rates" width="170">
            <div class="nk-preloader-animation"></div>
        </div>
    </div>

    <div class="nk-preloader-skip">Skip</div>
</div>
<!-- END: Page Preloader -->


<!-- START: Page Background -->
<!--<div class="bg-video" data-video="https://www.youtube.com/watch?v=-1j058JADXI&feature=youtu.be"></div><!-- END: Page Background -->
    <div class="nk-page-background op-5" data-bg-mp4="assets/video/bg-2.mp4" data-bg-webm="assets/video/bg-2.webm" data-bg-ogv="assets/video/bg-2.ogv" data-bg-poster="<?php echo $layout_name; ?>/assets/images/taleon_bg2.jpg"></div>

<!-- START: Page Border -->

<div class="nk-page-border">
    <div class="nk-page-border-t"></div>
    <div class="nk-page-border-r"></div>
    <div class="nk-page-border-b"></div>
    <div class="nk-page-border-l"></div>
</div>
<!-- END: Page Border -->


<!--
Additional Classes:
    .nk-header-opaque
-->
<header class="nk-header nk-header-opaque">



    <!--
START: Top Contacts
	-->
	
    <div class="nk-contacts-top">
        <div class="container">
            <div class="nk-contacts-left">
                <div class="nk-navbar">
                    <ul class="nk-nav">
                        <li><a href="#">Ticket</a></li>
                        <li><a href="page-contact.html">Downloads</a></li>
                        <li><a href="page-contact.html">Casts</a></li>
                    </ul>
                </div>
            </div>
            <div class="nk-contacts-right">
                <div class="nk-navbar">
                    <ul class="nk-nav">
                        <li>
                            <a href="#" target="_blank">
                                <span class="ion-social-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <span class="ion-social-dribbble-outline"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="ion-social-instagram-outline"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="ion-social-pinterest"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Top Contacts -->



        <!--
        START: Navbar
		-->
		
        <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
            <div class="container">
                <div class="nk-nav-table">

                    <a href="?subtopic=latestnews" class="nk-nav-logo">
                        <img src="<?php echo $layout_name; ?>/assets/images/logo.png" alt="" width="90">
                    </a>


                    <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
                        <li class="active  ">
                            <a href="?subtopic=latestnews">
                Home</a>
                        </li>
   
                        <li class="  nk-drop-item">
                            <a href="#">
                Library</a>
                            <ul class="dropdown">
                                <li class="  ">
                                    <a href="?subtopic=serverinfo">
                Serverinfo</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=quests">
                Quests</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=tasks">
                Tasks</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=achie">
                Achievement</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=crowntoken">
                Crown Tokens</a>
                                </li>
                            </ul>
                        </li>
						   <li class="  nk-drop-item">
                            <a href="#">
                Community</a>
                            <ul class="dropdown">
                                <li class="  ">
                                    <a href="?subtopic=forum">
                Forum</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=highscores">
                Highscores</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=wikiapedia">
                Wikipedia</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=houses">
                Houses</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=killstatistics">
                Latest Deaths</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=guilds">
                Guilds</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=powergamers">
                PowerGamers</a>
                                </li>
                            </ul>
                        </li>
                        <li class="  nk-drop-item">
                            <a href="?subtopic=help">
                Help</a>
                            <ul class="dropdown">
                                <li class="  ">
                                    <a href="?subtopic=faq">
                F.A.Q</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=rules">
                Rules</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=support">
                Support</a>
                                </li>
                                <li class="  ">
                                    <a href="?subtopic=security">
                Security</a>
                                </li>
                            </ul>
                        </li>
						  <li class="  ">
                            <a href="?subtopic=register">
                Register</a>
                        </li>
						                        <li class="  ">
                            <a href="?subtopic=account">
                Login</a>
                        </li>
                    </ul>

                    <ul class="nk-nav nk-nav-right nk-nav-icons">

                        <li class="single-icon hidden-lg-up">
                          <i class="fas fa-chart-bar"></i>  <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
							
                            </a>
                        </li>



                        <li class="single-icon">
                            <a href="#" class="nk-search-toggle no-link-effect">
                                <span class="nk-icon-search"></span>
                            </a>
                        </li>


                        <li class="single-icon">
                            <a href="#" class="nk-cart-toggle no-link-effect">
                                <span class="nk-icon-toggle">
                                    <span class="nk-icon-toggle-front">
                                        <span class="ion-android-cart"></span>
                                        <span class="nk-badge">8</span>
                                    </span>
                                    <span class="nk-icon-toggle-back">
                                        <span class="nk-icon-close"></span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="single-icon">
                            <a href="#" class="no-link-effect" data-nav-toggle="#nk-side">
							<i class="fa fa-bar-chart" aria-hidden="true"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- END: Navbar -->

</header>


<br>
<h2 class="nk-title h3 text-xs-center">
    GODLike |
    <span class="db hidden-sm-up"></span>
    <span class="nk-typed" data-loop="true" data-shuffle="false" data-cursor="false" data-type-speed="90" data-start-delay="0" data-back-speed="60" data-back-delay="1000">
                        <span>Best RPG</span>
                        <span>Low Rates</span>
                        <span>Missions & Acesses.</span>
                        <span>Custom Bosses</span>
                        <span>Updates all days!</span>
                        <span>Dedicated 24h!</span>
                    </span>
</h2>



<nav class="nk-navbar nk-navbar-side nk-navbar-right-side nk-navbar-lg nk-navbar-align-center nk-navbar-overlay-content" id="nk-side">

    <div class="nk-navbar-bg">
<!--        <div class="bg-image" style="background-image: url('<?php echo $layout_name; ?>/assets/images/bg-nav-side.jpg')"></div>-->
    </div>


    <div class="nano">
        <div class="nano-content">
            <div class="nk-nav-table">

                <div class="nk-nav-row">
                    <a href="index.html" class="nk-nav-logo">
                        <img src="<?php echo $layout_name; ?>/assets/images/logo.png" alt="" width="150">
                    </a>
                </div>
				
                <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">

				<center>
					<h4 class="card-title">Top 5 Level</h4>
					<div style="border-top: 2px solid #eceeef;"></div>
					<div style="margin-bottom: 2px solid white;"></div>
						<table class="table">
							<tbody>
								<?php echo $topData; ?>
							</tbody>
						</table>
				</center>	
                </div>
				
				<div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
				<?php
					$powergamers = $SQL->query("SELECT name, experience, exphist_lastexp FROM players WHERE group_id < 2 ORDER BY  experience - exphist_lastexp DESC LIMIT 5;");
				?>
				<center>
					<h4 class="card-title">PowerGamers</h4>
						<div style="border-top: 2px solid #eceeef;"></div>
						<table class="table">
							<tbody>
								<tbody>
								<?php
								$i=0;
								foreach($powergamers->fetchAll() as $player) {
									$i++;
									$change = $player['experience']-$player['exphist_lastexp'];
									$nam = $player['name'];
									if (strlen($nam) > 15)
										{$nam = substr($nam, 0, 12) . '...';}
									echo '
									<tr>
									<td style="width: 80%"><strong>'.$i.'.</strong> 
									<a href="?subtopic=characters&name=' . $player['name'] . '">' . $nam . '</a><td><span class="label label-' . ($change >= 0 ? 'success' : 'error') . ' pull-right">' . ($change >= 0 ? '+' : '-') . $change . ' exp</td></span>
									</td>
									</tr>';
								}
								?>
							</tbody>
							</tbody>
						</table>
				</center>	
                </div>
				
                <div class="nk-nav-row">
                    <div class="nk-nav-footer">
                        &copy; 2019 Gd Group Inc. Developed in association with LoremInc. IpsumCompany, SitAmmetGroup, CumSit and related logos are registered trademarks. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- END: Right Navbar -->



<!--
START: Navbar Mobile -->

<div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-left-side nk-navbar-overlay-content hidden-lg-up">
    <div class="nano">
        <div class="nano-content">
            <a href="index.html" class="nk-nav-logo">
                <img src="<?php echo $layout_name; ?>/assets/images/logo.png" alt="" width="90">
            </a>
            <div class="nk-navbar-mobile-content">
                <ul class="nk-nav">

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END: Navbar Mobile -->



<div class="nk-main">


    <nav class="nk-navbar nk-navbar-side nk-navbar-left nk-navbar-lg nk-navbar-align-center nk-navbar-overlay-content" id="nk-navbar-left">
        <div class="nano">
            <div class="nano-content">
                <div class="nk-nav-table">
                    <div class="nk-nav-row">
					
                        <a href="index.html" class="nk-nav-logo">
                            <img src="<?php echo $layout_name; ?>/assets/images/logo.png" alt="" width="130">
                        </a>

                    </div>
					
		
                    <!--
                    START: Navigation
					-->
					
					  
                    <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
					<center><h2 class="nk-title h3">Informations</h2>
						<div style="border-top: 2px solid #eceeef;"></div>
					<table class="table table-striped">
							<tbody>
								<tr>
									<td><b>IP:</b></td> <td>burmourne.net</td>
								</tr>
								<tr>
									<td><b>Client:</b></td> <td>10.80-10.82</td>
								</tr>
								<tr style="border-bottom:2pt 1px solid #404040;">
									<td><b>Type:</b></td> <td>PvP</td>
								</tr>
								
								<td>Status:</td><td colspan=1>
										<?php
										if($config['status']['serverStatus_online'] == 1)
											echo '<span class="label label-success label-sm">Online</span>';
										else
											echo '<span class="label label-danger label-sm">Offline</span>';
										?>
									</td>
								<tr>
									<td>Server Save:</td>
									<td>06:00</td>
								</tr>
							</tbody>
						</table>
					</center>	
                   </div>
				   
				   <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
					  <div class="nk-title-sep-icon">
                        <span class="icon">
                            <span class="ion-fireball"></span>
                        </span>
						</div>
					</div>
					</br>
					</br>
					
                <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
					<center><h2 class="nk-title h3">Downloads</h2>
						<div style="border-top: 2px solid #eceeef;"></div>
					<table class="table table-striped">
							<tbody>
								</br>
								<tr>
								<a style="margin-top: 10px;" href="#" target="_blank" class="link-effect-4 link-effect-inner link-effect-r">Download GODLike Client 12</a>
								</tr>
								<tr>
								</br>
								</br>
								<a style="margin-top: 10px;" href="#" target="_blank" class="link-effect-4 link-effect-inner link-effect-r">Road Map</a>
								</tr>
							</tbody>
						</table>
					</center>	
                    </div>
					
			
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Navbar -->


    <div class="container">

        <div class="row equal-height">
            <div class="col-lg-3">
                <!--
                START: Sidebar
				-->
                <aside class="nk-sidebar nk-sidebar-left nk-sidebar-sticky">
                    <div class="nk-gap-4"></div>
                    <div class="nk-doc-links">
                        <!-- Navigation created automatically using .nk-doc-item block titles -->
                    </div>
                    <div class="nk-gap-4"></div>
                </aside>
                <!-- END: Sidebar -->
            </div>



            <div class="col-lg-9">
                <div class="nk-gap-4"></div>

                <div>
                        <!-- START: Getting Started -->
                        <div class="nk-doc-item">
							<div class="nk-doc nk-box-4 bg-dark-1">


                            <?php if ($view == '' || $view == 'news') { ?>
                            <?php } ?>

                            <?PHP echo $main_content; ?>

                            <?PHP $time_end = microtime_float(); $time = $time_end - $time_start; ?>


							</div>
                        </div>		

                    <div class="nk-gap-3"></div>

                    <div class="nk-gap-4"></div>
                </div>
            </div>
			
			
        </div>

        <div class="nk-gap-3"></div>
    </div>




    <!-- START: Footer -->

   <footer class="nk-footer nk-footer-parallax nk-footer-parallax-opacity">
        <img class="nk-footer-top-corner" src="<?php echo $layout_name; ?>/assets/images/footer-corner.png" alt="">
		
        <div class="container">
            <div class="nk-gap-2"></div>
            <div class="nk-footer-logos">
                <a href="https://themeforest.net/user/_nk/portfolio?ref=_nK" target="_blank">
                    <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/footer-logo-godlike.png" alt="" width="120">
                </a>
                <a href="https://themeforest.net/user/_nk/portfolio?ref=_nK" target="_blank">
                    <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/footer-logo-yp3.png" alt="" width="120">
                </a>
                <a href="https://themeforest.net/user/_nk/portfolio?ref=_nK" target="_blank">
                    <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/footer-logo-nk-team.png" alt="" width="150">
                </a>
                <a href="https://themeforest.net/user/_nk/portfolio?ref=_nK" target="_blank">
                    <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/footer-logo-pegi-18.png" alt="" width="46">
                </a>
                <a href="https://themeforest.net/user/_nk/portfolio?ref=_nK" target="_blank">
                    <img class="nk-img" src="<?php echo $layout_name; ?>/assets/images/footer-logo-18-restricted.png" alt="" width="160">
                </a>
            </div>
            <div class="nk-gap"></div>

            <p>
                &copy; 2016 nK Group Inc. Developed in association with LoremInc. IpsumCompany, SitAmmetGroup, CumSit and related logos are registered trademarks. GodLike and related logos are registered trademarks or trademarks of id Software LLC in the U.S. and/or other countries. All other trademarks or trade names are the property of their respective owners. All Rights Reserved.
            </p>
            <p>
                GodLike &reg;: The Darkness&trade; is a fowl beginning there Over had moveth so land wherein, fruit very gathering of, female creepeth. Dominion above sea gathered unto whales. Subdue to, have Life fowl firmament wherein. Great air without for, great him he That let earth together thing sea fly gathering. Air whose. Green in face tree to spirit life. Place stars. It two. Deep seed man isn't third. Own he is may had darkness waters you'll forth fifth their don't also fruitful be years in spirit to tree. Sixth fourth open female.
            </p>

            <div class="nk-footer-links">
                <a href="#" class="link-effect">Terms of Service</a>
                <span>|</span> <a href="#" class="link-effect">Privacy Policy</a>
            </div>

            <div class="nk-gap-4"></div>
        </div>
    </footer>
    <!-- END: Footer -->


</div>


<!--
START: Side Buttons
-->

<div class="nk-side-buttons nk-side-buttons-visible">
    <ul>
        <li class="nk-scroll-top">
                <span class="nk-btn nk-btn-lg nk-btn-icon">
                    <span class="icon ion-ios-arrow-up"></span>
                </span>
        </li>
    </ul>
</div>
<!-- END: Side Buttons -->



<!--
START: Search
-->

<div class="nk-search">
    <div class="container">
        <form class="form-horizontal" role="form" action="?subtopic=characters" method="post">
		 <fieldset class="form-group nk-search-field">
		    <div class="form-group">
			 <label for="searchInput"><i class="ion-ios-search"></i></label>
					<input type="text" maxlength="35" class="form-control" name="name" placeholder="Search..." required>
			</div>
		</form>
		</fieldset>
    </div>
</div>
<!-- END: Search -->




<!--
START: Shopping Cart
-->
<div class="nk-cart">
    <div class="nk-gap-2"></div>
    <div class="container">
        <div class="nk-store nk-store-cart">
            <div class="table-responsive">
                <table class="table nk-store-cart-products">
                    <tbody>

                    <tr>
                        <td class="nk-product-cart-thumb">
                            <a href="store-product.html" class="nk-post-image">
                                <img src="<?php echo $layout_name; ?>/assets/images/product-2-sm.png" alt="Men Tshirt" class="nk-img">
                            </a>
                        </td>
                        <td class="nk-product-cart-title">
                            <h2 class="nk-post-title h5">
                                <a href="store-product.html">Men Tshirt</a>
                            </h2>
                        </td>
                        <td class="nk-product-cart-price">$67.00</td>
                        <td class="nk-product-cart-quantity">
                            1
                        </td>
                        <td class="nk-product-cart-total">
                            $67.00
                        </td>
                        <td class="nk-product-cart-remove">
                            <a href="#">
                                <span class="ion-trash-b"></span>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td class="nk-product-cart-thumb">
                            <a href="store-product.html" class="nk-post-image">
                                <img src="<?php echo $layout_name; ?>/assets/images/product-4-sm.png" alt="Men Hoodie" class="nk-img">
                            </a>
                        </td>
                        <td class="nk-product-cart-title">
                            <h2 class="nk-post-title h5">
                                <a href="store-product.html">Men Hoodie</a>
                            </h2>
                        </td>
                        <td class="nk-product-cart-price">$125.00
                            <del>$145.00</del>
                        </td>
                        <td class="nk-product-cart-quantity">
                            2
                        </td>
                        <td class="nk-product-cart-total">
                            $250.00
                        </td>
                        <td class="nk-product-cart-remove">
                            <a href="#">
                                <span class="ion-trash-b"></span>
                            </a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-cart-total">
                Total
                <span>$317</span>
            </div>

            <div class="nk-gap-3"></div>
            <div class="nk-cart-btns">
                <a href="#" class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4">
                    Go to Checkout
                </a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="nk-btn nk-btn-lg link-effect-4 nk-cart-toggle">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
    <div class="nk-gap-5"></div>
</div>
<!-- END: Shopping Cart -->




<!-- START: Scripts -->

<!-- GSAP -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/gsap/src/minified/TweenMax.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/tether/dist/js/tether.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Sticky Kit -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>

<!-- Jarallax -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/jarallax/dist/jarallax.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/jarallax/dist/jarallax-video.min.js"></script>

<!-- Flickity -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/flickity/dist/flickity.pkgd.min.js"></script>

<!-- Isotope -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/isotope/dist/isotope.pkgd.min.js"></script>

<!-- Photoswipe -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>

<!-- Typed.js -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/typed.js/dist/typed.min.js"></script>

<!-- Jquery Form -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/jquery-form/jquery.form.js"></script>

<!-- Jquery Validation -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

<!-- Jquery Countdown + Moment -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>

<!-- Hammer.js -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/hammer.js/hammer.min.js"></script>

<!-- nK Share -->
<script src="<?php echo $layout_name; ?>/assets/plugins/nk-share/nk-share.js"></script>

<!-- NanoSroller -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>

<!-- DateTimePicker -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>

<!-- Revolution Slider -->
<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>

<!-- Keymaster -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/keymaster/keymaster.js"></script>

<!-- Summernote -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/summernote/dist/summernote.min.js"></script>

<!-- Prism -->
<script src="<?php echo $layout_name; ?>/assets/bower_components/prism/prism.js"></script>

<!-- GODLIKE -->
<script src="<?php echo $layout_name; ?>/assets/js/godlike.min.js"></script>
<script src="<?php echo $layout_name; ?>/assets/js/godlike-init.js"></script>
<!-- END: Scripts -->



</body>

</html>