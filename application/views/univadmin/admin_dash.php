<?php 
$flag=1;
  if($admin_user_level=='3')
  {
  if($univ_detail_edit==0)
  {
  $flag=0;
  }
  }
if($flag) { ?> 
  <div class="content">
    <div class="container-fluid">      
<div class="row-fluid">
  <div class="span12">
   <div class="page-header clearfix tabs">
    <h2>Insight <small>Site Statistics</small></h2>
  </div>
  <div class="content-box">
    <div class="tab-content">
    
	   <div class="tab-pane active" id="big">
        <div class="flot"></div>
      </div>
	 
    </div>
  </div>
</div>
</div>
      <div class="row-fluid">
        <div class="span6 no-margin">
          <div class="page-header">
            <h2>Recent Articles</h2>
          </div>
          <div class="content-box">
            <table class="table table-striped table-nohead">
              <tbody>
			   <tr>
                  <td>
                    <b>Date</b>
                  </td>
                  <td>
                   <b>Article </b>
                  </td>
                  <td>
                    <a href="#"><b>Username</b></a>
                  </td>                  
                </tr>
			  <?php if(!empty($recent_articles))
			  { foreach($recent_articles as $article)
			    { ?>
                <tr>
                  <td>
                    <?php $date=strtotime($article['publish_time']); echo date('d/m/Y',$date); ?> 
                  </td>
                  <td>
                   <?php echo $article['article_title']; ?> 
                  </td>
                  <td>
                    <?php if(!empty($article['full_name'])){ echo $article['full_name']; } else { echo 'Not Available';} ?> 
                  </td>                  
                </tr>
              <?php }}else { ?>
				<tr>
				<td>No article  till now...</td>
				</tr>
				<?php } ?>
              </tbody>
            </table>
          </div>        
        </div>
        <div class="span6 no-margin">
          <div class="page-header clearfix tabs">
            <h2>Questions</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">Recent</a>
              </li>             
              <li>
                <a href="#unanswered" data-toggle="pill">Unanswered</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="table table-striped table-nohead">
                  <tbody>
                    <tr>
                      <td>
                       
                      </td>
                      <td>
                        <b> Question </b>
                      </td>
                      <td>
                        <a href="#">
                         <b> Asked By </b>
                        </a>
                      </td>
                    </tr>
					<?php 
					if(!empty($recent_questions))
					{ 
					foreach($recent_questions as $all)
					{ ?>
                    <tr>
                      <td>
                        <?php if($all['q_answered']==0 ){ echo "<span class='label label-important'>Open</span>"; } else{ echo "<span class='label label-success'>Answered</span>"; } ?>
                      </td>
                      <td>
                      <?php echo $all['q_title']; ?>
                      </td>
                      <td>
                        <a href="#">
                          <?php if(!empty($all['full_name'])){ echo $all['full_name']; }else { echo 'Not available'; } ?>
                        </a>
                      </td>
                    </tr>
					<?php }}else { ?>
				<tr>
				<td>No question till now...</td>
				</tr>
				<?php } ?>
              </tbody>  
            </table>
          </div>          
      <div class="tab-pane" id="unanswered">
        <table class="table table-striped table-nohead">
          <tbody>
            <tr>
                      <td>
                       
                      </td>
                      <td>
                        <b> Question </b>
                      </td>
                      <td>
                        <a href="#">
                         <b> Asked By </b>
                        </a>
                      </td>
                    </tr>
					<?php 
					if(!empty($unasnwered))
					{ 
					foreach($unasnwered as $ans)
					{ ?>
                    <tr>
                      <td>
                       <span class='label label-important'><b>Open</b>
					   </span>
                      </td>
                      <td>
                      <?php echo $ans['q_title']; ?>
                      </td>
                      <td>
                        <a href="#">
                          <?php if(!empty($ans['full_name'])){ echo $ans['full_name']; }else { echo 'Not available'; } ?>
                        </a>
                      </td>
                    </tr>
					<?php }}else { ?>
				<tr>
				<td>No question  till now...</td>
				</tr>
				<?php } ?>
      </tbody>  
    </table>
  </div>
</div>
</div>
</div>
</div>
<div class="row-fluid">
  <div class="span9">
    <div class="page-header tabs clearfix">
      <h2>Recent Leads</h2>
    </div>
    <div class="content-box">
      <div class="tab-content">
        <div class="tab-pane active" id="plain">
          <table class="table table-striped">
            <thead>			
              <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Lead Created Time</th>                
              </tr>
            </thead>
            <tbody>
			<?php //print_r($recent_leads); 
			if(!empty($recent_leads))
			{ foreach($recent_leads as $leads)
			{ ?>
              <tr>
                <td><?php echo $leads['fullname']; ?> </td>
                <td><?php echo $leads['email']; ?></td>
                 <td><?php  $d=strtotime($leads['lead_created_time']); 
				 echo date('d/m/y-h:m',$d); ?></td>              
               </tr> 
			<?php }}else { ?>
				<tr>
				<td>No leads  till now...</td>
				</tr>
				<?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="span3 no-margin">
    <div class="page-header">
      <h2>Recent Followers</h2>
    </div>
    <div class="content-box">
      <table class="table table-striped table-nohead">
        <tbody>
		<?php// print_r($recent_followers_of_univ); ?>
          <tr>
            <td>
              <a href="#">Name</a>
            </td>
            <td style="width:48px;">
              <div class="btn-group">
                 <a href="#">Details</a>
              </div>
            </td>
          </tr>
		  <?php if(!empty($recent_followers_of_univ))
		  { foreach($recent_followers_of_univ as $recent)
		  { ?>
          <tr>
            <td>
              <a href="#"><?php if(!empty($recent['full_name'])) { echo $recent['full_name']; }else { echo 'Not Available';} ?></a>
            </td>
            <td style="width:48px;">
              <div class="btn-group">
                <a href="#" title="Go to profile" class="tip btn btn-icon"><i class="icon-search"></i></a>
                <a href="#" title="Delete user" class="tip btn btn-icon"><i class="icon-remove"></i></a>
              </div>
            </td>
          </tr>
         <?php  }} else { ?>
           <tr>
            <td>
              No followers till now...
            </td>
           <?php } ?>
          </tr>
        </tbody>
      </table> 
    </div>   
  </div>
</div>
<div class="row-fluid">
  <div class="span12 no-margin">
    <div class="page-header">
      <h2>Events</h2>
    </div>
    <div class="content-box">
      <div class="calendar"></div>
    </div>
  </div>
</div>
</div><!-- close .container-fluid -->
</div><!-- close .content -->
<!-- END Content -->
<?php } ?>

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
 </script>

