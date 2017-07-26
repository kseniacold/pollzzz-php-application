<?php

	// Declaring Poll class
	class User {
		
		// instance variables
		private $_id;
		private $_username;
		private $_email;
		private $_password;
		private $_name = NULL;
		private $_website = NULL;
		private $_bio = NULL;
		private $_profile_image = NULL;
		private $_karma = 0;
		
		
		public function __construct($id, $username, $email, $password) {
      		$this->_id = $id;
			$this->_username = $username;
			$this->_email = $email;
			$this->_password = $password;		
   		}
		
	   /**
		* Mutators
		*/		
		public function set_username($username) {
			$this->_username = $username;
		}
		
		public function set_email($email) {
			$this->_email = $email;
		}
		
		public function set_password($password) {
			$this->_password = $password;
		}
		
		
		public function set_name($name) {
			$this->_name = $new_name;
		}
		
		public function set_bio($bio) {
			$this->_bio = $bio;
		}
		
		public function set_profile_image($profile_image) {
			$this->_profile_image = $profile_image;
		}
		
		public function set_karma($karma) {
			$this->_karma = $karma;
		}
		
	   /**
		* Accessors
		*/
		
		public function get_id() {
			return $this->_id;
		}
		
		public function get_username() {
			return $this_->_username;
		}
		
		public function get_email() {
			return $this->_email;
		}
		
		public function get_password() {
			return $this->_password;
		}
		
		public function get_name() {
			return $this->_name;
		}
		
		public function get_website() {
			return $this->_website;
		}
		
		public function get_bio() {
			return $this->_bio;
		}
		
		public function get_profile_image() {
			return $this->_profile_image;
		}
		
		public function get_karma() {
			return $this->_karma;
		}
	}
?>