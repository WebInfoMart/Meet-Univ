<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<?php $this->load->view('auth/univ-header-gallery-logo'); ?>
		
<?php
if(!empty($prog_title_of_univ))
{
foreach($prog_title_of_univ as $show_title)
	{
?>
	<a href="<?php echo "$base"; ?>program_detail/<?php echo $univ_id_for_program; ?>/<?php echo $show_title['prog_id']; ?>"><h3><?php echo $show_title['course_name']; ?> </h3></a></br>
	<?php echo $show_title['educ_level']; 
	}
}
 $this->load->view('auth/univ-fb-sidebar'); ?>
</div>
			</div>
		