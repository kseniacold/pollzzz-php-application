<?php
	require_once(LIBRARY_PATH . "/FormValidator.php");
	
	class Form implements FormValidator {
		public function __construct() {
			
		}
		
		/**
		 * check_input() performs basic data sanitation
		 */
		 public function check_input($data) {
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    return $data;
		}
		 
		/**
		 * validate_form() performs sanitation on all submitted, no specific validation in this generic class
		 *
		 */
		public function validate_form() {
			foreach ($_POST as $value) {
				$this->check_input($value);
			}
			return empty($GLOBALS['errors']);
		}
		
		/**
		 * process_form() calls $this->validate_from()
		 * in case of falilure displays errors
		 * returns true in case of success
		 * returns false otherwise
		 */
		public function process_form() {
			if ($this->validate_form()) {
				echo '<h5 class="success">Thank you! We\'ve got it!</h3>';
				return true;
			} else {
				$this->display_errors();
				return false;
			}
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
		 
		 /**
		  * Specific validators
		  */
		  	  
		  public function validate_email($email) {
		  	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
		  		$GLOBALS['errors'][] = "Please provide a valid email address.";  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_url($url) {
			if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $url)) {
				$GLOBALS['errors'][] = "Please provide a valid URL.";  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_number($number) {
		  	if (preg_match("/\D/", $number)) {
		  		$GLOBALS['errors'][] = "Please enter numbers only.";  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_letters_only($string) {
		  	if (preg_match("/[^a-zA-Z]/", $string)) {
		  		$GLOBALS['errors'][] = "Please enter letters a-z and A-Z only!";  //Add to Error List
				return false;
		  	}
		  }
		  
		  public function validate_no_white_space($text) {
		  	if (preg_match("/\s/", $text)) {
		  		$GLOBALS['errors'][] = "Please do not enter any spaces, tabs or new lines!";  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_max_length($text, $max_length) {
		  	if (strlen($string) > $max_length ) {
		  		$GLOBALS['errors'][] = "Maximum " . $max_length . " characthers.";  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_max_value($number, $max_value) {
		  	if ($number > $max_length) {
		  		$GLOBALS['errors'][] = "Maximum value: " . $max_value . "<br>You entered: " . $number;  //Add to Error List
				return false;
			}
		  }
		  
		  public function validate_positive_zero($number) {
		  	if ($number < 0) {
		  		$GLOBALS['errors'][] = "Value must be positive or zero.";  //Add to Error List
				return false;
			}
		  }
		  
  		  public function validate_positive($number) {
		  	if ($number <= 0) {
		  		$GLOBALS['errors'][] = "Value must be positive.<br>You entered: " . $number;  //Add to Error List
				return false;
			}
		  }
	}
?>