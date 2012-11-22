<pre>
<?php //print_r($event_users);exit; ?>
</pre>
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
	<div id="content">
		<div class="message info"><p>Welcome to the Meet universities Admin Panel</p></div> 		
		<h2>Statistics</h2>
		<div class="stats_charts" id="chart_div" style="width: 1100px; height: 300px;"></div>		
		<div class="registerd_event_admin" style="width:50%;float:left">
			<h3>Latest Users</h3>
		
				<?php //print_r($latest_users);exit;; 
				if($latest_users!=0){ ?>
				<table cellpadding="0" cellspacing="0" width="50%" class="sortable">
			
				<thead>
					<tr>
						<th>Sr No</th>
						<th>Username</th>
						<th>Email Id</th>
						<th>User Type</th>						
						<th>Created On</th>
					</tr>
				</thead>
				
				<tbody>
				<?php $i=1;
				foreach($latest_users as $latest_user) { ?>	
					<tr> 	
						<td><?php echo $i; $i++;  ?></td>
						<td><?php if($latest_user['fullname']==""){ echo 'Not Available'; } echo $latest_user['fullname']; ?></td>
						<td><?php if($latest_user['email']==""){ echo 'Not Available'; } echo $latest_user['email']; ?></td>
						<td>
						<?php if($latest_user['user_type']=="")
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
						<td><?php $date=strtotime($latest_user['createdon']); echo date('d/M/Y h:m',$date); ?></td>
					</tr>	
				<?php } } ?>		
				
					
				</tbody>
				
			</table>
		</div>
	
	<div class="chat chat_admin" style="float:left;width:45%;margin-left: 30px;margin-top:30px">
<div class="chat_messages">
				<h3>Question</h3>
		<ul>
				
		<?php if($ten_question!=0) {
		$x=0;
		foreach($ten_question as $ten_questions) {
		$x=$x+1;
		
		?>	
			
					<li>
						<span><abbr class="timeago time_ago" title="<?php echo $ten_questions['q_asked_time']; ?>"></abbr></span>
						<?php if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$ten_questions['user_thumb_pic_path']) && $ten_questions['user_thumb_pic_path']!='')
						{
						if(filesize(getcwd().'/uploads/user_pic/thumbs/'.$ten_questions['user_thumb_pic_path']))
						{
						 $user_pic =  base_url()."uploads/user_pic/thumbs/".$ten_questions['user_thumb_pic_path'];
						}
						else
						{
						 $user_pic = base_url()."images/profile_icon.png";
						}
						//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';	
						}
						else
						{
						$user_pic = base_url()."images/profile_icon.png";
						}
						?>
					<a href="#" class="avatar"><img src="<?php echo $user_pic; ?>" /> </a>
									
						<a href="#" class="username"><?php echo $ten_questions['fullname']; ?></a>
						<p><?php echo $ten_questions['email']; ?></p>
						<p><?php echo $ten_questions['q_title']; ?></p>
						<p class="q_detail"><?php echo $ten_questions['q_detail']; ?></p>
					
					</li>
				
				
		<?php 
		} ?>		
		</ul>
						
		<?php } else { ?>
		NO Recent Question
		<?php } ?>	
		</div>
		</div>
		<div class="clearfix"></div>
		<div class="registerd_event_admin" style="width:50%;float:left">
			<h3>Latest Events Registrations</h3>
		
				<?php //print_r($latest_users); 
				if($latest_users!=0){ ?>
				<table cellpadding="0" cellspacing="0" width="50%" class="sortable">
			
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
				foreach($event_users as $user) { ?>	
					<tr> 	
						<td><?php echo $i; $i++;  ?></td>
						<td><?php if($user['fullname']==""){ echo 'Not Available'; }  echo $user['fullname']; ?></td>
						<td><?php if($user['email']==""){ echo 'Not Available'; }  echo $user['email']; ?></td>
						<td><?php if($user['phone']==""){ echo 'Not Available'; }  echo $user['phone']; ?></td>
						<td><?php if($user['event_title']==""){ echo 'Not Available'; }  echo $user['event_title']; ?></td>
						<td><?php if($user['univ_name']==""){ echo 'Not Available'; }  echo $user['univ_name']; ?></td>
						<td><?php $dt=strtotime($user['event_registered_time']); echo date('d/M/Y G:i ',$dt); ?></td>
					</tr>	
				<?php } } ?>		
				
					
				</tbody>
				
			</table>
		</div>
		</div>

<script>
function answerthis(formid)
{
$('#answer_form_'+formid).toggle(500);
}
function submitanswer(qid)
{
var commentedtext=$('#answer_of_que_'+qid).val();
var commentd_on='qna';
var commented_on_id=qid;
if($('#answer_of_que_'+qid).val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   async:false,
	   data: 'commented_text='+commentedtext+'&commentd_on='+commentd_on+'&commented_on_id='+commented_on_id,
	   cache: false,
	   success: function(msg)
	   {
		
		/*$(".event_border:last").after(msg);
		$('#commented_text').val('');
		$('#txt_cnt_comment_show').val(parseInt(span_comment)+1);*/
		$('.q_detail').html('<div class="answer_box">'+q_detail+'</div>');
		}
	   });
}
}
</script>	

</body>
</html>
