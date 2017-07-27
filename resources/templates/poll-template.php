<?php
	require_once(LIBRARY_PATH . "/Poll.php");
	require_once(LIBRARY_PATH . "/PollForm.php");
	
	/**
	 * This template goes inside main.page
	 * 1. validate #poll-form
	 * 2. submit data to the server
	 * 3. receive result with created poll record back
	 * 4. pass poll ID to get method of dynamic URL 
	 * 5. redirect user to the poll page
	 */
	
	$poll = new Poll('California vibes', '10 hours', 'All Cali and beyond.');
?>

<?php
	
	
?>
<div class="poll-form__results">
		<?php 	
			if (!empty($_POST)) {
			 	$poll_form = new PollForm();
			 	$poll_form->process_form();
			}
		?>
</div>

<div class="poll">
	<?php 
		$attr_value = $poll->get_time_end_timestamp_msec();
		$title = $poll->get_title();
		$description = $poll->get_description();
		echo  '<h1 class="poll__title">' . $title . '</h1>';
		echo  '<div class="poll__description">' . $description . '</div>';
		echo  '<div class="timer" data-timer-end=' . $attr_value . '></div>';
	?>
</div>