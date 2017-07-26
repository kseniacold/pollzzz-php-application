
<?php
    // load up your config file
    require_once("../config.php");
	
	/**
	 * DbConnection class
	 * establish connection with the server
	 * provides higher level methods as API
	 * e.g create_table() or drop_table()
	 * to be used on Business logic level
	 */
	 
	class DbConnection {
		// database host
		private $_host;
		// database user
		private $_user;
		// database password
		private $_password;
		// name of the database
		private $_db_name;
		// connection to be established
		private $_cn;
		
		public function __construct($host, $user, $password, $db_name) {
			$this->_host = $host;
			$this->_user = $user;
			$this->_password = $password;
			$this->_db_name = $db_name;
		}
		
		/**
		 * connect_to_host() connects to database
		 * sets instance variable $this->_cn of type mysqli class
		 * retuns $this->_cn
		 */
		private function connect_to_host() {
		 	$this->_cn = new mysqli($this->_host, $this->_user, $this->_password, $this->_db_name);
		    if ($this->_cn->connect_error) {
		    	$message = "Connection failed: " . $this->_cn->connect_error;
				echo $message;
		        exit;
		    }
			
			return $this->_cn;
		}
		
		/**
		 * close_connection() closes established connection by accessing $this->_cn
		 */
		private function close_connection() {
			if ($this->_cn) {
				$this->_cn->close();
				$this->_cn = null;	
			} else {
				echo "No connection has been established.";
			}
		}
		
		/**
		 * create_table($query) creates table with provided query
		 * closes connection after creation
		 */
		public function create_table($query) {
			$db = $this->connect_to_host();
				
			if ($db->query($query)) {
				echo "Table has been created" . "<br>";
				$this->close_connection();
			}
			else {
				echo "<pre>";
				echo "Error while creating the table: \n";
			 	print_r($db->error_list);
				echo "</pre>";
			}
		}
		
		/**
		 * drop_table($if_exists, $table_name) will drop table with provided table name
		 * accepts $if_exists boolean argument
		 */
		public function drop_table($if_exists, $table_name) {
			$db = $this->connect_to_host();
			$query;
			if ($if_exists) {
				$query = "DROP TABLE IF EXISTS `" . $table_name  . "`";
			} else {
				$query = "DROP TABLE `" . $table_name . "`";
			}
				
			if ($db->query($query)) {
				echo "Table has been dropped" . "<br>";
				$this->close_connection();
			}
			else {
				echo "<pre>";
				echo "Error while dropping the table: \n";
			 	print_r($db->error_list);
				echo "</pre>";
			}
		}
	}
	
	/**
	 * debug_to_console() helper function to debug to console instead to user screen
	 */
	function debug_to_console($data) {
	    $output = $data;
	    if (is_array( $output ))
	        $output = implode( ', ', $output);
	
	    echo "<script>console.log( 'PHP information: " . $output . "' );</script>";
	}
?>