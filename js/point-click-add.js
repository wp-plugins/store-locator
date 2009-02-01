	var map;
    var geocoder;
    var address;

    function initialize() {
      map = new GMap2(document.getElementById("map_canvas"));
      map.addControl(new GLargeMapControl);
      GEvent.addListener(map, "click", getAddress);
      geocoder = new GClientGeocoder();
	  geocoder.getLatLng(sl_google_map_country, function(latlng) {
			map.setCenter(latlng, 7);
		});
    }
    
    function getAddress(overlay, latlng) {
      if (latlng != null) {
        address = latlng;
        geocoder.getLocations(latlng, showAddress);
      }
    }

	function showAddress(response) {
      map.clearOverlays();
      if (!response || response.Status.code != 200) {
        alert("Status Code:" + response.Status.code);
      } else {
        place = response.Placemark[0];
        point = new GLatLng(place.Point.coordinates[1],
                            place.Point.coordinates[0]);
        marker = new GMarker(point);
        map.addOverlay(marker);
        marker.openInfoWindowHtml(
        '<b>latlng:</b>' + place.Point.coordinates[1] + "," + place.Point.coordinates[0] + '<br>' +
        '<b>Status Code:</b>' + response.Status.code + '<br>' +
        '<b>Address:</b>' + place.address + '<br>' +
        '<b>Country code:</b>' + place.AddressDetails.Country.CountryNameCode +
		'<form name="pcaForm" method="get">' +
		'<input type=hidden name="page" value="' + sl_dir + '/add-locations.php"' +
		'<input type=hidden name="mode" value="pca"' +
		'<input type=hidden name="step" value="1"' +
		'<input type=hidden name="lat" value="' + place.Point.coordinates[1] + '"' +
		'<input type=hidden name="lng" value="' + place.Point.coordinates[0] + '"' +
		'<input type=hidden name="address" value="' + place.address + '"' +
		'<b>Enter Location\'s Name:</b>&nbsp;<input name="name" ><br>' +
		'<input type="submit" class="button" value="Add This Location"></form>' +
		'<div name="ajaxMsg"></div>');
      }
    }
	
	function pcaSubmit(formObj) {
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null){
			alert ("Browser does not support HTTP Request");
			return false;
		} 
		var url=add_base + "/add-locations.php";
		url = url + "?mode=pca";
		for (i=0; i<formObj.elements.length; i++) {
			url = url + "&" + formObj.elements[i].name + "=" + formObj.elements[i].value;
		}
		alert(url);
		//xmlHttp.onreadystatechange=stateChanged;
		//xmlHttp.open("GET",url,true);
		//xmlHttp.send(null);
	}
		
	//function written by Moyo 11/13/08 per request
	function centerMap(address) {
		geocoder.getLatLng(address, function(latlng) {
       if (!latlng) {
         alert(address + ' not found');
       } else {
          map.setCenter(new GLatLng(latlng.lat(),latlng.lng(),10));
       }
     });
	}