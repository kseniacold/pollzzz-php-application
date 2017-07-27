<?php
	require_once(LIBRARY_PATH . "/PollForm.php");
	/**
	 * This template goes inside main.page
	 * 1. validate #poll-form
	 * 2. submit data to the server
	 * 3. receive result with created poll record back
	 * 4. pass poll ID to get method of dynamic URL 
	 * 5. redirect user to the poll page
	 */
?>
<div class="poll-form__results">
		<?php 	
			if (!empty($_POST)) {
			 	$poll_form = new PollForm();
			 	$poll_form->process_form();
			}
		?>
</div>