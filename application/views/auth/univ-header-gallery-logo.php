<div class="row">
				<div class="span10">
					<h2><?php 
					if($university_details['univ_name'] != '')
					{
					echo $university_details['univ_name']; } ?> 
					- <small><?php 
					if($country_name_university['country_name'] != '')
					{
					echo $country_name_university['country_name']; } ?>
					, <?php 
					if($city_name_university['cityname'] != ''){
					echo $city_name_university['cityname']; } ?></small></h2>
				</div>
				<div class="span4 float_r margin_t">
					<div class="margin_zero float_l">
						<div class="float_l"><img src="<?php echo "$base$img_path" ?>/user.png"></div>
						<div class="float_r margin_l"><small>Followers <?php print_r($count_followers); ?></small></div>
					</div>
					<div class="margin_zero float_r">
						<div class="float_l"><img src="<?php echo "$base$img_path" ?>/document.png"></div>
						<div class="float_r margin_l"><small>Articles <?php print_r($count_articles); ?></small></div>
					</div>
				</div>
			</div>
			
			<ul class="uni_gallery">
				<li class="univ_page_logo">
				<?php 
				if($university_details['univ_logo_path'] != '')
				{
				echo "<img src='".base_url()."uploads/univ_gallery/".$university_details['univ_logo_path']."'/>"; 
				}
				?></li>
				<?php
				if(!empty($univ_gallery))
				{
				foreach($univ_gallery as $gallery)
				{
				if(is_array($gallery))
				{
				foreach($gallery as $gal)
				{
				//print_r($gal);
				?>
					<li class="univ_page_gal"><?php echo "<img src='".base_url()."uploads/univ_gallery/".$gal."'/>"; ?></li>
				<?php
				}
				}
				}
				}
				?>
				<li class="clearfix"></li>
			</ul>
			
			<div class="row uni_menu_placeholder">
				<div class="span7 float_r">
					<ul class="uni_menu">
						<li>Home</li>
						<li>About</li>
						<li><a href="<?php echo "$base"; ?>univ_programs/<?php echo $univ_id_for_program; ?>/program">Programs</a></li>
						<li>Events</li>
						<li>Questions & Answers</li>
						<li class="border_beta">News</li>
					</ul>
				</div>
			</div>
			
			<div class="clearfix"></div>