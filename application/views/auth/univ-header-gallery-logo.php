<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
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
				echo "<img class='univ_page_logo' src='".base_url()."uploads/univ_gallery/".$university_details['univ_logo_path']."'/>"; 
				}
				else
				{
				echo "<img class='univ_page_logo' src='".base_url()."uploads/univ_gallery/default_logo.png'/>"; 
				}
				?>
				</li>
				<?php
				if(!empty($univ_gallery))
				{
				foreach($univ_gallery as $gallery)
				{
				if(is_array($gallery))
				{
				foreach($gallery as $gal)
				{
				if($gal!=''){
				?>
					<li><?php echo "<img class='univ_page_gal' src='".base_url()."uploads/univ_gallery/".$gal."'/>"; ?></li>
				<?php
				}
				else{ ?>
				<li class="univ_page_gal"><?php echo "No Image Available"; ?></li>
				<?php
				}
				}
				}
				}
				}
				?>
				<li class="clearfix"></li>
			</ul>
			
			<div class="row uni_menu_placeholder">
				<div class="span8 float_r" id="main-nav-holder">
					<nav id="main-nav">
						<ul class="uni_menu">
							<li><a href="<?php echo $base ?>university/<?php echo $univ_id_for_program; ?>" class="active">Home</a></li>
							<li>About</li>
							<li><a href="<?php echo "$base"; ?>univ_programs/<?php echo $univ_id_for_program; ?>/program" class="active">Programs</a></li>
							<li><a href="<?php echo "$base" ?>univ-<?php echo $univ_id_for_program; ?>-events" class="active">Events</a></li>
							<li><a href="<?php echo $base; ?>UniversityQuestSection/<?php echo $univ_id_for_program; ?>" class="active">Questions & Answers</a></li>
							<li class="border_beta"><a href="<?php echo "$base" ?>univ-<?php echo $univ_id_for_program; ?>-news" class="active">News</a></li>
						
						</ul>
					</nav>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var fixed = false;

$(document).scroll(function() {
    if( $(this).scrollTop() >= 50 ) {
        if( !fixed ) {
            fixed = true;
            $('#main-nav').css({position:'fixed',top:140,left:694});
			// Or set top:20px; in CSS
        }                                           // It won't matter when static
    } else {
        if( fixed ) {
            fixed = false;
            $('#main-nav').css({position:'static'});
        }
    }
});

});

</script>