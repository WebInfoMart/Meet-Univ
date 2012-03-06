Hi, <strong><?php echo $query['username']; ?></strong>! You are logged in now. <?php echo anchor('/logout/', 'Logout'); ?>


<?php
echo "</br>ID--".$query['id']."</br>";
echo "username--".$query['username']."</br>";
echo "email--".$query['email']."</br>";
echo "fullname--".$query['fullname']."</br>";
echo "level--".$query['level']."</br>";
echo "createdon--".$query['createdon']."</br>";
echo "createdby--".$query['createdby']."</br>";
/*foreach($query as $row)
{
echo $row->fullname;
}*/
?>