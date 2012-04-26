<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
				<div class="float_r span3 margin_t1">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
					
				</div>
				<div id="quest_div_show_right" class="span13 margin_l margin_t1">
				<div class="float_r" >
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				<div class="clearfix"></div>
				</div>
				<h2 class="course_txt"><?php echo $count_all_question; ?> Questions asked on MeetUniversities</h2>
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
				<div class="event_border">
				<div>
				<div id="quest_pic" class="float_l">
				<?php if($quest_list['user_pic_path']!='')
				{
				echo "<img style='width:80px;height:80px;margin-right:20px;' src='".base_url()."uploads/".$quest_list['user_pic_path']."'/>"; 
				} else
				{
				echo "<img style='width:80px;height:80px;margin-right:20px;' src='".base_url()."images/user_model.png'/>"; 
				} ?></div>
				
				
				<div id="quest" class="dsolution">
				<div>
				<div class="float_l">
			<a href="<?php echo "$base$url"; ?>" class="black">
					<h3><?php echo $quest_list['q_title']."</br>";?></h3></a>
				
				<span style="color:black;"><?php echo $quest_list['q_asked_time']; ?></span>, <?php echo "by&nbsp;".$quest_list['fullname']."&nbsp";
				// Quickly calculate the timespan
					
	// $time = $quest_list['q_asked_time'];
	// $diferencia = time() - $quest_list['q_asked_time'];
    
				?>
				</div>
	<?php $url = "UniversityQuest/$quest_list[q_univ_id]/$quest_list[que_id]/$quest_list[q_askedby]"; ?>			
				<div class="fb-like float_r" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial">
				</div>
				
				
				
				<div class="clearfix"></div>
				</div>
				<?php echo $quest_list['q_detail']."</br>";?>
				</div>
				</div>
				</div>
				<?php
				}
				}
				?>
				</div>
				
				</div>
				
				<div class="clearfix"></div>
</div>
</div>
</div>