<?php

	/* ############################################################### */
	/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
	/* ############################################################### */

	/* You can use the code of this website as long as you give credits */
	/* You can't use code of this website with commercial purpose */
	/* If have any question contact me: info@localgeonius.com */

	session_start();

	$city = str_replace("_"," ", $_GET['city']);

	$_SESSION['city'] = $city;
	$_SESSION['lat'] = $_GET['lat'];
	$_SESSION['lng'] = $_GET['lng'];
?>