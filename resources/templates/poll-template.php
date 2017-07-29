<?php
	require_once(LIBRARY_PATH . "/Poll.php");
	require_once(LIBRARY_PATH . "/PollForm.php");
	require_once(LIBRARY_PATH . "/db-lib.php");
	
	/**
	 * This template goes inside main.page
	 * 1. Parse URL, get poll id
	 * 2. Get poll from db
	 * 3. Display poll
	 */
	 $config_db = $config['db']; 
	 $poll;
	 
	 if(!empty($_GET)) {
	 	// getting poll id
	 	$poll_id = $_GET['id'];
				
		// getting poll from db
		$duration_seconds;
		$time_start;
		$title;
		$description;
		
		// using SelectQuery class to generate SELECT query
		$select_query = new SelectQuery('*');
		$select_query->set_table('poll');
		$select_query->set_where_clause("ID=$poll_id");
		
		// connecting to the data base
		$db = new DbConnection($config_db['host'], $config_db['user'], $config_db['password'], $config_db['dbname']);
		// performing the query
		try {
			$rows = $db->select($select_query);
			$row = $rows[0];
		} 
		
		catch(Exception $err) {
			echo $err->getMessage();
		}
		
		// filling local variables
		$duration_seconds = $row['duration_millisec'] / 1000;
		$time_start = $row['time_start'];

		$interval_spec = 'PT' . $duration_seconds . 'S';
		$title = $row['title'];
		$description = $row['description'];
		
		$poll = new Poll($title, $time_start, $interval_spec, $description);
				
	 } 
		
?>

<div class="poll">
	<?php
		if(!empty($poll)) {
			$attr_value = $poll->get_time_end_timestamp_msec();
			
			$title = $poll->get_title();
			$description = $poll->get_description();
			echo  '<h1 class="poll__title">' . $title . '</h1>';
			if (!empty($description)) {
				echo  '<div class="poll__description">' . $description . '</div>';
			}
			
			echo  '<div class="timer" data-timer-end=' . $attr_value . '></div>';
			echo '<p class="details">Create <a class="details__link" href="index.php">a new poll.</a></p>';
		} else {
			echo '<h3 class="poll_message">Can not find this poll. :-(</h3>';
			echo '<p class="details">Feel free to create <a class="details__link" href="index.php">a new one.</a></p>';
		}
		
	?>
</div>