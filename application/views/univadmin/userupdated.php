<!--<div id="content" class="alert alert-success" style="z-index:99999">
 <a class="close" data-dismiss="alert" href="#">×</a>
  <strong><?php //echo $msg; ?></strong>
  </div>
 
<script>
$("#content").delay(5000).hide("slow");
</script>
-->
<div class="modal hide" id="content">				<!-- Added by satbir on 12/14/2012 -->			
	<div class="modal-header">		
		<div align="center"><h3><?php echo $msg; ?></h3></div>
	</div>
</div>
<script>
$('#content').show();
setTimeout(function(){$('#content').fadeOut('slow');},2000);
</script>