<?php

	// Declaring Poll class
	class Poll {
		
		// instance variables
		
		// time poll has been created at
		private $_time_start;
		// time to live for this poll, e.g. to be open for new comments
		private $_time_to_live;
		// end time of the poll
		private $_time_end;
		// poll's title
		private $_title;
		// poll's description
		var $_description;
		
		public function __construct($title, $time_start, $time_to_live, $description) {
			date_default_timezone_set('UTC');
      		$this->_time_start = new DateTime($time_start);
			
			// will need to clone to object to keep instance variable intact and further modify cloned object
			$start_time = clone $this->_time_start;
			
			// expecting time string e.g. '1 day', '10 hours', etc
			// using static method createFromDateString() of DateInterval class
			$this->_time_to_live = $time_to_live;
			
			// intemediate variable to create DateInterval object
			// expects interval specification string for DateInterval Constructor
			$time_to_live_interval = new DateInterval($time_to_live);
			$this->_time_end = $start_time->add($time_to_live_interval);
			
			$this->_title = $title;
			$this->_description = $description;
   		}
		
	   /**
		* Accessors
		*/
		
		/**
		 * returns start time of the poll - DateTime object
		 */
		public function get_time_start() {
			return $this->_time_start;
		}
		
		/**
		 * returns time to live for the poll - string
		 */
		public function get_time_to_live() {
			return $this->_time_to_live;
		}
		
		/**
		 * returns the time when the poll will be closed - DateTime object
		 */
 		public function get_time_end() {
 			return $this->_time_end;
 		}
		
		/**
		 * returns poll title
		 */
		public function get_title() {
			return $this->_title;
		}
		
		/**
		 * returns poll description
		 */
		public function get_description() {
			return $this->_description;
		}
		
		/**
		 * API methods
		 */
		
		/**
		 * returns start time of the poll - formatted string
		 */
		public function get_time_start_formatted() {
			return $this->_time_start->format('Y-m-d H:i:s');
		}
		
		/**
		 * returns the time when the poll will be closed - formatted string
		 */
		public function get_time_end_formatted() {
			return $this->_time_end->format('Y-m-d H:i:s');
		}
		
		/**
		 * returns the time when the poll will be closed - timestamp
		 */
		public function get_time_end_timestamp() {
			return $this->_time_end->getTimestamp();
		}
		
		/**
		 * returns the time when the poll will be closed - timestamp in milliseconds
		 */
		public function get_time_end_timestamp_msec() {
			return $this->_time_end->getTimestamp() * 1000;
		}
		
		/**
		 * prints information about state of the Poll object
		 */
		public function print_info() {
			echo "<pre>";
			echo $this->get_title() . "\n";
			echo $this->get_description() ."\n";
			echo $this->get_time_start_formatted() . "\n";
			echo $this->get_time_to_live() . "\n";
			echo $this->get_time_end_formatted() . "\n";
			echo $this->get_time_end_timestamp() . "\n";
			echo "</pre>";
		}
	}
?>