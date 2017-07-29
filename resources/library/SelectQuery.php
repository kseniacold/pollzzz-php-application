<?php

	/**
	 * SelectQuery class to provide flexibility for select queries
	 * Currently has minimal functionality for simple select queries
	 */
	 
	class SelectQuery {
		private $_select_expr;
		private $_query;
		
		private $_db_table = NULL;
		private $_where = NULL;
		private $_order_by = NULL;
		
		public function __construct($select_expr) {
			$this->_select_expr = $select_expr;
			$this->_query = "SELECT $select_expr";
		}
		
		public function set_table($db_table) {
			$this->_db_table = $db_table;
		}
		
		public function set_where_clause($where) {
			$this->_where = $where;
		}
		
		/**
		 * returns full select query adter setting instance varibles
		 */
		public function get_query() {
			$this->_query = "SELECT $this->_select_expr";
			
			if ($this->_db_table) {
				$this->_query .= " FROM $this->_db_table";
			} 
			
			if ($this->_where) {
				$this->_query .= " WHERE $this->_where"; 
			}
			
			return $this->_query;
		}
		
		
	}
?>