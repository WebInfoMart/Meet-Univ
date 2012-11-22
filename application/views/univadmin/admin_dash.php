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
<?php } ?>
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
