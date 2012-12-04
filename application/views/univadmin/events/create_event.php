  <div class="content">
    <div class="container-fluid">
      <div class="responsible_navi">
        <div class="currentPage">
          <i class="icon-tasks icon-white"></i> Interface Elements - Tabs
          <div class="sorting">
            <img src="img/sort_both.png" alt="">
          </div>
        </div>
        <ul class='respNav'>
          <li>
            <a href="dash.html">
              <i class="icon-home"></i>
              Dashboard
              <span class="label label-important">16</span>
            </a>
          </li>
          <li>
            <a href="#" class='toggle-subnav'>
              <i class="icon-book"></i>
              Sample Pages
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="user.html">User Profile</a></li>
              <li><a href="404.html">404 Error</a></li>
            </ul>
          </li>
          <li>
            <a href="stats.html">
              <i class="icon-signal"></i>
              Statistics
            </a>
          </li>
          <li>
            <a href="4.html" class='toggle-subnav'>
              <i class="icon-tasks"></i>
              Interface Elements
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li><a href="buttons.html">Buttons & Icons</a></li>
              <li><a href="modals.html">Modals, Alerts & Notifications</a></li>
              <li><a href="tabs.html">Tabs & Accordion</a></li>
              <li><a href="tooltips.html">Tooltips & Popovers</a></li>
              <li><a href="sliders.html">Sliders & Progressbars</a></li>
            </ul>
          </li>
          <li>
            <a href="forms.html">
              <i class="icon-list"></i>
              Forms
            </a>
          </li>
          <li>
            <a href="tables.html">
              <i class="icon-th-large"></i>
              Tables
              <span class="badge badge-warning">4</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Create Events</h2>
			</div>
          <div class="content-box">
            <div class="row-fluid">
					<div class="span12">
						<form class="form-horizontal">
							<fieldset>
								<div class="row-fluid">
									<div class="span6">
										<div class="control-group">
										<label class="control-label" for="input01">Event Title</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="input01">
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Checked IF Event IS Online</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" value="0" name="check"> Check this checkbox!</label>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input01">Country</label>
										<div class="controls">
											<select name="select" id="input06" class="inline">
											<option value="0">- Select something -</option>
											<option value="1">Lorem ipsum</option>
											<option value="2">Sit dolor</option>
											</select>
											<span class="inline margin_l"><button class="btn btn-icon tip" data-original-title="Add New Country"><i class="icon-plus"></i></button></span>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input01">State</label>
										<div class="controls">
											<select name="select" id="input06" class="inline">
											<option value="0">- Select something -</option>
											<option value="1">Lorem ipsum</option>
											<option value="2">Sit dolor</option>
											</select>
											<span class="inline margin_l"><button class="btn btn-icon tip" data-original-title="Add New Country"><i class="icon-plus"></i></button></span>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input01">City</label>
										<div class="controls">
											<select name="select" id="input06" class="inline">
											<option value="0">- Select something -</option>
											<option value="1">Lorem ipsum</option>
											<option value="2">Sit dolor</option>
											</select>
											<span class="inline margin_l"><button class="btn btn-icon tip" data-original-title="Add New Country"><i class="icon-plus"></i></button></span>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Hide Event On Site</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" value="0" name="check"> Check this checkbox!</label>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input01">Event Place</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="input01">
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Event Type</label>
										<div class="controls">
											<select name="select" id="input06">
											<option value="0">- Select something -</option>
											<option value="1">Lorem ipsum</option>
											<option value="2">Sit dolor</option>
											</select>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="date">Event Date</label>
											<div class="controls">
											<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span><input type="text" size="16" id="date" class='span4 datepick'>
											</div>
											</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Checked IF Event Timing Is</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" value="0" name="check"> (Appintment based,Not Fixed etc.)</label>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="time">Event time</label>
											<div class="controls">
												<div class="input-prepend">
													<span>From</span>
												<span class="add-on"><i class="icon-time"></i></span><input type="text" size="16" id="time" class='span4 timepicker'>
												<span class="margin_r">Till</span><span class="add-on inline margin_l"><i class="icon-time"></i></span><input type="text" size="16" id="time" class='span4 timepicker'>
												</div>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="tags">Council</label>
											<div class="controls">
											<input type="text" class='tagsinput span12' id="tags" value="council">
											</div>
										</div>
									</div>
									<div class="span6">
										<div class="control-group">
										<label class="control-label" for="input06">Share on Facebook</label>
										 <div class="controls">
											<label class='radio'><input type="radio" name="radio" value="0"> 3 days</label>
											<label class='radio'><input type="radio" name="radio" value="1"> 7 days</label>
											<label class='radio'><input type="radio" name="radio" value="2"> 15 days</label>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Detail</label>
										<div class="controls">
											<textarea name="cleditor" class='cleditor span12'></textarea>
										</div>
										</div>
										<div class="form-actions">
										<button type="submit" class='btn btn-primary'>Add Events</button>
										<a href="#" class='btn btn-danger'>Cancel</a>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
          </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
   <script>
$(document).ready(function(){	
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
</body>
</html>