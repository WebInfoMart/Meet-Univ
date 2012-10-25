<?php
$edit=0;
$delete=0;
$view=0;
$insert=0;
$event_edit_op=array('3','6','7','10');
$event_delete_op=array('5','7','8','10');
$event_insert_op=array('4','6','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!=0)
{
$view=1;
if(in_array($admin_priv_res['privilege_level'],$event_edit_op))
{
$edit=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_delete_op))
{
$delete=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_insert_op))
{
$insert=1;
}
}
}

if(!empty($article_info))
{  ?>
  <!-- BEGIN Content -->
  <div id="deleted" style="display:none;" class="alert alert-success" style="z-index:99999">
 <a class="close" data-dismiss="alert" href="#">×</a>
  <strong>Article deleted successfully</strong>
  </div>
  <div class="content">
    <div class="container-fluid">      
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Articles</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li id="active_menu">
                <a href="#create" data-toggle="pill">Create Articles</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="table table-striped dataTable" >
                  <thead>
                    <tr>
                      <th width="10%">
					  <input type="checkbox" class="check_all"></th>
                      <th width="25%">Article Title</th>
                      <th width="25%">University Name</th>
                      <th width="20%">Status</th>
					  <th width="20%">Featured/UnFeatured</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($article_info as $article)
					{ ?>
					<tr id="check_university_<?php echo $article->article_id;?>">
                      <td><input type="checkbox" value="<?php echo $article->article_id;?>" name="check_article_<?php echo $article->article_id; ?>" class='selectable_checkbox setchkval' id="check_article_<?php echo $article->article_id; ?>"></td>
                      <td><?php echo ucwords(substr($article->article_title,0,50)); ?></td>
                       <td><?php echo ucwords($article->univ_name); ?></td>
                       <td class="center"> <?php if($article->article_approve_status){ echo "Approved"; } else {  echo "<span style='color:#000;'>Pending For Approve</span>";} ?></td>
					  <td><?php if($article->featured_home_article){ echo "<span style='color:#000;'>Featured</span>"; } else {  echo "Nonfeatured";} ?></td>
					  <td class="options">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/view_article/<?php echo $article->article_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo "$base"; ?>newadmin/adminarticles/edit_article/<?php echo $article->article_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $article->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $article->article_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $article->article_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	if(($edit==1 || $delete==1 || $insert==1)  && $admin_user_level!='3' ){  ?>
								<a href="#"  onclick="approve_home_confirm('<?php echo "$base";?>newadmin/adminarticles','<?php  echo $article->featured_home_article; ?>','<?php echo $article->article_id; ?>');"  class="btn btn-icon tip" <?php if($article->article_approve_status){ ?> data-original-title="Disapprove" <?php } else { ?> data-original-title="Approve" <?php } ?> >
									<i class="<?php if($article->article_approve_status){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
								$article_title=$this->subdomain->process_url_title(substr($article->article_title,0,50));
									$article_link=$this->subdomain->genereate_the_subdomain_link($article->subdomain_name,'articles',$article_title,$article->article_id);				
									?>
								<a href="<?php echo $article_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
									<a href="#" onclick="featured_home_confirm('<?php echo "$base";?>newadmin/adminarticles','<?php  echo $article->featured_home_article; ?>','<?php echo $article->article_id; ?>');" class="btn btn-icon tip" <?php if($article->featured_home_article){ ?> data-original-title="Unfeatured" <?php } else { ?> data-original-title="Featured" <?php } ?>>
									<i class="<?php if($article->featured_home_article){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php }}  ?>
                   
                    
                   
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:70px;">
				<select name="univ_action" id="univ_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
              </div>
			   <div class="tab-pane " id="new">
                <table class="table table-striped dataTable">
                  <thead>
                    <tr>
                      <th width="10%"><input type="checkbox" class="check_all"></th>
                      <th width="25%">Article Title</th>
                      <th width="25%">University Name</th>
                      <th width="20%">Status</th>
					  <th width="20%">Featured/UnFeatured</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($recent_articles as $recent)
					{ ?>
					<tr id="check_university_<?php echo $recent->article_id;?>">
                      <td><input type="checkbox" name="sel_row[]" value="<?php echo $recent->article_id;?>" class='selectable_checkbox setchkval' /></td>
                      <td><?php echo ucwords(substr($recent->article_title,0,50)); ?></td>
                       <td><?php echo ucwords($recent->univ_name); ?></td>
                       <td class="center"> <?php if($recent->article_approve_status){ echo "Approved"; } else {  echo "<span style='color:#000;'>Pending For Approve</span>";} ?></td>
					  <td><?php if($recent->featured_home_article){ echo "<span style='color:#000;'>Featured</span>"; } else {  echo "Nonfeatured";} ?></td>
					 <td class="options">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/view_article/<?php echo $recent->article_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo "$base"; ?>newadmin/adminarticles/edit_article/<?php echo $recent->article_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $recent->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $recent->article_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $recent->article_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }
								if(($edit==1 || $delete==1 || $insert==1) && $admin_user_level!='3' ){  ?>
								<a href="#"  onclick="approve_home_confirm('<?php echo "$base";?>newadmin/adminarticles','<?php  echo $recent->featured_home_article; ?>','<?php echo $recent->article_id; ?>');"  class="btn btn-icon tip" <?php if($recent->article_approve_status){ ?> data-original-title="Disapprove" <?php } else { ?> data-original-title="Approve" <?php } ?> >
									<i class="<?php if($article->article_approve_status){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
								$article_title=$this->subdomain->process_url_title(substr($recent->article_title,0,50));
									$article_link=$this->subdomain->genereate_the_subdomain_link($recent->subdomain_name,'articles',$article_title,$recent->article_id);				
									?>
								<a href="<?php echo $article_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
									<a href="#" onclick="featured_home_confirm('<?php echo "$base";?>newadmin/adminarticles','<?php  echo $recent->featured_home_article; ?>','<?php echo $recent->article_id; ?>');" class="btn btn-icon tip" <?php if($recent->featured_home_article){ ?> data-original-title="Unfeatured" <?php } else { ?> data-original-title="Featured" <?php } ?>>
									<i class="<?php if($recent->featured_home_article){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php }  ?>
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:70px;">
				<select name="univ_action" id="del_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
              </div>
			  <div class="tab-pane" id="create">
				<div class="row-fluid">
					<div class="span9">
						<form class="form-horizontal" name="myform" action="<?php echo $base; ?>newadmin/adminarticles/add_article" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="input01">Title</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="title" id="title">
								</div>
								</div>
								<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
								<div class="control-group">
								<label class="control-label" for="input06">Choose University</label>
								<div class="controls">
									<select name="univ" id="univ">
									<option value="0">- Please Select -</option>
								<?php foreach($univ_info as $univ_detail) 
									{ ?>
									<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
									<?php } ?>
									</select>
								</div>
								</div>
								<?php } else { ?>
									<input type="hidden" id="univ" name="univ" value="<?php echo $univ_info['univ_id']; ?>">		
									<?php }?>
								<div class="control-group">
									<label class="control-label" for="input04">Article Logo</label>
									<div class="controls">
										<input type="file" class="input-xlarge" id="userfile" name="userfile">
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Detail</label>
								<div class="controls">
									<textarea name="detail" id="detail" class='span12' rows='8'></textarea>
								</div>
								</div>
								<div class="form-actions">
								<button type="submit" onclick="addArticle()" class='btn btn-primary'>Add Article</button>
								<a href="#" class='btn btn-danger'>Cancel</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
 
     <script>
$(document).ready(function(){
	//alert('fnslfc');
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 
	var activePage = url.substring(url.lastIndexOf('/')+1);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', 'img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
	
function addArticle()
{
	if($('#univ option:selected').val()=='')
	{
		$("#univ").addClass('needsfilled');
	}
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');		
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');		
	}
		
	if($("#title").val()!='' && $("#detail").val()!='' )
	{
		document.forms["myform"].submit();
	}
}
function delete_confirm(id)
{
	//alert(id);
	$.ajax({	
	 type: "POST",
	   url: "<?php echo $base; ?>newadmin/adminarticles/delete_single_article/"+id,
	   async:false,
	   data: '',
	   cache: false,
	   success: function(msg)
	   {alert(msg);
	    $('#check_university_'+id).hide();
		}
	
	});
}

function approve_home_confirm(a,b,c)
{
	if(b=='0')
	{
	status='approve';
	}
	if(b=='1')
	{
	status='disapprove';
	}
	var r=confirm("Are you sure you want to " +status+ " to this article?");
	if (r==true)
	{
	  window.location.href=a+'/approve_disapprove_article/'+b+'/'+c;
	}
}
function featured_home_confirm(a,b,c)
{
	var nof='1';
	if(b=='0')
	{
		nof=chknooffeatured('featured_home_article');
	}
	if(nof=='1')
	{
		var status;
		if(b==0)
		{
		status='make home featured';
		}
		if(b==1)
		{
		status='make home unfeatured';
		}
		var r=confirm("Are you sure you want to " +status+ " to this article?");
		if (r==true)
		{
		  window.location.href=a+'/featured_unfeatured_article/'+b+'/'+c;
		}
	}
	else
	{
		alert("You have reached maximum limit for show article");
	}
}	
function chknooffeatured(field)
{
var f;
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>newadmin/adminarticles/count_featured_articles/"+field,
	   async:false,
	   data: '',
	   cache: false,
	   success: function(msg)
		{
		
			f=msg;
		}
	   });
	 return f;
}
var arr=new Array;

function action_formsubmit(id,flag)
{
	var action;
	if($('#univ_action').val()!='')
	{
		action=$('#univ_action').val();
	}
	if($('#del_action').val()!='')
	{
		action=$('#del_action').val();
	}
	
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected article");
			set_chkbox_val();
			var data={'article_id':arr};

			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/adminarticles/delete_articles',
					async:false,
					data: data,
					cache: false,
					success: function(msg)
					{						
						$('.toremove').hide();
						$("#deleted").show();
						$("#deleted").delay(5000).hide("slow");
					}

				});
			}
		}
		else
		{
			alert("please select al least one article");
			return false;
		}
	}
	else
	{
		alert("please select the action");
		return false;
	}
}

function set_chkbox_val()
{
	$('.setchkval').each(function()
	{
		if($(this).attr('checked'))
		{
			$('#check_university_'+$(this).val()).addClass('toremove');
			arr.push($(this).val());
		}		
	});
}
</script>