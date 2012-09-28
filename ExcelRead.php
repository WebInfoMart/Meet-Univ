<?php
$dbhost = 'localhost';
	// $dbuser = 'wimuniv_wim';
	// $dbpass = 'hvrwe+oWPKQJ';
	// $dbname = 'wimuniv_unibeta';
	
$dbuser= 'root';
$dbpass = ''; 
$dbname= 'meetuniversities';
	 $con = mysql_connect($dbhost,$dbuser,$dbpass);
// if (!$con)
  // {
  // die('Could not connect: ' . mysql_error());
  // }
 mysql_select_db($dbname);
require_once 'reader.php';
$data = new Spreadsheet_Excel_Reader();

$data->read('excel.xls');

error_reporting(E_ALL ^ E_NOTICE);

for ($j = 1; $j <= $data->sheets[0]['numRows']; $j++)
{
$r=$data->sheets[0]['cells'][$j+1][1];
$row= mysql_query("select univ_id from university where univ_name='".$r."'");
mysql_num_rows($row);
if(mysql_num_rows($row)>0)
{
$res=mysql_fetch_array($row);
$univ_id=$res[0]['id'];
mysql_query("insert into events(event_title,event_detail,postedby,event_date_time,event_time,event_univ_id,event_country_id,event_state_id,event_city_id,event_type,event_category,event_place) values('Education UK Exhibition','<p>British Council<br />17 Kasturba Gandhi Marg<br />New Delhi 110001 <br /> Tel: +91 11 23711401</p>
','1','24 Nov 2012','01:00 pm - 06:00pm',".$univ_id.",.'14','22','67','univ_event','spot_admission','British Council') ");
}
}	
?>
