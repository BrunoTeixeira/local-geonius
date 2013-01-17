<?php 
	
	/* ############################################################### */
	/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
	/* ############################################################### */

	/* You can use the code of this website as long as you give credits */
	/* You can't use code of this website with commercial purpose */
	/* If have any question contact me: info@localgeonius.com */

  header('Content-type: application/json');

  $reference  = str_replace("_"," ", $_GET['city']);

  include("../core/localgeonius.class.php");

  $object = new localgeonius_api_object();

  $city = $object->retrieve_citys($reference);

  echo $city;