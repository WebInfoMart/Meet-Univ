  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-responsive.css">
  <link rel="stylesheet" href="css/chosen.css">
  <link rel="stylesheet" href="css/bootstrap.datepicker.css">
  <link rel="stylesheet" href="css/jquery.tagsinput.css">
  <!-- BEGIN Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="responsible_navi">
        <div class="currentPage">
          <i class="icon-book icon-white"></i> Sample Pages - User Profile
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
          <div class="page-header">
            <h2>Email Packs</h2>
          </div>
          <div class="content-box">
				<div class="row-fluid">
					<div class="span8">
						<form class="form-horizontal">
							<fieldset>
							<div class="control-group">
								<label class="control-label">Name</label>
								<div class="controls">
									<span class="help-inline data1">ndfn<span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="disabled">Used</label>
								<div class="controls">
								<span class="help-inline data1">ndfn<span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="disabled">Total Emails</label>
								<div class="controls">
								<span class="help-inline data1">ndfn<span>
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label" for="disabled">Remaining</label>
								<div class="controls">
								<span class="help-inline data1">ndfn<span>
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label" for="button">Apply Promocode</label>
								<div class="controls">
								<div class="input-append">
									<input type="text" size="12" id="button" class="span5"><button class="btn" type="button">Submit</button>
								</div>
								</div>
							</div>
							</fieldset>
						</form>
					</div>
				</div>
          </div>
        </div>  
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  <script src="js/ui.spinner.js"></script>
  <script src="js/bootstrap.datepicker.js"></script>
  <script src="js/chosen.jquery.min.js"></script>
  <script src="js/jquery.flot.js"></script>
  <script src="js/jquery.flot.pie.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.tagsinput.min.js"></script>
  <script src="js/custom.js"></script>
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
</body>
</html>