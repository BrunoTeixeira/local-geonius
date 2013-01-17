/* ############################################################### */
/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
/* ############################################################### */

/* You can use the code of this website as long as you give credits */
/* You can't use code of this website with commercial purpose */
/* If have any question contact me: info@localgeonius.com */

$(document).ready(function() {

  // Found this function on web - scripterlative.com/files/noaccent.htm
  function replace_accents(str)
  {
   var rExps=[
   {re:/[\xC0-\xC6]/g, ch:'A'},
   {re:/[\xE0-\xE6]/g, ch:'a'},
   {re:/[\xC8-\xCB]/g, ch:'E'},
   {re:/[\xE8-\xEB]/g, ch:'e'},
   {re:/[\xCC-\xCF]/g, ch:'I'},
   {re:/[\xEC-\xEF]/g, ch:'i'},
   {re:/[\xD2-\xD6]/g, ch:'O'},
   {re:/[\xF2-\xF6]/g, ch:'o'},
   {re:/[\xD9-\xDC]/g, ch:'U'},
   {re:/[\xF9-\xFC]/g, ch:'u'},
   {re:/[\xD1]/g, ch:'N'},
   {re:/[\xF1]/g, ch:'n'} ];

   for(var i=0, len=rExps.length; i<len; i++)
    str=str.replace(rExps[i].re, rExps[i].ch);

   return str;
  }

  // Setup Bootstrap drop down menu
  $('.dropdown-toggle').dropdown();

  // Fix input element click problem
  $('.btn-group').click(function(e) { e.stopPropagation(); });

  $(".add-on").click(function() {
   var data = $("#city-finder").val();
   data = data.replace(" ", "_");

    $.ajax({
       type: "POST",
       dataType: "json",
       url: "bin/check_city.php?city=" + data,

       // Load Gif to simulate a loader
       beforeSend : function() { $("#data-citys").html("<center><img src='img/loader.gif' style='opacity: 0.65; width:25px;' /></center>"); },
       
       // Only returns success if there is data to display
       success: function(data) {

          $("#data-citys").hide();

          template = $('#citys_template').html();
          html = Mustache.to_html(template, data);

          $('#data-citys').html(html);
          $("#data-citys").fadeIn(500);
       }
    });          
  });

  $(".select").change(function() {

    if ($(this).val() != "#")
    {
      // Hide google map but doesn't break it
      $("#map_canvas").css({ "opacity" : "0"})

      // Reset Div with the informations
      $("#data-place-information").html("");

    
      // Default Coordenates
      var latitude  = $("#latitude").text();
      var longitude = $("#longitude").text();

      // Parameters to post
      var searchString = "lat=" + latitude + "&lon=" + longitude + "&type=" + $(this).val();

      $.ajax({
         type: "POST",
         dataType: "json",
         url: "bin/check_places.php?" + searchString,

         // Load Gif to simulate a loader
         beforeSend : function() { $("#data-places").html("<center><img src='img/loader.gif' style='opacity: 0.65; width:50px;' /></center>"); },
         
         // Only returns success if there is data to display
         success: function(searchString) {

            // Build json array object and function to retrieve font size -> better rating = bigger font
            var dataTemplate = {
              data: searchString,
              fontSize: function () {
                return function (val, render) { 
                  defaultValue = render(val);
                  
                  if(defaultValue == "") { fontSize = 12; }
                  else { fontSize = 11.5 + (2 * defaultValue); }

                  return parseInt(fontSize);
                }
              }
            }

            $("#data-places").hide();

            template = $('#places_template').html();
            html = Mustache.to_html(template, dataTemplate);

            $('#data-places').html(html);
            $("#data-places").fadeIn(500);
         }
      });
    }
    else {}

  });

  $(".more-options").livequery('click', function(event) { 

    // Hide google map but doesn't break it
    $("#map_canvas").css({ "opacity" : "0"})

    // Reset Div with the informations
    $("#data-place-information").html("");

    // Next page token (Google Array)
    var pagetoken = $(this).attr("data-token");

    // Parameters to post
    var searchString = "pagetoken=" + pagetoken;

    $.ajax({
       type: "POST",
       dataType: "json",
       url: "bin/check_places_next_page.php?" + searchString,

       // Load Gif to simulate a loader
       beforeSend : function() { $("#data-places").html("<center><img src='img/loader.gif' style='opacity: 0.65; width:50px;' /></center>"); },
       
       // Only returns success if there is data to display
       success: function(searchString) {

          // Build json array object and function to retrieve font size -> better rating = bigger font
          var dataTemplate = {
            data: searchString,
            fontSize: function () {
              return function (val, render) {  
                defaultValue = render(val);
              
                if(defaultValue == "") { fontSize = 12; }
                else { fontSize = 11.5 + (2 * defaultValue); }
                
                return parseInt(fontSize);
              }
            }
          }

          $("#data-places").hide();

          template = $('#places_template').html();
          html = Mustache.to_html(template, dataTemplate);

          $('#data-places').html(html);
          $("#data-places").fadeIn(500);
       }
    });
  });

  // Here we use Livequery because this elements are not in the DOM after the page load 
  $('.option').livequery('click', function(event) { 

    // Hide google map but doesn't break it
    $("#map_canvas").css({ "opacity" : "0"})

    var reference = $(this).attr("data-place-reference");
    var lat = $(this).attr('data-latitude');
    var lng = $(this).attr('data-longitude');

    $.ajax({
       type: "POST",
       dataType: "json",
       url: "bin/check_place_information.php?reference=" + reference,

       // Load Gif to simulate a loader
       beforeSend : function() { $("#data-place-information").html("<center><img src='img/loader.gif' style='opacity: 0.65; width:50px;' /></center>"); },
       
       success: function(reference) {
          $("#data-place-information").hide();

          template = $('#places_detail_template').html();
          html = Mustache.to_html(template, reference);

          $('#data-place-information').html(html);

          create_map(lat, lng);
          $("#data-place-information").fadeIn(500);
          $("#map_canvas").css({ "opacity" : "1"});
       } 
    });
  }); 

  // Lets set some sessions 
  $('.option_city').livequery('click', function(event) { 

    var city = $(this).attr("data-city");
    var lat  = $(this).attr('data-latitude');
    var lng  = $(this).attr('data-longitude');

    // strip spaces from parameters
    city = city.replace(" ", "_");

    $.ajax({
       type: "POST",
       url: "bin/set_city.php?city=" + city + "&lat=" + lat + "&lng=" + lng,

       // Load Gif to simulate a loader
       beforeSend : function() { $("#data-city").html("<center><img src='img/loader.gif' style='opacity: 0.65; width:50px;' /></center>"); },
       
       // When the scripts ends we refresh the page to load the sessions and replace location
       success: function(reference) { location.reload(); } 
    });
  });
});