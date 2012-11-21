<style>
#contacts .contact_list{float:right;width:300px;}
</style>
	<SCRIPT type="text/javascript" lang="javascript" 
	   src="http://cdn.gigya.com/JS/socialize.js?apikey=3_eMXZZb_WCviHi4q14RQ79tI9ASolBI8NgF-YN8sj0vkxL8JNGdkj4qh0jj48ALNE">
	</SCRIPT>
	<script>
	    function onLoad() {
	        // get user info
	        gigya.socialize.getUserInfo({ callback: renderUI });

	        // register for connect status changes
	        gigya.socialize.addEventHandlers({ onConnectionAdded: renderUI, onConnectionRemoved: renderUI });

	    }
    </script>
    <script type="text/javascript">

	    function renderUI(res) {
	        // enable/disable "Get Contacts" button
	        var connected = (res.user != null && res.user.isConnected);
	        document.getElementById('btnGetContacts').disabled = !connected;

	        // clear contact list if not connected
	        if (!connected)
	            document.getElementById('contacts').innerHTML = "";
	    }

	    // Get the user's contacts
	    function getContacts() {
	        gigya.socialize.getContacts({ callback: getContacts_callback });
	        document.getElementById('btnGetContacts').disabled = true;
	    }
		
		// Use the reponse of getContacts and render HTML to display the first five contacts.
	    function getContacts_callback(response) {
			$("#contacts").show();
			document.getElementById('btnGetContacts').disabled = false;
	        document.getElementById('contacts').innerHTML = "";
	        if (response.errorCode == 0) {
	            var array = response.contacts.asArray();
	            var html = "<div id='form_div' style='background-color: #F3F3F3;padding:10px;'><h3>You have " + array.length + " contacts:</h3><BR/>";
				html +="<form action='<?php echo $base; ?>auth/send_invites' id='form' method='post'>";
				html +="<input type='checkbox' onclick='select_all()' id='select_it'><input name='fullname' type='hidden' value='<? echo $fullname; ?>' /><input name='email' type='hidden' value='<? echo $email; ?>' />";
				html +="<span style='margin: 0px 5px;'>select all</span>";
	            for (var i = 0; i < Math.max(10, array.length); i++) {
					html += "<div class='contact_list'><input type='checkbox' class='mail_address' value='"+array[i].email+"' name='checkbox[]'>";
	                html += "<span style='margin: 0px 5px;'>";
	                if (array[i].photoURL)
	                    
	                html += array[i].firstName + " " + array[i].lastName + ": <br>";
	                html += array[i].email + "</span></div>";
	            }
				
				html +="<div style='margin: 10px 10px 0px;cursor:pointer;float: right;' onclick='sent_invite();' ><img src='http://meetuniversities.com/images/send_invite.gif'></div></form>";
				html +="<div class='clearfix'></div></div>";
	            document.getElementById('contacts').innerHTML = html;
	        } else {
		        alert('Error :' + response.errorMessage);
		    }
	    }
		
		function sent_invite(){
			$('#form').submit();
		}
		
		function select_all(){
			if($('#select_it').is(':checked')){
				$('input:checkbox').attr('checked','checked');
			}else {
				$('input:checkbox').removeAttr('checked');
			}
		}
    </script>

<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
			<div class="body">
		<div class="row">
			<div class="float_l span13 margin_l margin_t1">
				<div style="text-align:center"><br /><img src="http://meetuniversities.com/images/thank.png" /></div><br />
				<div style="text-align:center;font-size:18px;line-height:30px">Who doesn't need publicity, don't you think we are doing a decent job ?<br />
				Keeping all this information free for You "THE STUDENT".</div>
				<br />
				<div style="width:300px;background:#f1f1f1;border:solid 1px #ccc;padding:5px;height:200px;float: right;margin: 5px 45px;">
					<div id="fb-root"></div>
					<script src="http://connect.facebook.net/en_US/all.js"></script>
					<a href='javascript:void(0)' onclick="sendRequestViaMultiFriendSelector(); return false;" >
						<img src="http://meetuniversities.com/images/facebook_inv.png" style="margin:75px;text-align:center" />
					</a>
				</div>
				<div style="float:right;width:300px;background:#f1f1f1;border:solid 1px #ccc;margin: 5px 45px 45px 20px;padding:5px;height:200px">
					<img src="http://meetuniversities.com/images/gmail.png" style="margin:10px 100px 0px;" />
					<div style="display: block;clear: both;line-height: 0;height: 0;">
						<div style="margin: 5px;height: 70px;">
							<h5>Step 1: Choose your email provider</h5>
							<div id="divConnect"></div>
							<script type="text/javascript">
								// show 'Add Connections' Plugin in "divConnect"
								gigya.socialize.showAddConnectionsUI({ 
									height:55
									,width:120
									,showTermsLink:false // remove 'Terms' link
									,hideGigyaLink:true // remove 'Gigya' link
									,requiredCapabilities: "Contacts" // we want to show only providers that support retrieving contacts.
									,containerID: "divConnect" // The component will embed itself inside the divConnect Div 
								});
							</script>
						</div>
						<div style="margin: 5px 0px 0px;height: 35px;">
							<h5>Step 2: Get your email Contacts</h5>
							<div style="margin-top:5px;">
							Click the button below to retrieve your email contacts
							</div>
							
						</div>
						<div style="float: right;margin: 5px;">
							<input id="btnGetContacts" type="button" value="Get Contacts" onclick="getContacts()" disabled=true />
							<!--<div id="btnGetContacts" onclick="getContacts()"><img src="http://meetuniversities.com/images/import_button.gif" /></div>-->
						</div>
					</div>
				</div>
				
				<div style="content: '.';display: none;clear: both;margin: 25px 45px 10px 65px;" id="contacts"></div>
				<div style='margin: 0px 20px 30px 75px;'>
					<a href="https://www.facebook.com/MeetUniversities/app_190322544333196" target="_blank">
						<img src="http://meetuniversities.com/images/likeusnow.png">
					</a>
				</div>
				<div><img src="http://meetuniversities.com/images/thanx-page-for-code.png" style="text-align:center" /></div>
				
			</div>
			<div class="float_r span3 margin_t1">
				<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="http://meetuniversities.com/images/banner_img.png"></a>
			</div>
		</div>
		
	</div>
</div>
<script>
      FB.init({
        appId  : '415316545179174',
        frictionlessRequests: true
      });

      function sendRequestViaMultiFriendSelector() {
        FB.ui({method: 'apprequests',
          message: 'Meetuniversities.com - University Events, Scholarships & Courses | Win Funbook'
        });
      }
</script>

</div>


