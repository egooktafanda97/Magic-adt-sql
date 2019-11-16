<?php 

class control extends DB_Magic{
	// test
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		echo "framework OK";
	}


	public function db_query_select(){
		$sql = $_POST['sql_select'];
		$sql = "select*from tb_pegawai";
		$qw = mysqli_query($this->main_database(),$sql);
		$result = array();
		while ($row = mysqli_fetch_array($qw)) {
			array_push($result,array(
			"id"=>$row['id'],
			"name"=>$row['nama']
			));
		}	
		
		echo json_encode(array('result'=>$result));
		mysqli_close($this->main_database());

	}

	public function SQL_query_creat(){
		$qw =  $_POST['SQL'];
		$sqli = explode('/',$qw);
		if (!empty($sqli)) {
			for ($i=0; $i < count($sqli); $i++) { 
				 echo $this->db_select_query($sqli[$i]);

			}
		}

		
	}

	public function SQL_query_update(){
		$qw =  $_POST['SQL'];
		$sqli = explode('/',$qw);
		if (!empty($sqli)) {
			for ($i=0; $i < count($sqli); $i++) { 
				echo $this->db_select_query($sqli[$i]);
				//var_dump($sqli[$i]);

			}
		}
	}
	public function SQL_query_delete(){
		$qw =  $_POST['SQL'];
		$sqli = explode('/',$qw);
		if (!empty($sqli)) {
			for ($i=0; $i < count($sqli); $i++) { 
				echo $this->db_select_query($sqli[$i]);
				//var_dump($sqli[$i]);

			}
		}
	}
	public function create_databases(){
		$table 	=  $_POST['Table'];
		$Values =  $_POST['Values'];
		$conf = $_POST['Setting'];
		$conf = explode(',', $conf);

		if (!empty($conf)) {
		$this->configDB($conf[0],$conf[1],$conf[2],$conf[3]);	
		}
		$this->create_Database();
		$this->create_Tables($table,$Values);

	}
	
}

