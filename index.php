<?php 

//  ego oktafanda 
//  Riau, Kuantan singingi, Pangean, Sungai langsat
//  developer website
//  Universitas Islam Kuantan Singingi
//  https://devsintax.blogspot.com/




require_once 'System/DB_Magic.php';
require_once 'app/config/database.php';

function parseUrl(){
	if (isset($_GET['url'])) {
		 //mengilangkan slesdi url
		$url = rtrim($_GET['url'], '/');
		// membuat filterdarinkarakter aneh di url
		$url = filter_var($url, FILTER_SANITIZE_URL);
		//memecah url menjadi elem elen array yang dengn delimeter nya /
		$url = explode('/', $url); 
		return $url;
	}
}


$url = parseUrl();
$class  = '';
$method = '';
$data 	= '';
for ($i=0; $i < count($url); $i++) { 
	if (!empty($url[0])) {
		$class = $url[0];
	}
	if (!empty($url[1])) {
		$method = $url[1];
	}

	if (!empty($url[2])) {
		$data = $url[2];
	}
}

require_once 'app/controllers/'.$class.".php";

if (empty($method)) {
	$method = 'index';
}
$base = new $class();
$base->input_get($data);
$base->$method();





