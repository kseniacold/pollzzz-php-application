<?php    
    // load up your config file
    require_once("../resources/config.php");
     
    require_once(TEMPLATES_PATH . "/head.php");
?>
<body>
	<div class="wrapper">
		<?php 
			require_once(TEMPLATES_PATH . "/header.php");
			require_once(TEMPLATES_PATH . "/poll-template.php");
		?>
	</div>

	<?php
		require_once(TEMPLATES_PATH . "/footer.php");
	?>
</body>