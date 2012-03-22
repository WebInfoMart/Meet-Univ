<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="form">
			<div class="row">
				<div class="span6 real gallery_div">
					<div id='coin-slider'>
					<?php
				foreach($gallery_home as $galery_images)
				{
					if(!empty($galery_images['image_path']))
					{
					?>
					
<a href="" target="_blank">
		<img src="<?php echo "$base"; ?>uploads/home_gallery/<?php echo $galery_images['image_path']; ?>" alt="" width="580" height="360" title="" alt="" rel=" "/>
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
				
				<div class="float_r span14 margin">
					<div class="row margin_b">
						<div class="float_l span21 padding_alpha">
							<h3>Explore</h3>
						</div>
						<div class="float_r span5">
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn active" id="events">Events</button>
								<button class="btn" id="colleges">Colleges</button>
							</div>
							<h4><small class="white">colleges by programs, country and course level</small></h4>
						</div>
						<div class="clearfix"></div>
					</div>
				<div class="events" id="events_col">
					<div class="row margin_b">
						<div class="float_l span21">
							<span class="line">Events</span></br>
						</div>
						<div class="float_r span5">
							<div class="btn-group" data-toggle="buttons-radio">
								<!--<a class="btn" href="#">All</a>
								<a class="btn" href="#">Postgraduate</a>
								<a class="btn" href="#">Undergraduate</a>
								<a class="btn" href="#">Foundation</a>-->
								<button class="btn btnop active" id="all">All</button>
								<button class="btn btnop" id="spot">Spot Admission</button>
								<button class="btn btnop" id="fairs">Fairs</button>
								<button class="btn btnop"id="opendd">Counselling</button>
							</div>
							  <ul class="ddclass">
							  <li class="li1 openddli">
							  <a href="#">Others</a></li>
							  <li class="li2 openddli" >
							  <a href="#">Alumuni</a>
							  </li>
							  </ul>
						</div>
						<div class="clearfix"></div>
				</div>			
				</div>
				<div class="college" id="col">
				
					<div class="row margin_b">
						<div class="float_l span21">
							<span class="line">Type</span></br>
						</div>
						<div class="float_r span5">
							<div class="btn-group" data-toggle="buttons-radio">
								<!--<a class="btn" href="#">All</a>
								<a class="btn" href="#">Postgraduate</a>
								<a class="btn" href="#">Undergraduate</a>
								<a class="btn" href="#">Foundation</a>-->
								<button class="btn">All</button>
								<button class="btn">Postgraduate</button>
								<button class="btn">UnderGraduate</button>
								<button class="btn">Foundation</button>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row margin_b">
						<div class="float_l span21">
							<span>in Country</span></br>
						</div>
						<div class="float_r span5">
							<div class="controls">
								<select id="select01">
									<option>All</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row margin_b">
						<div class="float_l span21">
							<span>Course</span></br>
						</div>
						<div class="float_r span5">
							<div class="controls float_l span3 margin_zero">
									<select id="select01">
										<option>All</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="float_r span1 margin_r">
									<button class="btn" href="#">Submit</button>
								</div>
								<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
						<div class="search_layout">
					
					
					
					
					<div class="row margin_b">
						<div class="float_l span21">
							<span>City</span></br>
						</div>
						<div class="float_r span5">
							<div class="controls float_l span3 margin_zero">
								<select id="select01">
									<option>Select City</option>
									<option>India</option>
									<option>USA</option>
									<option>Canada</option>
									<option>New york</option>
								</select>
								
							</div>
								
								<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="margin_b2">
						<div class="float_l">
							<img src="images/form_line_breaker.png">
						</div>
						<div class="float_l style_or">OR</div>
						<div class="float_l"><img src="images/form_line_breaker2.png"></div>
						<div class="clearfix"></div>
					</div>
					
				</div>
			
					
					<div class="row margin_b">
						<div class="float_l span21">
							<span>Search</span></br>
						</div>
						<div class="float_r span5">
							<div class="controls float_l span3 margin_zero">
								<input class="input-large focused" id="focusedInput" type="text" value="" placeholder="Search here...">
								<h4 class="span4 margin_zero"><small class="white">ex:</small><small> mba, university of sydney, undergraduate course</small></h3>
							</div>
								<div class="float_r span1 margin_r">
								<button class="btn" href="#">Submit</button>
								</div>
								<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			<div class="clearfix"></div>
		</div>
		<div class="body_container">
			<div class="yellow_bar text_bar margin_t">
				<div class="row">
					<div class="span17 yellow_bar_text float_l"><ul><li><a href="#">Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat.</a></li></ul></div>
					<div class="span17 yellow_bar_text float_r margin_zero"><ul><li><a href="#">Praesent eu nisl at eros vulputate fringilla vel rdiet od liastu vestibulum.</a></li></ul></div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="margin_t1">
				<div class="span41 margin_delta">
					<ul id="tab" class="nav nav-tabs">
						<li class="active"><a data-toggle="tab">Events</a></li>
					</ul>
					<div id="home" class="box">
						<div class="row box_list">
							<ul>
								<li><div class="float_l span11">
										<img src="images/bucks.png">
									</div>
									<div class="float_l span15 margin_zero">
										<p>Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl </p> 
									</div>
									<div class="float_r span1 margin_zero margin_l8 text_align">
										<h3><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
									<div class="clearfix"></div>
								</li>
								<li><div class="float_l span11">
										<img src="images/ls.png">
									</div>
									<div class="float_l span15 margin_zero">
										<p>Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl </p> 
									</div>
									<div class="float_r span1 margin_zero margin_l8 text_align">
										<h3><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
										<div class="clearfix"></div>
								</li>
								<li><div class="float_l span11">
										<img src="images/uds.png">
									</div>
									<div class="float_l span15 margin_zero">
										<p>Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl </p> 
									</div>
									<div class="float_r span1 margin_zero margin_l8 text_align">
										<h3><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
										<div class="clearfix"></div>
								</li>
								<li><div class="float_l span11">
										<img src="images/layer2.png">
									</div>
									<div class="float_l span15 margin_zero">
										<p>Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl </p> 
									</div>
									<div class="float_r span1 margin_zero margin_l8 text_align">
										<h3><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
										<div class="clearfix"></div>
								</li>
								<li><div class="float_l span11">
										<img src="images/middlesex.png">
									</div>
									<div class="float_l span15 margin_zero">
										<p>Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl </p> 
									</div>
									<div class="float_r span1 margin_zero margin_l8 text_align">
										<h3><small>11-Mar</small></h3>
										<span class="span_text">300 attending</span>
										<button class="btn_reg" href="#">Register!</button>
									</div>
										<div class="clearfix"></div>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="span41">
					<ul id="tab" class="nav nav-tabs">
							<li class="active"><a data-toggle="tab">Featured Article</a></li>
					</ul>
					<div id="home" class="box">
						<div class="float_l margin_r1">
							<img src="images/layer.png">
						</div>
						<div class="margin_l8">
							Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdie fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od. 
						</div>							
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="span41">
					<ul id="tab" class="nav nav-tabs">
							<li class="active"><a data-toggle="tab">Featured Colleges</a></li>
					</ul>
						<div id="home" class="box">
							<div class="row list_style">
								<ul>
									<li>
										<div class="float_l span22"><img src="images/layer15.png"></div>
										<div class="float_l span22 margin_zero margin_l21"><img src="images/layer11.png"></div>
										<div class="float_r span22 margin_zero"><img src="images/layer10.png"></div>
										<div class="clearfix"></div>
									</li>
									<li>
										<div class="float_l span22"><img src="images/layer15.png"></div>
										<div class="float_l span22 margin_zero margin_l21"><img src="images/layer13.png"></div>
										<div class="float_r span22 margin_zero"><img src="images/layer12.png"></div>
										<div class="clearfix"></div>
									</li>
									<li>
										<div class="float_l span22"><img src="images/layer15.png"></div>
										<div class="float_l span22 margin_zero margin_l21"><img src="images/layer11.png"></div>
										<div class="float_r span22 margin_zero"><img src="images/layer10.png"></div>
										<div class="clearfix"></div>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="yellow_bar margin_t1">
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
			<div class="margin_t1">
				<div class="span41 margin_delta">
					<ul id="tab" class="nav nav-tabs">
							<li class="active"><a data-toggle="tab">Questions and Answers</a></li>
					</ul>
					<div id="home" class="box question">
						<ul>
							<li class="margin_t1">
								<div class="float_l">
									<img src="images/img_boy.png">
								</div>
								<div class="float_r span16 margin_zero">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
						   <li>
								<div class="float_l">
									<img src="images/img_girl.png">
								</div>
								<div class="float_r span16 margin_zero">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_boy.png">
								</div>
								<div class="float_r span16 margin_zero">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li>
								<div class="float_l">
									<img src="images/img_girl.png">
								</div>
								<div class="float_r span16 margin_zero">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...<img src="images/like.png" class="face">
								</div>
							</li>
							<li class="margin_gamma">
								<div class="float_l">
									<img src="images/img_boy.png">
								</div>
								<div class="float_r span16 margin_zero">
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate vel rdiet ...
									<img src="images/like.png" class="face">
								</div>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>					
				</div>
				<div class="span41">
					<ul id="tab" class="nav nav-tabs">
							<li class="active"><a data-toggle="tab">Demo</a></li>
					</ul>
					<div id="home" class="box">
					
					</div>
				</div>
				<div class="span41 margin_n">
					<img src="images/facebook.png">
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="banner margin_t1">
				<div class="float_l span6 margin_zero"><img src="images/banner1.png"></div>
				<div class="float_r span6 margin_zero"><img src="images/banner1.png"></div>
				<div class="clearfix"></div>
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
		$('#coin-slider').coinslider({ width: 900, navigation: false, delay: 5000 });
		
		
		width: 565, // width of slider panel
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


