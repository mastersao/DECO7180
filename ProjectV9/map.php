<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tracks and Trails Map</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
        <script src="js/jquery-3.4.1.min.js"></script>

    </head>
    <body>
		<?php include "header.php"; ?>
        <div class="map-container">
            <div class="filter">
			    <form>
                    <h4 id="filter-title">Filters</h4>
				    <div class="filter-block">
					    <h4>Search</h4>
					
					    <div class="filter-content">
						    <input type="search" placeholder="Try Brisbane...">
					    </div> <!-- filter-content -->
				    </div> <!-- filter-block -->

				    <div class="filter-block">
					    <h4>Species</h4>

					    <ul class="filter-content filters list">
						    <li>
							    <input class="filter" data-filter=".check1" type="checkbox" id="checkbox1">
			    			    <label class="checkbox-label" for="checkbox1">All</label>
						    </li>

						    <li>
						    	<input class="filter" data-filter=".check2" type="checkbox" id="checkbox2">
						    	<label class="checkbox-label" for="checkbox2">Kangaroo</label>
						    </li>

						    <li>
						    	<input class="filter" data-filter=".check3" type="checkbox" id="checkbox3">
						    	<label class="checkbox-label" for="checkbox3">Wombat</label>
						    </li>
                            <li>
						    	<input class="filter" data-filter=".check4" type="checkbox" id="checkbox4">
						    	<label class="checkbox-label" for="checkbox4">Magpies</label>
						    </li>
					    </ul> <!-- filter-content -->
				    </div> <!-- filter-block -->

				    <div class="filter-block">
					    <h4>Search Radius</h4>
					
					    <div class="filter-content">
						    <div class="select filters">
						    	<select class="filter" name="selectThis" id="selectThis">
						    		<option value="">Choose an option</option>
							    	<option value="500">0.5 KM</option>
							    	<option value="1000">1.0 KM</option>
							    	<option value="3000">3.0 KM</option>
							    	<option value="5000">5.0 KM</option>
							    </select>
						    </div> <!-- select -->
					    </div> <!-- filter-content -->
				    </div> <!-- filter-block -->

				    <div class="filter-block">
					    <h4>Rarity</h4>

					    <ul class="filter-content filters list">
					    	<li>
					    		<input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
					    		<label class="radio-label" for="radio1">All</label>
					    	</li>

					    	<li>
					    		<input class="filter" data-filter=".radio2" type="radio" name="radioButton" id="radio2">
					    		<label class="radio-label" for="radio2">Common</label>
					    	</li>

					    	<li>
					    		<input class="filter" data-filter=".radio3" type="radio" name="radioButton" id="radio3">
					    		<label class="radio-label" for="radio3">Rare</label>
					    	</li>

                            <li>
					    		<input class="filter" data-filter=".radio4" type="radio" name="radioButton" id="radio4">
					    		<label class="radio-label" for="radio4">Legendary</label>
					    	</li>
					    </ul> <!-- filter-content -->
				    </div> <!-- filter-block -->
			    </form>
		    </div> <!-- filter -->
            <div id="map"></div>
        </div>
        <script src="js/Wildlife incident locations copy.geojson.js" type="text/javascript"></script>
        <script src="js/Tracks_and_Trails.geojson.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <!-- <script src="wildlife.js"></script> -->

		<?php include "footer.php"; ?>
	</body>
</html>


