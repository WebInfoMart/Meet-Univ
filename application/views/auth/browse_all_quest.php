<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
				<div class="float_r span3 margin_t1">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
					
				</div>
				<div id="quest_div_show_right" class="span13 margin_l margin_t1">
				<!--<div class="float_r" >
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				<div class="clearfix"></div>
				</div>-->
				<h2 class="course_txt"><?php echo $count_all_question; ?> Questions asked on MeetUniversities</h2>
				<div class="margin_t1">
				<?php
				if(!empty($get_all_question))
				{
				$a=0;
				foreach($get_all_question['quest_detail'] as $quest_list)
				{
				if($quest_list['q_univ_id'] != '0')
				{
					//$univ_title = str_replace(' ','_',$quest_list['title']);
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$url = "$quest_list[q_univ_id]/UniversityQuest/$quest_list[que_id]/$question_title/$quest_list[q_askedby]";
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				else
				{
					//$univ_title = str_replace(' ','_',$quest_list['title']);
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$url = "MeetQuest/$quest_list[que_id]/$question_title/$quest_list[q_askedby]";
				}
				?>
				<div id="effect-style">
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
				
				<span style="color:black;">
				<abbr class="timeago time_ago" title="<?php echo $quest_list['q_asked_time'] ?>"></abbr>
							
				</span>, <?php echo "by&nbsp;".$quest_list['fullname']."&nbsp";
				
				if($quest_list['q_country_id'] == '0' and $quest_list['q_univ_id'] != '0')
							{
								echo 'Category-Colleges,';
							}
							else if($quest_list['q_country_id'] != '0' and $quest_list['q_univ_id'] == '0') 
							{
								echo 'Category-Study Abroad, ';
							}
							else{
							echo 'Category-General Question,';
							}
				echo "&nbsp;&nbsp;".$get_all_question['ans_count'][$a]."&nbsp;Answers&nbsp;";
				
				// Quickly calculate the timespan
					
	// $time = $quest_list['q_asked_time'];
	// $diferencia = time() - $quest_list['q_asked_time'];
    
				?>
				</div>
	<?php //$url = "UniversityQuest/$quest_list[q_univ_id]/$quest_list[que_id]/$quest_list[q_askedby]"; ?>			
				<div class="float_r">
				<div class="float_l" style="margin-right:15px;"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo "$base$url"; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
							<div class="float_l" style="width: 58px"><div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
							<div class="float_l">
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "$base$url"; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
							</div>
				</div> 
				
				
				
				<div class="clearfix"></div>
				</div>
				<?php echo $quest_list['q_detail']."</br>";?>
				</div>
				</div>
				</div>
				</div>
				<?php
				$a++;
				}
				}
				?>
				</div>
				
				</div>
				
				<div class="clearfix"></div>
</div>
</div>
</div>