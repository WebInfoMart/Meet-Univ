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
		  <div class="table">
			<div class="page-header tabs clearfix">
			  <h2>Recent Leads</h2>
			</div>       
			<div class="content-box">				
				<table class="responsive table table-striped dataTable" id="allcheck">
					<thead>			
					  <tr>
						<th>User Name</th>
						<th>Email</th>
						<th>Phone</th>						
						<th>Lead Created Time</th>                
						<th>Status</th>                
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
						<td><?php echo $leads['phone_no1']; ?></td>					
						 <td><?php  $d=strtotime($leads['lead_created_time']); 
						 echo date('d/m/y-h:m',$d); ?></td> 
						<td>
							<div class="btn-group">
								<?php if($leads['phone_verified']==1){ ?>
									<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone varified"><i class="icon-ok-sign icon-blue"></i></a>
								<?php } else {?>
									<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Phone not varified"><i class="icon-ok-sign"></i></a>									
								<?php } ?>	
								<?php if($leads['activated']==1){ ?>
									<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email varified"><i class="icon-envelope icon-blue"></i></a>
								<?php } else {?>									
									<a href="javascript:void(0)" class="btn btn-icon tip" data-original-title="Email not varified"><i class="icon-envelope"></i></a>
								<?php } ?>								
							</div>
						</td>
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
