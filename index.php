<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Your Local Geonius - Find the places that you need near your location</title>

    <meta name="description" content="Local Geonius its a web app that finds places of interest near your location."/>
    
    <meta property='og:locale' content='en_US'/>
    <meta property='fb:admins' content='100000270140901'/>
    <meta property='og:title' content='Your Local Geonius - Find the places that you need near your location'/>
    <meta property='og:description' content='Local Geonius its a web app that finds places of interest near your location.'/>
    <meta property='og:url' content='http://www.localgeonius.com/'/>
    <meta property='og:site_name' content='Local Geonius'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='http://localgeonius.com/img/pic.png'/>
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" type="text/css" href="css/core.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="canonical" href="http://www.localgeonius.com/" />

    <?php 
      include("core/localgeonius.class.php");

      $object = new localgeonius_api_object();

      // If the user changed is location
      if (isset($_SESSION['city']) and isset($_SESSION['lat']) and isset($_SESSION['lng'])):
        $city      = $_SESSION['city'];
        $latitude  = $_SESSION['lat'];
        $longitude = $_SESSION['lng'];
      else:
        $city      = $object->user_city;
        $latitude  = $object->user_latitude;
        $longitude = $object->user_longitude;
      endif;
    ?>

  </head>

  <body>

  <div class="wrapper">

    <header>
      <div class="container">
        <div class="row">
          <div class="span4 bar-top-left">
            <div>Find this website useful?</div> 
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FLocalGeonius&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=436888393017996" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></div>
          <div class="span8">
            <div class="city-options">

              <?php if ($city): ?>
                My powers tell me that you're in <strong><?php echo $city; ?></strong>
              <?php endif; ?>

              <div class="btn-group">
                <a class="btn btn-inverse dropdown-toggle city-chooser" data-toggle="dropdown" href="#">
                    Change Location

                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu city-form">
                  Where are you?
                  <div class="input-append">
                    <input class="span3" id="city-finder" type="text">
                    <span class="add-on">send</span>
                  </div>

                  <div id="data-citys"></div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">
        <div class="span3">
          <div class="headline">
            <a class="logo" href="index.php">
              <h1 class="hide">Local Geonius</h1>
            </a>

            <h3>What do you wish now?</h3>
          </div>
        </div>

        <div class="span9"></div>
      </div>

      <div class="row">

        <div class="span12">
          <form name="artist-form">


            <select class="select" <?php echo $form_status = ($city) ? "" : "disabled style='opacity: 0.5'"; ?>>
              <option value="#">Select what you wish to find</option>
              <option value="accounting">Accounting</option>
              <option value="airport">Airport </option>
              <option value="amusement_park">Amusement Park</option>
              <option value="aquarium">Aquarium</option>
              <option value="art_gallery">Art Gallery </option>
              <option value="atm">Atm</option>
              <option value="bakery">Bakery</option>
              <option value="bank">Bank</option>
              <option value="bar">Bar </option>
              <option value="beauty_salon ">Beauty Salon</option>
              <option value="bicycle_store">Bicycle Store </option>
              <option value="book_store ">Book Store</option>
              <option value="bowling_alley">Bowling Alley </option>
              <option value="bus_station">Bus Station</option>
              <option value="cafe">Cafe</option>
              <option value="campground">Campground</option>
              <option value="car_dealer">Car Dealer</option>
              <option value="car_rental">Car Rental</option>
              <option value="car_repair">Car Repair</option>
              <option value="car_wash">Car Wash</option>
              <option value="casino">Casino</option>
              <option value="cemetery">Cemetery</option>
              <option value="church">Church</option>
              <option value="city_hall">City Hall </option>
              <option value="clothing_store">Clothing Store</option>
              <option value="convenience_store">Convenience Store </option>
              <option value="courthouse">Courthouse</option>
              <option value="dentist">Dentist </option>
              <option value="department_store">Department Store</option>
              <option value="doctor">Doctor</option>
              <option value="electrician">Electrician</option>
              <option value="electronics_store">Electronics Store</option>
              <option value="embassy">Embassy</option>
              <option value="establishment">Establishment</option>
              <option value="finance">Finance</option>
              <option value="fire_station">Fire station</option>
              <option value="florist">Florist </option>
              <option value="food">Food</option>
              <option value="funeral_home">Funeral home</option>
              <option value="furniture_store">Furniture store</option>
              <option value="gas_station">Gas Station</option>
              <option value="general_contractor">General Contractor</option>
              <option value="grocery_or_supermarket">Grocery or Supermarket</option>
              <option value="gym">Gym</option>
              <option value="hair_care">Hair Care</option>
              <option value="hardware_store">Hardware Store</option>
              <option value="health">Health</option>
              <option value="hindu_temple">Hindu Temple</option>
              <option value="home_goods_store">Home Goods Store</option>
              <option value="hospital">Hospital</option>
              <option value="insurance_agency">Insurance Agency</option>
              <option value="jewelry_store">Jewelry Store</option>
              <option value="laundry">Laundry</option>
              <option value="lawyer">Lawyer</option>
              <option value="library">Library</option>
              <option value="liquor_store">Liquor Store</option>
              <option value="local_government_office">Local Government Office</option>
              <option value="locksmith">Locksmith</option>
              <option value="lodging">Lodging </option>
              <option value="meal_delivery">Meal Delivery</option>
              <option value="meal_takeaway">Meal Takeaway</option>
              <option value="mosque">Mosque</option>
              <option value="movie_rental">Movie Rental</option>
              <option value="movie_theater">Movie Theater</option>
              <option value="moving_company">Moving Company</option>
              <option value="museum">Museum</option>
              <option value="night_club">Night Club</option>
              <option value="painter">Painter</option>
              <option value="park">Park</option>
              <option value="parking">Parking</option>
              <option value="pet_store">Pet store</option>
              <option value="pharmacy">Pharmacy</option>
              <option value="physiotherapist">Physiotherapist</option>
              <option value="place_of_worship">Place of Worship</option>
              <option value="plumber">Plumber</option>
              <option value="police">Police</option>
              <option value="post_office">Post Office</option>
              <option value="real_estate_agency">Real Estate Agency</option>
              <option value="restaurant">Restaurant</option>
              <option value="roofing_contractor">Roofing Contractor</option>
              <option value="rv_park">RV Park</option>
              <option value="school">School</option>
              <option value="shoe_store">Shoe Store</option>
              <option value="shopping_mall">Shopping Mall </option>
              <option value="spa">Spa</option>
              <option value="stadium">Stadium</option>
              <option value="storage">Storage</option>
              <option value="store">Store</option>
              <option value="subway_station">Subway Station</option>
              <option value="synagogue">Synagogue </option>
              <option value="taxi_stand ">Taxi Stand</option>
              <option value="train_station">Train Station</option>
              <option value="travel_agency">Travel Agency</option>
              <option value="university">University</option>
              <option value="veterinary_care">Veterinary Care</option>
              <option value="zoo">Zoo</option>
            </select>

            <?php if (!$city): ?>
              <small>You can't use me just yet, tell me your location first (right upper corner)</small>
            <?php endif; ?>

          </form>

          <div id="data-places"></div>
          <div class="clearfix"></div>

          <div class="content">
            <div id="data-place-information"></div>
            <div id="map_canvas" style="position:absolute; right: 10px; top:10px; width:606px; height:280px"></div>
          </div>
          
        </div>
      </div>
    </div>

    <div id="latitude" class="hide"><?php echo $latitude; ?></div>
    <div id="longitude" class="hide"><?php echo $longitude; ?></div>

    <div class="push"></div>
  </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="span8 offset4">
            <div class="stick-label">
              Developed by <a href="http://www.bruno-teixeira.pt" target="blank" alt="Local Geonius Creator - Bruno Teixeira">Bruno Teixeira</a> <a href="https://twitter.com/brunodemorango" target="blank_">(follow me at twitter)</a>.
              <br />
              I hope that this website helps you, here's some notes: <br />

              &#8594; Results with better ratings are displayed larger <br />
              &#8594; If the website is running slow wait a few minutes or try to refresh the page <br />
              &#8594; If you can't find your city, try other nearby, the results will be practically the same.
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="js/mustache.js"></script>
    <script type="text/javascript" src="js/jquery.livequery.js"></script>
    <script type="text/javascript" src="js/google_maps.js"></script>
    <script type="text/javascript" src="js/front.js"></script>

    <?php include("core/templates.mustache.php"); ?>

    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-37640914-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>