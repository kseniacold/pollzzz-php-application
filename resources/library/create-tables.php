<?php
	// load up your config file
    require_once("../config.php");
	require_once(LIBRARY_PATH . "/db-lib.php");
     
	/**
	 * NB: This script will drop exiting tables and will create new ones instead
	 */
	 
   	//connecting to the server unsing DbConnection class.
   	$config_db = $config['db'];
	$cn = new DbConnection($config_db['host'], $config_db['user'], $config_db['password'], $config_db['dbname']);
	
	//dropping tables `user` and `poll` if they exist
	$if_exists = true;
	
	// query for creating user table
   	$sql_query_user = "CREATE TABLE user (
						ID bigint UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    				  	email varchar(256) UNIQUE NOT NULL,
						name varchar(256),
        		  		username varchar(256),
  			  			password varchar(256),
      			  		website  varchar(500),
      			  		bio varchar(500),
      			  		profile_image varchar(500),
    				  	karma bigint DEFAULT 0,
					  	PRIMARY KEY (ID)
						)";
						
	// query for creating poll table					
	$sql_query_poll = "CREATE TABLE poll (
	  					ID bigint UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
	  					author_id bigint UNSIGNED,
	  					time_start timestamp DEFAULT CURRENT_TIMESTAMP,
    					duration_millisec bigint UNSIGNED,
	  					title varchar(250),
						description varchar(500),
	  					PRIMARY KEY (ID),
						FOREIGN KEY (author_id)
        				REFERENCES user (ID)
        				ON DELETE SET NULL
						)";
	
	// to mantain data integrity but to allow only anonymous polls and comments for the first time
	// will insert default user					
	$sql_query_default_user_array = array(
									'email' => 'test@test.com',
									'name' 	=> 'test',
									'username' => 'test_user',
									'password' => 'pass'
									);
						
	try {
		if ($cn->drop_table($if_exists, "poll")) { echo "poll table dropped.<br>"; }			
		if ($cn->drop_table($if_exists, "user")) { echo "user table dropped.<br>"; }
		
		// creating table user	
		if ($cn->create_table($sql_query_user)) { echo "user table created.<br>"; }
		// creating table poll			
		if ($cn->create_table($sql_query_poll)) { echo "poll table created.<br>"; }
		
		// adding default user
		if ($cn->insert_with_query_arr($sql_query_default_user_array, 'user')) { echo "Default user inserted.<br>"; }
		
		
	} 
	// catch and print errors
	catch (Exception $err) {
		echo "<pre>";
		echo $err->getMessage();
		echo "</pre>";
	}					
	
?>