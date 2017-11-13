<?php 

class dbConnect{

	var $conLinks;
	var $host = _HOST;
	var $user = _USER;
	var $pass = _PASSWORD;
	var $database = _DBName;
	var $_prefix = _PREFIX;
	var $ip;
		
	function __construct() {
		
       error_reporting(E_ERROR);
	   date_default_timezone_set(_TIMEZONE);
	   $this->ip = $_SERVER['REMOTE_ADDR'];
	   
    }// end function constructor

	public function connect(){
		
		$this->conLinks = mysql_connect($this->host,$this->user,$this->pass) or die("error".mysql_error());
		mysql_select_db($this->database);
	
	} // end function
	public function destroy(){
		
		mysql_close($this->conLinks);
		
	}// end function destroy connection
	
	public function getData($table,$field,$where,$type) {
	
		if($type == 'val')		
			$query  = "select $field as var from $table where $where ";
		else
			$query  = "select $field from $table where $where ";
			
		
		$res = mysql_query($query);
		$row = mysql_fetch_assoc($res);
		
		if($type == 'val')
			return $row['var'];
			
		else if($type == 'res')
			return mysql_query($query);
			
		else
			return $row;
	
	}// end function getData
	
	private function createFieldsValues($fields,$type){
	
		$val = "(";
			for($x = 0 ; $x < count($fields) ; $x++){
				
				if($type == 'values') 						// checl for values 
					$fields[$x] = "\"".$fields[$x]."\"";	 	// check for values
				
				$val = $val.$fields[$x];
				
				if($x != (count($fields)-1) )
					$val = $val.",";
			
			} // end for
			
		return $val = $val.")";								// return values
	
	} // end function create fields
	
	public function insertData($table,$fields,$values){ 
	
		if(	count($fields) != count($values) )
			return "number of fields do not match";
			
		$into =  $this->createFieldsValues($fields,'');
		$values = $this->createFieldsValues($values,'values');
		
		$query = "INSERT INTO $table $into VALUES $values";	
		if(mysql_query($query))
			return _TRUE;
		else
			return mysql_error();
		
	} // end function InsertData
	
	public function updateData($table,$fields,$values,$where){ 
		
		if(	count($fields) != count($values) )
			return "number of fields do not match";
			
		for($x=0; $x<count($fields) ; $x++){
				
			$data = $data.$fields[$x]." = \"".$values[$x]."\"";
	
			if($x != (count($fields)-1) )
				$data = $data.",";
		
		} // end for create data
		
		$query = "UPDATE $table set $data where $where";
		
		if(mysql_query($query))
			return _TRUE;
		else
			return mysql_error();

				
	} // end function UpdateData
	
	public function deleteData($table,$where){
	
		$query = "DELETE from $table WHERE $where";
	
		if(mysql_query($query))
			return _TRUE;
		else
			return mysql_error();	
	
	
	}// end function deleteData
	public function truncateTable($table){
	
		$query = "truncate table $table";
	
		if(mysql_query($query))
			return _TRUE;
		else
			return mysql_error();	
	
	
	}// end function deleteData

}// end class

?>