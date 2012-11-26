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
				<div class="span8">
					<h3>Event Source</h3>
					<div class="content-box">
						<div class="flot-pie"></div>
					</div>
				</div>
				<div class="span4">
					<h3>Event Users Source</h3>
					<?php
						$fb=0;	$hm=0;	$nc=0;	$as=0;	$ga=0;	$in=0;	$other=0;						
						foreach($visit as  $type)
						{ 
							if($type['campaign_type']=='fb')
							{
								$fb=$type['total'];
							}
							if($type['campaign_type']=='hm')
							{
								$hm=$type['total'];
							}
							if($type['campaign_type']=='nc')
							{
								$nc=$type['total'];
							}
							if($type['campaign_type']=='as')
							{
								$as=$type['total'];
							}
							if($type['campaign_type']=='ga')
							{
								$ga=$type['total'];
							}
							if($type['campaign_type']=='in')
							{
								$in=$type['total'];
							}
							if($type['campaign_type']=='')
							{
								$other=$type['total'];
							}
						}
						$total = $fb+$hm+$nc+$as+$ga+$in+$other;
					?>	
					<table class="table table-striped" id="targetSample">
						<tbody>
							<tr>
								<td>Facebook</td>
								<td><?php echo $fb; ?></td>
							</tr>
							<tr>
								<td>Home</td>
								<td><?php echo $hm; ?></td>
							</tr>
							<tr>
								<td>Netcore</td>
								<td><?php echo $nc; ?></td>
							</tr><tr>
								<td>Alfa Sandesh</td>
								<td><?php echo $as; ?></td>
							</tr><tr>
								<td>Google</td>
								<td><?php echo $ga; ?></td>
							</tr>
							<tr>
								<td>Intra</td>
								<td><?php echo $in; ?></td>
							</tr>							
							<tr>
								<td>Other</td>
								<td><?php echo $other; ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo $total; ?></td>
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
					<table class="responsive table table-striped dataTable" id="allcheck">
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
					if(!empty($rec_eve_reg))
					{ foreach($rec_eve_reg as $events)
						{ 
					?>
						<tr id="tr_<?php echo $events['id']; ?>">
							<td><?php echo $events['fullname']; ?> </td>
							<td><?php echo $events['email']; ?></td>
							<td><?php echo $events['phone']; ?></td>							
							<td>
									<div class="btn-group">	
									<?php if($events['phone_verified']==1){ ?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone verified"><i class="icon-ok-sign icon-blue"></i></a>
									<?php } else {?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone not verified"><i class="icon-ok-sign"></i></a>									
									<?php } ?>	
									<?php if($events['activated']==1){ ?>
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email verified"><i class="icon-envelope icon-blue"></i></a>
									<?php } else {?>									
										<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email not verified"><i class="icon-envelope"></i></a>
									<?php } ?>																	
									<div class="modal hide" id="myModal_<?php echo $events['id']; ?>">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">x</button>
											<h3>Do you want to delete <?php echo $events['fullname']; ?>'s data?</h3>
										</div>
										<?php $eve_ID = $events['id']; ?>
										<?php $eve_Email = $events['email']; ?>
										<div class="modal-footer">
											<a href="#" onclick="del_reg_con('<?php echo $eve_ID; ?>','<?php echo $eve_Email; ?>')" class="btn" data-dismiss="modal">Yes</a>
											<a href="#" class="btn" data-dismiss="modal">Close</a>
										</div>
									</div>									
									<a href="#myModal_<?php echo $events['id']; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete"><i class="icon-trash"></i></a>
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
			$('#tr_'+id).hide('slow');
			$('#deleted').show();
			setTimeout(function(){$('#deleted').hide('slow');},6000);			
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
				if($(".flot-pie").length > 0){
					$.plot($(".flot-pie"), 
					[ {label: "Facebook", data: <?php echo $fb;?>}, 
					{label: "Home", data: <?php echo $hm;?>},
					{label: "Netcore", data: <?php echo $nc;?>},
					{label: "Alfa Sandesh", data: <?php echo $as;?>} ,
					{label: "Google", data: <?php echo $ga;?>} ,
					{label: "Intra", data: <?php echo $in;?>},
					{label: "Other", data: <?php echo $other;?>}],options2);
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
