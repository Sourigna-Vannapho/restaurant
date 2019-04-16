class Carte{
	constructor(longitude,latitude,zoom,maxZoomTile){
	this.longitude = longitude
	this.latitude = latitude
	this.zoom = zoom
	this.maxZoomTile = maxZoomTile
	}

	definitionMap(mapIdHTML){
		return L.map(mapIdHTML,{scrollWheelZoom:false}).setView([this.longitude,this.latitude],this.zoom);
}
	tileLayerCreation(apiKey){
		return L.tileLayer(`https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=${apiKey}`, {
	maxZoom: this.maxZoomTile,
	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	id: 'mapbox.streets'
	});
}}