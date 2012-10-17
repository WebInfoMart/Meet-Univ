<?php
include('application/libraries/googleanalytics.php');
$ga = new GoogleAnalytics();
$ga->setProfile('ga:60386809');
$yesterday_date=date('Y-m-d',strtotime('1 day ago'));
$y_date=str_replace('-','',$yesterday_date);
$ga->setDateRange($yesterday_date,$yesterday_date);
$data['report'] = $ga->getReport(
array('dimensions'=>urlencode('ga:date'),'metrics'=>urlencode('ga:pageviews,ga:uniquePageviews,ga:visitors,ga:newVisits')));
//print_r($data['report']);
$noofvisitor=$data['report'][$y_date]['ga:visitors'];
$noofuniquevisitor=$data['report'][$y_date]['ga:newVisits'];
$pageviews=$data['report'][$y_date]['ga:pageviews'];
$uniquepageviews=$data['report'][$y_date]['ga:uniquePageviews'];
//$to=array('nitin@globalcampusmedia.com','himanshu@globalcampusmedia.com','debal@webinfomart.com','keshavmunjal@webinfomart.com');
$to = "sumitmunjal@webinfomart.com";
$subject = "Google Analytics Daily Report";
$txt = "Dear sir yesterday report of site visitors is described below\n";
$txt.="No of Visitors : ".$noofvisitor.'\n\n';
$txt.="No of Unique Visitors : ".$noofuniquevisitor.'\n\n';
$txt.="No of Page Views : ".$pageviews.'\n';
$txt.="No of Unique Page Views : ".$uniquepageviews.'\n';

$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

//mail('sumitmunjal@webinfomart.com',$subject,$txt,$headers);
?>