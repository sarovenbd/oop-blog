<?php if(isset($_SESSION['success']) && $_SESSION['success'] != ""){ ?>

	<div class="alert alert-success alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <h4><i class="icon fa fa-check"></i> Success</h4>
	    <?php 
	    	echo $_SESSION['success'];
	    	unset($_SESSION['success']);
	    ?>
	</div>

<?php } ?>



<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>

	<div class="alert alert-danger alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <h4><i class="icon fa fa-ban"></i> Error!</h4>
	    <?php 
	    	echo $_SESSION['error'];
	    	unset($_SESSION['error']);
	    ?>
	</div>

<?php } ?>