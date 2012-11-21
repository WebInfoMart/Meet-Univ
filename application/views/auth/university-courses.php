<div class="start_bar">			
	<!--<div class="float_l"><h3>Viewing 1 - <span id="listed_currently_univ">0</span> programs of <span id="red_total_univ">5</span>.</h3>			</div>-->		
	<div class="float_r">			
		<div class="sort_contanier">			
			<ul class="sort_list">					
				<li><h4>Sort By:</h4></li>				
				<li id="sort_foundation">				
					<a href="javascript:void(0)" id="level_2" class="active" onclick="sortBy('2')">Foundation</a>
				</li>					
				<li id="sort_underGraduate">		
					<a href="javascript:void(0)" id="level_3" onclick="sortBy('3')">UnderGraduate</a>		
				</li>					
				<li id="sort_postgraduate">	
					<a href="javascript:void(0)" id="level_4" onclick="sortBy('4')">PostGraduate</a>			
				</li>					
			</ul>			
		</div>		
	</div>		
	<div class="clearfix"></div>
</div>
		<div class="row">
			<div class="span12 float_l margin_l margin_t">	
				<h1 class="course_txt">Academic Programs</h1>
					<div>
						<ul class="course_list">
							<?php
							//echo $university_name;
							if(!empty($prog_title_of_univ))
							{
								foreach($prog_title_of_univ as $show_title)
								{
			
									$univ_domain=$show_title['subdomain_name'];
									$prog_title=$show_title['prog_title'];
									$prog_id=$show_title['prog_id'];
									
									$prog_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'programs',$prog_title,$prog_id);
									if($show_title['prog_educ_level'] == '2'){
									?>
									<li class="foundation">
										<a href="<?php echo $prog_link; ?>"><h2><?php echo $show_title['course_name']; ?> </h2></a>
										<span class="course_tit"><?php echo $show_title['educ_level']; ?> </span>
									</li>
									<?php 
									}elseif($show_title['prog_educ_level'] == '3'){
									?>
									<li class="undergraduate">	
										<a href="<?php echo $prog_link; ?>">		
											<h2><?php echo $show_title['course_name']; ?> </h2>							
										</a>									
										<span class="course_tit"><?php echo $show_title['educ_level']; ?> </span>
									</li>
									<?php
									}elseif($show_title['prog_educ_level'] == '4'){
									?>
									<li class="postgraduate">	
										<a href="<?php echo $prog_link; ?>">		
											<h2><?php echo $show_title['course_name']; ?> </h2>							
										</a>									
										<span class="course_tit"><?php echo $show_title['educ_level']; ?> </span>
									</li>
									<?php
									}
								}
							} else { echo "</br><h4>We are gathering information about $university_name. Please visit back soon</h4>"; } ?>
							
						</ul>
					</div>
			</div>
			<?php $this->load->view('auth/univ-fb-sidebar'); ?>
			<div class="clearfix"></div>
		</div>
</div>
</div>
<script>	
	$(document).ready(function(){
		sortBy('2');
	});
	function sortBy(edu_level){	
	
		if(edu_level == '2'){
			$('.sort_list a').removeClass('active');
			$('#level_'+edu_level).addClass('active');
			$('.foundation').show();
			$('.undergraduate').hide();
			$('.postgraduate').hide();
		}else if(edu_level == '3'){
			$('.sort_list a').removeClass('active');
			$('#level_'+edu_level).addClass('active');
			$('.foundation').hide();
			$('.undergraduate').show();
			$('.postgraduate').hide();
		}else if(edu_level == '4'){
			$('.sort_list a').removeClass('active');
			$('#level_'+edu_level).addClass('active');
			$('.foundation').hide();
			$('.undergraduate').hide();
			$('.postgraduate').show();
		}
	}		
</script>
		