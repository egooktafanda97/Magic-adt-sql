<?php
//  ego oktafanda 
//  Riau, Kuantan singingi, Pangean, Sungai langsat
//  developer website
//  Universitas Islam Kuantan Singingi
//  https://devsintax.blogspot.com/
class connection{
	public function connect($host,$user,$pass,$db){
		$con = mysqli_connect($host,$user,$pass,$db) or die('Unable to Connect');
		return $con; 
	}
	public function connect_create($host,$user,$pass){
		$con = mysqli_connect($host,$user,$pass) or die('Unable to Connect');
		return $con; 
	}
}