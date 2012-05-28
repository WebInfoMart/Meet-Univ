
<html>
<body>
<div align="center">

<table border="1" cellspacing="0" cellpadding="0" width="602" style="width:451.5pt;border:solid #e88230 1.0pt">
 <tbody><tr>
  <td style="border:none;padding:0in 0in 0in 0in">
  <table border="0" cellpadding="0" width="604" style="width:453.0pt;background:#3881AB">
   <tbody><tr>
    <td style="padding:.75pt .75pt .75pt .75pt">
    <table border="0" cellspacing="0" cellpadding="0" align="right">
     <tbody>
	 <tr style="min-height:10.5pt">
		<td style="float:left;width:385px;padding:7px;"><img src="<?php echo "$base$img_path" ?>/logo.png"></td>
		<td style="float:right;width:385px;"></td>
     </tr>
    </tbody></table>
    </td>
   </tr>
  </tbody></table>
  <table border="1" cellspacing="0" cellpadding="0" style="border:none;border-bottom:solid #e88230 1.0pt">
   <tbody><tr>
    <td style="border:none;padding:0in 0in 0in 0in">
    <table border="0" cellspacing="0" cellpadding="0">
     <tbody><tr>
      <td style="padding:0in 12.75pt 0in 12.75pt">
      <h1 style="margin:0in;margin-bottom:.0001pt;text-align:justify"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#058dd7">Welcome To Meet Universities<u></u><u></u></span></h1>
      </td>
     </tr>
     <tr>
      <td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
      <p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">
	 <!-- Hi--> <?php //echo $send_info['fullname']; ?> Welcome to MeetUniversities.<br />
	  <h3>Your Event Registration Have been Completed Successfully........</br>
	  
	  <h3> Your Event Registration Detail Are... </h3>
	  <?php 
	  foreach($latest_register_event_info as $event_detail)
	  {
		if($events['event_category'] == 'spot_admission'){
										$event_cat =  "Spot Admission"; 
										}
										else if($events['event_category'] == 'fairs'){
										$event_cat = "Fairs"; 
										}
										else if($events['event_category'] == 'others'){
										$event_cat = "Alumuni"; 
										}
										else if($events['event_category'] == 'alumuni'){
										$event_cat = "Alumuni"; 
										}
		echo "<h4>Your Name-: &nbsp;".$event_detail['fullname']."</h4></br>";
		echo "<h4>Event Type-: &nbsp;".$event_cat."</h4></br>"; 
		echo "<h4>Event Of University-: &nbsp;".$event_detail['title']."</h4></br>"; 
		echo "<h4>Event Country-: &nbsp;".$event_detail['country_name']."</h4></br>"; 
		echo "<h4>Event State-: &nbsp;".$event_detail['statename']."</h4></br>"; 
		echo "<h4>Event City-: &nbsp;".$event_detail['cityname']."</h4></br>"; 
		echo "<h4>Event Date-: &nbsp;".$event_detail['event_date_time']."</h4></br>"; 
		echo "<h4>Event Timing-: &nbsp;".$event_detail['event_time']."</h4></br>"; 
		echo "<h4>Event Place-: &nbsp;".$event_detail['event_place']."</h4></br>"; 
	  }
	  ?>
	  Thanks For Registration...</h3>
	 <!-- <h3> Registered Event Information </h3></br>
	  Event Title : <?php //echo $send_info['event_title']; ?></br>
	  Event Date & Time : <?php //echo $send_info['event_date_time']; ?>-->
	  <u></u><u></u></span></p>
      </td>
     </tr>
     <tr>
     <!-- <td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
      <p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt;text-align:justify"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">Nulla
      tincidunt nulla a nisl fermentum molestie. Nullam fringilla, elit in
      varius congue, dui ante condimentum sapien, a tristique ante ante id dui.
      Morbi ac nisl neque, ac vehicula metus. Maecenas sit amet turpis nunc.
      Aliquam cursus egestas dignissim. Phasellus justo lectus, vehicula sed
      vulputate nec, dapibus vitae justo. Aenean eleifend nunc quis erat
      dapibus ornare. Integer auctor eros sit amet diam ornare vitae
      scelerisque urna varius. Maecenas vitae nisl sed lacus blandit tempus.
      Morbi ac dolor nulla. Morbi rutrum aliquam vulputate. <u></u><u></u></span></p>
      </td>
     </tr>
     <tr>
      <td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
      <p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt;text-align:justify"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">Donec
      auctor, sapien sit amet cursus gravida, erat odio aliquet tellus, non
      tincidunt elit lorem eu mauris. Sed lacinia tristique mauris non
      malesuada. Duis lacinia turpis a orci bibendum eu dapibus ante lobortis.
      Aenean suscipit laoreet dui, ut pellentesque urna ornare ut. <u></u><u></u></span></p>
      </td>
     </tr>
	 -->
    </tbody></table>
    </td>
   </tr>
  </tbody></table>
  <table border="0" cellpadding="0" width="100%" style="width:100.0%;background:#ffead7">
   <tbody><tr>
    <td style="padding:7.5pt 12.75pt 7.5pt 12.75pt">
    <table border="0" cellspacing="0" cellpadding="0" align="left" width="320" style="width:240.0pt;margin-top:1.5pt">
     <tbody><tr>
      <td style="padding:0in 0in 0in 0in">
      <h5 style="margin:0in;margin-bottom:.0001pt"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">Meet Universities
      please contact: <u></u><u></u></span></h5>
     <span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646"><a href="mailto:lorem@ipsum.com" target="_blank">info@meetuniversities.com</a><br>
      <span>+919891006366</span><span dir="ltr" tabindex="-1"></span><u></u><u></u></span></p>
      <p><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646"><u></u><u></u></span></p>
      </td>
     </tr>
    </tbody></table>
    
    </td>
   </tr>
  </tbody></table>
  </td>
 </tr>
</tbody></table>
</div>
</body>
</html>