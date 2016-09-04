 console.log("CM"+JSON.stringify(placemark));

<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/kmz/geoxml3.js"></script>
<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/trunk/ProjectedOverlay.js"></script>
<script type="text/javascript">

var infowindow = new google.maps.InfoWindow();
var M = null;
var P = null;
function I() {

 M = new google.maps.Map(document.getElementById('D'), {
  center: new google.maps.LatLng(43.31,-0.36),
  zoom: 14
 });

 P = new geoXML3.parser({map:M, markerOptions: {icon:{url:'http://bus.w.pw/R.png',size:new google.maps.Size(9,9),anchor:new google.maps.Point(5,5)}}, afterParse: S, 
  createMarker: CM, suppressInfoWindows: true});
con}

function S() {
 P.showDocument(P.docs[0]);
}

function CM(placemark) {
 var marker = P.createMarker(placemark);
 google.maps.event.addListener(marker, 'click', function(E) {
  infowindow.setContent('Description : ' + placemark.description+"<br>"+'Latitude & longitude : ' + E.latLng );
  infowindow.setPosition(marker.getPosition());
  infowindow.open(M /* ,marker */);
 })
 return marker;
}
//info window
google.maps.event.addListener(marker, 'click', function(content) {
    return function(){
        infowindow.setContent(content);//set the content
        infowindow.open(map,this);
    }
}(contentString));


//infowind jsfiddle http://jsfiddle.net/doktormolle/TLs8P/
var locations = [
  ['loan 1', 33.890542, 151.274856, 'address 1'],
  ['loan 2', 33.923036, 151.259052, 'address 2'],
  ['loan 3', 34.028249, 151.157507, 'address 3'],
  ['loan 4', 33.80010128657071, 151.28747820854187, 'address 4'],
  ['loan 5', 33.950198, 151.259302, 'address 5']
  ];

  function initialize() {

    var myOptions = {
      center: new google.maps.LatLng(33.890542, 151.274856),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.ROADMAP

    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);

    setMarkers(map,locations)

  }
    
    function setText()
    {   
        $(this).text(
            ($(this).text()==='Add') 
                ? 'Remove'
                : 'Add'
         );
        
    }



  function setMarkers(map,locations){

      var marker, i,content = $('<div>Add</div>').click(setText).css({cursor:'pointer',width:'40px'}),
          infowindow = new google.maps.InfoWindow();
    for (i = 0; i < locations.length; i++)
     {  

     var loan = locations[i][0]
     var lat = locations[i][1]
     var long = locations[i][2]
     var add =  locations[i][3]

     latlngset = new google.maps.LatLng(lat, long);

      var marker = new google.maps.Marker({  
              map: map, title: loan , position: latlngset ,
          content:content.clone(true)[0]
            });
            map.setCenter(marker.getPosition())


       

      

    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
            return function() {
               infowindow.setContent(marker.content);
               infowindow.open(map,marker);
            };
        })(marker,content,infowindow)); 

    }
  }



function showAddress(address) {
    var contentString = address+"<br>Outside Area";

    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
	  var point = results[0].geometry.location;
          contentString += "<br>"+point;
          map.setCenter(point);
          if (marker && marker.setMap) marker.setMap(null);
          marker = new google.maps.Marker({
              map: map, 
              position: point
          });
        for (var i=0; i<geoXml.docs[0].gpolygons.length; i++) {
          if (geoXml.docs[0].gpolygons[i].Contains(point)) {
            contentString = address+"<br>"+geoXml.docs[0].placemarks[i].name;
	    contentString += "<br>"+point+"<br>polygon#"+i;
            i = 999; // Jump out of loop
          }
        }
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    google.maps.event.trigger(marker,"click");
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}
