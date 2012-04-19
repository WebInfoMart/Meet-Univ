<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div>
<div class="float_r span3 margin_t">
					<img src="../images/banner_img.png">
				</div>
				<!-- Added by Subh -->
				<div id="quest_div_1" class="show_qans_main_div">
				<div id="question_filters" class="show_qans_main_div_left">
				
				

				</div>
				<div id="quest_div_show_right" class="show_qans_main_div_right">
				<h3 class="heading_follow"><?php echo $count_all_question; ?> Questions asked on MeetUniversities</h3>
				<div class="margin_t1">
				<?php
				if(!empty($get_all_question))
				{
				foreach($get_all_question as $quest_list)
				{
				if($quest_list['q_univ_id'] != '0')
				{
					$url = "UniversityQuest/$quest_list[q_univ_id]/$quest_list[que_id]/$quest_list[q_askedby]";
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				?>
				<a href="<?php echo "$base$url"; ?>">
				<div class="quest_row_single">
				<div id="quest_pic" class="quest_pic"> <?php echo "<img style='width:40px;height:40px;' src='".base_url()."uploads/".$quest_list['user_pic_path']."'/>";  ?> </div>
				<div id="quest" class="quest_right">
				<?php
				echo $quest_list['q_title']."</br>";
				echo "by&nbsp;".$quest_list['fullname']."&nbsp";
				// Quickly calculate the timespan
					
	// $time = $quest_list['q_asked_time'];
	// $diferencia = time() - $quest_list['q_asked_time'];
    
				?>
				</div>
				</div>
				</a>
				<?php
				}
				}
				?>
				</div>
				
				</div>
				</div>
</div>
</div>
</div>