var creationMap = new Carte(48.624094, 2.568, 17,18)
var carteLyon = creationMap.definitionMap('mapid');
carteLyon.dragging.disable();
creationMap.tileLayerCreation("pk.eyJ1Ijoic291cmlnbmEiLCJhIjoiY2pxYjVkZXc5MTZrcjN3cWc5MGM1enNhbyJ9.VM4GaHpgohWluWxAeEXVLw").addTo(carteLyon)
var marker = L.marker([48.624094, 2.565726]).addTo(carteLyon);
