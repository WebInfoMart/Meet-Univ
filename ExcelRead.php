<?php
ini_set('max_execution_time', 300);
$dbhost = 'localhost';
	// $dbuser = 'wimuniv_wim';
	// $dbpass = 'hvrwe+oWPKQJ';
	// $dbname = 'wimuniv_unibeta';
	
$dbuser= 'root';
$dbpass = ''; 
$dbname= 'meetuniversities';
	 $con = mysql_connect($dbhost,$dbuser,$dbpass);

 mysql_select_db($dbname);
require_once 'reader.php';
$data = new Spreadsheet_Excel_Reader();

$data->read('excel.xls');

error_reporting(E_ALL ^ E_NOTICE);

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++)
{// $val=array();
	
	//$val=$data->sheets[0]['cells'][$i+1][1];
	if($data->sheets[0]['cells'][$i][0]=='' && $data->sheets[0]['cells'][$i][1]=='')
	{	
		$i++;
		echo $i;exit;
		$univ=$data->sheets[0]['cells'][$i][1];	
		$row= mysql_query("select univ_id from university where univ_name='".$univ."'");
		if(mysql_num_rows($row)>0)
			{
			$res=mysql_fetch_array($row);
			$univ_id=$res['univ_id'];					
			
			}	
	}
	else
	{ 
		$course=$data->sheets[0]['cells'][$i][1];
		if($data->sheets[0]['cells'][$i][2]=='')
		{
			$parent_id=2;
		}
		else
		{
		     $parent=$data->sheets[0]['cells'][$i][2];
			 $row= mysql_query("select prog_parent_id from program_parent where program_parent_name='".$parent."'");
				if(mysql_num_rows($row)>0)
				{
					$res=mysql_fetch_array($row);
					$parent_id=$res['prog_parent_id'];					
				
				}	
		}
		
		if($data->sheets[0]['cells'][$i][1]!='')
		{
			//echo "select prog_id from program where course_name='".$course."' && educ_level_id='2'";
			$row= mysql_query("select prog_id from program where course_name='".$course."' && educ_level_id='4' ");
				if(mysql_num_rows($row)>0)
				{
					$res=mysql_fetch_array($row);
					$prog_id=$res['prog_id'];				
				
				}
				else
				{// 2 is education level change it every time
					mysql_query("insert into program values('','".$course."','4','".$course."','".$parent_id."','','')");
					$row= mysql_query("select prog_id from program where course_name='".$course."' && educ_level_id='4' ");
					if(mysql_num_rows($row)>0)
					{
						$res=mysql_fetch_array($row);
						$prog_id=$res['prog_id'];					
					
					}
				}
		}
		
		$result=mysql_query("select id from univ_program where univ_id='".$univ_id."' && program_id='".$prog_id."' && prog_parent_id='".$parent_id."' && prog_educ_level='4'");
		
		if(mysql_num_rows($result)<1)
		{					
			$qry= mysql_query("insert into univ_program values('','".$univ_id."','".$prog_id."','".$parent_id."','4')");
			
			
		}
		
		//echo "insert into univ_program(id,univ_id,program_id,prog_parent_id,prog_educ_level) values('','".$univ_id."','".$prog_id."','".$parent_id."','2')".'<br />';
		//$qry= mysql_query("insert into univ_program(id,univ_id,program_id,prog_parent_id,prog_educ_level) values('','".$univ_id."','".$course."','".$parent_id."','2')");			
		
	
	}
	
}	
echo 'inserted ';

?>
