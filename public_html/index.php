<?php    
    // load up your config file
    require_once("../resources/config.php");
     
    require_once(TEMPLATES_PATH . "/head.php");
?>
<body>
	<div class="wrapper">
		<?php 
			require_once(TEMPLATES_PATH . "/header.php");
			
			if (empty($_POST)) {
				require_once(TEMPLATES_PATH . "/create-poll.php");
			} else {
				require_once(TEMPLATES_PATH . "/poll-form-submit.php");
			}
		?>
	</div>
	
	<?php require_once(TEMPLATES_PATH . "/poll-form.php"); ?>
	<?php require_once(TEMPLATES_PATH . "/footer.php"); ?>
	
</body>