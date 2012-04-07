<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<?php $this->load->view('auth/univ-header-gallery-logo'); ?>
		<div class="row" style="margin-top:-40px">
			<div class="span12 float_l margin_l margin_t">	
				<h1 class="course_txt">Academic Programs</h1>
					<div>
						<ul class="course_list">
							<?php
							if(!empty($prog_title_of_univ))
							{
							foreach($prog_title_of_univ as $show_title)
								{
							?>
								<li><a href="<?php echo "$base"; ?>program_detail/<?php echo $univ_id_for_program; ?>/<?php echo $show_title['prog_id']; ?>"><h2><?php echo $show_title['course_name']; ?> </h2></a>
								<span class="course_tit"><?php echo $show_title['educ_level']; ?> </span></li>
								<?php 
								}
							}?>
							
						</ul>
					</div>
			</div>
			<?php $this->load->view('auth/univ-fb-sidebar'); ?>
			<div class="clearfix"></div>
		</div>
</div>
</div>
		