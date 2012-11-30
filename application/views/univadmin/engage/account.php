<!-- BEGIN Content -->
  <div class="content">
    <div class="container-fluid">     
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Account</h2>
            <ul class="nav nav-pills">
			  <li class='active'>
                <a href="#plan" data-toggle="pill">View Plan</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
			  <div class="tab-pane active" id="plan">
				<div class="row pricing">
					<div class="span4">
						<div class="well">
							<h2>Platinum</h2>
							<ul>
								<li><i class="icon-ok"></i> 5 users</li>
								<li><i class="icon-ok"></i> 1TB of space</li>
								<li><i class="icon-ok"></i> Limited access</li>
								<li><i class="icon-ok"></i> No phone support</li>
							</ul>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
							<hr>
							<h3 class="ac">$5.99 / month</h3>
							<hr>
							<p class="ac">
								<a class="btn btn-success btn-large" href="#">Select plan &raquo;</a>
							</p>
						</div>
					</div>
					<div class="span4 most-popular">
						<div class="well">
							<h2>Silver</h2>
							<p><span>POPULAR</span></p>
							<ul>
								<li><i class="icon-ok"></i> 20 users</li>
								<li><i class="icon-remove"></i> Unlimited access</li>
								<li><i class="icon-remove"></i>3TB of space</li>
								<li><i class="icon-ok"></i> E-mail support</li>
							</ul>          
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
							<hr>
							<h3 class="ac">$15.99 / month</h3>
							<hr>
							<p class="ac">
								<a class="btn btn-success btn-large" href="#"><i class="icon-ok icon-white"></i> Select plan</a>
							</p>
						</div>
					</div>
					<div class="span4">
						<div class="well">
							<h2>Gold</h2>
							<ul>
								<li><i class="icon-ok"></i> Unlimited users</li>
								<li><i class="icon-ok"></i> Unlimited access</li>
								<li><i class="icon-ok"></i> 100TB of space</li>
								<li><i class="icon-ok"></i> Phone and e-mail support</li>
							</ul>          
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
							<hr>
							<h3 class="ac">$25.99 / month</h3>
							<hr>
							<p class="ac">
								<a class="btn btn-success btn-large" href="#">Select plan &raquo;</a>
							</p>
						</div>
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
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/jquery.dataTables.bootstrap.js"></script>
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