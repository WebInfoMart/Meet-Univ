<?php 
$facebook = new Facebook();
$user = $facebook->getUser();
$this->load->model('users');
if ($user) {
//$logoutUrl2 = $this->tank_auth->logout();
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me'); 
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
?>

<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
				<div class="float_r span3 margin_t1">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
				</div>
				<div id="quest_div_show_right" class="span13 margin_l margin_t1">
				<h2 class="course_txt"><?php echo $count_all_question; ?> Questions Asked.</h2>
				<div class="margin_t1">
				<?php //print_r($get_all_question);
				if(!empty($get_all_question))
				{
				$a=0;
				foreach($get_all_question['quest_detail'] as $quest_list)
				{
				if($quest_list['q_univ_id'] != '0')
				{
				$univ_domain=$quest_list['subdomain_name'];
				$quest_title=$quest_list['q_title'];
				$url=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
				
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				else
				{
					//$univ_title = str_replace(' ','_',$quest_list['title']);
					//$question_title = str_replace(' ','-',$quest_list['q_title']);
					$question_title =$this->subdomain->process_url_title($quest_list['q_title']);
					$url = $base.'otherQuestion/'.$quest_list['que_id'].'/'.$question_title;
				}
				?>
				<div id="effect-style">
				<div class="event_border">
				<div>
				<div id="quest_pic" class="float_l">
				<?php
				$logged_user_id = $this->tank_auth->get_user_id();
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$quest_list['user_thumb_pic_path']) && $quest_list['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img style='width:40px;height:40px;margin-right:20px;' src='".base_url()."uploads/user_pic/thumbs/".$quest_list['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$quest_list['user_pic_path']) && $quest_list['user_pic_path']!='')
							{
								echo "<img style='width:40px;height:40px;margin-right:20px;' src='".base_url()."uploads/user_pic/".$quest_list['user_pic_path']."'/>";
							}
							else if($user && $quest_list['q_askedby'] == $logged_user_id)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img style='width:40px;height:40px;margin-right:20px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
				</div>
				
				
				<div id="quest" class="dsolution">
				<div>
				<div class="float_l">
			<a href="<?php echo $url; ?>" class="black">
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
							$count=$this->quest_ans_model->get_noof_comments($quest_list['que_id']);
							
				echo "&nbsp;&nbsp;".$count."&nbsp;Answers&nbsp;";
				
				// Quickly calculate the timespan
					
	// $time = $quest_list['q_asked_time'];
	// $diferencia = time() - $quest_list['q_asked_time'];
    
				?>
				</div>
	<?php //$url = "UniversityQuest/$quest_list[q_univ_id]/$quest_list[que_id]/$quest_list[q_askedby]"; ?>			
			<!--	<div class="float_r" id="soc_button">
				<div class="float_l" style="margin-right:15px;"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo "$base$url"; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
						<div class="float_l" style="width: 58px"><div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
							<div class="float_l">
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "$base$url"; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
							</div>
							
				</div> -->
				
				
				
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
				<div id="pagination" class="table_pagination right paging-margin">
				<?php echo $this->pagination->create_links(); ?>
				</div>
				</div>
				
				</div>
				
				<div class="clearfix"></div>
				
</div>
</div>
</div>