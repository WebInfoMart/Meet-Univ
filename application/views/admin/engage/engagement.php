<script type="text/javascript" src="<?php echo $base;?>/js/jsapi.js"></script>
<div class="body" id="content">
	<div class="engagement_holder">
		<div class="meet_heading">
			<img src="images/admin/images/lib.png" alt="Meet Universities" title="Meet Universities" class="margin_r"><span class="engage_heading">Meet University Dashboard</span>
		</div>
	<div>
	<pre>
	<?php 
			
			// print_r($type_count);
			
	?>
	</pre>
		<div class="lead_back float_l data10 margin_t3">
		<div class="lead_bg">Lead Source</div>		
				<div id="chart_div" style="width: 670px;height: 300px;margin:30px auto"></div>			
		</div>
		<div class="engage_bg float_r span20 margin_t3">
			<div class="black_heading">
				<span>Event Users 
				<?php
				$fb_user=0;
				$android=0;
				$event=0;
				$site_user=0;
				$fb_canvas=0;
				$college_request=0;
				$other=0;
				$total=0;
				foreach($type_info as  $type)
					{ if($type['lead_source']=='site_user')
						{
							$site_user=$type['count'];
						}
						if($type['lead_source']=='android_user')
						{
							$android=$type['count'];
						}
						if($type['lead_source']=='fb_login')
						{
							$fb_user=$type['count'];
						}
						if($type['lead_source']=='event_user')
						{
							$event=$type['count'];
						}
						if($type['lead_source']=='fb_canvas')
						{
							$fb_canvas=$type['count'];
						}
						if($type['lead_source']=='college_request')
						{
							$college_request=$type['count'];
						}
						if($type['lead_source']=='other')
						{
							$other=$type['count'];
						}
					}
					$total=$site_user+$android+$fb_user+$event+$fb_canvas+$college_request+$other;
					
				?></span>
			</div>
			<div class="padding_5">
				<table width="100%" class="right_table" cellspacing="0" cellpadding="0">
					<tbody>	
						<tr>
							<td width="50%" class="table_bott">Facebook</td><td width="50%" class="table_bott"><?php echo $fb_user; ?></td>
						</tr>
						<tr>
							<td width="50%" class="table_bott">Android</td><td width="50%" class="table_bott"><?php echo $android; ?></td>
						</tr>
						<tr>
							<td width="50%" class="table_bott">Event</td><td width="50%" class="table_bott"><?php echo $event; ?></td>
						</tr>
						<tr class="none">
							<td width="50%" class="table_bott">Siteusers</td><td width="50%" class="table_bott"><?php echo $site_user; ?></td>
						</tr>
						<tr class="none">
							<td width="50%" class="table_bott">fb_canvas</td><td width="50%" class="table_bott"><?php echo $fb_canvas; ?></td>
						</tr>
						<tr class="none">
							<td width="50%" class="table_bott">College Request</td><td width="50%" class="table_bott"><?php echo $college_request; ?></td>
						</tr>
						<tr class="none">
							<td width="50%" class="none">other</td><td width="50%" class="none"><?php echo $other; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
		<div class="lead_back float_l data7 margin_t3">
			<div class="lead_bg">Lead Analytics</div>
			<div style="width: 412px;margin:30px auto">
				<div id="chart_div1" style="width: 400px; height: 300px;"></div>
			</div>
		</div>
		<div class="engage_bg float_r data7 margin_t3">
			<div class="black_heading">
				<span>Recent Lead History</span>
			</div>
			<div class="padding_5">
				<table width="100%" class="right_table" cellspacing="0" cellpadding="4">
					<tbody>
						<tr>
							<td width="33%" class="table_bott1"><b>Name</b></td><td width="33%" class="table_bott1"><b>Email</b></td><td width="33%" class="table_bott1 border_right"><b>Recently</b></td>
						</tr>
						<?php foreach($recent_leads as $recent)
						{ if ($recent === end($recent_leads))
							{
						?>
						<tr>
							<td width="33%" class="table_bott2"><?php echo $recent['fullname']; ?></td>
							<td width="33%" class="table_bott2"><?php if($recent['email']==''){ echo 'Not Available'; } else { echo $recent['email']; } ?></td>
							<td width="33%" class="table_bott2 border_right"><?php echo date('d-M-y h:m',strtotime($recent['lead_created_time'])); ?></td>
						</tr>
						<?php } else {?>
						<tr>
							<td width="33%" class="table_bott1"><?php echo $recent['fullname']; ?></td>
							<td width="33%" class="table_bott1"><?php if($recent['email']==''){ echo 'Not Available'; } else { echo $recent['email']; } ?></td>
							<td width="33%" class="table_bott1 border_right"><?php echo date('d-M-y h:m',strtotime($recent['lead_created_time'])); ?></td>
						</tr>
						<?php } } ?>	
					</tbody>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="insight_holder margin_t3">
			Insight
		</div>
		<div class="engage_bg padding_t">
			<div class="span4 set_total">
				<span class="total_user">Total Numbers of Users</span>
				<div class="center padding_1">
					<img src="images/admin/images/community.png" align="middle">
					<span><?php echo $count; ?></span>
				</div>
			</div>
			<div class="right_dotted"></div>
			<div class="float_l">
				<div id="slides">
					<div class="slides_container" style="cursor:pointer;">
					<?php $i=1;	
					if(!empty($city_wise))
					{
					 foreach($city_wise as $city_count)
						{ 
						if($i==1)
						{ ?>					
							<div>
								<ul>
									<li>
							<?php } ?>
										<div class="float_l data_slider">
										<span id="city_<?php echo $city_count['event_city_id'];?>" onclick="eventDetail(<?php echo $u_id;?>,<?php echo $city_count['event_city_id'];?>);"><?php echo trim($city_count['cityname']).'('.trim($city_count['count']).')';$i++;?></span>
										</div>	
								<?php if($i==9){ $i=1; ?>			
									</li>
								</ul>
							</div>
							<?php }} 
					}else
					{ ?><div> <?php echo 'No Events'; ?></div>					
					<?php } ?>					
					</div>
				</div>
			</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="margin_t3 dlh_event_holder">			
		
		<div id="cityevent" style="display:none;">
		<div class="clearfix"></div>
		</div>
</div>	
<div id="stud_detail" style="display:none;">	
		
	</div>
</div>	
	<script src="<?php echo $base;?>/js/slides.min.jquery.js"></script>
<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				generateNextPrev: true
			});
		});
</script>
<script>
		$(function(){
			$('#slides_content').slides({
				preload: true,
				generateNextPrev: true
			});
		});
</script>

<script type="text/javascript">
function eventDetail(univ_id,event_city_id)		
{
 //var univ_id=107;
 var url='<?php echo $base;?>admin_engagement/city_events';
 var data={univ_id :univ_id,event_city_id: event_city_id };
 $.ajax({
				type: "POST",
				url: url,
				data:data,
				success:function(msg){
				if(msg=='logout')
					{
					  window.location="<?php echo $base;?>/admin/adminlogin";
					}
				else
				{
					$("#stud_detail").hide();
					$("#cityevent").html(msg);	
					$("#cityevent").show();
					$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
				}
			
				}
			});
	
}	
function eventStudents(event_id)
{
	
 var url='<?php echo $base;?>admin_engagement/city_students';
 var data={event_id :event_id};
 $.ajax({
				type: "POST",
				url: url,
				data:data,
				success:function(msg){
				if(msg=='logout')
					{
					  window.location="<?php echo $base;?>/admin/adminlogin";
					}
				else
				{
					$("#stud_detail").html(msg);
					$("#stud_detail").show();
					$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
				}
				}
			});
}			
			
</script>
 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	  
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],          				
		  ['Facebook', <?php echo $fb_user;?>],
          ['Android',<?php echo $android;?>],
          ['Events',<?php echo $event;?>],
          ['Siteusers',<?php echo $site_user;?>],
          ['fb_canvas',<?php echo $fb_canvas;?>],
		  ['collesge_request',<?php echo $college_request;?>],
		  ['other',<?php echo $other;?>],
        ]);

        var options = {
          title: 'Univ Users Type',
		  is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
     // google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
         
		  ['month', 'facebook', 'Android','Event','Siteuser','fbcanvas','College request','other'],
          ['4',  1000,        400,      100,     546,		654,		876,		876],
          ['5',  1170,      400,      100,     546,		654,		876,		876], 
          ['6',  660,       400,      100,     546,		654,		876,		876],
          ['7',  1030,      400,      100,     546,		654,		876,		876]
        ]);

        var options1 = {
          title: 'Students Rate'
        };

        var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);
      }
    </script>
		
<script type="text/javascript">
	function moreData(id,end)
	{//alert(id);
		 var url='<?php echo $base;?>admin_engagement/city_students';
		 var data={event_id :id,end:end,more:'more'};
		 $.ajax({
				type: "POST",
				url: url,
				data:data,
				success:function(msg){				
				$("#stud_detail").html(msg);
				$("#stud_detail").show();
				$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
				}
			});
	}
</script>	
	