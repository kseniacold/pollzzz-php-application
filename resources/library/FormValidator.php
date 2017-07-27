<?php
	// Declare interface FormValidator
	interface FormValidator {
		public function validate_form();
		public function process_form();
		public function display_errors();
		public function check_input($data);
	}
 ?>