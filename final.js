var polyline = L.polyline(latlngs, {color: 'green'}).addTo(map);
// zoom the map to the polyline
map.fitBounds(polyline.getBounds());

// add an OpenStreetMap tile layer
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'Política e privacidade da <a href="https://busplays.com.br/politica-e-privacidade/" target="new_blank">Bus Plays</a><br>&copy; Contribuidores do <a href="http://osm.org/copyright" target="new_blank">OpenStreetMap</a>'
}).addTo(map);