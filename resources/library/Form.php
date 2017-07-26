<?php
	class Form {
		public function __construct() {
			
		}
		
		/**
		 * check_input() performs basic data sanitation
		 */
		 private function check_input($data) {
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    return $data;
		}
		 
		/**
		 * validate_form() performs validation on all submitted fields and returns true if all fields are valid
		 */
		public function validate_form() {
			foreach ($_POST as $value) {
				$this->check_input($value);
			}
			return empty($GLOBALS['errors']);
		}
		 
	 	/**
		 * display_errors() dispays errors that were added to the error list
		 */
		 public function display_errors() {
			echo '<h5 class="warning__error">Something went wrong: </h5>';
			foreach ($GLOBALS['errors'] as $error) {
				echo "<p class='warning__error'>$error</p>";
	 		}
	 		echo '<h5 class="warning__error">Please submit again.</h5>';	
		}
	}
?>