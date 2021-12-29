<?php
	function getCurs(){
		// $info = file_get_contents('https://www.bnr.ro/nbrfxrates.xml');
		$info = file_get_contents('https://www.cursbnr.ro/curs-bnr-azi');
		
		$result = [];

		foreach ([
			'USD' => "United States Dollar",
		 	'EUR' => 'Euro', 
		 	'GBP' => "British pound sterling",
		 	'CHF' => 'Swiss Franc'] 
		 as $k => $v) {

			$curs = explode("$k</td>", $info)[1];	
			$curs = explode('text-center">', $curs)[1];
			$curs = explode('</td>', $curs)[0];

			$result[$k] = [$v, (float)$curs];
		}

		return $result;
	}
?>	