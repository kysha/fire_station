<script type="text/javascript">
    $(document).ready(function () {
        var substation_data;
        var sortable;
        var geoXml=null;
        var map;
        var markers = [];
        var sub_markers = [];
        var geocoder = new google.maps.Geocoder();
        var num = 0;    
        var substation_InfoWindow;
        var infowindow;
        var strictBounds;
        var contentString1;

        getStationInfo();
        cloning();
        /**** SIDE MENU *****/
        // function listbarangay(){
        //     var brgy={
        //             brgy_name : $("[name=locationmodal]").val()
        //         };
        //     $.post("<?php echo base_url('api/c_logs/listsuggest')?>",brgy,function(response){
        //         $("#dlbarangay").empty();
        //         var data = jQuery.parseJSON(response);
        //         var dataList = document.getElementById("dlbarangay");
        //         if(!data["error"].length){
        //             for (var x = 0; x < data.data.length; x++){
        //                 var option = document.createElement("option");
        //                 option.value = data["data"][x]["brgy_name"];
        //                 dataList.appendChild(option);
        //             }
        //         }
        //     });
        // }
        $("#addFireAlert").click(function(){
            cloning(1);
        }); 
        $("#accordion").on("click", ".addStation", function () {
            var newStation=addStation();
            $(this).parent().parent().find(".stationContainer").append(newStation);
        });
        function addStation(){
            var cloned=$(".respSubstation").clone();
            cloned.find(".dateTime-picker").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            cloned.removeClass("respSubstation").show();
            return cloned;            
        }
        function cloning(flag){
            num+=1;
            var cloned=$("#dataFireAlert").clone();
            var dateNow = new Date();
            if (flag)
            cloned.find(".collapse").removeClass("in");

            cloned.find(".accordion-toggle").attr("href",  "#" + num);
            cloned.find(".panel-collapse").attr("id", num);
            cloned.find("#Type1").attr("checked");
            console.log("Cloning");
            console.log(cloned.find("#Type1").val());
            

            cloned.find(".tab1").attr("href","#pane"+num+"1");
            cloned.find(".tab2").attr("href","#pane"+num+"2");
            cloned.find(".pane1").attr("id","pane"+num+"1");
            cloned.find(".pane2").attr("id","pane"+num+"2");
            var newStation=addStation();
            cloned.find(".dateTime-picker").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            cloned.find(".stationContainer").append(newStation);
            cloned.show();
            cloned.removeAttr("id");
            $("#accordion").append(cloned.fadeIn());            
        }

        $("#accordion").on("click", "#delAlert", function () {
            var myWindow = window.open('','','width=200,height=100')
            myWindow.document.write("This is 'myWindow'")
            myWindow.print();
        });
        $("#accordion").on("click", "#deleteAlert", function () {
            $(this).parent().parent().parent().remove();
        });
	    $('.icon-menu').click(function() {
    	    $('.menu').animate({
    	      right: "0px"
    	    }, 200);
    	    $('#googleMap').animate({
    	      left: "-350px"
    	    }, 200);
	    });
	    $('.icon-close').click(function() {
    	    $('.menu').animate({
    	      right: "-350px"
    	    }, 200);
    	    $('#googleMap').animate({
    	      left: "0px"
    	    }, 200);
	   });
        $("#accordion").on("click", ".getDateTime", function () {
            var changeDateTime= moment().format('YYYY-MM-DD HH:mm:ss');
            $(this).parent().parent().find('input').val(changeDateTime);
        });
        $("#accordion").on("click", ".getTime", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            console.log("respone");
            console.log("panelId:"+panelId);
            var notification=moment($("#"+panelId).find("#notification").val());
            var arrival;
            var prevresponse;
            var response;
            $("#"+panelId+" .arrival-input").each(function() {
                console.log("ARRIVAL EACH: "+$(this).val())
                   if ($(this).val().trim()){
                        arrival=moment($(this).val());
                        response=arrival.diff(notification);
                        if (prevresponse<response){
                            response=prevresponse;
                        }
                        prevresponse=response;
                   }
            })
            // var responseSec=response/1000;
            // console.log(moment({seconds :responseSec}).format("HH:mm:ss"));
            // console.log(moment.duration(response, "milliseconds").format("HH:mm:ss"));
            var d = moment.duration(response);
            // console.log(d.days()+"days" +d.hours()+":"+d.minutes()+":"+d.seconds());
           $(this).parent().parent().find('input').val(d.hours()+":"+d.minutes()+":"+d.seconds());
        });
        $("#accordion").on("click", "#createLog", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            var address = $("#"+panelId).find("#address").val().split(",");
            var fire_log={
                notifType: $("#"+panelId).find("#notifType").val(),
                notifName: $("#"+panelId).find("#notifName").val(),
                deviceId: $("#"+panelId).find("#deviceId").val(),
                latitude: $("#"+panelId).find("#latitude").val(),
                longitude: $("#"+panelId).find("#longitude").val(),
                address: address[0],
                barangay: $("#"+panelId).find("#barangay").attr("brgyId"),
                category: $("#"+panelId).find("#category").val(),                    
                notification: $("#"+panelId).find("#notification").val(),
                response: $("#"+panelId).find("#response").val(),
                fireOut: $("#"+panelId).find("#fireOut").val(),
                substation: $("#"+panelId).find("#substation").val(),
                arrival: $("#"+panelId).find("#arrival").val()
            };
            console.log("ipada");
            console.log(fire_log);
            // $("#"+panelId).find("input").parent().removeClass('has-error');       
            // $("#"+panelId).find(".error-message").addClass('hidden').text("");       

            // var request = $.post("<?=base_url('api/c_logs/createLog')?>",fire_log);
            // request.done(function (response){
            //     var data = jQuery.parseJSON(response);
            //     console.log(data);
            //             if(!data["error"].length){ 
            //                 console.log("walay error");                      
            //             }
            //             else{
            //                 $.each(data.error[0].message, function(index,value){
            //                     if (index) {};
            //                     $("#"+panelId).find("#"+index).parent().addClass('has-error');       
            //                     $("#"+panelId).find("."+index).removeClass('hidden').text(value);
            //                   // console.log("ERRORS");
            //                   // console.log(index);
            //                   // console.log(value);
            //                 });
            //                 // $('.alert').removeClass('hidden');
            //             }

            // });
        });
        /**** END SIDE MENU ****/

        /**** GOOGLE MAP ACTIONS****/
        // $("#accordion").on("click", "#spbtn", function () {
        //             var mark = markers[1]; 
        //     infowindow.open(map,mark);
        // });
        // $( "#notifType" ).change(function() {
        //     console.log("radio");
        //     console.log(this.value);
        // });
        $("#accordion").on("change", "#notifType", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            if (this.value!="Device") {
                $("#"+panelId).find("#deviceId").val("").parent().hide();
                $("#"+panelId).find("#latitude").val("").parent().hide();
                $("#"+panelId).find("#longitude").val("").parent().hide();
                $("#"+panelId).find("#notifName").parent().removeClass("hidden");
            }
            else{
                $("#"+panelId).find("#deviceId").parent().show();
                $("#"+panelId).find("#latitude").parent().show();
                $("#"+panelId).find("#longitude").parent().show();
                $("#"+panelId).find("#notifName").val("").parent().addClass("hidden");
            }
        });
        $("#accordion").on("click", "#addressBTN", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            var deviceId= $("#"+panelId).find("#deviceId").val().trim();
            var lat = $("#"+panelId).find("#latitude").val().trim();
            var lng = $("#"+panelId).find("#longitude").val().trim();

            if (lat!="" && lng!=""){
                var firealert = new google.maps.LatLng(lat, lng);
                if (strictBounds.contains(firealert)) {
                    var mark = markers[panelId]; 
                    var contentString;
                    if(mark)
                        mark.setMap(null);

                    getBarangay(firealert,deviceId,panelId,lat,lng);
                    getNearestStation(firealert);
                }
                else{
                    alert("The given coordinates are outside Cebu City!");
                }
            }
            else
                alert("Latitude or Longitude Field is Empty");
        });
        /**** END GOOGLE MAP ACTIONS****/

        /**** INITIALIZE MAP *****/
        function initialize() {
            var LatLng = new google.maps.LatLng(10.30, 123.89);
            map = new google.maps.Map(document.getElementById('googleMap'), {
                maxZoom:19,
                minZoom:13,
                zoom: 13,
                center: LatLng,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });
            //singleInfoWindow: true
            // suppressInfoWindows:true
            //,createMarker:CM
            //,suppressInfoWindows:true,createMarker:CM
            geoXml = new geoXML3.parser({map: map,singleInfoWindow: false,suppressInfoWindows:true,createMarker:createMarkers});
            geoXml.parse('../fire_station/assets/kml/Official_Cebu_City_Barangay_Transparent.kml');
            
            strictBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(10.20, 123.76),
                new google.maps.LatLng(10.41, 124.01)
            );
            google.maps.event.addListener(map, 'dragend', function ()
            {
                if (strictBounds.contains(map.getCenter())){
                    zoom = 12;
                    return;
                }
                 var c = map.getCenter(),
                     x = c.lng(),
                     y = c.lat(),
                     maxX = strictBounds.getNorthEast().lng(),
                     maxY = strictBounds.getNorthEast().lat(),
                     minX = strictBounds.getSouthWest().lng(),
                     minY = strictBounds.getSouthWest().lat();

                 if (x < minX) x = minX;
                 if (x > maxX) x = maxX;
                 if (y < minY) y = minY;
                 if (y > maxY) y = maxY;

                 map.setCenter(new google.maps.LatLng(y, x));
            });
        }
        function getDevice(firealert,deviceId,panelId,lat,lng,brgy_contacts,brgy_id,brgy_name){
                    var name;
                    var contacts = [];
                    console.log("MIDDLE2");
                    var request = $.post("<?=base_url('api/c_home/retrieveDeviceInfo')?>",{retrieve_type:1,deviceId: deviceId});
                    request.done(function(response){
                        var data = jQuery.parseJSON(response);
                        console.log("Device");
                        console.log(data);
                        if(!data["error"].length){
                            console.log("sulod sa device");                        
                            for (var x = 0; x < data.data.length; x++) {
                                name=data["data"][x]["user_name"];
                                contacts.push("</br>"+data["data"][x]["contact"]);
                            }
                            var contentString = '<div id="content">'+
                              '<div id="bodyContent">'+
                              '<p><b>Device ID: </b>'+ deviceId + 
                              '</br><b>Name: </b>' + data["data"][0]["lastname"] + ", "+ data["data"][0]["firstname"] +
                              '</br><b>Contact Number/s: </b>' + contacts.toString() +
                              '</br><b>Barangay Name: </b>' + brgy_name +
                              '</br><b>Contact Number/s: </b>' + brgy_contacts.toString() +
                              '</p>'+
                              '</div>'+
                              '</div>';

                             infowindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            var image = {
                                url: 'assets/image/fire.png',
                                size: new google.maps.Size(43, 68),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(35, 35)
                            };
                            var marker = new google.maps.Marker({
                                id: panelId,
                                position: firealert,
                                animation: google.maps.Animation.DROP,
                                icon: image,
                                map: map,
                                title: "Coordinates: " + lat + " , " + lng 
                            });
                            infowindow.open(map, marker);                    
                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });
                            console.log("4th");
                            markers[panelId]=marker;            
                            geocoder.geocode({ 
                                latLng: firealert
                            }, 
                            function(responses){     
                                if (responses && responses.length > 0){
                                    $("#"+panelId).find("#address").val(responses[0].formatted_address);       
                                    var add= responses[0].formatted_address.split(",");
                                    $("#"+panelId).find("#address").val(add[0]);       
                                    $("#"+panelId).find("#barangay").val(brgy_name);       
                                    $("#"+panelId).find("#barangay").attr("brgyId",brgy_id);       
                                 }
                                else{
                                    $("#"+panelId).find("#address").val("Not getting any address");
                                }
                            });
                        }
                        else{
                            console.log("wa sa device");
                            // $.each(data.error[0].message, function(index,value){
                            //     $("#"+panelId).find("#"+index).parent().addClass('has-error');       
                            //     $("#"+panelId).find("."+index).removeClass('hidden').text(value);       
                            // });                            
                        }
                    });             
        }
//        function getBarangay(firealert,deviceId,panelId,lat,lng){
        function getBarangay(firealert,panelId,basic_info){
            var Barangay;
            for (var i=0; i<geoXml.docs[0].gpolygons.length; i++) {
                if (google.maps.geometry.poly.containsLocation(firealert, geoXml.docs[0].gpolygons[i])) {
                    Barangay= geoXml.docs[0].placemarks[i].name;
                    console.log("PLACE: "+Barangay);
                    break;
                }
            }
            console.log("getBarangay: "+Barangay);
            var request = $.post("<?=base_url('api/c_home/retrieveBarangayInfo')?>",{retrieve_type:1,barangayName: Barangay});
            request.done(function(response){
                data = jQuery.parseJSON(response);
                var contacts=[];
                var barangay_id;
                if(!data["error"].length){
                
                    for (var x = 0; x < data.data.length; x++) {
                        barangay_id=data["data"][x]["pk_brgy"];
                        contacts.push("</br>"+data["data"][x]["contact"]);
                    }
                    var contentString = '<div id="content">'+
                      '<div id="bodyContent">'+
                      '<p><b>Device ID: </b>'+ deviceId + 
                      '</br><b>Name: </b>' + data["data"][0]["lastname"] + ", "+ data["data"][0]["firstname"] +
                      '</br><b>Contact Number/s: </b>' + contacts.toString() +
                      '</p>'+
                      '</div>'+
                      '</div>';
                }
                // getDevice(firealert,deviceId,panelId,lat,lng,contacts,barangay_id,Barangay);

                // getDevice(firealert,panelId,basic_info,contacts,barangay_id,Barangay);
            }); 

        }

        /********************************************
        Gets Cebu City Fire Station's Contact Numbers
        *********************************************/
        function getStationInfo(){
            var request = $.post("<?=base_url('api/c_substation/retrieveContacts')?>");
            request.done(function(response){
                substation_data = jQuery.parseJSON(response);
                initialize();
            }); 
        }
        function createMarkers(placemark){
            var sub_id;
            var contacts=[];
            if(!substation_data["error"].length){
                for (var x = 0; x < substation_data.data.length; x++) {
                    if (substation_data["data"][x]["substn_name"]==placemark.name) {
                        sub_id=substation_data["data"][x]["pk_substn"];
                        contacts.push("</br>"+substation_data["data"][x]["contact"]);                
                        if ((x+1)!=substation_data.data.length && substation_data["data"][x+1]["substn_name"]!=placemark.name)
                            break;
                    }
                }
            }
            placemark.id=sub_id;
//            google.maps.Animation.BOUNCE;
            var substation_marker = geoXml.createMarker(placemark);
            var infowindow1 = new google.maps.InfoWindow();
            google.maps.event.addListener(substation_marker, 'mouseover', function(E) {
                substation_marker.setAnimation(google.maps.Animation.BOUNCE);
             });
            google.maps.event.addListener(substation_marker, 'click', function(E) {
                substation_marker.setAnimation(null);
                infowindow1.setContent('Substation ID: '+ sub_id + '</br>Substation Name:' + placemark.name+'</br>Contact Numbers: ' + contacts.toString());
                infowindow1.setPosition(substation_marker.getPosition());
                infowindow1.open(map  ,substation_marker );
             });

            sub_markers[sub_id]=substation_marker;
            return substation_marker;
        }
        /********************************************
        Get Nearest Fire Station from Fire Scene
        *********************************************/        
        function getNearestStation(firealert){
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [geoXml.docs[0].placemarks[80].marker.getPosition(),
                    geoXml.docs[0].placemarks[81].marker.getPosition(),
                    geoXml.docs[0].placemarks[82].marker.getPosition(),
                    geoXml.docs[0].placemarks[83].marker.getPosition(),
                    geoXml.docs[0].placemarks[84].marker.getPosition(),
                    geoXml.docs[0].placemarks[85].marker.getPosition(),
                    geoXml.docs[0].placemarks[86].marker.getPosition(),
                    geoXml.docs[0].placemarks[87].marker.getPosition(),
                    geoXml.docs[0].placemarks[88].marker.getPosition()
                ],
                destinations: [firealert],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
                durationInTraffic: false
            }, callback);
        }
        function callback(response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                console.log('DistanceMatrix Error: ', status);
            } 
            else{
                var origins = response.originAddresses;
                var destinations = response.destinationAddresses;
                sortable = [];
                    for (var i = 0; i < origins.length; i++) {
                        var results = response.rows[i].elements;
                        for (var j = 0; j < results.length; j++) {
                            var element = results[j];
                            var distance = element.distance.text;
                            var duration = element.duration.text;
                            var from = origins[i];
                            var to = destinations[j];
                            sortable.push([origins[i], element.distance.value,(80+i)]);
                        }
                    }
                sortable.sort(function (a, b) {
                    return a[1] - b[1];
                });                
                for (var i = 0; i < 3; i++) {
                    var stationId=(sortable[i][2])%80;
                    google.maps.event.trigger(sub_markers[stationId+1], 'mouseover');
                }
                console.log("click");
            } 
        }
        function StationInfo(){
            console.log("trial");
                    for (var i = 0; i < 3; i++) {
                        var stationId=(sortable[i][2])%80;
                        google.maps.event.trigger(sub_markers[stationId+1], 'click');
                    }
        }
        function useTheData(doc) {
          for (var i = 0; i < doc[0].placemarks.length; i++) {
            console.log("poly:"+doc[0].placemarks[i].polygon);
            console.log("marker:"+ doc[0].placemarks[i].marker);
            console.log("polyline:"+ doc[0].placemarks[i].polyline);
            var placemark = doc[0].placemarks[i].polygon || doc[0].placemarks[i].marker || doc[0].placemarks[i].polyline;
            console.log("placemark: "+ placemark);
            console.log("placemarks: "+doc[0].placemarks[i]);
            console.log("Name:"+doc[0].placemarks[i].name);
            bindPlacemark(placemark, doc[0].placemarks[i].name);
          }
        };
        /**** END INITIALIZE MAP *****/
    });    





    function initialize() 
    {
          myLatLng = new google.maps.LatLng(37.422104808,-122.0838851);
          var test;
          var lat = 37.422104808;
          var lng = -122.0838851;
          var zoom = 18;
          var maptype = google.maps.MapTypeId.ROADMAP;
          if (!isNaN(lat) && !isNaN(lng)) 
          {
                myLatLng = new google.maps.LatLng(lat, lng);
           }
                var myOptions = {zoom: zoom,center: myLatLng,mapTypeId: maptype};
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);        
                infowindow = new google.maps.InfoWindow({}); 
                geoXml = new geoXML3.parser({map: map,infoWindow: infowindow,singleInfoWindow: true,zoom: myGeoXml3Zoom, markerOptions: {optimized: false},createMarker: createMarker});
                geoXml.parse('test.kml');             
    };




    var createMarker = function (placemark, doc) {

        var markerOptions = geoXML3.combineOptions(geoXml.options.markerOptions, {
          map:      geoXml.options.map,
          position: new google.maps.LatLng(placemark.Point.coordinates[0].lat, placemark.Point.coordinates[0].lng),
          title:    placemark.name,
         zIndex:   Math.round(placemark.Point.coordinates[0].lat * -100000)<<5,
         icon:     placemark.style.icon,
         shadow:   placemark.style.shadow 
        });

        // Create the marker on the map
        var marker = new google.maps.Marker(markerOptions);
        if (!!doc) {
        doc.markers.push(marker);
        }

        // Set up and create the infowindow if it is not suppressed
        if (!geoXml.options.suppressInfoWindows) {
          var infoWindowOptions = geoXML3.combineOptions(geoXml.options.infoWindowOptions, {
            content: '<div class="geoxml3_infowindow"><h3>' + placemark.name + 
                     '</h3><div>' + placemark.description + '</div></div>',
            pixelOffset: new google.maps.Size(0, 2)
          });
          if (geoXml.options.infoWindow) {
            marker.infoWindow = geoXml.options.infoWindow;
          } else {
            marker.infoWindow = new google.maps.InfoWindow(infoWindowOptions);
          }
          marker.infoWindowOptions = infoWindowOptions;

          // Infowindow-opening event handler
          google.maps.event.addListener(marker, 'click', function() 
        {            
              alert(placemark.name);           
            this.infoWindow.close();
            marker.infoWindow.setOptions(this.infoWindowOptions);
            this.infoWindow.open(this.map, this);

          });
        }
        placemark.marker = marker;
        return marker;
      };

</script>