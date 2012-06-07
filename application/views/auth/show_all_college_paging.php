					
<?php
						$count_array = count($get_university['university']);
						$map_address='';
						$cnt = 1;
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
							<div class="events_holder_box margin_t" date="<?php echo date("m-d-Y", strtotime($get_university['univ_event'][$no_university][0]['event_date_time'])); ?>" country="<?php echo $get_university['university'][$no_university]['country_name']; ?>" univ_name="<?php echo $get_university['university'][$no_university]['univ_name']; ?>">
								<div class="row">
									<div class="span8 float_l margin_l margin_t1">
										<h3><span><a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>" >
										
										<?php echo $get_university['university'][$no_university]['univ_name']; ?></a></span>- 
										<?php echo $get_university['university'][$no_university]['country_name']; ?></h3>
									</div>
									<div class="float_r">
										<!--<div class="box_col">
										<div class="fb-like float_l" data-href="<?php echo $base;?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
										<div class="float_r">
										<a href="https://twitter.com/share" data-url="<?php echo $base;?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"  class="twitter-share-button" data-count="none">Tweet</a>
										</div>
										<div class="clearfix"></div>
										</div>-->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="margin_t1"> 
									<div class="float_l margin_zero">
										<div class="float_l span2 margin_zero">
											<div class="col_list_logo aspectcorrect" style="position: absolute;z-index: 100;>
												<?php
							$image_exist=0;	
							$univ_img = $get_university['university'][$no_university]['univ_logo_path'];	
						    if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_img) && $univ_img!='')	
							{
							
							$image_exist=1;
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$univ_img);
							}
							else
							{
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');
							}
							if($univ_img!='' && $image_exist==1)
							{
							$image=$base.'uploads/univ_gallery/'.$univ_img;
							}
							else
							{
							$image=$base.'uploads/univ_gallery/univ_logo.png';
							} 
							$img_arr=$this->searchmodel->set_the_image($width,$height,110,115,TRUE);
							?>
							<a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><img  title="<?php echo $get_university['university'][$no_university]['univ_name']; ?>" src='<?php echo $image;?>' style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;"></a>
											
											</div>
											<div class="apply">
												<span id="send_steps_span">
											<input type="hidden" id="steps_univ_id_<?php echo $cnt; ?>" name="steps_univ_id_<?php echo $cnt; ?>" value="<?php echo $get_university['university'][$no_university]['univ_id']; ?>"
												<span class="green"><img src="<?php echo $base; ?>	images/tick.gif"/><a href="#" id="<?php echo $cnt; ?>" onclick="send_steps(this);">Apply</a></span>
											</span>
											</div>
										</div>
										<div class="float_r course_des margin_l">
											<?php 
											$overview=$get_university['university'][$no_university]['univ_overview'];
											echo substr($overview,0,205);
											if(strlen($overview)>205)
											{											
											?>
											..<div class="float_r"><a href="<?php echo $base; ?>about-<?php echo $get_university['university'][$no_university]['univ_id']  ;?>-university">View all&raquo;</a></div>
											<?php } ?>
										</div>
									</div>
									<div class="float_r page2_col">
										<div class="float_l done margin_l">
											<div class="events_dates float_l" onclick="gotoevent('<?php echo $get_university['university'][$no_university]['univ_id']  ;?>','<?php echo $get_university['univ_event'][$no_university][0]['event_id']; ?>');" style="cursor:pointer;">
												<div class="red_box">
													Events
												</div>
												<div class="padding1">
													<div class="float_l margin_t">
													<?php 
													if($get_university['univ_event'][$no_university]!=0)
													{
													$event_has=1;
													$date=$get_university['univ_event'][$no_university][0]['event_date_time']; 
													$date_part=explode(' ',$date);
													
													?>
														<span class="date"><?php echo $date_part[0]; ?></span>
													</div>
													<div class="float_l margin_l">
														<span style="font-size:18px;">
														<?php if($event_has) { echo $date_part[1]; ?> <br/>
											<?php if($get_university['univ_event'][$no_university][0]['country_name']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['country_name']);
											} ?><br />
													
											<?php if($get_university['univ_event'][$no_university][0]['cityname']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['cityname']); }
											} ?><br />
														</span>
											<?php } else { ?>
											
											<div class="center">
														<span style="font-size:18px;">No Recent Event </span> </div><?php } ?>			
													</div>
													</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r page4_col margin_l">
											<ul>
												<li><a href="<?php echo $base; ?>univ-<?php echo $get_university['university'][$no_university]['univ_id']; ?>-articles">Articles (<span class="blue"><?php echo $get_university['article'][$no_university]; ?></span>)</a></li>
												<li><a href="<?php echo $base; ?>UniversityQuestSection/<?php echo $get_university['university'][$no_university]['univ_id']; ?>">Q/A (<span class="blue"><?php echo $get_university['questions'][$no_university]; ?></span>)</a></li>
												<li><a href="#">Followers (<span class="blue followers_<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['followers'][$no_university]; ?></span>)</a></li>
												<li><a href="<?php echo $base; ?>univ_programs/<?php echo $get_university['university'][$no_university]['univ_id']; ?>/program">Courses(<span class="blue"><?php echo count($get_university['program'][$no_university]); ?></span>)</a></li>
												
												<!--<li><a href="#">E-Brochure</a></li>-->
											</ul>
										</div>
										<div class="clearfix"></div>
										<div>
											<div class="float_l top_page">
												Views: <span class="blue"><?php echo $get_university['university'][$no_university]['univ_views_count']; ?></span>
											</div>
											<div class="float_l top_page margin_l">
												&nbsp;&nbsp;Listed: <span class="blue">2980</span>
											</div>
											<div class="last_box_col float_r">
												<img src="<?php echo "$base$img_path"; ?>/add.PNG" class="img_set"/>
				<span class="margin_l follow_univ_<?php echo $get_university['university'][$no_university]['univ_id']; ?>" onclick="follow_university('<?php echo $get_university['university'][$no_university]['univ_id']; ?>','<?php echo $get_university['followers'][$no_university]; ?>')" style="cursor:pointer;">
												<?php if($get_university['is_already_follow'][$no_university]=='0'){ ?>Follow<?php } else { ?>Unfollow<?php } ?>
									   </span>
		<input type="hidden" id="follow_count_<?php echo $get_university['university'][$no_university]['univ_id']; ?>" value="<?php echo $get_university['followers'][$no_university]; ?>">								
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
					<?php $cnt++; } ?>	
						</div>
						