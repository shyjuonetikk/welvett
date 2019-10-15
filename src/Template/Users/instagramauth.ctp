<?php ?>
<!--<div style="margin: 0 auto;">
<img src="<?php //echo $this->request->webroot; ?>img/instagram.jpg" />
</div>-->
<script type="text/javascript">
    		//using php to look for the error parameter in the URL
    		if(<?php echo intval(isset($_GET['error'])); ?>) {
				self.close();
			}
    	</script>