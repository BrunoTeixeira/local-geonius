<?php 

	/* ############################################################### */
	/* Created and developed by Bruno Teixeira - www.bruno-teixeira.pt */
	/* ############################################################### */

	/* You can use the code of this website as long as you give credits */
	/* You can't use code of this website with commercial purpose */
	/* If have any question contact me: info@localgeonius.com */
	
?>

<script id="places_template" type="text/html">
	{{#data}}
	  {{#results}}
	    <span class='option' style='font-size:{{#fontSize}}{{rating}}{{/fontSize}}px' data-place-reference='{{reference}}' data-latitude='{{#geometry}}{{#location}}{{lat}}{{/location}}{{/geometry}}' data-longitude='{{#geometry}}{{#location}}{{lng}}{{/location}}{{/geometry}}'>
	      {{name}}
	    </span>
	  {{/results}}
	  
	  {{^results}}
	  	Hmmm... I am unable to grant your wish, scratch to try something else.
	  {{/results}}


	  {{#next_page_token}}
	  	<span class='more-options' data-token='{{next_page_token}}'>More &#8594;</span>
	  {{/next_page_token}}
	 {{/data}}
</script>

<script id="places_detail_template" type="text/html">
	<div class="container-white">
	  <div class="row-fluid">
	    <div class="span4">
	    	{{#result}}

		    	<h2>{{name}}</h2>
		      <hr />

		      <table>
		          {{#formatted_address}}
		            <tr>
		              <td valign='top'><i class='icon-map-marker'></i></td>
		              <td valign='top'> {{formatted_address}} </td>
		           </tr>
		          {{/formatted_address}}

		          {{#geometry}}
	              <tr>
	                <td valign='top'><i class='icon-screenshot'></i></td>
	                <td valign='top'>{{#location}} {{lat}}, {{lng}} {{/location}}</td>
	              </tr>
	            {{/geometry}}

	            {{#phone}}
	              <tr>
	                <td valign='top'><i class='icon-info-sign'></i></td>
	                <td valign='top'>{{phone}}</td>
	              </tr>
	            {{/phone}}

	            {{#rating}}
	              <tr>
	                <td valign='top'><i class='icon-star'></i></td>
	                <td valign='top'>Rating - {{rating}}</td>
	              </tr>
	            {{/rating}}

	            {{#website}}
	              <tr>
	                <td valign='top'><i class='icon-globe'></i></td>
	                <td valign='top'>{{website}}</td>
	              </tr>
	            {{/website}}
		      </table>

	      {{/result}}
	    </div>

	  </div>
	</div>
</script>

<script id="citys_template" type="text/html">
  {{#query}}
	  {{#results}}
	 	 {{#place}}
		    <span class='option_city' data-city='{{name}}' data-latitude='{{#centroid}}{{latitude}}{{/centroid}}' data-longitude='{{#centroid}}{{longitude}}{{/centroid}}'>
		      {{name}}, {{#admin2}}{{content}}{{/admin2}} - {{#admin1}}{{content}}{{/admin1}}, {{#country}}{{content}}{{/country}}
		    </span>
	  	{{/place}}
	  {{/results}}

	  {{^results}}
	  	<span style='line-height: 18px; display: block; padding-bottom: 10px;'>Sorry, I didn't find that city, try other nearby</span>
	  {{/results}}
	{{/query}}
</script>

