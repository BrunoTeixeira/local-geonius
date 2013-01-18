<?php

/* ############################################################### */
/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
/* ############################################################### */

/* You can use the code of this website as long as you give credits */
/* You can't use code of this website with commercial purpose */
/* If have any question contact me: info@localgeonius.com */
  
class localgeonius_api_object
  {
    var $user_city, $user_latitude, $user_longitude;

    public function curl_query($query) 
    {
      $this->session = curl_init($query);
      curl_setopt($this->session, CURLOPT_RETURNTRANSFER, true);
      $this->data    = curl_exec($this->session);
      curl_close($this->session);

      return $this->data; 
    }

    function retrieve_places($latitude, $longitude, $type)
    {
      $this->array = self::curl_query("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $latitude . "," . $longitude . "&radius=5000&types=" . $type . "&sensor=false&key=AIzaSyBXfquUm8XZ8F3g7s8P6i8R60zO46eJCi0");
      return $this->array;
    }

    function retrieve_places_next_page($pagetoken)
    {
      $this->array = self::curl_query("https://maps.googleapis.com/maps/api/place/nearbysearch/json?pagetoken=" . $pagetoken . "&sensor=false&key=AIzaSyBXfquUm8XZ8F3g7s8P6i8R60zO46eJCi0");
      return $this->array;
    }

    function retrieve_place_details($reference)
    {
    	$this->array = self::curl_query("https://maps.googleapis.com/maps/api/place/details/json?reference=" . $reference . "&sensor=false&key=AIzaSyBXfquUm8XZ8F3g7s8P6i8R60zO46eJCi0");
    	return $this->array;
    }

    function retrieve_citys($input)
    {
      $this->array = self::curl_query("http://query.yahooapis.com/v1/public/yql?q=" . urlencode(sprintf("select * from geo.places where text='%s'", $input)) . "&format=json");
     	return $this->array;
    }
    
    function __construct()
    {
      $this->ip = $_SERVER['REMOTE_ADDR'];
      $this->data = json_decode(self::curl_query('http://www.geoplugin.net/json.gp?ip=' . $this->ip));
      $this->user_country = $this->data->geoplugin_countryName;

      $lat = $this->data->geoplugin_latitude;
      $lng = $this->data->geoplugin_longitude;

      $this->user_city  = ($this->data->geoplugin_city) ? $this->data->geoplugin_city : null;
      
      $this->info = json_decode(self::curl_query("http://where.yahooapis.com/geocode?flags=J&country=" . urlencode(sprintf("%s",$this->user_country)) . "&city=" .  urlencode(sprintf("%s",$this->user_city)) ."&appid=dj0yJmk9VDg5Ujl0RW5oNU1hJmQ9WVdrOU0weHZUWEozTkhVbWNHbzlNVGs0TnpRM016QTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0wMQ--"));

      if($this->info->ResultSet->Found != "0"):
        foreach($this->info->ResultSet->Results as $result):
          $this->user_latitude  = $result->latitude;
          $this->user_longitude = $result->longitude;
        endforeach;
      else:
        $this->user_latitude  = $lat;
        $this->user_longitude = $lng;
      endif;
    }
  }
?>