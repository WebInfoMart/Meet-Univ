<div id="content_data">
<center><h1>Manage Leads</h1></center>
<div style="margin-bottom:30px;"></div>
<div>
<?php if($teleleads!='0') { ?>
<table align="center">
<tr>
<th><h3>Serial No.</h3></th>
<th><h3>Full Name</h3></th>
<th><h3>Email</h3></th>
<th><h3>Phone</h3></th>
<th></th></tr>

<?php 
$sno=1;
foreach($teleleads as $teleleadsres) { ?>
<tr >
<th><?php echo $sno++ ;?></th>
<th><?php echo $teleleadsres['fullname']; ?></th>
<th><?php echo $teleleadsres['email_as_lead']; ?>(
<?php if($teleleadsres['email_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;">Not Verified</span>'; } ?>
 )</th>
<th><?php 
if($teleleadsres['mob_no']=='' || $teleleadsres['mob_no']==0 || $teleleadsres['mob_no']==NULL) {
echo "<span style='color:blue'>Not Available</span>(<span style='color:red;font-size:10px;'>Not Verified</span>)";
}
else {
echo $teleleadsres['mob_no']; ?>(
<?php if($teleleadsres['mob_no_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;"> Not Verified</span>'; } ?> )<?php }?>

</th>
<th><a href="javascript:void(0);" onclick="" style="color:gray;margin-left:10px;" >Edit</a></th></tr>
<?php } ?>
</table>
<?php } else { 
echo "No Record Found";
}
?>
</div>
  <div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>
           
  </div>
</div>
<script>
  $(function() {
    applyPagination();

    function applyPagination() {
      $("#pagination a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          data: "ajax=1",
          url: url,
          beforeSend: function() {
            $("#content_data").html("");
          },
          success: function(msg) {
            $("#content_data").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }
  });
  </script>