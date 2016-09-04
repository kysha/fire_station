<script type="text/javascript">
    $(document).ready(function () {
        var substation_data;
        var sortable;
        var geoXml=null;
        var map;
        var markers = [];
        var sub_markers = [];
        var nearest_sub_markers = [];
        var currentMarker;
        var geocoder = new google.maps.Geocoder();
        var marker_num = 0;    
        var sub_num = 0;  
        var substation_InfoWindow;
        var strictBounds;

        //Initialize upon loading the Home Page
        getStationInfo();
        cloning();

        /********************************************
                        HOME SIDE BAR
        *********************************************/
        //Open Home Side Bar
        $('.icon-menu').click(function() {
            $('.menu').animate({
              right: "0px"
            }, 200);
            $('#googleMap').animate({
              left: "-350px"
            }, 200);
        });
        //Close Home Side Bar
        $('.icon-close').click(function() {
            $('.menu').animate({
              right: "-350px"
            }, 200);
            $('#googleMap').animate({
              left: "0px"
            }, 200);
       });
        //Call function Creating New Fire Alert Panel
        $("#addFireAlert").click(function(){
            cloning(1);
        }); 
        //Create New Responding Substation in Fire Alert Panel
        $("#accordion").on("click", ".addStation", function () {
            console.log("Me");
            var newStation=addStation();
            $(this).parent().parent().find(".stationContainer").append(newStation);
        });
        //Createb additional Responding Substation 
        function addStation(){
            sub_num = sub_num + 1;
            var cloned=$(".respSubstation").clone();
            cloned.attr('id',"tmp_"+sub_num); 
            cloned.find(".dateTime-picker").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            cloned.removeClass("respSubstation").show();
            return cloned;            
        }
        //Create additional Fire Alert Panel
        function cloning(flag){
            marker_num++;
            var cloned=$("#dataFireAlert").clone();
            var dateNow = new Date();
            if (flag)
            cloned.find(".collapse").removeClass("in");
            cloned.find(".accordion-toggle").attr("href",  "#" + marker_num);
            cloned.find(".panel-collapse").attr("id", marker_num);
            cloned.find("#Type1").attr("checked");
            cloned.find(".tab1").attr("href","#pane"+marker_num+"1");
            cloned.find(".tab2").attr("href","#pane"+marker_num+"2");
            cloned.find(".pane1").attr("id","pane"+marker_num+"1");
            cloned.find(".pane2").attr("id","pane"+marker_num+"2");
            var newStation=addStation();
            cloned.find(".dateTime-picker").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            cloned.find(".stationContainer").append(newStation);
            cloned.show();
            cloned.removeAttr("id");
            $("#accordion").append(cloned.fadeIn());            
        }
        //Get and Set Current Date and Time
        $("#accordion").on("click", ".getDateTime", function () {
            var changeDateTime= moment().format('YYYY-MM-DD HH:mm:ss');
            $(this).parent().parent().find('input').val(changeDateTime);
        });
        //Get Response Time = Arrival Time - Notification Time
        $("#accordion").on("click", ".getTime", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            var notification=moment($("#"+panelId).find("#notification").val());
            var arrival;
            var prevresponse;
            var response;
            $("#"+panelId+" .arrival-input").each(function() {
                   if ($(this).val().trim()){
                        arrival=moment($(this).val());
                        response=arrival.diff(notification);
                        if (prevresponse<response){
                            response=prevresponse;
                        }
                        prevresponse=response;
                   }
            })
            var d = moment.duration(response);
            $(this).parent().parent().find('input').val(d.hours()+":"+d.minutes()+":"+d.seconds());
        });
        //What happens everytime user change Notification Type
        $("#accordion").on('click',"#notifType", function () {
            previous = this.value;
        }).on('change',"#notifType", function() {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            var panel = $("#"+panelId);
            if ((previous==0 && this.value!=0) || (previous!=0 && this.value==0)) {
                $("#"+panelId+" .pane1 input").each(function() {
                    $(this).val(" ").parent().removeClass("has-error");
                });
                $("#"+panelId+" .pane1 p").each(function() {
                    $(this).addClass("hidden");
                });
                panel.find("#Latitude").parent().toggle();
                panel.find("#Longitude").parent().toggle();
                if ((previous==0 && this.value!=0)) {
                    panel.find("#address").val("").attr("readonly",false);                
                    panel.find("#barangay").val("").attr("readonly",false);
                    panel.find("#addressBTN").prop('disabled', true);
                }
                else{
                    panel.find("#addressBTN").prop('disabled', false);
                    panel.find("#barangayBTN").prop('disabled', false);
                    panel.find("#address").val("").attr("readonly",true);
                    panel.find("#barangay").val("").attr("readonly",true);
                }
            }
        });        
        //Create  new Fire Log
        $("#accordion").on("click", "#createLog", function () {
            var error=0;
            var dataarr = [];
            var panelId = $(this).closest(".panel-collapse").attr("id");
            var panel = $("#"+panelId);
            var notifType = $("#"+panelId).find("#notifType").val();
            $("#"+panelId).find('.stationContainer').find('.alert').each(function() {
                var id = $(this).attr('id');
                var substation = $(this).find("#substation").val();
                var arrival =  $(this).find("#arrival").val();
                dataarr.push({id,substation,arrival});
            });
            if (notifType==0)
                error = getLocation(panelId,1);

            if (!error) {
                var fire_log={
                    notifType: panel.find("#notifType").val(),
                    Latitude: panel.find("#Latitude").val().trim(),
                    Longitude: panel.find("#Longitude").val().trim(),
                    address: panel.find("#address").val().trim(),
                    barangay: panel.find("#barangay").val().trim(),
                    category: panel.find("#category").val().trim(),                    
                    notification: panel.find("#notification").val().trim(),
                    fireOut: panel.find("#fireOut").val().trim(),
                    response: panel.find("#response").val().trim(),
                    respondents: dataarr 
                };
                var url = "<?=base_url('api/c_logs/createLog')?>";          
                var request = $.post( url,fire_log);
                request.done(function (response){
                    var data = jQuery.parseJSON(response);
                    if(!data["error"].length){   
                        $("#"+panelId).parent().remove();    
                        $('#submitted').modal('show');
                        deleteMarkers(panelId); 
                    }
                    else{
                        var pane2Error=0;
                        $.each(data.error[0].message, function(index,value){
                            if(index == "substation"){
                                for (i in data.error[0].message.substation) {
                                $.each(data.error[0].message.substation[i], function(index,value){
                                    if (value != "") {
                                        pane2Error++;
                                        $("#"+panelId).find("#"+index).find("#arrival").parent().addClass('has-error');       
                                        $("#"+panelId).find("#"+index).find("p").removeClass('hidden').text(value);
                                    }
                                    else{   
                                        $("#"+panelId).find("#"+index).find("#arrival").parent().removeClass('has-error');       
                                        $("#"+panelId).find("#"+index).find("p").removeClass('hidden').text("");
                                    }                               
                                });
                                }
                            }
                            else{
                                if (value != "") {
                                    $("#"+panelId).find("#"+index).parent().addClass('has-error');       
                                    $("#"+panelId).find("."+index).removeClass('hidden').text(value);
                                }
                                else{   
                                    $("#"+panelId).find("#"+index).parent().removeClass('has-error');       
                                    $("#"+panelId).find("."+index).addClass('hidden').text("");
                                }
                            }       
                            if ((index == "fireOut" && value !="") || (index == "notification" && value !="") || (index == "response" && value !="") || (index == "arrivalEmpty" && value !=""))  
                                pane2Error++;
                        });
                        if (pane2Error>0){
                            $("#"+panelId+" .respondentsError").removeClass('hidden').text("There are "+pane2Error+" error/s in Respondents tab.");
                        }else{
                            $("#"+panelId+" .respondentsError").addClass('hidden');
                        }
                    }
                });
            }
        });
        /********************************************
                    END OF HOME SIDE BAR
        *********************************************/

        /********************************************
                    GOOGLE MAP ACTIONS
        *********************************************/
        $("#accordion").on("click", "#barangay", function () {
            var brgy={
                    brgy_name : $(this).val(),
                    select : "brgy_name",
                    from : "brgy_info"
                };
            $.post("<?php echo base_url('api/c_home/listsuggest')?>",brgy,function(response){
                $("#dlbarangay").empty();
                var data = jQuery.parseJSON(response);
                var dataList = document.getElementById("dlbarangay");
                if(!data["error"].length){
                    for (var x = 0; x < data.data.length; x++){
                        var option = document.createElement("option");
                        option.value = data["data"][x]["brgy_name"];
                        dataList.appendChild(option);
                    }
                }
            });
        });
        $("#accordion").on("click", "#addressBTN", function () {
            var panelId = $(this).closest(".panel-collapse").attr("id");
            getLocation(panelId,0);
        });
        $("#googleMap").on("click", ".dynamicMarker", function () {
            deleteMarkers($(this).attr("id"));
        }); 
        $("#accordion").on("click", "#deleteAlert", function () {
            var container = $(this).parent().parent().parent();
            deleteMarkers(container.find(".panel-collapse").attr("id"));             
            container.remove();
        });
        //Check coordinates are valid and check if within Cebu City Barangay
        function getLocation(panelId,checkLocation){ // 1 - check location only
            var error=0;
            var basic_info={
                Latitude: $("#"+panelId).find("#Latitude").val().trim(),
                Longitude: $("#"+panelId).find("#Longitude").val().trim()
            };
            $.each(basic_info, function(index,value){
                if(!value){
                    error++;
                    $("#"+panelId).find("#"+index).parent().addClass("has-error");
                    $("#"+panelId).find("."+index).removeClass("hidden").text("The "+index+" field is required.");                    
                }
                else if(!$.isNumeric(value)){
                    error++;
                    $("#"+panelId).find("#"+index).parent().addClass("has-error");
                    $("#"+panelId).find("."+index).removeClass("hidden").text("The "+index+" field must contain only numbers.");                    
                }
                else{
                    $("#"+panelId).find("#"+index).parent().removeClass("has-error");
                    $("#"+panelId).find("."+index).addClass("hidden").text("");
                }
            });
            if (!error) {
                var fireLocation = new google.maps.LatLng(basic_info.Latitude, basic_info.Longitude);
                error=getBarangay(fireLocation, panelId, 0, checkLocation); //triggerType: 0 - inputted lat&lng| 1 - click map
                if (error==1){
                    $("#"+panelId).find(".Longitude").removeClass("hidden").text("Not Valid Cebu City Coordinates.");                    
                }                
            }
            return error;
        }
        //Check if location is within Cebu City and get Barangay information
        function getBarangay(fireLocation, markerId, triggerType,checkLocation){ //triggerType: 0 - inputted lat&lng| 1 - click map
            var barangayName;
            for (var i=0; i<geoXml.docs[0].gpolygons.length; i++) {
                if (google.maps.geometry.poly.containsLocation(fireLocation, geoXml.docs[0].gpolygons[i])) {
                    barangayName= geoXml.docs[0].placemarks[i].name;
                    break;
                }
            }
            if(typeof barangayName === 'undefined'){
                return 1;
            }
            else if(checkLocation==1){
                if(barangayName.localeCompare($("#"+markerId).find("#barangay").val())){
                    $("#"+markerId).find(".Longitude").removeClass("hidden").text("Given coordinates and address in Address field does not coincide.");                                                    
                    return 2;
                }
                else{
                    return 0;
                }
            }
            else{
                var request = $.post("<?=base_url('api/c_home/retrieveBarangayInfo')?>",{retrieve_type:1,barangayName: barangayName});
                request.done(function(response){
                    data = jQuery.parseJSON(response);
                    var barangayContacts=[];
                    if(!data["error"].length){ 
                        for (var x = 0; x < data.data.length; x++) {
                            barangayContacts.push("</br>"+data["data"][x]["contact"]);
                        }
                        currentMarker=markerId;
                        insertMarker(fireLocation,markerId,triggerType,barangayContacts,barangayName);
                    }
                    else{
                    }
                }); 
            }                
        }
        //Insert Fire Markers in Google Map
        function insertMarker(fireLocation,markerId,triggerType,barangayContacts,barangayName){
            var address;
            var contentString;
            var error=0;
            var mark = markers[markerId]; 
            if(mark)
                mark.setMap(null);

            var image = {
                url: 'assets/image/fire.png',
                size: new google.maps.Size(43, 68),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            };
            var marker = new google.maps.Marker({
                id: markerId,
                position: fireLocation,
                animation: google.maps.Animation.DROP,
                icon: image,
                map: map,
                title: "Coordinates: " + fireLocation.lat().toFixed(5) + " , " + fireLocation.lng().toFixed(5) 
            });
            markers[markerId]=marker;            
            contentString= '<div id="content">'+
                              '<div id="bodyContent">';

            if (triggerType){
                contentString = contentString+                
                                '<b>Latitude: </b>'+ fireLocation.lat().toFixed(5) +'</br>'+
                                '<b>Longitude: </b>'+ fireLocation.lng().toFixed(5) +'</br>';
            }
            geocoder.geocode({ 
                latLng: fireLocation
            },function(responses){     
                if (responses && responses.length > 0){
                    address = responses[0].formatted_address.split(",");
                    if (!triggerType)
                    $("#"+markerId).find("#address").val(address[0]);       
                }
                else{
                    address = "Not getting any address";
                    error++;
                    if (!triggerType)
                    $("#"+markerId).find("#address").val(address);
                }
                $("#"+markerId).find("#barangay").val(barangayName);              
                if (!error){
                    contentString = contentString+'<b>Address Name: </b>' + address[0];
                }else{
                    contentString = contentString+'<b>Address Name: </b>' + address;
                }
                contentString = contentString+
                              '</br><b>Barangay Name: </b>' + barangayName +
                              '</br><b>Contact Number/s: </b>' + barangayContacts.toString() +
                              '</p>'+
                              '</div>';
                if (triggerType){
                    contentString = contentString+
                                    '<div class="text-center">'+
                                    '<button type="button" class="center btn btn-xs btn-danger dynamicMarker" id="'+markerId+'">Delete Marker</button>'+
                                    '</div>'+
                                    '</div>';
                }
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                infowindow.open(map, marker);
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                    currentMarker=marker.id;
                    checkSubstation();
                });
            });
            getNearestStation(fireLocation);
        }
        function deleteMarkers(id){
            var mark = markers[id]; 
            if(mark){
                mark.setMap(null);
                for (var i = 1; i <= 3; i++) {
                    var mystation=nearest_sub_markers[id][i];
                    sub_markers[mystation].setAnimation(null);
                }
                delete markers[id];
                delete nearest_sub_markers[id];
            }
        }
        function initialize() {
            map = new google.maps.Map(document.getElementById('googleMap'), {
                maxZoom:19,
                minZoom:13,
                zoom: 13,
                center: new google.maps.LatLng(10.3157, 123.8854),
                TypeId:google.maps.MapTypeId.ROADMAP
            });
            geoXml = new geoXML3.parser({map: map,singleInfoWindow:true,suppressInfoWindows:true,createMarker:createMarkers, afterParse:useTheData,preserveViewport:true,zoom:false});
            geoXml.parse('../fire_station/assets/kml/Cebu_Barangay_Transparent_Final.kml');
            
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
        //bind substatio markers every click 
        function bindPlacemark(placemark, text) {
          google.maps.event.addListener(placemark,"click", function(event) {
            marker_num++;
            var myLatlng = event.latLng;
            getBarangay(myLatlng, marker_num, 1,0); //triggerType: 0 - inputted lat&lng| 1 - click map
          });
        }
        function useTheData(doc) {
          for (var i = 0; i < doc[0].placemarks.length; i++) {
            var placemark = doc[0].placemarks[i].polygon;
            if (placemark){
                bindPlacemark(placemark, doc[0].placemarks[i].name);
                var d=i;
            }
          }
        }
        /********************************************
                    END GOOGLE MAP ACTIONS
        *********************************************/

        /********************************************
                    Cebu City Substation
        *********************************************/
        //Get Substation's Information for Info Window
        function getStationInfo(){
            var request = $.post("<?=base_url('api/c_substation/retrieveContacts')?>");
            request.done(function(response){
                substation_data = jQuery.parseJSON(response);
                initialize();
            }); 
        }
        //Create Substation markers on the map
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
            var substation_marker = geoXml.createMarker(placemark);
            var infowindow1 = new google.maps.InfoWindow();
            google.maps.event.addListener(substation_marker, 'click', function(E) {
                    substation_marker.setAnimation(null);
                    infowindow1.setContent('<b>Substation Name: </b>' + placemark.name+'</br><b>Contact Numbers: </b>' + contacts.toString());
                    infowindow1.setPosition(substation_marker.getPosition());
                    infowindow1.open(map  ,substation_marker );
             });
            sub_markers[sub_id]=substation_marker;
            return substation_marker;
        }
        //Get Top 3 Nearest Substation from Fire Scene 
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
                var subs={
                    1:((sortable[0][2])%80)+1,
                    2:((sortable[1][2])%80)+1,
                    3:((sortable[2][2])%80)+1
                }
                nearest_sub_markers[currentMarker]=subs;
                checkSubstation();
            } 
        }
        //Responsible for bouncing top 3 nearest fire station
        function checkSubstation(){
            if (Object.keys(markers).length==1){
                for (var i = 1; i <= 3; i++) {
                    var mystation=nearest_sub_markers[currentMarker][i];
                    sub_markers[mystation].setAnimation(google.maps.Animation.BOUNCE);
                }
            }else{
                for (var i = 1; i <= 9; i++) {
                    if (nearest_sub_markers[currentMarker][1]==i || nearest_sub_markers[currentMarker][2]==i || nearest_sub_markers[currentMarker][3]==i ) {
                        sub_markers[i].setAnimation(google.maps.Animation.BOUNCE);
                    }
                    else{
                       sub_markers[i].setAnimation(null);
                    }
                }
            }
        }
        function StationInfo(){
            for (var i = 0; i < 3; i++) {
                var stationId=(sortable[i][2])%80;
                google.maps.event.trigger(sub_markers[stationId+1], 'click');
            }
        }
        /********************************************
                    END Cebu City Substation
        *********************************************/
    });    
</script>