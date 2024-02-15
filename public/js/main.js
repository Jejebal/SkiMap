/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : /public/js/main.js
 * Authors      : Jérémy Ballanfat
 * Date         : 2 Février 2024
 */

let donnees = document.getElementById("donnees").textContent;
donnees = JSON.parse(donnees);

let carte = L.map("carte").setView([46.090216531417134, 7.23228256554322], 13);
let marker;
//maxZoom: 21
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {

    maxZoom: 19,
    attribution: "&copy; <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>"

}).addTo(carte);

getStationLayout(donnees, carte);

//carte.on('zoomend', function () {

//    if(carte.getZoom() <= 11){

//        getDomaineLayout(donnees, carte);

//    }
//    else{

//        getStationLayout(donnees, carte);

//    }

//});

function getDomaineLayout(donnees, carte){

    let pointPolygon = []

        donnees.forEach(domaine => {

            domaine.stations.forEach(station => {
        
                station.points.forEach(point => {
                    pointPolygon.push([point.latitude, point.longitude]);
                });
                
            });
            
        });

        let polygon = L.polygon(pointPolygon).addTo(carte).bindPopup("Station " + station.nomStation);

        polygon.setStyle({fillColor: "#" + Math.floor(Math.random() * 16777215).toString(16)});

}

function getStationLayout(donnees, carte){

    console.log(donnees);

    donnees.forEach(domaine => {

        domaine.stations.forEach(station => {
    
            let pointPolygon = []
    
            station.points.forEach(point => {
                pointPolygon.push([point.latitude, point.longitude]);
            });
    
            let polygon = L.polygon(pointPolygon).addTo(carte).bindPopup("Station " + station.nomStation);
    
            polygon.setStyle({fillColor: "#" + Math.floor(Math.random() * 16777215).toString(16)});
            
        });
        
    });

}

/**
 * 
 * Permet de créer a chaque clique un marker avec une pop up indiquant la longitude et l'attitude du point.
 * 
 */
function carteClick(e){

    marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(carte);

    marker.bindPopup("This pop up is at " + e.latlng).openPopup();

}

carte.on("click", carteClick);