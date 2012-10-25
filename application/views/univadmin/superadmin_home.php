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
<div class="row-fluid">
  <div class="span12">
   <div class="page-header clearfix tabs">
    <h2>Insight <small>Site Statistics</small></h2>
  </div>
  <div class="content-box">
    <div class="tab-content">
    
	   <div class="stats_charts" id="chart_div" style="width: 1100px; height: 300px;"></div>	
	 
    </div>
  </div>
</div>
</div>
      <div class="row-fluid">
        <div class="span6 no-margin">
          <div class="page-header">
            <h2>Latest Users</h2>
          </div>
          <div class="content-box">
            <table class="table table-striped table-nohead">
              <tbody>
			   <tr>
						<th>Sr No</th>
						<th>Username</th>
						<th>Email Id</th>
						<th>User Type</th>						
						<th>Created On</th>
					</tr>
			 
				<?php 
				if($latest_users!=0)
				{$i=1;
				foreach($latest_users as $latest_user) { ?>	
					<tr> 	
						<td><?php echo $i; $i++;  ?></td>
						<td><?php echo $latest_user['fullname']; ?></td>
						<td><?php echo $latest_user['email']; ?></td>
						<td><?php echo $latest_user['user_type']; ?></td>
						<td><?php $date=strtotime($latest_user['createdon']); echo date('d/M/Y h:m',$date); ?></td>
					</tr>	
				
              <?php }} ?>
				
              </tbody>
            </table>
          </div>        
        </div>
        <div class="span6 no-margin">
         
              <div class=".chat_messeges" >
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
					<a href="<?php echo $base; ?>user/<?php echo $ten_questions['id'];?>/<?php echo $ten_questions['fullname'];?>" class="avatar">
					<img style="width:50px;"  src="<?php echo $user_pic; ?>" /> </a>
									
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
</div>
