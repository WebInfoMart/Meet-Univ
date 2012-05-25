<?php //function for counting the no of views 
$no_of_views=$university_details['univ_views_count']+1;
$this->users->increase_univ_no_of_views($university_details['univ_id'],$no_of_views); ?>
<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.univ.fancybox.js"></script>
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/jquery.fancybox.css" />
<script type="text/javascript">
		$(document).ready(function() {
			
			$('.fancybox').fancybox();

		});
	</script>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<div class="row">
				<div class="span10">
					<h2><?php 
					$comcount=0;
					if($university_details['univ_name'] != '' || $university_details['univ_name']!= '0')
					{
					echo $university_details['univ_name'].'-'; } ?> 
					 <small><?php 
					 if($city_name_university !='0')
					 {
						echo $city_name_university['cityname']; 
						$comcount=1;
					 }
					 if($state_name_university != '0')
					 {
						if($comcount>0)
						{
						$comcount++;
						echo ",";
						}
						echo $state_name_university['statename'];
						
					 }
					if($country_name_university != '0')
					{
						if($comcount>0)
						{
						$comcount++;
						echo ",";
						}
					echo $country_name_university['country_name']; 
					
					} ?>
					 </small></h2>
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
			
			
				<div class="univ_page_logo aspectcorrect" style='position:absolute;' >
				
				<?php
									$image_exist=0;	
									$univ_img = $university_details['univ_logo_path'];	
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_img) && $univ_img!='')	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$univ_img);
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');
									}
									if($univ_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/univ_gallery/'.$univ_img;
									}
									else
									{
									$image=$base.'uploads/univ_gallery/univ_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,150,150,TRUE);
				?>
				<img  title="" src='<?php echo $image;?>' style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;">
	
				</div>
				
				<ul class="uni_gallery">
				<?php
				if(!empty($univ_gallery))
				{
				foreach($univ_gallery as $gallery)
				{
				if(is_array($gallery))
				{
				foreach($gallery as $gal)
				{
				if(file_exists(getcwd().'/uploads/univ_gallery/'.$gal) && $gal!='')
				{
				?>
					<li>
				<a class="fancybox" href="<?php echo $base; ?>uploads/univ_gallery/<?php echo $gal; ?>" data-fancybox-group="gallery" >	<img class='univ_page_gal' src='<?php echo $base; ?>uploads/univ_gallery/<?php echo $gal; ?>' /></a>
					</li>
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
				<div class="span9 float_r" id="main-nav-holder">
					<nav id="main-nav">
						<ul class="uni_menu">
							<li><a href="<?php echo $base ?>university/<?php echo $univ_id_for_program; ?>" class="active">Home</a></li>
							<li><a href="<?php echo $base ?>about-<?php echo $univ_id_for_program; ?>-university" class="active">About</a></li>
							<li><a href="<?php echo "$base"; ?>univ_programs/<?php echo $univ_id_for_program; ?>/program" class="active">Programs</a></li>
							<li><a href="<?php echo "$base" ?>univ-<?php echo $univ_id_for_program; ?>-events" class="active">Events</a></li>
							<li><a href="<?php echo $base; ?>UniversityQuestSection/<?php echo $univ_id_for_program; ?>" class="active">Questions & Answers</a></li>
							<li ><a href="<?php echo "$base" ?>univ-<?php echo $univ_id_for_program; ?>-news" class="active">News</a></li>
							<li class="border_beta"><a href="<?php echo "$base" ?>univ-<?php echo $univ_id_for_program; ?>-articles" class="active">Articles</a></li>
						</ul>
					</nav>
				</div>
			</div>
			
			<div class="clearfix"></div>

<script type="text/javascript">
$(document).ready(function() {
	var fixed = false;

$(document).scroll(function() {
    if( $(this).scrollTop() >= 75 ) {
        if( !fixed ) {
            fixed = true;
            $('#main-nav').css({position:'fixed',top:140,left:628});
			 $('.uni_menu').css({opacity:1});
			// Or set top:20px; in CSS
        }                                           // It won't matter when static
    } else {
        if( fixed ) {
            fixed = false;
            $('#main-nav').css({position:'static'});
			$('.uni_menu').css({opacity:0.7});
        }
    }
});
$(".uni_menu").hover(
  function () {
    $(this).css({opacity:1});
  }, 
  function () {
    $(this).css({opacity:0.7});
  }
);
});

</script>