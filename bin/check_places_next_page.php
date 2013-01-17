<?php 

	/* ############################################################### */
	/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
	/* ############################################################### */

	/* You can use the code of this website as long as you give credits */
	/* You can't use code of this website with commercial purpose */
	/* If have any question contact me: info@localgeonius.com */
	
  header('Content-type: application/json');

  $pagetoken = $_GET['pagetoken'];

  include("../core/localgeonius.class.php");

  $object = new localgeonius_api_object();

  $places = $object->retrieve_places_next_page($pagetoken);

  echo $places;
?>


