<?php
//  ego oktafanda 
//  Riau, Kuantan singingi, Pangean, Sungai langsat
//  developer website
//  Universitas Islam Kuantan Singingi
//  https://devsintax.blogspot.com/

//require_once dirname(__FILE__).'/interface_db.php';
require_once dirname(__FILE__).'/libary_function.php';
require_once dirname(__FILE__).'/connection.php';
require_once dirname(__FILE__).'/DB.php';
class Databases{
 	private $host = '';
 	private $user = '';
 	private $pass = '';
 	private $db   = '';
 	public function configDB($host,$user,$pass,$db){
 		$this->host = $host;
 		$this->user	= $user;
 		$this->pass	= $pass;
 		$this->db   = $db;
 	}
    public function multiexplode($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
 	public function main_database(){
 		$connection = new connection();
 		$co = $connection->connect($this->host,$this->user,$this->pass,$this->db);
 		return $co;
 	}
 	public function database_create(){
 		$connection = new connection();
 		$co = $connection->connect_create($this->host,$this->user,$this->pass);
 		return $co;
 	}
    
   
 	public function create_Database(){
 		if ($this->database_create()) {
            $cekDb = mysqli_select_db($this->database_create(), $this->db);
            if ($cekDb) {
                return "1";
            }else{
                $queryCreateDb = mysqli_query($this->database_create(), "CREATE DATABASE ".$this->db);
                if ($queryCreateDb) {
                    return "0";
                }
            }
        }else{
            return "this not connect";
        }
 	}
   
    public function getDepartment(){
        return $this->main_database();
    }

    public function dbquery($qr, $type=""){
        $getConnection = $this->getDepartment();
        $query = mysqli_query($getConnection, $qr);
        $box = [];
        while ($data = mysqli_fetch_object($query) ) {
            $box[] = $data;
        }
        if ($type == "count") {
            return count($box);
        }else{
            return $box;
        }
    }

    public function getColumnName($table, $row){
        $data = $this->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".$this->db."'
            AND TABLE_NAME = '".$table."'
            AND ORDINAL_POSITION = ".$row."
        ");
        $nama = "";
        foreach ($data as $key => $value) {
            $nama .= $value->nama_kolom;
        }

        return $nama;
    }

    public function ArrColumnName($table){
        $data = $this->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".$this->db."'
                AND TABLE_NAME = '".$table."'
        ");
        $nama = array();
        foreach ($data as $key => $value) {
            $nama[] = $value->nama_kolom;
        }

        return $nama;
    }

    public function cekColumn($table, $row){
        return $this->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".$this->db."'
            AND TABLE_NAME = '".$table."'
            AND ORDINAL_POSITION = ".$row."
        ", "count");
    }

    public function cekTable($table, $tablestruktur){
        $getConnection = $this->getDepartment();
        $query = mysqli_query($getConnection, "DESCRIBE $table ");
        if ($query) {

            $aa = $this->ArrColumnName($table);
            $bb = array_keys($tablestruktur);

            if (count($aa) > count($bb)) {
                foreach ($aa as $ay => $ax) {
                    if (in_array($ax, $bb)) {
                    }else{
                        $this->query("
                            ALTER TABLE ".$table."
                            DROP COLUMN ".$ax.";
                        ");
                    }
                }
            }else{
                $no = 1;
                foreach ($tablestruktur as $key => $value) {
                    if ($this->cekColumn($table, $no) == 0) {
                        $this->query("
                            
                            ALTER TABLE ".$table."
                            ADD ".$key." ".$value.";

                        ");
                    }else{
                        if ($this->getColumnName($table, $no) != $key) {
                            $this->query("
                            
                                ALTER TABLE ".$table."
                                CHANGE COLUMN ".$this->getColumnName($table, $no)." ".$key." ".$value.";

                            ");
                        }
                    }
                    $no++;
                }
            }

            return 'tersedia';
        }else{

            $mystructure = "";

            $no = 0;
            foreach ($tablestruktur as $key => $value) {
                if ($no == 0) {
                    $mystructure .= $key.' '.$value;
                }else{
                    $mystructure .= ','.$key.' '.$value;
                }
                $no++;
            }
            $createtable = mysqli_query($getConnection, 'CREATE TABLE '.$table.' ('.$mystructure.') ');
            if ($createtable) {
                return 'dibuat';
            }else{
                return 'gagal';
            }
        }
    }
     // query data ke database
    public function query($e)
    {
        $conn = $this->getDepartment();
        $query = mysqli_query($conn, $e);
        return $query;
    }
    public function executes($sql){
        return mysqli_query($this->main_database(),$sql);
    }

}
// $co = new Databases();
// $co->configDB('localhost','root','','android');


// $co->create_Table("MHS");
// $co->create_Database();

// $sql = "SELECT * FROM tb_pegawai";
	
// 	//Mendapatkan Hasil
// $r = mysqli_query($co->koneksi(),$sql);
// var_dump(mysqli_fetch_array($r));
