<?php if($u_id!='363') 
{
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
					<div class="flot-pie"></div>
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
								<td><?php echo $fb_user; ?></td>
							</tr>
							<tr>
								<td>Android</td>
								<td><?php echo $android; ?></td>
							</tr><tr>
								<td>Event</td>
								<td><?php echo $event; ?></td>
							</tr><tr>
								<td>Site Users</td>
								<td><?php echo $site_user; ?></td>
							</tr>
							<tr>
								<td>facebook Canvas App</td>
								<td><?php echo $fb_canvas; ?></td>
							</tr>
							<tr>
								<td>College Request</td>
								<td><?php echo $college_request; ?></td>
							</tr>
							<tr>
								<td>Other</td>
								<td><?php echo $other; ?></td>
							</tr>
						</tbody>						
					</table>
				</div>
			</div>
			 <div class="row-fluid">
				<div class="span7">
					<h3>Lead Analytics</h3>
					<div class="content-box">
					 <div class="flot-multi"></div>
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
						
						<?php foreach($recent_leads as $recent)
						{ if ($recent === end($recent_leads))
							{
						?>
							<tr>
								<td><?php echo $recent['fullname']; ?></td>
								<td><?php if($recent['email']==''){ echo 'Not Available'; } else { echo $recent['email']; } ?></td>
								<td><?php echo date('d-M-y h:m',strtotime($recent['lead_created_time'])); ?></td>
							</tr>
						<?php } }?>	
						</tbody>
						</table>
				</div>
			</div>
          </div>
        </div>  
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <?php } ?>
