<?php
	require_once("Poll.php");
	
	$poll = new Poll('TIFU', '10 days', 'recent and not recent fuck ups');
?>

<main class="page">
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
</main>