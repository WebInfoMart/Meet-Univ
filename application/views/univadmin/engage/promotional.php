<!-- BEGIN Content -->
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
            <h2>Promotional Panel</h2>
            <ul class="nav nav-pills">
              <li class="active">
                <a href="#email" data-toggle="pill">Email Campaign</a>
              </li>
              <li>
                <a href="#sms" data-toggle="pill">SMS Campaign </a>
              </li>
			  <li>
                <a href="#voice" data-toggle="pill">Voice Campaign </a>
              </li>
			  <li id="active_menu">
                <a href="#plan" data-toggle="pill">View Plan</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="email">
				<div class="row-fluid">
					<div class="span8">
						<form class="form-horizontal">
							<fieldset>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Pack Name</label>
									<div class="controls">
										<div class="help-inline data1">Golden</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Total Credits</label>
									<div class="controls">
										<div class="help-inline data1">200</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Credit Used</label>
									<div class="controls">
										<div class="help-inline data1">50</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Credit Left</label>
									<div class="controls">
										<div class="help-inline data1">150</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Expired</label>
									<div class="controls">
										<div class="help-inline data1">15 Dec, 2012</div>
									</div>
								</div>
							<fieldset>
						</form>
					</div>
				</div>
			  </div>
              <div class="tab-pane" id="sms">
				<div class="row-fluid">
					<div class="span8">
						<form class="form-horizontal">
							<fieldset>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Pack Name</label>
									<div class="controls">
										<div class="help-inline data1">Golden</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Total Credits</label>
									<div class="controls">
										<div class="help-inline data1">200</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Credit Used</label>
									<div class="controls">
										<div class="help-inline data1">50</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Credit Left</label>
									<div class="controls">
										<div class="help-inline data1">150</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Expired</label>
									<div class="controls">
										<div class="help-inline data1">15 Dec, 2012</div>
									</div>
								</div>
							<fieldset>
						</form>
					</div>
				</div>
              </div>
			  <div class="tab-pane" id="voice">
					<div class="alert alert-success">
						<a class="close" data-dismiss="alert" href="#">x</a>
							You are not subscribe.
					</div>
              </div>
			  <div class="tab-pane" id="plan">
				<div class="alert alert-success">
					<a class="close" data-dismiss="alert" href="#">x</a>
					Data 
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
 </script>
