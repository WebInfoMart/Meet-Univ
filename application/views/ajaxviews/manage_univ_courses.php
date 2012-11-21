		<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
						<th class="header" style="cursor: pointer; ">Program Title</th>
						<th class="header" style="cursor: pointer; ">Education Level</th>
						<th class="header" style="cursor: pointer; ">Course Name</th>
						<th class="header" style="cursor: pointer; ">Area of Interest</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				foreach($course_info as $row){
				?>
					<tr class="even">
					
						<td>
						<input type="checkbox" class="setchkval" value="" name="check_course_<?php echo $row->prog_id; ?>" id="check_course_<?php echo $row->prog_id; ?>">
						<input type="hidden" name="course_id[]" value="<?php echo $row->prog_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						<?php echo ucwords($row->prog_title); ?>
						<td><?php echo ucwords($row->educ_level); ?></td>
						<td><a href="#"><?php echo ucwords($row->course_name); ?></a></td>
						<td >
					<?php echo $row->program_parent_name; ?>
						</td>
						<td>
			
      <ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-course-univ icon-white"></i>COURSE</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<li><a href="#" onclick="delete_confirm('<?php echo $row->prog_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
			</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } ?>		
				</tbody>
				
			</table>
		<div class="tableactions" style="margin-top:10px;">
				<select name="univ_action" id="course_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		
		
			<div id="pagination" class="table_pagination right paging-margin">
			
            <?php echo $this->pagination->create_links();?>
			
            </div> 			