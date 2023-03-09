const doc = document;
const menuOpen = doc.querySelector(".menu");
const menuClose = doc.querySelector(".close");
const overlay = doc.querySelector(".overlay");

//Current run function
$(doc).ready(function() {
    const startButton = doc.querySelector(".startButton");
    const pauseButton = doc.querySelector(".stopButton");
    const resetButton = doc.querySelector(".resetButton");

    //how many feet it takes to walk 10 steps
    var stepFeet = 10;

    //assume it takes 1 step for every seconds
    var stepPerMeter = 0;

    //calculate calories burnt
    var currentTime = 0;
    console.log(currentTime);

    // calories variable
    var calRef = document.querySelector('.num-calories');
    // variable for moderately aerobic physical activity
    var MET = 4.5;
    // weight in kg
    var weight = 53;

    // average jogging speed in m/s
    var speed = 3;

    // distance covered in m
    var distRef = document.querySelector('.num-distance');

    // steps reference
    var stepRef = document.querySelector('.num-step');

    // Timer variables
    var [milseconds,seconds,minutes,hours] = [0,0,0,0];
    var timerRef = document.querySelector('.main-time');
    var int = null;

    menuOpen.addEventListener("click", () => {
    overlay.classList.add("overlay--active");
    });

    menuClose.addEventListener("click", () => {
    overlay.classList.remove("overlay--active");
    });

    // Start button 
    startButton.addEventListener('click', ()=>{
        console.log("start");
        if(int!==null){
            clearInterval(int);
        }
        int = setInterval(updateStats,10);
    });

    // Pause button
    pauseButton.addEventListener('click', ()=>{
        console.log("pause");
        clearInterval(int);
    });

    // Reset button
    resetButton.addEventListener('click', ()=>{
        console.log("reset");
        clearInterval(int);
        [milseconds,seconds,minutes,hours] = [0,0,0,0];
        timerRef.innerHTML = '00 : 00 : 00';

        currentTime = 0;
        stepPerMeter = 0;
        calRef.innerHTML = '0.000';
        distRef.innerHTML = '0 M';
        stepRef.innerHTML = '0';
    });

    // Update the stats counter
    function updateStats(){
        milseconds+=10;
        hours = 0;
        if(milseconds == 1000){
            milseconds = 0;
            seconds++;
            currentTime++;
            stepPerMeter++;
            //distance = speed*currentTime;
            if(seconds == 60){
                seconds = 0;
                minutes++;
                //currentTime++;
                if(minutes == 60){
                    minutes = 0;
                    hours++;
                }
            }
        }

    let h = hours < 10 ? "0" + hours : hours;
    let m = minutes < 10 ? "0" + minutes : minutes;
    let s = seconds < 10 ? "0" + seconds : seconds;
    // change the calories burnt as the time goes on
    let calBurnt = (currentTime/60)*(MET*3.5*weight)/200; // --> formula from (https://www.verywellfit.com/how-many-calories-you-burn-during-exercise-4111064)
    //console.log(calBurnt.toFixed(3));
    let dist = speed*currentTime;
    let step = stepPerMeter;

    timerRef.innerHTML = ` ${h} : ${m} : ${s} `;
    calRef.innerHTML = calBurnt.toFixed(3);
    distRef.innerHTML = `${dist} M`;
    stepRef.innerHTML = step;
    }


});
// Current run function ends

menuOpen.addEventListener("click", () => {
  overlay.classList.add("overlay--active");
});

menuClose.addEventListener("click", () => {
  overlay.classList.remove("overlay--active");
});

var roadBoard = L.icon({
    iconUrl: 'images/road-board.png',
    iconSize: [30, 30],
})

function showPreview(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

/*function searchNearbyAnimals(location, radius){
    $.each(wildlife, function (recordID, recordValue) {
        var distance = Math.sqrt(Math.pow(recordValue["latitude"] - currentLocation.lat) + 
        Math.pow(recordValue["longitude"] - currentLocation.long));
        console.log(distance);
    });
}*/

/*function iterateRecords(results) {
    console.log(results);
    var i = 0;

    // Iterate over each record and add a marker using the Latitude field (also containing longitude)
    $.each(results, function (recordID, recordValue) {
        var distance = Math.sqrt((recordValue["latitude"] - currentLocation.lat)**2 + 
        (recordValue["longitude"] - currentLocation.long)**2);
        if (distance*25000 <= rad) { //this is not an accurate ratio
            $("#nearby-animals").append(
                $('<article class="animals">').append(
                    $('<a>').text(recordValue["species"]))
                );
            console.log(distance);
            console.log(recordValue["species"]);
            i++;
        }
    });
    console.log(i);
}*/
   
//Define a array to store the animal points and calculate the distance with trails
var faunaArr = new Array();

//Store the distinct track name
var trackArr = new Array();

var changeFlag = 0;

var faunaOption = "ALL";

//Get user's location
var currentLocation;
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(definePosition);

}
function definePosition(position) {
  currentLocation = L.latLng(position.coords.latitude, position.coords.longitude);
//   console.log(currentLocation);
}

$(document).ready(function(){
  var map = L.map('map').setView(currentLocation, 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
  }).addTo(map);

  //Default search radius
  var rad = 500;
  var user = L.marker(currentLocation).addTo(map);
  var circle = L.circle(currentLocation, {
      radius: rad,
      color: 'blue'
  }).addTo(map);
  user.bindPopup("Current location");  

  var wombatInfo =  `<h3>Wombat</h3>
  <p>Description:
  They are adaptable and habitat tolerant, and are found in forested, mountainous, and heathland areas of southern and eastern Australia, including Tasmania, as well as an isolated patch of about 300 ha (740 acres) in Epping Forest National Park in central Queensland.
  </p>
  <div style="text-align:center">
      <img width="200px" height="auto" src="pics/Wombat.jpg"/>
  </div>

  `
  
  //Get the survey/Sightings (need modification since thew survey can only return species if searched by species ID)  
  $.ajax({
    url: "https://apps.des.qld.gov.au/species/?op=getsurveys&projids=82",
    //Some other survey: 103,1007,926,1318,1326,2037,2039,6389,3290,5942,5945,2464,2466,2485,2488,7923,2503
    type: "GET",
    data: {
      "$limit" : 1000,
      "circle" : "-27.469, 153.0222, 10000"
    },
    success: function (data) {
        
        var fauna_points = new L.geoJson(
            data, {
        
                style: function (feature) {
                    return feature.properties && feature.properties.style;
                },
        
                filter: function (feature, layer){
                    if (faunaOption == "ALL") {
                        return true;
                    }
                    return feature.properties.species.indexOf(faunaOption) >= 0;
                          
                },
        
                pointToLayer: function (feature, latlng) {
                    var distance = currentLocation.distanceTo(latlng);
                    //console.log(distance);

                    //After each points be added to map, store ID and distance to user 
                    //(which a little larger than current rad) to the 2D array
                    if (distance < 1.2 * rad) {
                        faunaArr.push([feature.properties.ID, distance]);
                    }

                    var recordSpecies = feature.properties.species;
                    if (distance <= rad) { //this is not an accurate ratio
                        $("#nearby-animals").append(
                            $('<article class="animals">').append(
                                $('<a>').text(recordSpecies))
                            );
                    }
                    var desc = wombatInfo;
                    
                    return L.circle(latlng, {
                        radius: 26,
                        fillColor: '#ff7800',
                        color: '#000',
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).bindPopup(desc);
                }
            }
        );
        fauna_points.addTo(map);
    }
}).done(function(data) {
//   alert("Retrieved " + data.length + " records from the dataset!");
  //console.log(data);
});
    //Add tracks which are around the user's location
    var hikeTracks = new L.geoJson(
        tracks, {
    
            style: function (feature) {
                return {"color": "orange",
                "weight": 5,
                "opacity": 0.7};
            },

            filter: function (feature, layer){
                var startPoint = L.latLng(feature.geometry.coordinates[0][0][1], feature.geometry.coordinates[0][0][0]);
                var distance = currentLocation.distanceTo(startPoint);
                return distance <= rad;    
            },
            
            onEachFeature: function (feature, layer) {
                var startPoint = L.latLng(feature.geometry.coordinates[0][0][1], feature.geometry.coordinates[0][0][0]);
                var distance = currentLocation.distanceTo(startPoint);
                var trailDes = feature.properties.ITEM_DESCRIPTION;
                trailDes.className = "trail-popup-trailName";

                //Create a new array to store the name(now is id)of fauna 
                //which has less 200m distance to the trail's start point
                var nameArr = new Array();
                var nameStr;
                faunaArr.forEach(function(item) {
                    if (Math.abs(item[1] - distance) < 200) {
                        nameArr.push(item[0]);
                    }
                })
                nameStr = nameArr.join(", ");

            } 
        }
    );


    hikeTracks.addTo(map);

    $("#filter-b").change(function(){
        faunaOption = $(this).val();
        alert($(this).val());
        map.removeLayer(fauna_points);
        var fauna_points2 = new L.geoJson(
            wildlife, {
        
                style: function (feature) {
                    return feature.properties && feature.properties.style;
                },
        
                filter: function (feature, layer){
                    if (faunaOption == "ALL") {
                        return true;
                    }
                    return feature.properties.species.indexOf(faunaOption) >= 0; 
                },
        
                pointToLayer: function (feature, latlng) {
                    return L.circle(latlng, {
                        radius: 26,
                        fillColor: '#ff7800',
                        color: '#000',
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).bindPopup(feature.properties.species);
                }
            }
        ).addTo(map);
    }); 

    //Make the radius options work
    $("#selectThis").change(function(){
        rad = $(this).val();
        alert($(this).val());

        map.removeLayer(hikeTracks);
        map.removeLayer(user);
        map.removeLayer(circle);
        
        user = L.marker(currentLocation).addTo(map);
        circle = L.circle(currentLocation, {
        radius: rad,
        color: 'blue'
        }).addTo(map);
        circle.bringToBack();
        user.bindPopup("Current location");
        hikeTracks = new L.geoJson(
            tracks, {

                style: function (feature) {
                    return {"color": "orange",
                    "weight": 5,
                    "opacity": 0.7};
                },

                filter: function (feature, layer){
                    var startPoint = L.latLng(feature.geometry.coordinates[0][0][1], feature.geometry.coordinates[0][0][0]);
                    var distance = currentLocation.distanceTo(startPoint);
                    return distance <= rad;
                },

                onEachFeature: function (feature, layer) {
                    var startPoint = L.latLng(feature.geometry.coordinates[0][0][1], feature.geometry.coordinates[0][0][0]);
                    var distance = currentLocation.distanceTo(startPoint);
                    var trailDes = feature.properties.ITEM_DESCRIPTION;
                    trailDes.className = "trail-popup-trailName";
    
                    //Create a new array to store the name(now is id)of fauna 
                    //which has less 200m distance to the trail's start point
                    var nameArr = new Array();
                    var nameStr;
                    faunaArr.forEach(function(item) {
                        if (Math.abs(item[1] - distance) < 200) {
                            nameArr.push(item[0]);
                        }
                    })
                    // console.log(nameArr);
                    nameStr = nameArr.join(", ");

                    
                if (!trackArr.includes(feature.properties.PARK_NAME)) {

                    console.log("yes")

                    var roadMarker = L.marker(startPoint, {icon : roadBoard}).addTo(map);

    
                    roadMarker.bindPopup("<b>Trail Description: " + trailDes + "</b><br />Park Around: " + 
                    feature.properties.PARK_NAME + "<br />Away from you: <b>" + distance.toFixed(1) + "m</b>" + 
                    "<br />Animal species nearby: " + nameStr, {
                        'className' : 'popupCustom'
                    });

                    trackArr.push(feature.properties.PARK_NAME);
                }                  

                    // layer.bindPopup(feature.properties.ITEM_DESCRIPTION + "<br />" + 
                    // feature.properties.PARK_NAME + "<br />Away from you " + distance.toFixed(1) + "m" + 
                    // "<br />Animal species nearby: ");
                }

            }
        );
        
        hikeTracks.addTo(map);
    });

    /*Drop down for each filter element*/
    $('.filter-block h4').on('click', function(){
		$(this).toggleClass('closed').siblings('.filter-content').slideToggle(300);
	})



});

/*$(document).ready(function () {

    $.ajax({
        url: "https://www.data.act.gov.au/resource/qw4j-6rbq.json",
        type: "GET",
        data: {
          "$limit" : 100,
          "$$app_token" : "PNS2CZuEMPVQFFwNDSitwanbU"
        },
        success: function (data) {
            iterateRecords(data);
        }
    }).done(function(data) {
    //   alert("Retrieved " + data.length + " records from the dataset!");
      console.log(data);
    });
});*/
