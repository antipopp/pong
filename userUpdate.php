<?php
	// how to access data sent using JSON
	$jsondata = file_get_contents('php://input');

	// http://php.net/manual/en/function.json-decode.php
	$player = json_decode( $jsondata, true ); // 2nd arg true to convert objects to associative arrays

	// more info at http://www.dyn-web.com/tutorials/php-js/json/decode.php
	print_r ($player);
?>