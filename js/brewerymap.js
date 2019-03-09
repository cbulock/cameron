function initMap() {
	let openMarkers = [];

	const breweries = JSON.parse($("#brewery-data").html());

	const michigan = { lat: 44.331038, lng: -84.742330 };

	// The map, centered on Michigan
	const map = new google.maps.Map(
		document.getElementById('map'), { zoom: 6.5, center: michigan }
	);

	breweries.map((brewery) => {
		// Content to display in the marker popup
		const logoText = brewery.logo_url ? "<img class='logo' src='" + brewery.logo_url + "'/>" : ''; 
		const sampledText = brewery.sampled ? "<div class='yes'>&check;</div>" : "<div class='no'>&cross;</div>";
		const visitedText = brewery.visited ? "<div class='yes'>&check;</div>" : "<div class='no'>&cross;</div>";
		const touredText = brewery.toured ? "<div class='yes'>&check;</div>" : "<div class='no'>&cross;</div>";
		
		let contentString = "<h1>" + brewery.name + "</h1>" +
		logoText +
		"<p>" + brewery.address + "</p>" +
		"<div class='chart'>" +
		"<div class='titles'><div>Sampled</div><div>Visited</div><div>Toured</div></div>" +
		"<div class='response'><div>" +
			sampledText +
		"</div><div>" +
			visitedText +
		"</div><div>" +
			touredText +
		"</div></div></div>";

		let color = 'red';
		// Pin to use
		if (brewery.sampled) color = 'yellow';
		if (brewery.visited) color = 'green';

		addMarker(brewery, contentString, color);
	});

	function addMarker(brewery, content, color) {
		let infowindow = new google.maps.InfoWindow({
			content: content
		});
		let icon = "https://maps.google.com/mapfiles/ms/icons/" + color + ".png";
		let location = { lat: brewery.latitude, lng: brewery.longitude };
		let marker = new google.maps.Marker({
			position: location,
			icon: {
				url: icon
			},
			map: map
		});
		marker.addListener('click', function () {
			let currentMarker = openMarkers.pop();
			if (currentMarker) currentMarker.close();
			infowindow.open(map, marker);
			//$('.logo').attr('src', brewery.logo_url);
			openMarkers.push(infowindow);
		});
	}

}
