<?php
	require_once(LIBRARY_PATH . "/SelectQuery.php");
	
	/**
	 * DbConnection class
	 * establish connection with the server
	 * 
	 * provides higher level methods as API
	 * e.g create_table(), drop_table()
	 * to be used on Business logic level
	 * 
	 * API methods throw exceptions in case of errors
	 * uses SelectQuery class to provide flexibility for select query
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
		    	throw new Exception("Connection failed: " . $this->_cn->connect_error);
		    }
			
			return $this->_cn;
		}
		
		/**
		 * close_connection() closes established connection by accessing $this->_cn
		 * throws exeption if no connection was previously established
		 */
		private function close_connection() {
			if ($this->_cn) {
				$this->_cn->close();
				$this->_cn = null;	
			} else {
				throw new Exception("No connection has been established.");
			}
		}
		
		/**
		 * create_table($query) creates table with provided query
		 * closes connection after creation
		 * throws exeption if can not connect to host or can not close connection
		 * throws exeption when error occurs while creating the table
		 * returns true if table has been created
		 */
		public function create_table($query) {
			try {			
				$db = $this->connect_to_host();
			} 
			// catch and rethrow exception
			catch (Exception $err) {
				throw new Exception($err->getMessage());
			}
	
			if ($db->query($query)) {
				// close connection
				try {			
					$this->close_connection();
				} 
				// catch and rethrow exception
				catch (Exception $err) {
					throw new Exception($err->getMessage());
				}
				return true;			
	
			} else {
				$message = "Error while creating the table: \n" . print_r($db->error_list, true);
				throw new Exception($message);
			}
				
		}
		
		/**
		 * insert_with_query_arr($query_arr, $table_name) method
		 * Accepts $query_arr parameter that must contain column_names as keys
		 * and values to insert as values
		 * throws exeption if can not connect to host or can not close connection
		 * returns insert_id
		 */
		public function insert_with_query_arr($query_arr, $table_name) {
			$query;
			
			// connect to host
			try {			
				$db = $this->connect_to_host();
			}
			
			// catch and rethrow exception
			catch (Exception $err) {
				throw new Exception($err->getMessage());
			}
			
			// escape characthers
			$valuesArr = array_values($query_arr);
			$valuesArrEscaped = array();
			foreach ($valuesArr as $value) {
				$valuesArrEscaped[] = $db->real_escape_string($value);
			}	
				
			$query_into_str = implode(", ", array_keys($query_arr));
			$query_values_str = implode("', '", $valuesArrEscaped);
			
			$query = "INSERT INTO $table_name ( $query_into_str) values ('$query_values_str')";
		  	
			
			
			if ($db->query($query)) {
				$insert_id = $db->insert_id;
				
				// close connection
				try {			
					$this->close_connection();
				} 
				// catch and rethrow exception
				catch (Exception $err) {
					throw new Exception($err->getMessage());
				}
				return $insert_id;	
			} else {
				throw new Exception("Error while inserting row: \n" . print_r($db->error_list, true));
			}		
		}
		
		/**
		 * Accepts $query parameter as ready to use mySQL query
		 * throws exeption if can not connect to host or can not close connection
		 */
		public function insert($query) {
			// TODO implement simple insert with ready query
		}
		
		/**
		 * Accepts $select_query_obj of SelectQuery type
		 * throws exeption if can not connect to host or can not close connection
		 * throws exeption when error occurs while selecting rows
		 * returns rows array containing associative array for each row
		 */	 
		public function select($select_query_obj) {
			$rows = array();
			$query = $select_query_obj->get_query();
			
			// connect to host
			try {			
				$db = $this->connect_to_host();
			}
			
			// catch and rethrow exception
			catch (Exception $err) {
				throw new Exception($err->getMessage());
			}
			
			if ($result = $db->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$rows[] = $row; 
				}
				
				// close connection
				try {			
					$this->close_connection();
				} 
				// catch and rethrow exception
				catch (Exception $err) {
					throw new Exception($err->getMessage());
				}
				return $rows;			
	
			} else {
				$message = "Error while retreiving rows: \n" . print_r($db->error_list, true);
				throw new Exception($message);
			}
		}
		
		
		/**
		 * drop_table($if_exists, $table_name) will drop table with provided table name
		 * accepts $if_exists boolean argument
		 * throws exeption if can not connect to host or can not close connection
		 * throws exrption when error occurs while creating the table
		 * returns true if table has been droped
		 */
		public function drop_table($if_exists, $table_name) {
			try {			
				$db = $this->connect_to_host();
			} 
			// catch and rethrow exception
			catch (Exception $err) {
				throw new Exception($err->getMessage());
			}
			
			$query;
			if ($if_exists) {
				$query = "DROP TABLE IF EXISTS `" . $table_name  . "`";
			} else {
				$query = "DROP TABLE `" . $table_name . "`";
			}
				
			if ($db->query($query)) {
				
				// close connection
				try {			
					$this->close_connection();
				} 
				// catch and rethrow exception
				catch (Exception $err) {
					throw new Exception($err->getMessage());
				}
				return true;
				
			}
			else {
				$message = "Error while dropping the table: \n" . print_r($db->error_list, true);
				throw new Exception($message);
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