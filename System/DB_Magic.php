<?php 
//  ego oktafanda 
//  Riau, Kuantan singingi, Pangean, Sungai langsat
//  developer website
//  Universitas Islam Kuantan Singingi
//  https://devsintax.blogspot.com/

// require_once dirname(__FILE__).'/Databases.php';
require_once dirname(__FILE__).'/DB.php';

class DB_Magic extends DB{
	public function __construct(){
		if (isset($_POST['switch']) && $_POST['switch'] == 'true') {
			$this->create_databases();
		}else{
			$this->connections('true');
		}
		
	}

	public $input_get = '';
	public function create_Tables($table,$row){
		$db = new databases();
 		$tb = explode(',', $table);
 		$ar = explode('/', $row);
 		$jmlah = count($ar);
		   for ($i=0; $i <$jmlah ; $i++) { 
		   	$arrays = array();
		   	$eer = $this->multiexplode(array("=>",","),$ar[$i]);
		   	
		   	$sQQ = count($eer);

				for ($j=0; $j <$sQQ ; $j++) {
				   	$arrays[$eer[$j]] = $eer[$j+=1];
				}
				$this->cekTable($tb[$i],$arrays);
				
		   }
 	}
 	public function input_get($data){
 		$this->input_get = $data;
 	}

 	public function connections($conf = 'false'){
 		if($conf == 'true'){
 			$this->configDB(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 			$this->main_database();
 		}
 	}
 	
}



// $db = new DB_Magic();

// $tb = "Dosen,Mahasiswa";

// $SQL = "id => INT(11) AUTO_INCREMENT PRIMARY KEY ,Nama => VARCHAR(20) not null,Alamat => VARCHAR(20) not null/id => INT(11) AUTO_INCREMENT PRIMARY KEY,data1 => VARCHAR(255)";
// 		// cek table 2 paramater namatable dan struktur table


// $db->configDB('localhost','root','','android');
// $db->create_Database();
// $db->create_Tables($tb,$SQL);

// $data = [
// 	'data1' =>'ego oktafanda'
// ];

// //$db->db_insert('mahasiswa',$data);

// ;

// var_dump($db->db_get_where("mahasiswa",['id'=>3]));


// // $db->where('id',5);
// // var_dump($db->update('Dosen',$data));