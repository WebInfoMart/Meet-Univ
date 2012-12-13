<script>
$(document).ready(function() {
if($('.dataTable').length > 0){
		$('.dataTable').each(function(e){
			if($(this).hasClass("dataTable-noheader")){
				$(this).dataTable({
					"sPaginationType": "bootstrap",
					'bFilter': false,
					'bLengthChange': false
				});
			} else {
				$(this).dataTable({
					"sPaginationType": "bootstrap"
				});
			}
		});
	}
if($(".flot").length > 0 ){
		$(function(e){
				var sin = [], cos = [], tmp = [];
				for (var i = 0; i < 21; i += 0.5) {
					sin.push([i, Math.sin(i)]);
					cos.push([i, Math.cos(i)]);
				}

				var options = {
					series: {
						lines: { show: true },
						points: { show: true }
					},
					grid: {
						hoverable: true,
						clickable: true
					},
					yaxis: { min: -1.1, max: 1.1 },
					colors: [ '#2872bd', '#666666', '#feb900', '#128902', '#c6c12f']
				};


				if($('.flot').length > 0){
					$.plot($(".flot"), [ {label: "Active guests", data: sin}, {label: "Active members", data: cos} ] , options);
				}
				
				var d1 = [];
				for (var i = 0; i <= 10; i += 1)
					d1.push([i, parseInt(Math.random() * 30)]);

				var d2 = [];
				for (var i = 0; i <= 10; i += 1)
					d2.push([i, parseInt(Math.random() * 30)]);

				var d3 = [];
				for (var i = 0; i <= 10; i += 1)
					d3.push([i, parseInt(Math.random() * 30)]);

				var ds = new Array();

				ds.push({
					data:d1,
					bars: {
						show: true, 
						barWidth: 0.2, 
						order: 1,
						lineWidth : 2
					}
				});
				ds.push({
					data:d2,
					bars: {
						show: true, 
						barWidth: 0.2, 
						order: 2
					}
				});
				ds.push({
					data:d3,
					bars: {
						show: true, 
						barWidth: 0.2, 
						order: 3
					}
				});

			

			function showTooltip(x, y, contents) {
				$('<div id="tooltip">' + contents + '</div>').css( {
					top: y + 5,
					left: x + 10,
				}).appendTo("body").show();
			}


		var previousPoint = null;
		$(".flot-bar,.flot-pie,.flot,.flot-multi").bind("plothover", function (event, pos, item) {
			if (item) {
				if(event.currentTarget.className == 'flot-bar'){
					var y = Math.round(item.datapoint[1]);
				} else if(event.currentTarget.className == 'flot-pie') {
					var y = Math.round(item.datapoint[0])+"%";
				} else if(event.currentTarget.className == 'flot'){
					var y = (Math.round(item.datapoint[1] * 1000)/1000);
				} else {
					var y = (Math.round(item.datapoint[1]*1000)/1000)+"€";
				}
				$("#tooltip").remove();
				showTooltip(pos.pageX, pos.pageY,"Value = "+y);
			}
			else {
				$("#tooltip").remove();
				previousPoint = null;            
			}
		});
	});
	}
});	
</script>
<?php
if($admin_user_level=='3') 
{ 
?> 
  <div class="content">
    <div class="container-fluid">	
      <div class="responsible_navi"></div>	
		<div class="row-fluid">
		  <div class="span12">
		   <div class="page-header clearfix tabs">
			<h2>Insight <small>Site Statistics</small></h2><?php if($admin_user_level=='3' && !($user_id =='533' || $user_id =='534' || $user_id =='544')) { ?><a href="<?php echo $base; ?>newadmin/admin_events/recent_event"><h2 style="float:right;">Recent Events</h2></a><?php } ?>
		  </div>
		  <div class="content-box">
			<div class="tab-content">
			
			   <div class="tab-pane active" id="big">
				<div class="flot"></div>
			  </div>			 
			</div>
		  </div>
		</div>
		</div>
      <div class="row-fluid">
        <div class="span6 no-margin">
          <div class="page-header">
            <h2>Recent Articles</h2>
          </div>
          <div class="content-box">
            <table class="table table-striped table-nohead">
              <tbody>
                <tr>
                  <td><b>Date</b></td>
                  <td><b>Article </b></td>
                  <td><b>Username</b></td>                  
                </tr>
				
			  <?php if(!empty($recent_articles))
			  { foreach($recent_articles as $article)
			    { ?>
                <tr>
                  <td>
                    <?php $date=strtotime($article['publish_time']); echo date('d/m/Y',$date); ?> 
                  </td>
                  <td>
                   <?php echo $article['article_title']; ?> 
                  </td>
                  <td>
                    <?php if(!empty($article['full_name'])){ echo $article['full_name']; } else { echo 'Not Available';} ?> 
                  </td>                  
                </tr>
              <?php }}else { ?>
				<tr>
					<td>No article  till now...</td>
				</tr>
				<?php } ?>
              </tbody>
            </table>
          </div>        
        </div>
        <div class="span6 no-margin">
          <div class="page-header clearfix tabs">
            <h2>Questions</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">Recent</a>
              </li>             
              <li>
                <a href="#unanswered" data-toggle="pill">Unanswered</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="table table-striped table-nohead">
                  <tbody>
                    <tr>
                      <td width="20%">
                       
                      </td>
                      <td>
                        <b> Question </b>
                      </td>
                      <td width="20%">                 
                         <b> Asked By </b>                       
                      </td>
                    </tr>
					<?php 
					if(!empty($recent_questions))
					{ 
					foreach($recent_questions as $all)
					{ 
						if($all['q_univ_id'] != '0')
						{
							$question_title = str_replace(' ','-',$all['q_title']);
							$univ_domain=$all['subdomain_name'];
							$quest_title=$all['q_title'];
							$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$all['que_id']);
							$url = $que_link;
						}
						else if($all['q_country_id']!= '0')
						{
							$url = "";
						}
						else
						{							
							$question_title =$this->subdomain->process_url_title($all['q_title']);	
							$url = "MeetQuest/".$all['que_id']."/".$question_title."/".$all['q_askedby'];
							$url = $base.'otherQuestion'.'/'.$all['que_id'].'/'.$question_title;
						}						
					?> 
					<input type="hidden" id="que_url_<?php echo $all['que_id'] ?>" value="<?php echo $url;?>" />
					<div class="modal-lightsout" id="lightsoutId">
						<div class="modal hide" id="myModal_<?php echo $all['que_id']; ?>">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">x</button>
								<div>
									<div><b>Question : </b><?php echo $all['q_title']; ?></div>
								</div>
								<div>
									<div><b>Answer :</b></div><span><textarea  id="ans_<?php echo $all['que_id']; ?>" rows="6"></textarea></span>
								</div>
							</div>
							<div class="modal-footer">
								<a href="#" onclick="add_answer('<?php echo $all['que_id']; ?>')" class="btn" data-dismiss="modal">Add Answer</a>
								<a href="#" class="btn" data-dismiss="modal">Close</a>
							</div>
						</div>					
					</div>					
					<tr>
					<td>
                        <?php if($all['q_answered']==0 ){ echo "<span class='label label-important' id='spn_".$all['que_id']."'><a href='#myModal_".$all['que_id']."' style='text-decoration: none; color: white;' data-toggle='modal'>Open</a></span>"; } else{ echo "<span class='label label-success'>Answered</span>"; } ?>
                    </td>
                      <td>
                      <?php echo $all['q_title']; ?>
                      </td>
                      <td>                       
                          <?php if(!empty($all['full_name'])){ echo $all['full_name']; }else { echo 'Not available'; } ?>
                      </td>
					</tr>
					
					<?php }}else { ?>
				<tr>
				<td>No question till now...</td>
				</tr>
				<?php } ?>
              </tbody>  
            </table>
          </div>          
      <div class="tab-pane" id="unanswered">
        <table class="table table-striped table-nohead">
          <tbody>
            <tr>
               <td width="20%">
                       
				</td>
				<td>
				<b> Question </b>
				</td>
				<td width="20%">
				<b> Asked By </b>                       
				</td>
			</tr>
					<?php 
					if(!empty($unasnwered))
					{ 
					foreach($unasnwered as $ans)
					{ 
						if($ans['q_univ_id'] != '0')
						{
							$question_title = str_replace(' ','-',$ans['q_title']);
							$univ_domain=$ans['subdomain_name'];
							$quest_title=$ans['q_title'];
							$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$ans['que_id']);
							$url = $que_link;
						}
						else if($ans['q_country_id']!= '0')
						{
							$url = "";
						}
						else
						{
							
							$question_title =$this->subdomain->process_url_title($ans['q_title']);	
							$url = "MeetQuest/".$ans['que_id']."/".$question_title."/".$ans['q_askedby'];
							$url = $base.'otherQuestion'.'/'.$ans['que_id'].'/'.$question_title;
						}
					?>
					<input type="hidden" id="que_url_<?php echo $ans['que_id'] ?>" value="<?php echo $url;?>" />
					<div class="modal-lightsout" id="lightsoutId">
						<div class="modal hide" id="myUnansweredModal_<?php echo $ans['que_id']; ?>">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">x</button>
								<div>
									<div><b>Question : </b><?php echo $ans['q_title']; ?></div>
								</div>
								<div>
									<div><b>Answer :</b></div><span><textarea  id="ans_<?php echo $ans['que_id']; ?>" rows="6"></textarea></span>
								</div>
							</div>
							<div class="modal-footer">
								<a href="#" onclick="add_answer('<?php echo $ans['que_id']; ?>')" class="btn" data-dismiss="modal">Add Answer</a>
								<a href="#" class="btn" data-dismiss="modal">Close</a>
							</div>
						</div>
					</div>
                    <tr id="tr_<?php echo $ans['que_id']; ?>">
                      <td>
                       <span class='label label-important'><a href="#myUnansweredModal_<?php echo $ans['que_id'];?>" style='text-decoration: none; color: white;' data-toggle='modal'>Open</a></span>
                      </td>
                      <td>
                      <?php echo $ans['q_title']; ?>
                      </td>
                      <td>                        
                          <?php if(!empty($ans['full_name'])){ echo $ans['full_name']; }else { echo 'Not available'; } ?>                        
                      </td>
                    </tr>
					<?php }}else { ?>
				<tr>
				<td>No question  till now...</td>
				</tr>
				<?php } ?>
      </tbody>  
    </table>
  </div>
</div>
</div>
</div>
</div>
<div class="row-fluid">
  <div class="span9 no-margin">
    <div class="page-header tabs clearfix">
      <h2>Recent Leads</h2>
    </div>       
	<div class="content-box">
		<table class="table table-striped">
            <thead>			
              <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Lead Created Time</th>                
              </tr>
            </thead>
            <tbody>
			<?php //print_r($recent_leads); 
			if(!empty($recent_leads))
			{ foreach($recent_leads as $leads)
			{ ?>
              <tr>
                <td><?php echo $leads['fullname']; ?> </td>
                <td><?php echo $leads['email']; ?></td>
                 <td><?php  $d=strtotime($leads['lead_created_time']); 
				 echo date('d/m/y-h:m',$d); ?></td>              
               </tr> 
			<?php }}else { ?>
				<tr>
				<td>No leads  till now...</td>
				</tr>
				<?php } ?>
            </tbody>
          </table>        
  </div>
  </div>
  <div class="span3 no-margin">
    <div class="page-header">
      <h2>Recent Followers</h2>
    </div>
    <div class="content-box">
      <table class="table table-striped table-nohead">
        <tbody>
		<?php  // print_r($recent_followers_of_univ); ?>
          <tr>
            <th>Name</th>
            <th style="width:48px;"><div class="btn-group">Details</div></th>
          </tr>
		  <?php if(!empty($recent_followers_of_univ))
		  { foreach($recent_followers_of_univ as $recent)
		  { ?>
          <tr>
            <td>
              <a href="#"><?php if(!empty($recent['full_name'])) { echo $recent['full_name']; }else { echo 'Not Available';} ?></a>
            </td>
            <td style="width:48px;">
              <div class="btn-group">
                <a href="#" title="Go to profile" class="tip btn btn-icon"><i class="icon-search"></i></a>
                <a href="#" title="Delete user" class="tip btn btn-icon"><i class="icon-remove"></i></a>
              </div>
            </td>
          </tr>
         <?php  }} else { ?>
           <tr>
            <td>No followers till now...</td>
           <?php } ?>
          </tr>
        </tbody>
      </table> 
    </div>   
  </div>
</div>
<div class="row-fluid">
  <div class="span12 no-margin">
    <div class="page-header">
      <h2>Events</h2>
    </div>
    <div class="content-box">
      <div class="calendar"></div>
    </div>
  </div>
</div>
</div><!-- close .container-fluid -->
</div><!-- close .content -->
<!-- END Content -->

<script>
function add_answer(id)
{
	var url='<?php echo $base; ?>newadmin/admin_ques/add_ans';
	var que_url=$('#que_url_'+id).val();
	var answer=$("#ans_"+id).val();
	var data={id:id,answer:answer,que_url:que_url,ajax:'1'};
	$.ajax({
	  type: "POST",
	  data: data,
	  url: url, 		
	  success: function(msg) 
	  {	 
	   if(msg='1')
		{
			$('#spn_'+id).removeClass('label-important');				
			$('#spn_'+id).addClass('label-success');
			$('#spn_'+id).text('Answered');
			$('#tr_'+id).css('display','none');
		}				   
	  }
	});

}

 </script>
<!-- for calander     added by satbir on 11/17/2012   -->
<script>
	if($('.calendar').length > 0){
		$('.calendar').fullCalendar({
			header: {
				left: 'prev',
				center: 'title',
				right: 'next,month,agendaWeek,agendaDay'
			},
			editable: false,
			events: [
			<?php
			if(!empty($events_for_calendar))
			{
				foreach($events_for_calendar as $event_detail){
					echo "{";
						if(!empty($event_detail['event_title']))
							echo "title: '".$event_detail['event_title']."',";	
						if(!empty($event_detail['event_date_time']))
							echo "start: '".$event_detail['event_date_time']."',";	
						if(!empty($event_detail['event_date_time']))
							echo "end: '".$event_detail['event_date_time_end']."',";		
					echo "},";
				}
			}
			?>			
			]		
		});
	}
</script>
<?php 
} 
else
{ 
?>
<script>
$(document).ready(function() {
	$('#maxWid').width('90%');
});
</script>
<script type="text/javascript" src="<?php echo $base;?>js/jsapi.js"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['day', 'visitors','pageviews'],
		  <?php 
		 $i=30;
		 		foreach($report as $objResult )
					{	
					$i--;
 					$start_date=date('Y-m-d',strtotime($i.' day ago'));					
					  echo "['".$start_date."',".$objResult['ga:pageviews'].",".$objResult['ga:visitors']."]";	
						if($i!=30)
						{
						echo ',';
						}
						
					} ?>					
        ]);
        var options = {
          title: 'Users details'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
<div class="content">
	<div class="container-fluid">	
		<div class="responsible_navi"></div>	
		<div class="row-fluid">
			<div class="span12">
				<div class="page-header clearfix tabs">
					<h2>Insight <small>Site Statistics</small></h2>
				</div>
				<div class="content-box">
					<div class="tab-content">
						<div class="tab-pane active" id="big">
							<div class="stats_charts" id="chart_div" style="width: 1100px; height: 300px;"></div>							
						</div>			 
					</div>
				</div>
			</div>
		</div>		
		<div class="row-fluid" id="maxWid">
			<div class="span6 no-margin">
				<div class="page-header">
					<h3>Latest Users</h3>
				</div>
				<div class="content-box">
					<table class="table table-striped table-nohead">
						<tr>
							<th>Sr No</th>
							<th>Username</th>
							<th>Email Id</th>
							<th>User Type</th>						
							<th>Created On</th>                 
						</tr>					
						<?php 
						$i=1;
						foreach($latest_users as $latest_user) 
						{ 
						?>	
						<tr> 	
							<td><?php echo $i; $i++;?></td>
							<td><?php if($latest_user['fullname']==""){ echo 'Not Available'; } echo $latest_user['fullname']; ?></td>
							<td><?php if($latest_user['email']==""){ echo 'Not Available'; } echo $latest_user['email']; ?></td>
							<td>
								<?php 
								if($latest_user['user_type']=="")
								{ 
									echo 'Not Available';
								} 
								else 
								{ 
									if($latest_user['user_type']=='site_user')
									{
										echo 'Site User';
									}
									else if($latest_user['user_type']=='fb_login')
									{
										echo 'Facebook User';
									}
									else if($latest_user['user_type']=='fb_canvas')
									{
										echo 'Facebook application';
									}
									else if($latest_user['user_type']=='android_user')
									{
										echo 'Android User';
									}
									else if($latest_user['user_type']=='event_user')
									{
										echo 'Event User';
									}
									else if($latest_user['user_type']=='offline')
									{
										echo 'Offline';
									}
									else
									{
										echo 'Other';
									}
								} 
								?>
							</td>
							<td><?php $date=strtotime($latest_user['createdon']); echo date('d/M/Y G:i',$date); ?></td>
						</tr>	
						<?php 
						}
						?>					
					</table>
				</div>        
			</div>			
			<div class="span6 no-margin">
				<div class="page-header">
					<h3>Question</h3>
				</div>
				<div class="content-box">
					<table class="table table-striped table-nohead">
						<tr>
							<th>Image</th>
							<th>Username</th>
							<th>Email Id</th>
							<th>Title</th>						
							<th>Question</th>                 
						</tr>
						<?php 
						if($ten_question!=0) 
						{
							$x=0;						
							foreach($ten_question as $ten_questions) 
							{
						?>
								<tr>
								<?php
								$x=$x+1;		
								if(file_exists(getcwd().'/uploads/user_pic/'.$ten_questions['user_pic_path']) && $ten_questions['user_pic_path']!='')
								{
									if(filesize(getcwd().'/uploads/user_pic/'.$ten_questions['user_pic_path']))
									{
										$user_pic =  base_url()."uploads/user_pic/".$ten_questions['user_pic_path'];
									}
									else
									{
										$user_pic = base_url()."images/profile_icon.png";
									}						
								}
								else
								{
									$user_pic = base_url()."images/profile_icon.png";
								}
							?>
								<td><a href="javascript:void(0);" class="avatar"><img src="<?php echo $user_pic; ?>" width="30px" /></a></td>								
								<td><a href="javascript:void(0);" class="username"><?php echo $ten_questions['fullname']; ?></a></td>
								<td><p><?php echo $ten_questions['email']; ?></p></td>
								<td><p><?php echo $ten_questions['q_title']; ?></p></td>
								<td><p class="q_detail"><?php echo $ten_questions['q_detail']; ?></p></td>					
							</tr>
							<?php 
							} 
							?>
						<?php 
						} 
						else
						{
							echo "<tr>NO Recent Question</tr>";
						}
						?>			
					</table>
				</div>        
			</div>
		</div>
		<div class="row-fluid">
			<div class="table">
				<div class="page-header">
					<h3>Latest Events Registrations</h3>
				</div>
				<div class="content-box">
					<?php
					if($latest_users!=0)
					{
					?>
					<table id="allcheck" class="responsive table table-striped">
						<thead>
							<tr>
								<th>Sr No</th>
								<th>Username</th>
								<th>Email Id</th>
								<th>Phone No</th>						
								<th>Event Name</th>						
								<th>University Name</th>						
								<th>Created On</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach($event_users as $user) 
							{ 
							?>	
							<tr> 	
								<td><?php echo $i; $i++;  ?></td>
								<td><?php if($user['fullname']==""){ echo 'Not Available'; }  echo $user['fullname']; ?></td>
								<td><?php if($user['email']==""){ echo 'Not Available'; }  echo $user['email']; ?></td>
								<td><?php if($user['phone']==""){ echo 'Not Available'; }  echo $user['phone']; ?></td>
								<td><?php if($user['event_title']==""){ echo 'Not Available'; }  echo $user['event_title']; ?></td>
								<td><?php if($user['univ_name']==""){ echo 'Not Available'; }  echo $user['univ_name']; ?></td>
								<td><?php $dt=strtotime($user['event_registered_time']); echo date('d/M/Y G:i ',$dt); ?></td>
							</tr>	
							<?php 
							}
							?>
						</tbody>
					</table>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div><!-- close .container-fluid -->
</div><!-- close .content -->
<!-- END Content -->
<?php 
} 
?>
