//<![CDATA[
    var map;
    var geocoder;

	// Added by Moyo 5/23/08 11:52 am
	//var sidebar1 = document.getElementById('sidebar');
    //sidebar1.innerHTML = '';
    //if (markers.length == 0) {
		//sidebar1.innerHTML = '<h1>Enter Your Address or Zip Code Above.</h2>';
	//}
	
    function load() {
      if (GBrowserIsCompatible()) {
        geocoder = new GClientGeocoder();
        map = new GMap2(document.getElementById('map'));
        map.addControl(new GSmallMapControl());
		//map.addControl(new GLargeMapControl); //11/29/08 1:19am Moyo
        map.addControl(new GMapTypeControl());
		geocoder.getLatLng(sl_google_map_country, function(latlng) {
			map.setCenter(latlng, 4);
		});
      }
    }

   function searchLocations() {
     var address = document.getElementById('addressInput').value;
     geocoder.getLatLng(address, function(latlng) {
       if (!latlng) {
         alert(address + ' not found');
       } else {
         searchLocationsNear(latlng, address); // address param added by Moyo 5/23/08
       }
     });
   }

   function searchLocationsNear(center, homeAddress) { // homeAddress param added by Moyo 5/23/08
     var radius = document.getElementById('radiusSelect').value;
	 var searchUrl = add_base + '/generate-xml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
     GDownloadUrl(searchUrl, function(data) {
       var xml = GXml.parse(data);
       var markers = xml.documentElement.getElementsByTagName('marker');
       map.clearOverlays();
	   
	    //marker for searched location - Moyo Aluko: 5/14/08, 4 am
	   var theIcon = new GIcon(G_DEFAULT_ICON);
		theIcon.image = sl_map_home_icon;
		if (sl_map_home_icon.indexOf('flag')!='-1') {theIcon.shadow = add_base + "/icons/flag_shadow.png";}
		else if (sl_map_home_icon.indexOf('arrow')!='-1') {theIcon.shadow = add_base + "/icons/arrow_shadow.png";}
		else {theIcon.shadow = add_base + "/icons/shadow.png";}
		//theIcon.iconSize = new GSize(30,30);
		//theIcon.shadowSize = new GSize(30,30);
		
		markerOpts = { icon:theIcon };
		point = new GLatLng (center.lat(), center.lng());
		var homeMarker = new GMarker(point, markerOpts);
      var html = '<b>Your Location:</b> <br/>' + homeAddress;
      GEvent.addListener(homeMarker, 'click', function() {
        homeMarker.openInfoWindowHtml(html);
      });
      map.addOverlay(homeMarker);
	  //end marker for searched location

       var sidebar = document.getElementById('map_sidebar');
       sidebar.innerHTML = '';
       if (markers.length == 0) {
         sidebar.innerHTML = '<div style="padding:10px"><h2>No results found.</h3></div>';
         map.setCenter(new GLatLng(40, -100), 4);
         return;
       }
	   
       var bounds = new GLatLngBounds();
       for (var i = 0; i < markers.length; i++) {
         var name = markers[i].getAttribute('name');
         var address = markers[i].getAttribute('address');
         var distance = parseFloat(markers[i].getAttribute('distance'));
         var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                                 parseFloat(markers[i].getAttribute('lng')));
		 var description = markers[i].getAttribute('description');
		 var url = markers[i].getAttribute('url');
		 var hours = markers[i].getAttribute('hours');
		 var phone = markers[i].getAttribute('phone');
		 var image = markers[i].getAttribute('image');
         
         var marker = createMarker(point, name, address, homeAddress, description, url, hours, phone, image); // homeAddress param added by Moyo 5/23/08 **description through image added 12/2/08 by Moyo
         map.addOverlay(marker);
         var sidebarEntry = createSidebarEntry(marker, name, address, distance, homeAddress); // homeAddress param added by Moyo 5/23/08
         sidebar.appendChild(sidebarEntry);
         bounds.extend(point);
       }
	  map.setCenter(bounds.getCenter(), (map.getBoundsZoomLevel(bounds)-0)); //8/28/08: -1 to zoom out one step
	 });
	  // var adsOptions = new GAdsManagerOptions(5, "", 6);
		//if (adsManager==null) {
	 /* var ads_opts = { 
          maxAdsOnMap:5, 
          channel:5427909518, 
        }; 
        var adsManager = new GAdsManager(map, "pub-2683936843555589", ads_opts); 
        adsManager.enable(); */
	  
	  //adsManager = new GAdsManager(map, "ca-pub-2683936843555589", {maxAdsOnMap:5, channel:5427909518, minZoomLevel:2});
	  //adsManager.enable();
	   //}
   }

    function createMarker(point, name, address, homeAddress, description, url, hours, phone, image) { // homeAddress param added by Moyo 5/23/08
	
	  var theIcon = new GIcon(G_DEFAULT_ICON);
	  theIcon.image = sl_map_end_icon;
	  //theIcon.image = add_base + "/icons/red_flag1.png";
	    if (sl_map_end_icon.indexOf('flag')!='-1') {theIcon.shadow = add_base + "/icons/flag_shadow.png";}
		else if (sl_map_end_icon.indexOf('arrow')!='-1') {theIcon.shadow = add_base + "/icons/arrow_shadow.png";}
		else {theIcon.shadow = add_base + "/icons/shadow.png";}
	  //theIcon.iconSize = new GSize(30,30);
	  //theIcon.shadowSize = new GSize(30,30);
	  markerOpts = { icon:theIcon };
      var marker = new GMarker(point, markerOpts);
	  
	  var more_html="";
	  if (image.indexOf(".")!=-1) {more_html+="<br><img src='"+image+"' style='max-width:250px; border:none'>"} else {image=""}
	  if (description!="") {more_html+="<br><div style='width:250px'>"+description+"</div>";} else {description=""}
	  if (hours!="") {more_html+="<br><b>Hours:</b> "+hours;} else {hours=""}
	  if (phone!="") {more_html+="<br><b>Phone:</b> "+phone;} else {phone=""}
	  if (url.indexOf("http://")!=-1 && url.indexOf(".")!=-1) {more_html+="<br><a href='"+url+"' target='_blank' class='storelocatorlink'>Visit Website &raquo;</a>"} else {url=""}
	  
      var html = '<span style="color:black"><h2>' + name + '</h2>' + address + '</span><br/> <a href="http://maps.google.com/maps?q=' + homeAddress + ' to ' + address + '" target="_blank" class="storelocatorlink">Get Directions to Here</a><br>' + more_html; // Get Directions link added by Moyo 5/23/08
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }

	var resultsDisplayed=0;
	var bgcol="white";
    function createSidebarEntry(marker, name, address, distance, homeAddress) { // homeAddress param added by Moyo 5/23/08
	document.getElementById('map_sidebar_td').style.display='block';
      var div = document.createElement('div');
      var html = '<center><table width="95%" cellpadding="7px"><tr><td width="35%" style="padding-right:4px"><b>' + name + '</b> (' + distance.toFixed(1) + ' mi.) </td><td width="55%">' + address + ' </td><td width="10%"><a href="http://maps.google.com/maps?q=' + homeAddress + ' to ' + address + '" target="_blank" class="storelocatorlink">Directions</a></td></tr></table></center>'; // Get Directions link added by Moyo 5/23/08
      /*if (resultsDisplayed==0) {
		div.innerHTML = "<table><tr><td>";
	  }*/
	  div.innerHTML = html;
      div.style.cursor = 'pointer';
      div.style.padding = '4px';
	  div.style.color = 'black'; //added by Moyo 11/2/08 10:43am
	  div.style.borderBottom = 'solid silver 1px' ; // added by Moyo 5/23/08 11:23am
	  div.style.backgroundColor = bgcol; //added 12/2/2208
	  resultsDisplayed++;
      GEvent.addDomListener(div, 'click', function() {
        GEvent.trigger(marker, 'click');
      });
      GEvent.addDomListener(div, 'mouseover', function() {
        div.style.backgroundColor = 'salmon';
      });
      GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#fff';
      });
	  if (bgcol=="white") {bgcol="#dddddd";} else {bgcol="white";}	  
      return div;
    }
    //]]>

	//document.onload=load();
//	document.onunload=GUnload();