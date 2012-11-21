<?php
include('lock.php'); 
$url="http://webinfomart.com/cii-i3/admin"; 
include('dates.php');
require_once('paginator.class.php');
require('config.php');
//for pagination pushing ids in array
$pages = new Paginator;
$rec=mysql_query("select count(*) cnt from application_iii");
$res=mysql_fetch_object($rec);							
$pages->items_total = $res->cnt;
$pages->mid_range = 9;
$pages->paginate();
$ids=array();
$rows=mysql_query("select id from application_iii $pages->limit");
$sr_no=1;

$pg = $_GET['page'];
$ip = $_GET['ipp'];

if($pg == 1 || $pg=="")
	{	
	$sr_no==1;	
	}
else if($pg > 1)
{	
$c = $pg-1;
$d = $c*$ip;
$sr_no = $sr_no+$d;	
}
while($row = mysql_fetch_array($rows)) 
{
$ids[]=$row['id'];
}
$ids=implode(',',$ids);
//---end pagination
unset($srch);
?>
<html lang="en">
    <head>
       <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta charset="utf-8">
        <title>CII ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Turbo send">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }

        </style>
		<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 200%;
			height: 400%;
			background-color: black;			
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 5%;
			left: 5%;
			width: 70%;
			height: 100%;		
			z-index:1002;
			overflow: auto;
			border:2px solid;
			
			
		}
	</style>
        <!-- styles -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
 <script src="js/jquery-latest.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
	
 	<!--	<SCRIPT src="tablefilter.js"></SCRIPT>-->
		
        <script type="text/javascript">
            jQuery(document).ready(function(){			 
               	 jQuery("#drop").change(function()
					{  
						 var e = document.getElementById("drop");
						 var dataString = e.options[e.selectedIndex].value
						 if(dataString==1 || dataString==7 || dataString==2)
							{
							  $("#state").hide();
								$("#area").hide();
								$("#subject").hide();
							  $("#name").show();
							  $("#search").show();
							}	
							if(dataString==3)
							{
							  $("#name").hide();
								$("#area").hide();
								$("#subject").hide();
							  $("#state").show();
							  $("#search").show();
							}	
							if(dataString==4)
							{
							  $("#state").hide();
								$("#name").hide();
								$("#subject").hide();
							  $("#area").show();
							  $("#search").show();
							}	
							if(dataString==10)
							{
							  $("#state").hide();
								$("#name").hide();
								$("#subject").show();
							  $("#area").hide();
							  $("#search").show();
							  
							}	
               });
        
    
    });
</script>
<script type="text/javascript">
$a = jQuery.noConflict();
$a('document').ready(function(){	
$a("#myTable").tablesorter();
});
</script>
<script  type="text/javascript">
		function validated()
		{
			
			if(document.attach.file.value=="")
			{
				alert("please select a file!");
				document.attach.file.focus()
				return false;
			}			 
			
			return true;
			
		}
		
	</script>
	
    </head>

<body>
    
<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" >Welcome <?php echo $_SESSION['username']; ?> </a>
                    <ul class="nav pull-right">
                     <!--   <li><a href="#">Link</a></li>
                        <li class="divider-vertical"></li>-->
                      <!--  <li class="dropdown">  -->
 <!--  <a data-toggle="dropdown" class="dropdown-toggle" href="">Logout <b class="caret"></b></a>   -->
                         <!--  <ul class="dropdown-menu">   -->
								 <li><a href="<?php echo $url;?>/panel.php">Home</a></li>  
                                <li><a href="logout.php">Logout</a></li>
                               
                           <!-- </ul>  -->
                     <!--   </li>   -->
                    </ul>
                    <div class="nav-collapse">
                        <ul class="nav">
                          <!--  <li><a href="#">Dashboard</a></li>-->
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>    

        <div class="container-fluid">
            <div class="row-fluid">
                 <!--  sidebar-->
				<?php include('sidebar.php');?>
				<!--  sidebar-->
					
                <div class="span9">
				<?php
				// for level checking
				include('config.php');
				$sql=mysql_query("select * from admin where id='".$_SESSION['admin']."' ");
				$level=mysql_fetch_array($sql);
											
					if($level['level']==1)
					{
					?>
                    <!--  blocktop-->
					<?php include('blocktop.php');?>
					<!--  blocktop-->
					<?php } ?>
                    <div class="row-fluid">
                        <div id="accordion9" class="accordion9">
                            <div class="accordion-group">
<!------------------------------------search form----------------------------------------->
<?php 
if($level['level']==1)
{ ?>
							
					<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" >
							<div style="margin-left: 15px; font-size: 20px; margin-top: 15px;">
							<span >Filter</span>
							<select id="drop" name="drop" >
							<option>Select to Search</option>
							<option value="1">Name</option>
							<option value="3">State</option>
							<option value="4">Region</option>
							<option value="10">Subject</option>
							<option value="7">Email Id</option>
							<option value="2">Application Id</option>
							</select>
							<input id="name"  style="height: 30px;margin-left: 10px;margin-top: 4px;display:none;" type="text" name="fullname" />
							<?php 
							$drop = mysql_query("SELECT * FROM `form_fields` where form_field_label_id =3");
							?><select id="state" name="state" style="display:none">
							<option value="">Select State</option>
							<?php
							while($state_names = mysql_fetch_array($drop))
							{?>
								
								<option value="<?php echo $state_names['form_field_value'];?>"><?php echo $state_names['form_field_name'];?></option>
								 <?php
							}		
							?>
							</select>
							<?php 
							$reg = mysql_query("SELECT * FROM `form_fields` where form_field_label_id =4");
							?><select id="area" name="area" style="display:none">
							<option value="">Region</option>
							<?php
							while($area = mysql_fetch_array($reg))
							{?>
								
								<option value="<?php echo $area['form_field_value'];?>"><?php echo $area['form_field_name'];?></option>
								 <?php
							}		
							?>
							</select>
							<?php 
							$sub = mysql_query("SELECT * FROM `form_fields` where form_field_label_id =10");
							?><select id="subject" name="subject" style="display:none">
							<option value="">Subjects</option>
							<?php
							while($subject = mysql_fetch_array($sub))
							{?>
								
								<option value="<?php echo $subject['form_field_value'];?>"><?php echo $subject['form_field_name'];?></option>
								 <?php
							}
														
							?>	
						<option value="other">Other</option>							
							</select>
							<input id="search" style="margin-top: 4px;display:none;" type="submit"  value="search" />
							</div>
						</form>
						<?php } ?>
                                <div class="accordion-heading">
                                    <a href="#" data-parent="#accordion9" data-toggle="collapse" class="accordion-toggle btn manage" style='text-align:left;'>
                                        <i class="icon-folder-open"></i>
                                        Manage
                                        <i class="icon-circle-arrow-down pull-right"></i>
                                    </a>

                                </div>
<div class="accordion-body collapse in" id="collapse9">
<div id="table_filter" class="accordion-inner" style="min-height: 100%;">
<form  method="post" action="excel.php">
	<table  id="myTable" width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-striped">
                                               
	<thead>
	<tr>
	<th style="background-color: skyblue;"><a href="#">Serial No.</a></th>
	<?php	
	if($level['level']==1)
	{ ?>
		<th style="background-color: skyblue;"><a href="#">Assign Jury</a></th>
		<th style="background-color: skyblue;"><a href="#">Level</a></th>
		<?php 
	}
	else
	{ ?>
		<th style="background-color: skyblue;"><a href="#">Select</a></th>
		<?php 
	}
	?>
		
		<th style="background-color: skyblue;"><a href="#">Application Id</a></th>
		<?php	
	if($level['level']==1)
	{ ?>
		<th style="background-color: skyblue;"><a href="#">Full Name</a></th>
		<?php } ?>
		<th style="background-color: skyblue;"><a href="#">State</a></th>
		<th style="background-color: skyblue;"><a href="#">Region</a></th>
		<th style="background-color: skyblue;"><a href="#">Actions</a></th>
	<!--   <th><a href="">Progress</a></th> -->
	</tr>
	</thead>
	<tbody>
	<?php	
	if($level['level']==1)
	{
	if(isset($_POST['state']) || isset($_POST['fullname']) ||isset($_POST['area']))
	{	
	$drop=$_POST['drop'];  								
	if(isset($_POST['fullname']) && $_POST['fullname'] !='' ){$search=$_POST['fullname'];}							
	if(isset($_POST['area']) && $_POST['area'] !='' ){$search=$_POST['area'];}
	if(isset($_POST['state']) && $_POST['state'] !='' ){$search=$_POST['state'];}	
	if(isset($_POST['subject']) && $_POST['subject'] !='' ){$search=$_POST['subject'];}
		

	$srch=array();
	if(isset($_POST['fullname']) && $_POST['fullname'] !='' )
	{
		if($drop!=2)
		{
		$search_rows=mysql_query("select app_id from app_info where app_label_info_id in('$drop') && app_label_value like '%$search%' ");
		}
		else
		{
			
			$search_rows=mysql_query("select id as app_id from application_iii where application_id like '%$search%' ");
		}
	}
	else
	{
		if($search!='other')
		{
		$search_rows=mysql_query("select app_id from app_info where app_label_info_id in('$drop') && app_label_value='$search'");
		}
		else
		{
		$search_rows=mysql_query("select app_id from app_info where app_label_info_id in('$drop') && app_label_other_value!='' ");
		}
	}
	if(mysql_num_rows($search_rows)>0)
	{
	while($row = mysql_fetch_array($search_rows)) 
	{
		$srch[]=$row['app_id'];
	}
		$srch=implode(',',$srch);
		$array=$srch;
		$pagi=0;
	}
	else
	{
		echo "No result Found";
		$pagi=0;
	}
	}							
	else 
	{	
		$array=$ids;
		$pagi=1;
	}
	}
	else
	{
	$pagi=0;
	$applicants=array();
	if($date>$level1_date && $date<$level2_date)
	{
		$lev="&& level1='select'";
	}
	else if($date>$level2_date)
	{
		$lev="&& level2='select'";
	}
	else
	{
		$lev='';
	}
	$applicant_ids1=mysql_query("select applicant_id from user_assigned where jadmin_id='".$_SESSION['admin']."' ".$lev."");

	while($applicant_ids=mysql_fetch_array($applicant_ids1))
	{
		$applicants[]=$applicant_ids['applicant_id'];
	}
	$applicants=implode(',',$applicants);
	$array=$applicants;
	}
	mysql_query("SET SQL_BIG_SELECTS=1");
	$result = mysql_query("SELECT *,(select form_field_name from form_fields where ai.app_label_info_id=form_field_label_id and ai.app_label_value=form_field_value) 
	FROM application_iii api 
	left join app_info ai ON api.id=ai.app_id 
	left join app_team_info at on api.id=at.team_application_id 
	left join label_info  li on li.label_id=ai.app_label_info_id where api.id in($array)
	GROUP BY ai.app_id,app_info_id");
	$id=0;
	if(!empty($result))
	{													
	while($row = mysql_fetch_array($result)) 
	{
	$innovator_level='';
	if($date<=$level1_date)
	{
		$column='level1';
	}
	elseif($date>$level1_date && $date<=$level2_date )
	{
		$column='level2';
	}
	$applicant_level1=mysql_query("select ".$column." as p from user_assigned where applicant_id='".$row["app_id"]."'");	
	if($applicant_level=mysql_fetch_array($applicant_level1))
	{
		$innovator_level=$applicant_level['p'];	
		//echo $innovator_level;		
	}	
	$app_id = $row["id"];											
	$team_id=0;																
	if($row["label_id"] == 3 || $row["label_id"] == 4)
	{
	$label = mysql_query("SELECT form_field_name FROM `form_fields` where form_field_label_id = '".$row["label_id"]."' && form_field_value = '".$row["app_label_value"]."'");
	$label_value = mysql_fetch_array($label);
	$row["app_label_value"] = $label_value['form_field_name'];
	}
	if($id==0 || $app_id != $id)
	{
	$id=$app_id;
	
	?>
	
 <tr id="<?php echo $row["app_id"];?>" <?php if($innovator_level=='select'){ ?> class="level_selected" <?php } ?>>
	<div id="light_<?php echo $row["app_id"];?>" class="white_content" style="margin-top: 50px; margin-left: 50px;">
<a  href = "javascript:void(0)" onclick = "document.getElementById('light_<?php echo $row["app_id"];?>').style.display='none'; document.getElementById('fade_<?php echo $row["app_id"];?>').style.display='none'" style="color: skyblue;">Close</a>
			<div style=" width: 300px; height: 400px; background-color: skyblue; ">
				
					<div style="margin-left:20px"> 
						<label><b>Add Note</b></label> <br />					
						<input type="hidden" value="" name="level" id="level_<?php echo $row["app_id"];?>"/>
						<input type="hidden" value="" name="rowid" id="rowid_<?php echo $row["app_id"];?>"/>
						<input type="hidden" value="<?php echo $username; ?>" name="juryname" id="juryname_<?php echo $row["app_id"];?>"/>						
						<?php $note=mysql_query("select note from user_assigned where applicant_id='".$row["app_id"]."'");						
						$count=mysql_fetch_array($note);						
						?>
						<input type="hidden" id="pre_note_<?php echo $row["app_id"];?>" name="pre_note" rows="5" col="30" value="<?php echo $count['note'];?>" />
						
						<textarea id="note_<?php echo $row["app_id"];?>" name="note" rows="5" col="30">
						</textarea>
						<br />
						<input onclick="change(<?php echo $row["app_id"];?>)" type="button" value="submit"/>
					</div>
				
			</div>
		</div>
		<div id="fade_<?php echo $row["app_id"];?>" class="black_overlay"></div> 
	<td><?php echo $sr_no; $sr_no++; ?></td>
	<?php	
	if($level['level']==1)
	{ ?>
		<td>
		
		<select multiple="multiple" class="jury" id="jury_select_<?php echo $row["app_id"]; ?>" name="jury[]" style=" width: 100px;" onchange="juryAssign('<?php echo $row["app_id"];?>')">		
		<?php 
		$jadmin=array();
		//echo "select jadmin_id from user_assigned where applicant_id='".$row["app_id"]."'";exit;
		$juryadmin=mysql_query("select jadmin_id from user_assigned where applicant_id='".$row["app_id"]."'");		
		if($juryadmin)
		{ while($juryadmin1=mysql_fetch_array($juryadmin))
			{//echo $juryadmin1['jadmin_id'];
			$jadmin[]=$juryadmin1['jadmin_id'];
			}
			//print_r($jadmin);exit;
			$juryids=implode("','",$jadmin);
			//echo $juryids;
			
			$jury_name1=mysql_query("select username from admin where id in('$juryids') ");
			$juryname=array();
			while($jury_name=mysql_fetch_array($jury_name1))					
			{
				$juryname[]=$jury_name['username'];
			}
			//print_r($juryname);
		}
		else
		{
			$jury_name['username']='';
		} 
		$jury1=mysql_query("select * from admin where level='2'");
		$hidden='';
		while($jury=mysql_fetch_array($jury1))
		{ 
		$selected='';
		
		if(in_array($jury['username'],$juryname))
		{ 
			if($hidden!='') {
			$hidden.=','.$jury['id']; }
			else
			{
			$hidden=$jury['id'];
			}
			$selected="selected";
		}
		?>
		<option value="<?php echo $jury['id'];?>" <?php echo $selected;?> > <?php echo $jury['username'];?></option>
		<?php 
		}
		?>
		</select>
			<input type="hidden" id="adminids_<?php echo $row["app_id"]; ?>" value="<?php echo $hidden; ?>" />
		<td>
		<select style="width:100px;" onchange="changeLevel(this.value,<?php echo $row["app_id"];?>)" >
		<option></option>		
		<option value="select"<?php if($innovator_level=='select'){?>selected <?php }?>>SELECT</option>
		<option value="reject" <?php if($innovator_level=='reject'){?>selected <?php }?>>REJECT</option>			
		</select>
		</td>
		<?php
		
	}
	else
	{ ?>
	
	<td>
	
	<select style="width:100px;" onchange="levelChange(this.value,<?php echo $row["app_id"];?>)">
	<option></option>		
	<option value="select"<?php if($innovator_level=='select'){?>selected <?php }?>>SELECT</option>
	<option value="reject" <?php if($innovator_level=='reject'){?>selected <?php }?>>REJECT</option>			
	</select>
	</td>
	<?php 	
	}
	?>
	
	<td><?php echo trim($row["application_id"]); ?></td>
	<?php 
	}		
	if($level['level']==1 && $row["app_label_info_id"] == 1 )
	{ ?>
	<td><?php echo strtoupper(trim($row["app_label_value"]));?></td>
	<?php		
	}
	if($row["app_label_info_id"] == 3 || $row["app_label_info_id"] == 4)
	{ ?>	
	<td><?php echo strtoupper(trim($row["app_label_value"]));?></td>
	<?php
	if($row["app_label_info_id"] == 4)
	{
	?>
	<td>
	<a title="View" class="btn set_btn" href="<?php echo $url;?>/view_single.php?id=<?php echo $row['id']; ?>"><i class="icon-file"></i></a>
	<?php if($level['level']==1)
	{ ?>
	<a title="Edit" class="btn set_btn" href="<?php echo $url;?>/edit.php?id=<?php echo $row['id']; ?>"><i class="icon-edit"></i></a>	
	<a onclick="del_confirm('<?php echo $row["app_id"]; ?>');" title="Delete" class="btn btn-danger set_btn" href="#"><i class="icon-remove icon-white"></i></a> 
    <?php } ?>
	<a title="Upload" class="btn btn-danger set_btn"  href = "javascript:void(0)" onclick = "upload('<?php echo $row["app_id"]; ?>');"> <i class="icon-upload icon-white"></i></a>
	
	<script type="text/javascript">
	function upload(id)
	{
	document.getElementById('cid').value=id; 
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';
	}
	</script>


	</td>
	</tr>

	<?php
	}}}} //echo $count;
	?>															  
	</tbody>
	</table>				

								
											
	<div class="form-actions">
	<?php
	if($pagi==1)	
	{
	?>
	<div class="pagination pull-left">
	<?php 							
	echo $pages->display_pages();
	?>
	<span style="margin-left:25px"> <?php echo $pages->display_jump_menu(). $pages->display_items_per_page();?></span>
	<?php  ?>
	</div>
	<?php 
	}
    $u=$url."/forexcel.php?";	
	$r=$_SERVER['QUERY_STRING'];
	$uri=$u.$r;	
	//echo $uri;
	
	if($level['level']==1)
	{
	?>	
	<input type="hidden" name="uri" value="<?php echo $uri;?>"/>
	<input class="btn btn-small btn-success pull-right" style="margin-left: 4px; margin-right: 0px;" type="submit"  value="Download Current Report"	/>
	<a class="btn btn-small btn-success pull-right" href="<?php echo $url;?>/excel_info.php"><i class="icon-plus-sign icon-white"></i>Download Report in Excel</a> 
	<a class="btn btn-small btn-success pull-right" onclick="jury();" href="javascript:void(0);"><i class="icon-plus-sign icon-white"></i>Assign Jury</a> 
	<?php } ?>	
	</div>
</form>	
<div id="light" class="white_content" style="margin-top: 50px; margin-left: 50px; ">
<a  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none'; document.getElementById('fade').style.display='none'" style="color: skyblue;">Close</a>
<div style=" width: 300px; height: 200px; background-color: skyblue; ">
			<form name="attach" method="post" action="upload.php" enctype="multipart/form-data" onsubmit="javascript:return validated();">
            <div style="margin-left:20px"> 
					<label><b>Filename:</b></label> <br />					
					<input type="hidden" value="" name="cid" id="cid"/>
					<input type="file" name="file" id="file" /> 
					<br />
					<input type="submit" name="submit" value="Upload" />
					</div>
			</form>
</div>
</div>
<div id="fade" class="black_overlay"></div> 
	 
	</div>
	</div>
	</div>

	</div>
	</div>

                </div><!--/span-->
            </div><!--/row-->

            

            <?php include('footer.php');?>
<script type="text/javascript">

function del_confirm(id)
{
    var r=confirm("Are you sure? ");
  
  if (r)
  {     
   
    jQuery.ajax({
	type: "POST",
	data: "id=" +id,
	url: "<?php echo $url;?>/delete.php",
	success: function(msg){
			$("#"+id).remove();
	}
	}); 
     
  }

}

var juries=new Array();
var splitted=new Array();
function juryAssign(appid)
	{
	$('#jury_select_'+appid+' option').each(function(i) 
	{
	
		if($(this).attr('selected'))
		{
			var adminid=$(this).val();//from dropdown
			//alert(adminid);
			var pre_selected=$("#adminids_"+appid).val();//from hidden field		
			splitted=pre_selected.split(",");
			if( $.inArray(adminid, splitted) == -1 )
			{
			
					juries.push(adminid,appid);	
					if(pre_selected!='')
					{
					$('#adminids_'+appid).val(pre_selected+','+adminid);
					}
					else
					{
					$('#adminids_'+appid).val(adminid);
					
					}
		  
			}	
		}
		else
		{
			
			var a = splitted.indexOf($(this).val());
			if(a!='-1')
			{
			splitted.splice(a,1);
			var split_string=splitted.join(",")
			$('#adminids_'+appid).val(split_string);
			}
			var b = juries.indexOf($(this).val());
					
			if(b!='-1')
			{	
				var len=juries.length;
				//alert(len);
				var x;
				for(x=0;x<=len;x++)
				{ 	
					if(juries[x]==juries[b] && juries[x+1]==appid)
					{
						juries.splice(x,2);
					}
				}
			}
		}
		});
		
		//alert(juries);
	}
function jury()
	{	
		jQuery.ajax({
		type: "POST",
		data: "juries="+juries,
		url: "<?php echo $url;?>/mul_jury_assign.php",
		success: function(msg){
		//alert(msg);
		alert("Jury added successfully");		
		}
		});
	}
function levelChange(level,rowid)
	{
		var id=rowid;
		document.getElementById('level_'+id).value=level;
		document.getElementById('rowid_'+id).value=rowid; 		
		document.getElementById('light_'+id).style.display='block';
		document.getElementById('fade_'+id).style.display='block';	

	}	
	function change(id)
	{		
		var level=jQuery("#level_"+id).val();
		var rowid=jQuery("#rowid_"+id).val();
		var pre_note=jQuery("#pre_note_"+id).val();
		var note=jQuery("#note_"+id).val();
		var juryname=jQuery("#juryname_"+id).val();
		var dataString = 'level='+ level +'&rowid='+rowid+'&note='+note+"&pre_note="+pre_note+"&juryname="+juryname;		
		jQuery.ajax({
		type: "POST",
		data: dataString,
		url: "<?php echo $url;?>/level.php",
		success: function(msg){
					document.getElementById('fade_'+id).style.display='none';
				document.getElementById('light_'+id).style.display='none';
				alert(msg);
				
		}
		});
	}
function changeLevel(level,rowid)
{  
	jQuery.ajax({
	type: "POST",
	data: "level="+level+","+rowid,
	url: "<?php echo $url;?>/app_level.php",
	success: function(msg){
			alert(msg);
	}
	});
}	
		
</script>
    </body>
</html>