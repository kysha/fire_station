
    public function retrieveVolunteer($retrieveType = false, $limit = false, $offset = false, $sort = NULL, $ID = NULL, $title = NULL, $fullName = NULL, $status = NULL, $groupID = NULL, $tagClaimed = NULL, $contactNumber = NULL, $school = NULL, $organization = NULL, $groupDescription = NULL){//$retrieveType: 1 - like, 0 - match, 3 count
        $this->db->start_cache();
        $this->db->flush_cache();
        
        $this->db->select("volunteer_application.*, volunteer_personal_detail.*, volunteer.*, volunteer_group.description AS group_description, volunteer_group.ID AS group_ID");
        $this->db->join("volunteer_personal_detail", "volunteer_personal_detail.volunteer_basic_information_ID = volunteer.ID", "left");
        $this->db->join("volunteer_group_member", "volunteer_group_member.volunteer_ID = volunteer.ID", "left");
        $this->db->join("volunteer_group", "volunteer_group.ID = volunteer_group_member.volunteer_group_ID", "left");
        $this->db->join("volunteer_application", "volunteer_application.volunteer_ID=volunteer_personal_detail.volunteer_basic_information_ID", "left");
        $condition = array();
        $likeCondition = array();
        
        ($ID != NULL) ? $condition["volunteer.ID"] = $ID : null;
        ($status != NULL) ? (is_array($status)) ? $this->db->where_in("volunteer.status", $status) : $condition["volunteer.status"] = $status : null;
        ($groupID != NULL) ? (is_array($groupID)) ? $this->db->where_in("volunteer.volunteer_group_member", $groupID) : $condition["volunteer.volunteer_group_member"] = $groupID : null;
        ($tagClaimed !== NULL) ? (is_array($tagClaimed)) ? $this->db->where_in("volunteer_application.tag_claimed", $tagClaimed) : $condition["volunteer_application.tag_claimed"] = $tagClaimed : null;
        
        if(!($retrieveType&1)){
            ($title != NULL) ? (is_array($title)) ? $this->db->where_in("volunteer.title", $title) : $condition["volunteer.title"] = $title : null;
            ($fullName != NULL) ? (is_array($fullName)) ? $this->db->where_in("volunteer.full_name", $fullName) : $condition["volunteer.full_name"] = $fullName : null;
            ($contactNumber != NULL) ? (is_array($contactNumber)) ? $this->db->where_in("volunteer_personal_detail.contact_number", $contactNumber) : $condition["volunteer_personal_detail.contact_number"] = $contactNumber : null;
            ($school != NULL) ? (is_array($school)) ? $this->db->where_in("volunteer_personal_detail.school", $school) : $condition["volunteer.school"] = $school : null;
            ($organization != NULL) ? (is_array($organization)) ? $this->db->where_in("volunteer_personal_detail.organization", $organization) : $condition["volunteer.organization"] = $organization : null;
            ($groupDescription != NULL) ? (is_array($groupDescription)) ? $this->db->where_in("volunteer_group.description", $groupDescription) : $condition["volunteer_group.description"] = $groupDescription : null;
        }else{
            ($title != NULL) ? $likeCondition["volunteer.title"] = $title : null;
            ($contactNumber != NULL) ? $likeCondition["volunteer_personal_detail.contact_number"] = $contactNumber : null;
            ($school != NULL) ? $likeCondition["volunteer_personal_detail.school"] = $school : null;
            ($organization != NULL) ? $likeCondition["volunteer_personal_detail.organization"] = $organization : null;
            ($groupDescription != NULL) ? $likeCondition["volunteer_group.description"] = $groupDescription : null;
            if($fullName !== NULL){
                $names = explode(" ", $fullName);
                foreach($names as $value){
                    $this->db->like(array("full_name" => $value));
                }
            }
        }
        
        if($sort){
            foreach($sort as $key => $value){
                $tableColumn = explode("__", $key);
                if(count($tableColumn) > 1){
                    $key = $tableColumn[0].".".$tableColumn[1];
                }
                $this->db->order_by($key, ($value) ? "asc" : "desc");
            }
        }
    
        (count($condition) > 0 != NULL) ? $this->db->where($condition) : null;
        (count($likeCondition) > 0) ? $this->db->like($likeCondition) : null;
        ($limit)?$this->db->limit($limit, $offset):0;
        if(!($retrieveType&2)){
            $result = $this->db->get("volunteer");
            $this->db->flush_cache();
            $this->db->stop_cache();
            if($result->num_rows()){
                return ($ID && !$retrieveType) ? $result->row_array() : $result->result_array();
            }else{
                return false;
            }
        }else{
            $result = $this->db->count_all_results('volunteer');
            $this->db->flush_cache();
            $this->db->stop_cache();
            return $result;
        }
    }

function calculateDistances() {
  // Create a new Distance Matrix Service object
  var service = new google.maps.DistanceMatrixService();
  
  // Set the options such as the pre-defined origin
  // and destinations, as well as specifying to use
  // duration in traffic
  
  service.getDistanceMatrix({
      origins: [customerLocation],
      destinations: [store1, store2, store3],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.IMPERIAL,
      avoidHighways: false,
      avoidTolls: false,
      durationInTraffic: true
  }, callback);
} 
   
function callback(response, status) {
  if (status != google.maps.DistanceMatrixStatus.OK) {
    console.log('DistanceMatrix Error: ', status);
  } else {
    // Get the arrays of origins and destinations
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;
    
    for (var i = 0; i < origins.length; i++) {
      // For each of the origins, get the results of the 
      // distance and duration of the destinations
      var results = response.rows[i].elements;
      for (var j = 0; j < results.length; j++) {
    // Store the results for later sorting
   storeResults.push([destinations[j],
       results[j].duration_in_traffic.value,
                  results[j].distance.value]);
      }
    }
    // Sort the results by duration in traffic
     storeResults.sort(function(a, b) {
           return a[1] - b[1];
         }); 
  }
}



Place1: (10.299271, 123.90347799999995)
(index):275 Place2: (10.369849, 123.91673800000001)
(index):276 Place5: (10.303085, 123.87879900000007)
8(index):303 OKundefined
(index):305 Budlaan
(index):423 [Object, Object, Object]0: Objectdistance: Objecttext: "9.4 km"value: 9412__proto__: Objectduration: Objectstatus: "OK"__proto__: Object1: Objectdistance: Objecttext: "9.4 km"value: 9412__proto__: Objectduration: Objectstatus: "OK"__proto__: Object2: Objectdistance: Objecttext: "9.4 km"value: 9412__proto__: Objectduration: Objectstatus: "OK"__proto__: Objectlength: 3__proto__: Array[0]

function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
    } else {
        //we only have one origin so there should only be one row
        var routes = response.rows[0];               
        var sortable = [];
        var resultText = "Origin: <b>" + origin + "</b><br/>";
        resultText += "Possible Routes: <br/>";
        for (var i = routes.elements.length - 1; i >= 0; i--) {
            var rteLength = routes.elements[i].duration.value;
            resultText += "Route: <b>" + destinations[i] + "</b>, " + "Route Length: <b>" + rteLength + "</b><br/>";
            sortable.push([destinations[i], rteLength]);
        }
        //sort the result lengths from shortest to longest.
        sortable.sort(function (a, b) {
            return a[1] - b[1];
        });




