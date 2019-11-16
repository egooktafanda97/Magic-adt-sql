<?php 
//  ego oktafanda 
//  Riau, Kuantan singingi, Pangean, Sungai langsat
//  developer website
//  Universitas Islam Kuantan Singingi
//  https://devsintax.blogspot.com/

require_once dirname(__FILE__).'/Databases.php';
class DB extends Databases{
	private $db_where='';
	private $db_QR_where='';
	private $db_select = '';

	// properti umum 
	public function db_where($key = null,$value = null){
		return $this->db_where = " where ".$key." = ".$value;
	}
	public function db_QR_where($QR_where){
		return $this->db_QR_where = " where ".$QR_where;
	}
	public function db_select($select){
		return $this->db_select = $select;
	}
	// -------------


	// selec----
	public function db_get($SQL){
		$Query = "SELECT * FROM ".$SQL;
		if($qw = mysqli_query($this->main_database(),$Query)){
		   return mysqli_fetch_assoc($qw);
		}else{
			return 'error';
		}
	}
	public function db_get_where($SQL,$where){
		$SSQL_key   ='';
		$SSQL_value ='';
			foreach ($where as $key => $value) {
				$SSQL_key   .= $key."="."'".$value."' AND ";
		}
		$Query = "SELECT * FROM ".$SQL." WHERE ".substr($SSQL_key, 0, -4);
		if($qw = mysqli_query($this->main_database(),$Query)){
		   return mysqli_fetch_assoc($qw);
		}else{
			return 'error';
		}
		
	}
	public function db_get_select($qr){
		$Query = $qr;	
		if($qw = mysqli_query($this->main_database(),$Query)){
		   return mysqli_fetch_assoc($qw);
		}else{
			return 'error';
		}
	}
	// -----------



	// insert----
	public function db_insert($table,$SQL){
		$SQL_key   ='';
		$SQL_value ='';
		foreach ($SQL as $key => $value) {
			$SQL_key   .= $key.",";
			$SQL_value .= "'".$value."',";
		}
		
		$QR = "INSERT INTO ".$table."(".substr($SQL_key, 0, -1).")VALUES(".substr($SQL_value, 0, -1).")";

		if(mysqli_query($this->main_database(),$QR) === true){
			return 'success';
		}else{
			return 'error';
		}
		
	}
	public function db_select_query($query){
		$QR = $query;
		if(mysqli_query($this->main_database(),$QR) === true){
			return 'success';
		}else{
			return 'error';
		}
	}
	public function db_insert_select($query){
		$QR = $query;
		if(mysqli_query($this->main_database(),$QR) === true){
			return 'success';
		}else{
			return 'error';
		}
	}
	
	// ----------

	
	// update-----
	public function db_update($table = null,$query = null,$where=null){
		if (!empty($table) && !empty($query)) {
			$SQL_key   ='';
			$SQL_value ='';
			foreach ($query as $key => $value) {
				$SQL_key   .= $key."="."'".$value."',";
			}
		}
		

		if (!empty($table) && !empty($query) && !empty($where) && !empty($where)) {
			$SSQL_key   ='';
			$SSQL_value ='';
			foreach ($where as $key => $value) {
				$SSQL_key   .= $key."="."'".$value."' AND ";
			}
				$Query = "UPDATE ".$table." SET ".substr($SQL_key, 0, -1)." where ".((!empty($where))?substr($SSQL_key, 0, -4):'');
		}else if (!empty($this->db_where) && empty($where)) {
				$Query = "UPDATE ".$table." SET ".substr($SQL_key, 0, -1).$this->db_where;
		}else if (!empty($this->db_QR_where) && empty($where) && empty($this->db_where)) {
				$Query = "UPDATE ".$table." SET ".substr($SQL_key, 0, -1).$this->db_QR_where;
		}else if(empty($table) && empty($query) && empty($where) && !empty($this->db_select)){
			$Query = $this->db_select;
		}

		if(mysqli_query($this->main_database(),$Query) === true){
			return 'success';
		}else{
			return 'error';
		}
		
	}
	// ---------------


	//delete ----------
	public function db_delete($table = null,$where = null){
		if (!empty($table) && !empty($where)) {
			$SSQL_key   ='';
			$SSQL_value ='';
			foreach ($where as $key => $value) {
				$SSQL_key   .= $key."="."'".$value."' AND ";
			}
			$Query = "DELETE FROM ".$table." where ".substr($SSQL_key, 0, -4);
		}else{
			$Query = $this->db_select;
		}

		
		if(mysqli_query($this->main_database(),$Query) === true){
			return 'success';
		}else{
			return 'error';
		}
		

	}
	// -------------------
	
}

