<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>
<!DOCTYPE html>
<html lang="<?php print get("webLang"); ?>"<?php print defined("_angularjs") ? " ng-app" : "";?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php print $this->getTitle(); ?></title>
	
	<?php
    	$this->CSS("bootstrap", NULL, TRUE);
		$this->CSS("prettyPhoto", "videos"); 
		$this->CSS("ads", "ads"); 
		$this->CSS("default"); 
	
	 	print $this->getCSS();
		print $this->themeCSS("cpanel"); 
                
        if(defined("_angularjs")) {
            print $this->js("angular", NULL, TRUE);
        }
        
        if(defined("_codemirror")) {
            print $this->js("codemirror", NULL, TRUE);
        }
                
		$this->js("www/lib/scripts/js/main.js");
	?>

	<script type="text/javascript" src="<?php echo path("vendors/js/jquery/jquery.js", "zan"); ?>"></script>
	<script type="text/javascript" src="<?php echo path("vendors/js/editors/markitup/jquery.markitup.js", "zan"); ?>"></script>
	<script type="text/javascript" src="<?php echo path("vendors/js/editors/markitup/sets/html/set.js", "zan"); ?>"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo path("vendors/js/editors/markitup/skins/markitup/style.css", "zan"); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo path("vendors/js/editors/markitup/sets/html/style.css", "zan"); ?>" />
	
	<script type="text/javascript">
		var PATH = "<?php print path(); ?>";
		
		var URL  = "<?php print get('webURL'); ?>";

		$(document).on("ready", function() {
      		$("textarea").markItUp(mySettings);
   		});
	</script>			
</head>

<body>
	<?php
		if($isAdmin) {
		?>
			<div id="top-bar">
				<?php
					$li[] = a("&lsaquo;&lsaquo;". __(_("Go back")), path());
					$li[] = " | ". span("bold", __(_("Welcome"))) .": " . SESSION("ZanUser");
					$li[] = " | ". span("bold", __(_("Online users"))) .": $online";
					$li[] = " | ". span("bold", __(_("Registered users"))) .": $registered";
					$li[] = " | ". span("bold", __(_("Last user"))) .": ". a($lastUser["Username"], path("users/$lastUser"));
					$li[] = " | ". a(__(_("Logout")) ."&rsaquo;&rsaquo;", path("cpanel/logout/")) ."";			
					
					print ul($li);				
				?>
			</div>
		<?php
		} else {
		?>
			<div id="top-bar-logout">
				<a href="<?php print path(); ?>" title="<?php print __(_("Go back")); ?>">&lsaquo;&lsaquo; <?php print __(_("Go back")); ?></a>
			</div>
		<?php		
		}
	?>
	
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="<?php print path("cpanel"); ?>" title="">
					<img src="<?php print $this->themePath; ?>/images/logo.png" alt="MuuCMS" class="no-border" />
				</a>
			</div>
						
			<?php
				if($isAdmin) {
				?>
					<div id="background">
						<div id="notifications">
							<?php 								
								if($feedbackNotifications > 0) {
									print '	<a href="'. path("feedback/cpanel/results") .'" title="'. __(_("Messages")) .'">
												<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __(_("Feedback")) .'" class="no-border" /> 
												<sup>'. $feedbackNotifications .'</sup> 
											</a>';
								}
							?>
						</div>
					</div>
					
					<div id="route">
						<strong><?php print __(_("You are in")); ?>:</strong> <?php print routePath(); ?>
					</div>
				<?php
				} else {
				?>
					<br />
				<?php
				}
			?>
		</div>