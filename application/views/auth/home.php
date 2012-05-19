<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<script>
$(function () {
        // basic version is: $('div.demo marquee').marquee() - but we're doing some sexy extras
        
        $('marquee').marquee('pointer').mouseover(function () {
	       $(this).trigger('stop');
        }).mouseout(function () {
            $(this).trigger('start');
        }).mousemove(function (event) {
            if ($(this).data('drag') == true) {
                this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
            }
        }).mousedown(function (event) {
            $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function () {
            $(this).data('drag', false);
        });
    });
 
</script>
<div class="container">

	<div class="body_bar"></div>
	<div class="body_header"></div>
	<div class="form">
		<div class="row">
			<div class="span8 real margin_t">
				<div id="slider_slides"  class='gallery_div'>
				<div class="slides_container">
				<?php
					foreach($gallery_home as $galery_images)
					{
						if(!empty($galery_images['image_path']))
					{
					?>			
					<div class="slide">
						<a href="#" title=""><img src="<?php echo "$base"; ?>uploads/home_gallery/<?php echo $galery_images['image_path']; ?>" alt="" width="700" height="360" title="" alt="" rel=" "></a>
						<div class="slider_caption" style="bottom:0">
							<p><?php echo $galery_images['title'].'</br>'.$galery_images['image_caption']; ?></p>
						</div>
					</div>	
				
				<?php
				  }
				  }
				?>
				</div>	
				</div>				
			</div>
			<div class="float_r span8 margin_t margin_l">
				<form class="form-horizontal form_horizontal_home" id="search_form" action="" method="get">
					<input type="hidden" name="type_search" id="type_search" value="0"/>
					<input type="hidden" name="educ_level" id="educ_level" value="All"/>
					
					<div class="control-group">
						<label class="control-label" for="focusedInput"><h3 class="white">Explore</h3></label>
						<div class="controls">
							<div class="btn-group" data-toggle="buttons-radio">
								<button type="button" class="btn active" id="events">Events</button>
								<button type="button" class="btn" id="colleges">Colleges</button>
							</div>
							<p class="help-block white form_height">colleges by programs, country and course level</p>
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
									<button type="button" class="btn btnop" id="opendd">Counselling</button>
								</div>
								<div class="ddposition">
									<ul class="ddclass">
										<li class="li1 openddli" id="others"><a href="#" id="other_dd">Others</a></li>
										<li class="li2 openddli" id="alumuni" ><a href="#" id="alu_dd">Alumuni</a></li>
									</ul>
								</div>	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h3 class="white">in City</h3></label>
							<div class="controls">
								<select name="event_city" id="city">
									<option value="">All</option>
									<?php
									foreach($cities as $city)
									{ ?>
									<option value="<?php echo $city['city_id']; ?>"><?php echo ucwords($city['cityname']); ?></option>
								
								<?php } ?>	
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h3 class="white">in the Month of</h3></label>
							<div class="float_l span4 margin_zero">
								<!--<input class="input-xlarge focused" id="focusedInput" type="text" value="" placeholder="Month">-->
								<select name="event_month" id="month">
									<option value="">All</option>
									<option value="Januray">Jan</option>
									<option value="February">Feb</option>
									<option value="March">Mar</option>
									<option value="April">Apr</option>
									<option value="May">May</option>
									<option value="June">Jun</option>
									<option value="July">Jul</option>
									<option value="August">Aug</option>
									<option value="September">Sep</option>
									<option value="October">Oct</option>
									<option value="November">Nov</option>
									<option value="December">Dec</option>
								</select>
							</div>
							<div class="float_l span1">
									<input type="button" onclick="serch_events();" name="btn_evet_search" class="btn" value="Search"/>
									<input type="hidden" name="btn_event_serch" value="">
								</div>
								<div class="clearfix"></div>
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
									<button type="button" id="allcollege" class="btn active">All</button>
									<button type="button" id="pg" class="btn">PostGraduate</button>
									<button type="button" id="ug" class="btn">UnderGraduate</button>
									<button type="button" id="found" class="btn">Foundation</button>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h3 class="white">in Country</h3></label>
							<div class="controls">
								<select id="search_country" name="search_country">
									<option value="">Select Country</option>
										<?php
										foreach($country as $srch_country)
										{
										?>
											<option value="<?php echo $srch_country['country_id'] ?>"><?php echo ucwords($srch_country['country_name']); ?></option>
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
										<option value="">Select</option>
										<?php
										foreach($area_interest as $srch_course)
										{
										?>
											<option value="<?php echo $srch_course['prog_parent_id']; ?>"><?php echo ucwords($srch_course['program_parent_name']); ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="float_l span1">
									<input type="button" onclick="serach_results()" name="serach_col_btn" class="btn" value="Search"/>
									<input type="hidden" name="btn_search" id="btn_col_search">
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
					<!--<div class="control-group">
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
					-->
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="body">
		<div class="row">
			<div class="span16 margin_l margin_t1">
				<div class="yellow_bar text_bar">
				<?php
					$x=0;
				if($featured_news==0) {	 ?>
				<div class="span8 yellow_bar_text float_l margin_zero"><ul><li>
					Sorry No recent News
					</li></ul>
					</div>
				
			<?php 	}
				else
				{?>
	<div class="marquee">
		<?php				foreach($featured_news as $featured_news_list) { $x++; ?>
					<div class="span8 yellow_bar_text float_l  margin_zero"><ul><li>
					<a href="<?php echo $base; ?>univ-<?php echo $featured_news_list['news_univ_id']; ?>-news-<?php echo $featured_news_list['news_id']; ?>">
					<?php echo substr($featured_news_list['news_title'],0,70).'..'; ?>
					</a></li></ul>
					</div>

		<?php		 }
			?>	</div>	
		<?php } ?>		
					<div class="clearfix"></div>
				</div>
		    </div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="grid_6 margin_l">
					<div class="home_artical_box">
						<span>Events</span>
					</div>
					<form action="EventRegistration" method="post">
					<div class="box all_box event_rad">
						<ul class="">
						
						
							<?php 
						if(!empty($featured_events))
						{
						foreach($featured_events as $events) { 
						//if($featured_events != '' || $featured_events != '0') {
						$date = explode(" ",$events['event_date_time']);
						?>
						
							<li>
								<div>
								<div class="page_data">
										<div class="float_l page_data_item">
											<span class="month"><?php echo $date[1]; ?></span> 
											<span class="day"><?php echo $date[0]; ?></span>
										</div>
										<div class="year float_r"><span><?php echo $date[2]; ?></span></div>
										<div class="clearfix"></div>
									</div>
									<div class="float_l span1 img_logo_events aspectcorrect">
										<img <?php if($events['univ_logo_path']!=''){ ?> src=" <?php echo $base;?>/uploads/univ_gallery/<?php echo $events['univ_logo_path']; ?>" <?php } else { ?> src="<?php echo "$base$img_path" ; ?>/calendar.png <?php } ?>">
									</div>
									<div class="float_l span5">
										<a class="" href="<?php echo $base;?>univ-<?php echo $events['univ_id']; ?>-event-<?php echo $events['event_id']; ?>"><h3><?php echo $events['univ_name']; ?></h3></a>
										<h4><?php
										if(!empty($date))
										{
										echo $date[0].' '.$date[1].', '.$date[2].'|';
										}
										?> 
										 <?php echo $events['event_time']; ?></h4>
										<h4><?php echo ucwords(substr($events['event_detail'],0,176)); ?></h4>
									</div>
									<div class="float_r center">
										<h3>
										
										<?php 
										if($events['event_category'] == 'spot_admission'){
										echo "Spot Admission"; 
										}
										else if($events['event_category'] == 'fairs'){
										echo "Fairs"; 
										}
										else if($events['event_category'] == 'others'){
										echo "Alumuni"; 
										}
										else if($events['event_category'] == 'alumuni'){
										echo "Alumuni"; 
										}
										?>
										
										</h3>
										
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $events['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $events['event_id']; ?>"/>
									<div class="float_r margin_t1">
									<input type="submit" name="btn_event_register" id="<?php echo $events['event_id']; ?>" value="Register" class="btn btn-primary" /></div>
										
										
									</div>
									<div class="clearfix"></div>
								</div>
							</li>
						<?php } } else { echo "There is No Upcoming Events ! ! !"; } ?>
							

							</ul>
					</div>
					</form>
				</div>
				<div class="grid_3">
					<div class="home_artical_box feat_col">
						<span>Featured Colleges</span>
					</div>
					<div class="col_box event_rad">
						<ul class="col_img">
							<li>
						<?php 
						$x=0;
						foreach($featured_college as $featured_clg) { ?>
									<div class="aspectcorrect featured_art <?php if($x % 3!=0){ ?>float_l<?php }else{echo "float_r";}if($x==2 || $x==5 || $x==8){ echo ""; } ?>" >
				<a href="<?php echo $base; ?>university/<?php echo $featured_clg['univ_id']; ?>">	<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php if($featured_clg['univ_logo_path']!=''){echo $featured_clg['univ_logo_path'];}else{ echo 'univ_logo.png';} ?>" >
				
				</a>
						</div>							

					
				<?php $x++; }?>
								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="margin_t">
			<div class="row">
				<div class="yellow_bar span16 margin_l">
				<!--<marquee behavior="scroll" scrollamount="3" direction="left">-->
					<ul class="yellow yellow_nav">
						<li><a href="#">Engineering</a></li>
						<li><a href="#">Medical</a></li>
						<li><a href="#">Media & Journalism</a></li>
						<li><a href="#">Hospitality </a></li>
						<li><a href="#">Technology  </a></li>
						<li><a href="#">Science</a></li>
						<li><a href="#" style="border:none;">MBA</a></li>
					</ul>
			<!--</marquee>-->
				</div>
			</div>
		</div>
		<div class="row margin_t">
			<div class="grid_6 margin_l">
				<div class="well margin_gamma padding_zero new_data">
					<div>
						<div class="float_l">
							<div class="letter_uni">
							<div>Q Go Ask </br><span>uestion</span></div>
							</div>
						</div>
						<div class="float_r have_data">
							<span>Have a Question?</span>
							<span>Ask our counselors!</span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="margin">
						<div>
							<div class="float_l wht_data">what are the type of questions they ask in iit?</div>
							
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="margin">
						<div>
							<div class="float_l">
								<div class="input-append">
								<form action="<?php echo $base; ?>QuestandAns" method="post">
									<input class="span6 margin_zero" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
									<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info" style="padding: 3px 18px 6px 18px;color:#fff;font-size:16px;height:28px;" value="Ask">
								</form>
								</div>
							</div>
							<!--<div class="float_r">
							<button class="btn btn-success more_btn" href="#">More Q&amp;A</button></div>-->
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="grid_3 margin_delta margin_t">
					<div class="home_artical_heading">
					<span>Featured Q & A</span>
					</div>
					<div class="box all_box">
					<ul>
					<?php
					if(!empty($featured_quest))
					{
					if($featured_quest != 0)
					{
					foreach($featured_quest as $feature_questions)
					{
					if($feature_questions['q_univ_id'] != '0')
					{
						$url = "UniversityQuest/$feature_questions[q_univ_id]/$feature_questions[que_id]/$feature_questions[q_askedby]";
					}
					else if($feature_questions['q_country_id'] != '0')
					{
						$url = "";
					}
					?>
					<li>
						<div class="float_l">
						<?php if($feature_questions['user_pic_path']!='' || $feature_questions['user_pic_path']!= '0') { ?>
						<?php echo "<img src='".base_url()."uploads/".$feature_questions['user_pic_path']."' class='girls_img'/>"; ?>
						<?php } else { echo "<img src='".base_url()."images/profile_icon.png' class='girls_img'/>"; } ?>
						</div>
						<div>
						<a href="<?php echo "$base$url"; ?>"><?php echo $feature_questions['q_title'] ? substr($feature_questions['q_title'],0,15) : 'Not Available'; ?>...</a>
						<div class="float_r"><div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
						</div>
					</li>
					<?php } } }  else { echo "Not Available"; } ?>
					
					</ul>
					</div>
				</div>
				<div class="grid_3 margin_t">
					<div class="home_artical_heading">
						<span>Featured Article</span>
					</div>
					<div class="box">
					<?php foreach($featured_article as $article){ ?>
						<div class="float_l">
						<?php if($article['article_image_path']==''){?>
						<img src="images/default_logo.png" class="home_art">
						<?php } else {?>
						<img src="<?php echo $base; ?>/uploads/news_article_images/<?php echo $article['article_image_path']; ?>" class="home_art">
						<?php } ?>	
						</div>
						<div class="justify">
						<?php echo substr($article['article_detail'],0,800).'...'; ?>	 
						</div>	
						<?php } ?>	
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="grid_3">
				<div class="fb-like-box" data-href="http://www.facebook.com/pages/MeetUniversity/366189663424238?ref=ts" data-width="326" data-height="514" data-show-faces="true" data-stream="true" data-header="true"></div>		
			</div>
			<div class="clearfix"></div>
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
	   $(this).removeClass('active');
	 });
	 $('#opendd').addClass('active');
	 $('.ddclass').css('display','none');
	 $('#opendd').html($(this).text());
	  if($(this).attr("id")=='others')
	  {
	  $('#type_search').val('others');
	  }
	  else
	  {
	  $('#type_search').val('alumuni');
	  
	  }
	});
	
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
<script>
$(document).ready(function(){
$('#allcollege').click(function(){
$('#type_search').val('0');
fetch_programs(0);
});

$('#found').click(function(){
$('#type_search').val(2);
$('#educ_level').val('Foundation');

fetch_programs(2);
});

$('#pg').click(function(){
$('#type_search').val(4);
$('#educ_level').val('PostGraduate');

fetch_programs(4);

});

$('#ug').click(function(){
$('#type_search').val(3);
$('#educ_level').val('UnderGraduate');
fetch_programs(3);
});

$('#spot').click(function(){
$('#type_search').val('spot_admission');
});

$('#fairs').click(function(){
$('#type_search').val('fairs');
});


});

function serach_results()
{
var url='<?php echo $base; ?>colleges/';
var country;
var educ_level;
var area_interest;
var country=$('#search_country option:selected').text();
country=country.replace(' ','_');
var prog= $('#search_program option:selected').text();
prog=prog.replace(/ /g,'_');
var educ_level=$('#educ_level').val();
if(country!='Select_Country')
{
url=url+country+'/';
}
if(prog!='Select' && prog!='Select_Program')
{
url=url+prog+'/';
}
if(educ_level!='All')
{
url=url+educ_level;
}
window.location=url;
}
function serch_events()
{
$("#search_form").attr("action","events_search");
$('#btn_event_serch').val('event_search');
$('#search_form').submit();
}

function fetch_programs(educ_level)
{
	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>search/fetch_parent_progrmas_on_home_ajax",
	   async:false,
	   data: 'educ_level='+educ_level,
	   cache: false,
	   success: function(msg)
	   {
	  $('#search_program').html(msg);
	   }
	   })
}
window.onload = function() {

			FixImages(true);

		}
		$(function(){
			$('#slider_slides').slides({
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.slider_caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.slider_caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.slider_caption').animate({
						bottom:0
					},200);
				}
			});
		});
</script>


