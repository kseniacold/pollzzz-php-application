
<?php
    // load up your config file
    require_once("../config.php");
	
	class DbConnection {
		private $_host;
		private $_user;
		private $_password;
		private $_dbname;
		
		public function __construct($host, $user, $password, $dbname) {
			$this->_host = $host;
			$this->_user = $user;
			$this->_passowrd = $password;
			$this->dbname = $dbname;
		}
		
		public function connect_to_host() {
		 	$mysqli = new mysqli($this->_host, $this->_user, $this->_password, $this->_dbname);
		    if (mysqli_connect_errno()) {
		    	$message = "Connection failed: " . mysqli_connect_error();
				debug_to_console($message);
		        //printf("Connection failed: %s\n", mysqli_connect_error());
		        exit;
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