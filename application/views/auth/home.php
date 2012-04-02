<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="form">
			<div class="row">
				<div class="span8 real margin_t">
					<div id='coin-slider' class='gallery_div'>
					<?php
				foreach($gallery_home as $galery_images)
				{
					if(!empty($galery_images['image_path']))
					{
					?>
					
<a href="" target="_blank">
		<img src="<?php echo "$base"; ?>uploads/home_gallery/<?php echo $galery_images['image_path']; ?>" alt="" width="700" height="360" title="" alt="" rel=" "/>
		<span>
			<?php echo $galery_images['title'].'</br>'.$galery_images['image_caption']; ?>
		</span>
	</a>
	
					
					<?php
					}
				}
				?>
				</div>
					
				
				</div>
				
				<div class="float_r span8 margin_t margin_l">
					<form class="form-horizontal form_horizontal_home" action="college_search" method="post">
					<input type="hidden" name="type_search" id="type_search" value="0"/>
						<div class="control-group">
						
						
						
							
							<label class="control-label" for="focusedInput"><h3 class="white">Explore</h3></label>
								<div class="controls">
									<div class="btn-group" data-toggle="buttons-radio">
										<button type="button" class="btn active" id="events">Events</button>
										<input type="button" class="btn" id="colleges" value="Colleges"><br/>
										<p class="help-block white form_height">colleges by programs, country and course level</p>
									</div>
								</div>
						</div>
						<div class="events" id="events_col">
							<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">Events</h3></label>
									<div class="controls">
										<div class="btn-group" data-toggle="buttons-radio">
											<!--<a class="btn" href="#">All</a>
											<a class="btn" href="#">Postgraduate</a>
											<a class="btn" href="#">Undergraduate</a>
											<a class="btn" href="#">Foundation</a>-->
											<button type="button" class="btn btnop active" id="all">All</button>
											<button type="button" class="btn btnop" id="spot">Spot Admission</button>
											<button type="button" class="btn btnop" id="fairs">Fairs</button>
											<button type="button" class="btn btnop"id="opendd">Counselling</button>
										</div>
										<ul class="ddclass">
										<li class="li1 openddli">
										<a href="#">Others</a></li>
										<li class="li2 openddli" >
										<a href="#">Alumuni</a>
										</li>
										</ul>
									</div>
							</div>
						</div>
						<div class="college" id="col">
							<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">Type</h3></label>
								<div class="controls">
									<div class="btn-group" data-toggle="buttons-radio">
										<!--<a class="btn" href="#">All</a>
										<a class="btn" href="#">Postgraduate</a>
										<a class="btn" href="#">Undergraduate</a>
										<a class="btn" href="#">Foundation</a>-->
										<button type="button" id="all" class="btn active">All</button>
										<button type="button" id="pg" class="btn">Postgraduate</button>
										<button type="button" id="ug" class="btn">UnderGraduate</button>
										<button type="button" id="found" class="btn">Foundation</button>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">in Country</h3></label>
								<div class="controls">
									<select id="search_country" name="search_country">
										<option value="">select</option>
										<?php
										foreach($country as $srch_country)
										{
										?>
											<option value="<?php echo $srch_country['country_id'] ?>"> <?php echo $srch_country['country_name'] ?> </option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">Course</h3></label>
								<div class="controls">
									<div class="float_l span4 margin_zero">
										<select id="search_program" name="search_program">
											<option value="">select</option>
											<?php
										foreach($area_interest as $srch_course)
										{
										?>
											<option value="<?php echo $srch_course['prog_id']; ?>"> <?php echo $srch_course['course_name']; ?> </option>
										<?php
										}
										?>
										</select>
									</div>
									<div class="float_l span1">
										
										<input type="submit" name="btn_col_search" class="btn" value="Search"/>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!--<div class="search_layout">
							<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">City</h3></label>
								<div class="controls">
									<select id="select01">
										<option>Select City</option>
										<option>India</option>
										<option>USA</option>
										<option>Canada</option>
										<option>New york</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<div class="margin_b2">
									<div class="float_l">
										<img src="images/form_line_breaker.png">
									</div>
									<div class="float_l style_or">OR</div>
									<div class="float_l"><img src="images/form_line_breaker2.png"></div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>-->
						<div class="control-group">
								<label class="control-label" for="focusedInput"><h3 class="white">Search</h3></label>
								<div class="controls">
									<div class="float_l span4 margin_zero">
										<input class="input-xlarge focused" id="focusedInput" type="text" value="" placeholder="Search here...">
										<p class="help-block ex_univ"><span class="white">ex:</span> mba, university of sydney, undergraduate course</p>
									</div>
									<div class="float_l span1">
										<button class="btn" href="#">Submit</button>
									</div>
									<div class="clearfix"></div>
								</div>
						</div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			<div class="clearfix"></div>
		</div>
	<div class="body">
		<div class="row">
			<div class="span16 margin_l margin_t1">
				<div class="yellow_bar text_bar">
					<div class="span8 yellow_bar_text float_l margin_zero"><ul><li><a href="#">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat.</a></li></ul></div>
					<div class="span8 yellow_bar_text float_r margin_zero"><ul><li><a href="#">Praesent eu nisl at eros vulputate fringilla vel rdiet od liastu vestibulum.</a></li></ul></div>
					<div class="clearfix"></div>
				</div>
		    </div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="grid_3 margin_l home_artical_box">
					<div class="home_artical_heading">
						<span>Events</span>
					</div>
					<div class="box all_box">
						<ul class="box_list">
							<li>
								<div>
									<div class="float_l">
										<img src="images/bucks.png" class="events_img">
									</div>
									<div class="float_l margin_l data_events">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl</div>
									<div class="float_r">
										<h3 class="style_h3"><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
									<div class="clearfix"></div>
								</div>
							</li>
							<li>
								<div>
									<div class="float_l">
										<img src="images/ls.png" class="events_img">
									</div>
									<div class="float_l margin_l data_events">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl</div>
									<div class="float_r">
										<h3 class="style_h3"><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
									<div class="clearfix"></div>
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/uds.png" class="events_img">
								</div>
								<div class="float_l margin_l data_events">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl</div>
								<div class="float_r">
									<h3 class="style_h3"><small>11-Mar</small></h3>
									<span class="span_text">300 attending</span>
									<button class="btn_reg" href="#">Register!</button>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/layer2.png" class="events_img">
								</div>
								<div class="float_l margin_l data_events">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl</div>
								<div class="float_r">
									<h3 class="style_h3"><small>11-Mar</small></h3>
									<span class="span_text">300 attending</span>
									<button class="btn_reg" href="#">Register!</button>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/middlesex.png" class="events_img">
								</div>
								<div class="float_l margin_l data_events">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl</div>
								<div class="float_r">
									<h3 class="style_h3"><small>11-Mar</small></h3>
									<span class="span_text">300 attending</span>
									<button class="btn_reg" href="#">Register!</button>
								</div>
								<div class="clearfix"></div>
							</li>

							</ul>
					</div>
				</div>
				<div class="grid_3">
					<div class="home_artical_heading">
						<span>Featured Article</span>
					</div>
					<div class="box">
						<div class="float_l">
							<img src="images/layer.png">
						</div>
						<div>
							Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdie fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od. 
						</div>							
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="grid_3">
					<div class="home_artical_heading">
						<span>Featured Colleges</span>
					</div>
					<div class="box">
						<ul>
							<li>
								<div class="float_l"><img src="images/layer15.png" class="featured_art"></div>
								<div class="float_l margin_l"><img src="images/layer11.png" class="featured_art"></div>
								<div class="float_r"><img src="images/layer10.png" class="featured_art"></div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="float_l"><img src="images/layer15.png" class="featured_art"></div>
								<div class="float_l margin_l"><img src="images/layer13.png" class="featured_art"></div>
								<div class="float_r"><img src="images/layer12.png" class="featured_art"></div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="float_l"><img src="images/layer15.png" class="featured_art"></div>
								<div class="float_l margin_l"><img src="images/layer11.png" class="featured_art"></div>
								<div class="float_r"><img src="images/layer10.png" class="featured_art"></div>
								<div class="clearfix"></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="yellow_bar span16 margin_l">
					<ul class="yellow yellow_nav">
						<li><a href="#">Engineering</a></li>
						<li><a href="#">Medical</a></li>
						<li><a href="#">Media & Journalism</a></li>
						<li><a href="#">Hospitality </a></li>
						<li><a href="#">Technology  </a></li>
						<li><a href="#">Science</a></li>
						<li><a href="#" style="border:none;">MBA</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="grid_3 margin_l">
					<div class="home_artical_heading">
						<span>Featured Colleges</span>
					</div>
					<div class="box all_box">
						<ul>
							<li>
								<div class="float_l">
									<img src="images/img_girl.png">
								</div>
								<div class="float_l span4 margin_l">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_boy.png">
								</div>
								<div class="float_l span4 margin_l">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_girl.png">
								</div>
								<div class="float_l span4 margin_l">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_boy.png">
								</div>
								<div class="float_l span4 margin_l">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_girl.png">
								</div>
								<div class="float_l span4 margin_l">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="grid_3">
					<div class="home_artical_heading">
						<span>Destination</span>
					</div>
					<div class="box">
						
					</div>
				</div>
				<div class="grid_3">
					<img src="images/facebook.png">
				</div>
			</div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="span8 margin_l"><img src="images/banner1.png"></div>
				<div class="span8"><img src="images/banner1.png"></div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">	
.ddclass{
list-style:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;
border:1px solid #ccc;width:86px;position:relative;left:186px;top:1px;display:none;
}
.ddclass li{background-color:#F5F5F5;}
.ddclass li:hover{background-color:#ccc;cursor:pointer;}
.li1 a {color:#000;}
.li2 a {color:#000;}
.li1{padding-left:10px;padding-top:5px;}
.li1 a:hover{text-decoration:none;}
.li2 a:hover{text-decoration:none;}
.li2{padding-left:10px;margin-bottom:0px;padding-right:5px;padding-top:5px;}
</style>
<script>
$('#opendd').mouseenter(
function(){
$('.ddclass').css('display','block');
}
);
$('.openddli').click(function()
	{
	
	 $('.btnop').each(function()
	 {
	
	  if($(this).attr("id")==null || $(this).attr("id")=='')
	  {
	   $(this).removeClass('active');
	  }
	  else
	  {
	  $(this).addClass('active');
	  $('.ddclass').css('display','none');
	  }
	 
	 })
	  $('#opendd').html($(this).text());
	})
	$("body").click
(
  function(e)
  {
    if(e.target.className !== "ddclass")
    {
      $('.ddclass').css('display','none');
    }
  }
);
$(document).ready(function() {
			$("#col").hide();
	$('#colleges').click(function() {
		$("#events_col").hide();
		$("#col").show();
   });
   $('#events').click(function() {
		$("#col").hide();
		$("#events_col").show();
   });
});
</script>	

<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider();
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({ width: 500, navigation: false, delay: 5000 });
		
		
		width: 400, // width of slider panel
height: 290, // height of slider panel
spw: 7, // squares per width
sph: 5, // squares per height
delay: 3000, // delay between images in ms
sDelay: 30, // delay beetwen squares in ms
opacity: 0.7, // opacity of title and navigation
titleSpeed: 500, // speed of title appereance in ms
effect: '', // random, swirl, rain, straight
navigation: true, // prev next and buttons
links : true, // show images as links
hoverPause: true // pause on hover
	});
</script>
<script>
$(document).ready(function(){
$('#all').click(function(){
$('#type_search').val('0');
});

$('#found').click(function(){
$('#type_search').val(2);
});

$('#pg').click(function(){
$('#type_search').val(4);
});

$('#ug').click(function(){
$('#type_search').val(3);
});



});
</script>


