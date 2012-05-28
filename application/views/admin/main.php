	
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
		
		<?php } ?>		
		
		<table width="100%" cellpadding="0" cellspacing="0" class="today_stats">
			<tr>
				<td><strong><?php echo $univ_detail_edit[0]->univ_views_count; ?></strong>University Viewd<span class="goup"><!--+53%--></span></td>
				<td><strong><?php echo $no_of_upcoming_event_requests; ?></strong>Upcoming Event's Registered User<!--<span class="goup">+53%</span>--></td>
				<td><strong><?php echo $no_of_requests; ?></strong>Total No of Program Request<span class="godown"><!---12%--></span></td>
				<td class="last"><strong><?php echo $univ_follwers; ?></strong>Follwers</td>
			</tr>
		</table>
		
	</div>
	
	

</body>
</html>
