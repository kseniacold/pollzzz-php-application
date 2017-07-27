<?php
	require_once(LIBRARY_PATH . "/FormValidator.php");
	require_once(LIBRARY_PATH . "/Form.php");
	
	class PollForm extends Form implements FormValidator {
		
		public function validate_form() {
			// Data Sanitation
			foreach ($_POST as $value) {
				$this->check_input($value);
			}
			// duration days
			$duration_days = $_POST['poll-duration-days'];
			// duration hours
			$duration_hours = $_POST['poll-duration-hrs'];
			// duration minutes
			$duration_minutes = $_POST['poll-duration-mins'];
			
			if(!$duration_days || !$duration_hours || !$duration_minutes) {
				$GLOBALS['errors'][] = "You must provide a valid timeframe.";  //Add to Error List
			}
			
			// days validation
			// must be number
			if($duration_days && $this->validate_number($duration_days)) {
				// convert to integer
				$duration_days = intval($duration_days);
				// must be positive or zero 
				$this->validate_positive_zero($duration_days);
			}
		
			// hours validation
			// must be number
			if ($duration_hours && $this->validate_number($duration_hours)) {
				// convert to integer
				$duration_hours = intval($duration_hours);
				// must be positive or zero 
				$this->validate_positive_zero($duration_hours);
				// max value 23
				$this->validate_max_value($duration_hours, 23);
			}
			
			// minutes validation
			// must be number
			if ($duration_minutes && $this->validate_number($duration_minutes)) {
				// convert to integer
				$duration_minutes = intval($duration_minutes);
				// must be positive or zero 
				$this->validate_positive_zero($duration_minutes);
				// max value 59
				$this->validate_max_value($duration_minutes, 59);
			}
								
			return empty($GLOBALS['errors']);
		}
	}
?>