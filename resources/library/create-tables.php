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
	$cn->drop_table($if_exists, "poll");
	$cn->drop_table($if_exists, "user");
	
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
	  					author_id bigint UNSIGNED UNIQUE,
	  					time_start timestamp DEFAULT CURRENT_TIMESTAMP,
    					duration_millisec bigint UNSIGNED,
	  					title varchar(250),
						description varchar(500),
	  					PRIMARY KEY (ID),
						FOREIGN KEY (author_id)
        				REFERENCES user (ID)
        				ON DELETE SET NULL
						)";
						
	// creating table user			
	$cn->create_table($sql_query_user);
	// creating table poll
	$cn->create_table($sql_query_poll);
?>