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
	 
	 /*
	 $pollForm = new PollForm();
	 if($pollForm->process_form()) {
	 	print_r($_POST);
	 } else {
	 	// sending error to Ajax response
 	 	throw new Exception(print_r($GLOBALS['errors'], true));
	 }

*/

	echo "Hello world";
?>