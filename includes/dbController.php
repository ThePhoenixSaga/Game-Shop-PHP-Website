<?php
class DBController {
  private $ServerName = "127.0.0.1";
  private $DBUserName = "root";
  private $DBPassword = "jonathanG12";
  private $DBName = "ddw_assignment1";
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysql_connect($this->ServerName,$this->DBUserName,$this->DBPassword);
		return $conn;
	}
	
	function selectDB($conn) {
		mysql_select_db($this->DBName,$conn);
	}
	
	function runQuery($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
}
?>