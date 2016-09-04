    <!--Right Navigation -->      
    <div style="height:100%;display:block;">
      <div class="menu" style="height:100%;">
        <!-- Menu icon -->
        <div>
              <span class="icon-add" id = "addFireAlert"><i style="color:#fff;font-size:20px;margin:10px;" class="fa fa-plus"></i></span>                
              <span class="icon-close pull-right"><i style="color:#fff;font-size:20px;margin-right:10px;" class="fa fa-times"></i></span>                
        </div>
        <!-- Menu icon End-->

        <!--Collapsible Menu -->
        <div style="height:90%;overflow-y:auto;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-danger text-left" id="dataFireAlert" style="display:none;">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed text-left" aria-expanded="false"><i class="fa fa-fire"></i> Fire Alert</a>
                  <span class="pull-right" id="deleteAlert"><i class="fa fa-times-circle"></i></span>                
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="tabbable">
                      <ul class="nav nav-tabs">
                        <li class="active"><a class="tab1" href="#pane01" data-toggle="tab">Information</a></li>
                        <li><a class="tab2" href="#pane02" data-toggle="tab">Respondents</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id="pane01" class="pane1 tab-pane active">
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-addon uniqueBTN alertButton">Notif Type</span>
                              <select class="form-control" id="notifType">
                                  <option value="0">Device</option>
                                  <option value="3">Radio</option>
                                  <option value="2">Phone Call</option>
                                  <option value="1">Walk-in</option>
                              </select>
                          </div>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-addon uniqueBTN alertButton">Latitude</span>
                              <input type="text" class="form-control" id="Latitude">
                          </div>
                          <p class="Latitude hidden text-danger error-message"></p>

                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-addon alertButton">Longitude</span>
                              <input type="text" class="form-control" id="Longitude">
                          </div>
                          <p class="Longitude hidden text-danger error-message"></p>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-btn"><button class="btn btn-primary alertButton" type="button" id="addressBTN"> Address</button></span>
                              <input type="text" class="form-control" id="address"  readonly>
                          </div>
                          <p class="address hidden text-danger error-message"></p>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-addon uniqueBTN alertButton">Barangay</span>
<!-- 
                              <span class="input-group-btn"><button class="btn btn-primary alertButton" type="button" id="barangayBTN"> Barangay</button></span> -->
                              <input type="text" class="form-control" id="barangay" list="dlbarangay" readonly>
                              <datalist id="dlbarangay"></datalist>
                          </div>
                          <p class="barangay hidden text-danger error-message"></p>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-addon uniqueBTN alertButton">Category</span>
<!--                               <span class="input-group-btn"><button class="btn btn-primary alertButton" type="button" id="categoryBTN"> Category</button></span> -->
                              <select class="form-control" id="category">
                                  <option value="0">No Category</option>
                                  <option value="1">Alpha</option>
                                  <option value="2">Bravo</option>
                                  <option value="3">Charlie</option>
                                  <option value="4">Delta</option>
                              </select>
                          </div> 
                          <p class="respondentsError hidden text-danger error-message"></p>
                          <div class="text-center row">
                            <button type="button" class="btn btn-sm btn-success" id="createLog"> SUBMIT</button>
                          </div>
                        </div>
                        <div id="pane02" class="pane2 tab-pane">                        
                          <div class="form-group input-group " id="alertElement">
                              <span class="input-group-btn"><button class="btn btn-primary getDateTime alertButton" type="button"> Notification</button></span>
                              <input type="text" class="form-control dateTime-picker" id="notification">
                          </div>
                          <p class="notification hidden text-danger error-message"></p>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-btn"><button class="btn btn-primary getDateTime alertButton" type="button"> Fire Out</button></span>
                              <input type="text" class="form-control dateTime-picker" id="fireOut">
                          </div>
                          <p class="fireOut hidden text-danger error-message"></p>
                          <div class="form-group input-group" id="alertElement">
                              <span class="input-group-btn"><button class="btn btn-primary getTime alertButton" type="button"> Response</button></span>
                              <input type="text" class="form-control Time-picker" id="response" readonly>
                          </div>
                          <p class="response hidden text-danger error-message"></p>                                                    
                          <div class="row">
                            <button type="button" class="btn btn-xs btn-success addStation" style="margin:5px;margin-left:18px;"><i  class="fa fa-plus"></i> Add Station</button>
                          </div>                          
                          <p class="arrivalEmpty hidden text-danger error-message"></p>                                                    
                          <div class="stationContainer">
                          </div>
                        </div>
                      </div><!-- /.tab-content -->
                    </div><!-- /.tabbable -->
                </div>
              </div>
            </div>
          </div> 
        </div>
        <!-- Collapsible Menu End -->
      </div>
    </div>
    <!--Right Navigation End-->  

    <!-- Google Map -->
<!--     <div id="googleMap" style="width:100%;height:620px;"> -->
    <div id="googleMap" >
    </div>
    <!-- Google Map End-->

<!--                           <div class="respSubstation" style="display:none;"> -->
<div class="alert alert-info alert-dismissable respSubstation" style="padding-top:0px;padding-right:14px;padding-bottom:0px;background-color:transparent;border-color:transparent;display:none;">
  <div class="row">
    <button type="button" style="margin-right:10px;color:rgb(169, 68, 66);" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-xs fa-times-circle" style="color:rgb(169, 68, 66);"></i></button>
<!--     <button type="button" style="margin-right:10px;" class="close btn-danger" data-dismiss="alert" aria-hidden="true"><i class="fa fa-xs fa-times-circle"></i></button>
 -->
  </div>
  <div class="row">
    <div class="form-group input-group" id="alertElement">
        <span class="input-group-addon uniqueBTN alertButton">Substation</span>
<!--         <span class="input-group-btn"><button class="btn btn-primary  alertButton" type="button" id="substationbtn"> Substation</button></span> -->
        <select class="form-control" id="substation">
            <option value="4">Guadalupe</option>
            <option value="6">Labangon</option>
            <option value="8">Lahug</option>
            <option value="7">Mabolo</option>
            <option value="5">Pahina</option>
            <option value="2">Pardo</option>
            <option value="1">Parian</option>
            <option value="3">San Nicolas</option>
            <option value="9">Talamban</option>
        </select>
    </div>
    <div class="form-group input-group" id="alertElement">
        <span class="input-group-btn"><button class="btn btn-primary getDateTime alertButton" type="button"> Arrival</button></span>
        <input type="text" class="form-control dateTime-picker arrival-input" id="arrival">
    </div>
      <p class="arrival hidden text-danger error-message"></p>
  </div>
</div>
<div id="submitted" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div id="deleting_modal">
                <div id="del_head" class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h1><i class="glyphicon glyphicon-alert"></i>
                    Delete
                    </h1>
                </div>
                <div id="del_body" class="modal-body">
                    <p>You are about to delete this Panel.</p>
                    <p>Are you sure you want to proceed?</p>
                    <input type="hidden" class="form-control" name="deleteID"/>
                </div>
                <div id="del_foot" class="modal-footer">
                    <button type="button" id="btn_yes" class="btn btn-danger btn-md"> <span class="glyphicon glyphicon-ok" aria-hidden="true"> Yes </button>
                    <button type="button" id="btn_no" class="btn btn-primary btn-md"> <span class="glyphicon glyphicon-remove" aria-hidden="true"> No </button>
                </div>
            </div>
                <div id="success_header" style="display: none;"></div>
                <div class="modal-body" id="success_body" style="display: none;"></div>
                <div class="modal-footer" id="success_footer" style="display: none;"></div>
            
        </div>
    </div>
</div>
<!-- end of modal -->