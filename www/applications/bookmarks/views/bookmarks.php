<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="bookmarks">
	<?php 
		foreach($bookmarks as $bookmark) { 
	?>
			<h2>
				<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"]); ?>" title="<?php echo $bookmark["Title"]; ?>"><?php echo $bookmark["Title"]; ?></a>
			</h2>

			<span class="small italic grey">
				<?php 
					echo __(_("Published")) ." ". howLong($bookmark["Start_Date"]) ." ". __(_("by")) .' <a title="'. $bookmark["Author"] .'" href="'. path("users/". $bookmark["Author"]) .'">'. $bookmark["Author"] .'</a> '; 
					 
					if($bookmark["Tags"] !== "") {
						echo __(_("in")) ." ". exploding($bookmark["Tags"], "bookmarks/tag/");
					}
				?>			
				<br />

				<?php 
					echo '<span class="bold">'. __(_("Likes")) .":</span> ". (int) $bookmark["Likes"]; 
					echo ' <span class="bold">'. __(_("Dislikes")) .":</span> ". (int) $bookmark["Dislikes"];
					echo ' <span class="bold">'. __(_("Views")) .":</span> ". (int) $bookmark["Views"];
				?>
			</span>

			<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo $bookmark["Title"]; ?>" tw:url="<?php echo path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"]); ?>"></a>
			</div>

			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script>			

			<p class="justify">				
				<?php echo stripslashes($bookmark["Description"]); ?>
			</p>

			<?php 
				if(SESSION("ZanUser")) { 
			?>
					<p class="small italic">
						<?php echo like($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Likes"]) ." ". dislike($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Dislikes"]) ." ". report($bookmark["ID_Bookmark"], "bookmarks"); ?>
					</p>
			<?php 
				} 
			?>
			<br />
		
	<?php 
		} 
	?>

	<?php echo $pagination; ?>
</div>
