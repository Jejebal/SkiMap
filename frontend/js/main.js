/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : frontend/index.html
 * Authors      : Jérémy Ballanfat
 * Date         : 2 Février 2024
 */

let carte = L.map("carte").setView([46.170245, 6.119510], 13);
let marker;
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {

    maxZoom: 19,
    attribution: "&copy; <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>"

}).addTo(carte);

/**
 * 
 * Permet de créer a chaque clique un marker avec une pop up indiquant la longitude et l'attitude du point.
 * 
 */
function carteClick(e){

    marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(carte);

    marker.bindPopup("This pop up is at " + e.latlng).openPopup();

}