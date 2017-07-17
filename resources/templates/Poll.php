<?php

	// Declaring Poll class
	class Poll {
		
		// instance variables
		
		// time poll has been created at
		var $_time_start;
		// time to live for this poll, e.g. to be open for new comments
		var $_time_to_live;
		// poll's title
		var $_title;
		// poll's description
		var $_description;
		
		public function __construct($time_start, $ttl, $title, $description) {
      		$this->_time_start = $time_start;
			$this->_time_to_live = $ttl;
			$this->_title = $title;
			$this->_description = $description;
   		}
		
	   /**
		* Accessors
		*/
		public function get_time_start() {
			return $_time_start;
		}
		
		public function get_time_to_live() {
			return $_time_to_live;
		}
		
		public function get_title() {
			return $_title;
		}
		
		public function get_description() {
			return $_description;
		}		
	}
?>