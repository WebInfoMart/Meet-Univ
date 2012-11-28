<div id="deleted" style="display:none;" class="alert alert-success" style="z-index:99999">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<strong>Registration deleted successfully</strong>
</div>
<div class="content">
    <div class="container-fluid">
     <div class="row-fluid">
        <div class="span12">
          <div class="page-header">
            <h2>Recent Events</h2>
          </div>
          <div class="content-box">
			 <div class="row-fluid">
				<div class="span6">
					<h3>Event Source</h3>
					<div class="content-box">
						<div class="flot-pie"></div>
					</div>
				</div>
				<div class="span3">
					<h3>Total Impression Served</h3>
					<?php
						$fb=0;	$hm=0;	$nc=0;	$as=0;	$ga=0;	$in=0;	$other=0;						
						foreach($visit as  $type)
						{ 
							if($type['campaign_type']=='fb')
							{
								$fb=$type['total']*46;
							}
							if($type['campaign_type']=='hm')
							{
								$hm=$type['total']*53;
							}
							if($type['campaign_type']=='nc')
							{
								$nc=$type['total']*54;
							}
							if($type['campaign_type']=='as')
							{
								$as=$type['total']*36;
							}
							if($type['campaign_type']=='ga')
							{
								$ga=$type['total']*44;
							}
							if($type['campaign_type']=='in')
							{
								$in=$type['total']*49;
							}
							if($type['campaign_type']=='')
							{
								$other=765;
							}
						}
						$total = ($fb+$hm+$nc+$as+$ga+$in+$other);
					?>	
					<table class="table table-striped" id="targetSample">
						<tbody>
							<tr>
								<td>Social</td>
								<td><?php echo $fb; ?></td>
							</tr>
							<tr>
								<td>On Portal</td>
								<td><?php echo $hm; ?></td>
							</tr>
							<tr>
								<td>Digital-Email(MU)</td>
								<td><?php echo $nc; ?></td>
							</tr><tr>
								<td>Digital-Email(Generic)</td>
								<td><?php echo $as; ?></td>
							</tr><tr>
								<td>SEM</td>
								<td><?php echo $ga; ?></td>
							</tr>
							<tr>
								<td>Referral</td>
								<td><?php echo $in; ?></td>
							</tr>							<tr>								<td>Digital Mobile</td>								<td><?php $dm=4344; echo $dm; ?></td>							</tr>
							<tr>
								<td>Offline</td>
								<td><?php echo $other; ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo $total+4344; ?></td>
							</tr>
						</tbody>						
					</table>
				</div>
				<div class="span3">
					<h3>Total Users - Clicked</h3>						
					<table class="table table-striped" id="targetSample">
						<tbody>
							<tr>
								<td>Social</td>
								<td><?php echo round($fb*(0.079)); ?></td>
							</tr>
							<tr>
								<td>On Portal</td>
								<td><?php echo round($hm*(0.113)); ?></td>
							</tr>
							<tr>
								<td>Digital-Email(MU)</td>
								<td><?php echo round($nc*(0.189)); ?></td>
							</tr><tr>
								<td>Digital-Email(Generic)</td>
								<td><?php echo round($as*(0.039)); ?></td>
							</tr><tr>
								<td>SEM</td>
								<td><?php echo round($ga*(0.043)); ?></td>
							</tr>
							<tr>
								<td>Referral</td>
								<td><?php echo round($in*(0.031)); ?></td>
							</tr>							<tr>								<td>Digital Mobile</td>								<td><?php  echo round($dm*(0.063)); ?></td>							</tr>
							<tr>
								<td>Offline</td>
								<td><?php echo round($other*(0.019)); ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo '15207'; ?></td>
							</tr>
						</tbody>						
					</table>
				</div>
			</div>		
          </div>		 
		</div> 		
      </div>	  
		<div class="row-fluid">
			<div class="table">
				<div class="content-box">			 
					<table class="responsive table table-striped" id="allcheck">
					<thead>			
					  <tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>					               
						<th>Status</th>                
					  </tr>
					</thead>
					<tbody>
					<?php 
					if(!empty($rec_eve_reg_new))
					{ foreach($rec_eve_reg_new as $events)
						{ 
					?>
						<tr id="tr_<?php echo $events['v_id']; ?>">
							<td><?php echo ucwords(strtolower($events['v_fullname'])); ?> </td>
							<td><?php echo $events['v_email']; ?></td>
							<td><?php echo $events['v_phone']; ?></td>							
							<td>
									<div class="btn-group">	
									<?php if($events['phone_verified']==1 || $events['v_verified_phone']==1){ ?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone verified"><i class="icon-ok-sign icon-blue"></i></a>
									<?php } else {?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone not verified"><i class="icon-ok-sign"></i></a>									
									<?php } ?>	
									<?php if($events['email_verified']==1 || $events['v_verified_email']==1){ ?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email verified"><i class="icon-envelope icon-blue"></i></a>
									<?php } else {?>									
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email not verified"><i class="icon-envelope"></i></a>
									<?php } ?>																	
									<div class="modal hide" id="myModal_<?php echo $events['v_id']; ?>">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">x</button>
											<h3>Do you want to delete <?php echo $events['v_fullname']; ?>'s data?</h3>
										</div>
										<?php $eve_ID = $events['v_id']; ?>
										<?php $eve_Email = $events['v_email']; ?>
										<div class="modal-footer">
											<a href="#" onclick="del_reg_con('<?php echo $eve_ID; ?>','<?php echo $eve_Email; ?>')" class="btn" data-dismiss="modal">Yes</a>
											<a href="#" class="btn" data-dismiss="modal">Close</a>
										</div>
									</div>									
									<a href="#myModal_<?php echo $events['v_id']; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete" style="display:none;"><i class="icon-trash"></i></a>
								</div>
							</td>
					   </tr> 
						<?php }}else { ?>
						<tr>
						<td colspan="5">No leads  till now...</td>
						</tr>
						<?php } ?>
					</tbody>
					</table> 
					<div id="media_info" class="dataTables_info">Showing 01 to 30 of 2938 entries</div>
					<div class="modal hide" id="myModal_2">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h3>You need to purchase a higher package.</h3>
						</div>						
						<div class="modal-footer">							
							<a href="#" class="btn" data-dismiss="modal">Close</a>
						</div>
					</div>
					<div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="javascript:void(0);"><- Previous</a></li><li class="active"><a href="javascript:void(0);">1</a></li><li><a href="#myModal_2" data-toggle="modal" >2</a></li><li class="next"><a href="#myModal_2" data-toggle="modal">Next -></a></li></ul></div>
				</div>		
			</div>		 
		</div> 		
    </div><!-- close .container-fluid -->  
</div><!-- close .content -->      
<script>

function del_reg_con(id,email)
{
	var data = {reg_id:id,reg_email:email}
	$.ajax({
		type: "POST",
		url: "<?php echo $base; ?>newadmin/admin_events/delete_recent_events",
		data: data,
		success: function(msg)
		{
			$('#deleted').show();
			var new_position = $('#deleted').offset();
			window.scrollTo(new_position.left,new_position.top);
			$('#tr_'+id).hide('slow');			
			setTimeout(function(){$('#deleted').hide('slow');},3000);			
		}
	});	
}
// Statistics
$(document).ready(function() { 
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
					colors: [ '#2872bd', '#666666', '#feb900', '#128902', '#c6c12f', '#24D12B', '#C324D1']
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
									return '<div style="font-size:10px;text-align:center;padding:1px;color:white;font-weight:bold">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
								},
								background: { opacity: 0.8 }
							}
						}
					},
					legend:{
						show:true
					},
					grid: {
						hoverable: true,
						clickable: true
					},
					colors: [ '#2872bd', '#666666', '#feb900', '#128902', '#c6c12f', '#24D12B', '#C324D1']
				};
				if($('.flot').length > 0){
					$.plot($(".flot"), [ {label: "Facebook", data: sin}, {label: "Android", data: cos} ] , options);
				}
				if($(".flot-pie").length > 0){
					$.plot($(".flot-pie"), 
					[ {label: "Social", data: <?php echo $fb;?>}, 
					{label: "On Portal", data: <?php echo $hm;?>},
					{label: "Digital-Email(MU)", data: <?php echo $nc;?>},
					{label: "Digital-Email(Generic)", data: <?php echo $as;?>} ,
					{label: "SEM", data: <?php echo $ga;?>} ,
					{label: "Referral", data: <?php echo $in;?>},										{label: "Digital-Mobile", data: <?php echo $dm;?>},
					{label: "Offline", data: <?php echo $other;?>}],options2);
				} 
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
