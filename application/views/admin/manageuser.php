
<table border="1" align="center">
<tr>
<th>ID</th>
<th>FULLNAME</th>
<th>USERNAME</th>
<th>EMAIL</th>
<th>USER TYPE</th>
</tr>
<?php
foreach($user_detail as $row){
if($row->level!='5' && $row->level!='' && $row->level!='0'){
?>
<td><?php echo $row->id; ?></td>
<td><?php echo $row->fullname; ?></td>
<td><?php echo $row->username; ?></td>
<td><?php echo $row->email; ?></td>
<td><?php if($row->level=='1' )
{
echo "Student";
}
else if($row->level=='2')
{
echo "Counsellor";
}
else if($row->level=='3')
{
echo "University Admin";
}
else if($row->level=='4')
{
echo "Admin";
}

 ?></td><tr />
<?php
}
}
?>
<table>