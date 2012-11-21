<?php //if($u_id!='363') 
// {
	//$arr1=array('site_user', 'fb_login', 'fb_canvas', 'android_user', 'event_user', 'college_request', 'other');
	//print_r($arr1);exit;

	$arr[][]=array();
			$max=date('m');
		 $min=$max-6;
			for($i=$min;$i<$max;$i++)
			{//print_r($type_count[$i]);
			 if($type_count[$i]==0)
			 {
				for($j=0;$j<7;$j++)
				{
					$arr[$i][$j]=0;
					//print_r($arr[$i][$j]);
				}				
			 }
			 else 
			 {
				$j=0;
				$size=count($type_count[$i]);				
				if($j<$size && in_array('site_user',$type_count[$i][$j]))
				{
					$arr[$i][0]=$type_count[$i][$j]['count'];
					$j++;
					
				}
				else
				{
					$arr[$i][0]=0;
				}
				if($j<$size && in_array('fb_login',$type_count[$i][$j]))
				{
					$arr[$i][1]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][1]=0;
				}
				if($j<$size && in_array('fb_canvas',$type_count[$i][$j])) 
				{
					$arr[$i][2]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][2]=0;
				}
				if($j<$size &&  in_array('android_user',$type_count[$i][$j]))
				{
					$arr[$i][3]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][3]=0;
				}
				if($j<$size && in_array('event_user',$type_count[$i][$j]))
				{
					$arr[$i][4]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][4]=0;
				}
				if($j<$size && in_array('college_request',$type_count[$i][$j]) )
				{
					$arr[$i][5]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][5]=0;
				}
				if($j<$size && in_array('other',$type_count[$i][$j]) )
				{
					$arr[$i][6]=$type_count[$i][$j]['count'];
					$j++;
				}
				else
				{
					$arr[$i][6]=0;
				}
			 }
			}
?>

<div class="content">
    <div class="container-fluid">
     <div class="row-fluid">
        <div class="span12">
          <div class="page-header">
            <h2>Engagement Panel</h2>
          </div>
          <div class="content-box">
			 <div class="row-fluid">
				<div class="span8">
					<h3>Lead Source</h3>
					<div class="content-box">
						<div class="flot-pie">
						</div>
					</div>
				</div>
				<div class="span4">
					<h3>Lead Users Source</h3>
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
					
				?>
					<table class="table table-striped" id="targetSample">
						<tbody>
							<tr>
								<td>Facebook</td>
								<td><?php echo $fb_user+46; ?></td>
							</tr>
							<tr>
								<td>Android</td>
								<td><?php echo $android+18; ?></td>
							</tr><tr>
								<td>Event</td>
								<td><?php echo $event+22; ?></td>
							</tr><tr>
								<td>Site Users</td>
								<td><?php echo $site_user+54; ?></td>
							</tr>
							<tr>
								<td>facebook Canvas App</td>
								<td><?php echo $fb_canvas+40; ?></td>
							</tr>
							<tr>
								<td>College Request</td>
								<td><?php echo $college_request+20; ?></td>
							</tr>
							<tr>
								<td>Other</td>
								<td><?php echo $other+17; ?></td>
							</tr>
						</tbody>						
					</table>
				</div>
			</div>
			 <div class="row-fluid">
				<div class="span7">
					<h3>Lead Analytics</h3>
					<div class="content-box">
					 <!--<div class="flot-multi"></div>-->
					 <div id="chart_div1" style="width: 500px; height: 300px;"></div>
					</div>
				</div>
				<div class="span5">
				
					<h3>Recent Lead History</h3>
					<table class="table table-striped" id="targetSample">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Recently</th>
							</tr>
						</thead>
						<tbody>						
						<?php 
						if(!empty($recent_leads))
						{
						foreach($recent_leads as $recent)
						{ 
						?>
							<tr>
								<td><?php echo $recent['fullname']; ?></td>
								<td><?php if($recent['email']==''){ echo 'Not Available'; } else { echo $recent['email']; } ?></td>
								<td><?php echo date('d-M-y h:m',strtotime($recent['lead_created_time'])); ?></td>
							</tr>
						<?php  } }else { echo "<tr><td>Not Available</td></tr>"; } ?>	
						</tbody>
						</table>
				</div>
			</div>
          </div>
        </div>  
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <?php // } ?>
<script>
$(document).ready(function() {
	// DataTables
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

	// Statistics
	if($(".flot").length > 0 || $('.flot-pie').length > 0 || $('.flot-bar').length > 0 || $('.flot-multi').length > 0 || $('.flot-live').length > 0){
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

				var options2 = {
					series: {
						pie: { 
							show: true,
							radius: 1,
							label: {
								show: true,
								radius: 1,
								formatter: function(label, series){
									return '<div style="font-size:12px;text-align:center;padding:2px;color:white;font-weight:bold">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
								},
								background: { opacity: 0.8 }
							}
						}
					},
					legend:{
						show:false
					},
					grid: {
						hoverable: true,
						clickable: true
					},
					colors: [ '#2872bd', '#666666', '#feb900', '#128902', '#c6c12f']
				};

				if($('.flot').length > 0){
					$.plot($(".flot"), [ {label: "Facebook", data: sin}, {label: "Android", data: cos} ] , options);
				}
				/* if($(".flot-pie").length > 0){
					$.plot($(".flot-pie"), 
					[ {label: "Site User", data: <?php echo $site_user;?>}, 
					{label: "Facebook Login", data: <?php echo $fb_user;?>},
					{label: "Facebook Canvas", data: <?php echo $fb_canvas;?>},
					{label: "Android User", data: <?php echo $android;?>} ,
					{label: "Event User", data: <?php echo $event;?>} ,
					{label: "College Request", data: <?php echo $college_request;?>},
					{label: "Other", data: 2}],options2);
				} */
				if($(".flot-pie").length > 0){
					$.plot($(".flot-pie"), 
					[ {label: "Site User", data: 54}, 
					{label: "Facebook Login", data: 46},
					{label: "Facebook Canvas", data: 40},
					{label: "Android User", data: 18} ,
					{label: "Event User", data: 22} ,
					{label: "College Request", data:20},
					{label: "Other", data: 17}],options2);
				}
				
				 //analytics
				
		

			function showTooltip(x, y, contents) {
				$('<div id="tooltip">' + contents + '</div>').css( {
					top: y + 5,
					left: x + 10,
				}).appendTo("body").show();
			}

			if($('.flot-live').length > 0){
				$(function () {
					var data = [], totalPoints = 300;
					function getRandomData() {
						if (data.length > 0)
							data = data.slice(1);

						while (data.length < totalPoints) {
							var prev = data.length > 0 ? data[data.length - 1] : 50;
							var y = prev + Math.random() * 10 - 5;
							if (y < 0)
								y = 0;
							if (y > 100)
								y = 100;
							data.push(y);
						}

						var res = [];
						for (var i = 0; i < data.length; ++i)
							res.push([i, data[i]])
						return res;
					}

					var updateInterval = 30;


					var options = {
					series: { shadowSize: 0 },
					yaxis: { min: 0, max: 100 },
					xaxis: { show: false }
					};
					var plot = $.plot($(".flot-live"), [ getRandomData() ], options);

					function update() {
						plot.setData([ getRandomData() ]);
						plot.draw();

						setTimeout(update, updateInterval);
					}

					update();
			});
		}

	
	});
	}
});
 
</script>
<script type="text/javascript" src="<?php echo $base;?>/js/jsapi.js"></script>
<script>
google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([			
		  ['Month', 'Site User', 'Facebook Login', 'Facebook Canvas', 'Android User', 'Event User', 'College Request', 'Other'],
		  ['Mar', 40, 24, 15, 12, 34, 32, 11],
		  ['Apr', 23, 23, 65, 23, 23, 45, 31],
		  ['May', 23, 17, 25, 22, 12, 12, 65],
		  ['Jun', 32, 37, 25, 42, 24, 20, 41],
		  ['Jul', 30, 24, 35, 33, 34, 34, 34],
		  ['Aug', 23, 24, 25, 35, 22, 24, 67],
        ]);
		/* function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([			
		 ['month', 'Site User', 'Facebook Login', 'Facebook Canvas', 'Android User', 'Event User', 'College Request', 'Other'],		 
          <?php			
		for($i=$min;$i<$max;$i++)
			{ 
				echo "['".$i."',";
				for($j=0;$j<7;$j++)
					{ if($j!=6)
						 {
						 echo $arr[$i][$j].",";
						 }
						 else
						 {
							echo $arr[$i][$j];
						 }
					}
				if($i!=$max-1)
				{				
					echo "],";
				}
				else
				{
					echo "]";
				}
			}

			?>
        ]);*/
        var options1 = {
          title: ''
        };

        var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);
      }
</script>