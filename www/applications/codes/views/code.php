<?php
    if(!defined("_access")) {
        die("Error: You don't have permission to access here...");
    }
    
    $this->CSS("code", "codes", TRUE);
?>
<div class="codes">
	<h2>
		<?php echo getLanguage($code["Language"], TRUE); ?> <a href="<?php echo path("codes/". $code["ID_Code"] . "/" . $code["Slug"]); ?>" title="<?php echo $code["Title"]; ?>"><?php echo $code["Title"]; ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __(_("Published")) ." ". howLong($code["Start_Date"]) ." ". __(_("by")) .' <a title="'. $code["Author"] .'" href="'. path("users/". $code["Author"]) .'">'. $code["Author"] .'</a> '; 
			 
			if($code["Languages"] !== "") {
				echo __(_("in")) ." ". exploding(implode(", ", array_map("strtolower", explode(", ", $code["Languages"]))), "codes/language/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __(_("Likes")) .":</span> ". (int) $code["Likes"]; 
			echo ' <span class="bold">'. __(_("Dislikes")) .":</span> ". (int) $code["Dislikes"];
			echo ' <span class="bold">'. __(_("Views")) .":</span> ". (int) $code["Views"];
		?>
	</span>
	<div class="code-right">
        <a href="#comments">
            <div class="fb-comments-count" data-href="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"]); ?>">0</div> <span><?php echo __("comments"); ?></span><span style="display:none"><?php echo __("comment"); ?></span>
        </a>
    </div>	
        <?php
            foreach ($code["Files"] as $file) {
        ?>
            <p>
                <div class="title-file">
                    <?php
                        echo tagHTML("div", array(
                            "class" => "filename"
                        ), $file["Name"]);
                        
                        echo tagHTML("a", array(
                            "name"  => slug($file["Name"]),
                            "class" => "permalink",
                            "title" => __(_("Permalink to this file")),
                            "href"  => "#" . slug($file["Name"])
                        ), "&para;&nbsp;");
                    ?>
                </div>
                <textarea name="code" data-syntax="<?php echo $file["ID_Syntax"];?>"><?php echo $file["Code"]; ?></textarea>
            </p>
        <?php
            }
		if(SESSION("ZanUser")) {
	?>
			<p class="small italic">
				<?php  echo like($code["ID_Code"], "codes", $code["Likes"]) ." ". dislike($code["ID_Code"], "codes", $code["Dislikes"]) ." ". report($code["ID_Code"], "codes"); ?>
			</p>
	<?php
		}
	?>

	<div class="codes-social">		
		<div class="fb-like logo-facebook" data-href="<?php echo path("codes/go/". $code["ID_Code"]); ?>" data-send="false" data-layout="button_count" data-width="45" data-show-faces="true" data-font="arial"></div>
			
		<a href="https://twitter.com/share" data-url="<?php echo path("codes/go/". $code["ID_Code"]);?>" data-text="<?php echo $code["Title"]; ?>" class="twitter-share-button logo-twitter" data-via="codejobs" data-lang="es" data-related="codejobs.biz" data-count="none" data-hashtags="codejobs.biz">
			<?php echo __(_("Tweet")); ?>
		</a>

		<div class="clear"></div>
	</div>

        <p>
            <a name="comments">
                <div class="fb-comments" data-href="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"]); ?>" data-num-posts="2" data-width="750"></div>
            </a>
        </p>
	<p>
	<p>
		<a href="<?php echo path("codes"); ?>">&lt;&lt; <?php echo __(_("Go back")); ?></a>
	</p>
</div>

<script type="text/javascript">
    var syntax = [];
    <?php
        $data = getSyntax();
        foreach ($data as $language) {
    ?>
    syntax[<?php echo $language["ID_Syntax"]; ?>] = <?php echo json($language); ?>;
    <?php
        }
    ?>
</script>

<?php
    echo $this->js("jquery.dataset.js", "codes", TRUE);
    echo $this->js("codes.js", "codes", TRUE);
?>