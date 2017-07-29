<?php
	// config file
	require_once("../resources/config.php");
	require_once(LIBRARY_PATH . "/db-lib.php");
	require_once(LIBRARY_PATH . "/PollForm.php");
	
	/**
	 * This script progess #poll-form
	 * 1. validate #poll-form
	 * 2. submit data to the server
	 * 3. receive result with created poll record back
	 * 4. pass poll ID to get method of dynamic URL 
	 * 5. redirect user to the poll page
	 */
	 
   	$config_db = $config['db'];
	
	 
	 // Validate #poll-from
	 $pollForm = new PollForm();
	 if($pollForm->process_form()) {
	 	// insert data to the poll table
	 	$poll_id = insertData($config_db);
		
	 	// send data back to AJAX
	 	echo json_encode(array("success" => true,"data" => $poll_id));
	 } else {
	 	// sending errors to Ajax
	 	$errors = $GLOBALS['errors'];		
		echo json_encode(array("success" => false,"error" => $errors));
	 }
	 
	 function insertData($config_db) {
	 	$poll_id;
				
	 	// data from $_POST
 		$author_id = $_POST['user-id'];
		$days    = 	 $_POST['poll-duration-days'];
		$hours   = 	 $_POST['poll-duration-hrs'];
		$minutes =   $_POST['poll-duration-mins'];
		$title   = 	 $_POST['poll-name'];
		$description = $_POST['poll-description'];
		
		$duration_millisec = get_duration_millisecs($days, $hours, $minutes);
		
	 	// connecting to db
	 	$cn = new DbConnection($config_db['host'], $config_db['user'], $config_db['password'], $config_db['dbname']);
		$query_arr = array(
							'author_id' 		=> $author_id,
							'duration_millisec' => $duration_millisec,
							'title'             => $title,
							'description'       => $description
							);
		
		try {
			$poll_id = $cn->insert_with_query_arr($query_arr, 'poll');
			return $poll_id;			
		}
		
		catch(Exception $err) {
			echo json_encode(array("success" => false, "error"  => $err->getMessage()));
		}
	 }
	 
	 function get_duration_millisecs($days, $hours, $minutes) {
	 	$millisecs = 0;
		$millisecs += $days * 86400000;
		$millisecs += $hours * 3600000;
		$millisecs += $minutes * 60000;

 		return $millisecs;
	 }
	 
?>