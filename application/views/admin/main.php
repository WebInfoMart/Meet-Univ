<?php 
$flag=1;
  if($admin_user_level=='3')
  {
  if($univ_detail_edit==0)
  {
  $flag=0;
  }
  }
 if($flag) { ?>  
	<div id="content">
		<div class="message info"><p>Welcome to the Meet universities Admin Panel</p></div> 
		
		<?php if($admin_user_level=='3') { ?>
		<h2>Statistics</h2>		
		<div class="stats_charts">
		
			<table class="stats" rel="line" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>&nbsp;</td>
			 <?php for($i = 0; $i < 15; $i++) 
			{ ?>
			<th scope="col"><?php echo date("d/m/y", strtotime('-'. $i .' days')); ?></th>
			<?php 
			$lead_created_time=date("Y-m-d", strtotime('-'. $i .' days'));
			$no_of_registerd_user[]=$this->dashboard->count_no_of_registerd_user_by_date($university_id,$lead_created_time);
			$no_of_event_registerd_user[]=$this->dashboard->count_no_of_event_registerd_user_by_date($university_id,$lead_created_time);
			
			} 
			?>		
					</tr>
				</thead>				
				<tbody>
				<tr>
					<th>Event Request</th>								
					<?php for($e=0;$e<count($no_of_event_registerd_user);$e++) { ?>
					<td><?php echo $no_of_event_registerd_user[$e]; ?></td>
					<?php } ?>							
				</tr>
					
					<tr>
						<th>Program Request</th>	
			<?php for($i=0;$i<count($no_of_registerd_user);$i++) { ?>
						<td><?php echo $no_of_registerd_user[$i]; ?></td>
			<?php } ?>			
					</tr>
				</tbody>
			</table>
			
		</div>		<!-- .stats_charts ends -->
		
		<table width="100%" cellpadding="0" cellspacing="0" class="today_stats">
			<tr>
				<td><strong><?php echo $univ_detail_edit[0]->univ_views_count; ?></strong>University Viewed<span class="goup"><!--+53%--></span></td>
				<td><strong><?php echo $no_of_upcoming_event_requests; ?></strong>Upcoming Event's Registered User<!--<span class="goup">+53%</span>--></td>
				<td><strong><?php echo $no_of_requests; ?></strong>Total No of Program Request<span class="godown"><!---12%--></span></td>
				<td class="last"><strong><?php echo $univ_follwers; ?></strong>Follwers</td>
			</tr>
		</table>
		<div class="registerd_event_admin">
		<center><h3>Newly Registerd User for Upcoming Event</h3></center>
		</div>
		<?php if($upcoming_event_registerd_user!=0){ ?>
		<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th>Event title</th>
						<th>Event Date</th>
						<th>Event Type</th>
						<th>Registerd User Name</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php foreach($upcoming_event_registerd_user as $upcoming_event_registerd_user_detail) { ?>	
					<tr> 
						<td><strong><a href="#"><?php echo substr($upcoming_event_registerd_user_detail['event_title'],0,60).'..'; ?></a></strong></td>
						<td><?php echo $upcoming_event_registerd_user_detail['event_date_time']; ?></td>
						<td><?php echo $upcoming_event_registerd_user_detail['event_category']; ?></td>
						<td><?php echo $upcoming_event_registerd_user_detail['fullname']; ?></td>
					</tr>	
				<?php } ?>		
				
					
				</tbody>
				
			</table>
		<?php } else {?>
		<center><h4>No Registerd User for Upcoming Event</h4></center>
		<?php } ?>
		<div class="chat chat_admin">
		<div class="chat_users">
				<h3>Recent Follweres</h3>
				<?php if($recent_followers_of_univ!=0) { 
				foreach($recent_followers_of_univ as $recent_followers_of_univ_detail) {
				?>
				<ul>
				
					<li>
					<?php if($recent_followers_of_univ_detail['user_pic_path']!='') { ?>
					<a><img src="<?php echo $base.'uploads/'.$recent_followers_of_univ_detail['user_pic_path']; ?>" /> </a>
					<?php } else { ?>
					<a><img src="<?php echo $base ?>uploads/user_model.png" /> </a>
					
					<?php } ?>
					<?php echo $recent_followers_of_univ_detail['fullname']; ?>
					</li>
								
				</ul>
				<?php } } else { ?>
				<h4>No Follwers Yet</h4>
				<?php } ?>
			</div>
		<div class="chat_messages">
				<h3>Question</h3>
		<ul>
				
		<?php if($fetch_recent_five_question!=0) {
		$x=0;
		foreach($fetch_recent_five_question as $fetch_recent_five_question_detail) {
		$x=$x+1;
		
		?>	
			
					<li>
						<span><abbr class="timeago time_ago" title="<?php echo $fetch_recent_five_question_detail['q_asked_time']; ?>"></abbr></span>
						<?php if($fetch_recent_five_question_detail['user_pic_path']!='') { ?>
					<a href="#" class="avatar"><img src="<?php echo $base.'uploads/'.$fetch_recent_five_question_detail['user_pic_path']; ?>" /> </a>
					<?php } else { ?>
					<a href="#" class="avatar"><img src="<?php echo $base ?>uploads/user_model.png" /> </a>
					
					<?php } ?>
						
						<a href="#" class="username"><?php echo $fetch_recent_five_question_detail['fullname']; ?></a>
						<p><?php echo $fetch_recent_five_question_detail['q_title']; ?></p>
						<p class="q_detail"><?php $fetch_recent_five_question_detail['q_detail']; ?></p>
						
					
					</li>
				
				
		<?php 
		} ?>		
		</ul>
						
		<?php } else { ?>
		NO Recent Question
		<?php } ?>	
		</div>
		</div>
		<?php } ?>		
		
	</div>
<?php } ?>	
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
