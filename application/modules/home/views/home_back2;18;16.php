    <!--Right Navigation -->      
    <div style="height:100%;display:block;">
      <div class="menu" style="height:100%;">
        <!-- Menu icon -->
        <div>
              <span class="icon-close"><i style="color:#fff;font-size:20px;margin:10px;" class="fa fa-times"></i></span>                
              <span class="pull-right icon-add" id = "addFireAlert"><i style="color:#fff;font-size:20px;margin:10px;" class="fa fa-plus"></i></span>                
        </div>
        <!-- Menu icon End-->

        <!--Collapsible Menu -->
        <div style="height:100%;overflow-y:auto;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-danger text-left" id="dataFireAlert" >
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed text-left" aria-expanded="false"><i class="fa fa-fire"></i> Fire Alert</a>
                  <span class="pull-right" id="deleteAlert"><i class="fa fa-times-circle"></i></span>                
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">


<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#pane1" data-toggle="tab">Tab 1</a></li>
    <li><a href="#pane2" data-toggle="tab">Tab 2</a></li>
  </ul>
  <div class="tab-content">
    <div id="pane1" class="tab-pane active">
      <h4>The Markup</h4>
      <pre>Code here ...</pre>
    </div>
    <div id="pane2" class="tab-pane">
    <h4>Pane 2 Content</h4>
      <p> and so on ...</p>
    </div>
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->


<!--                   <form class="form-horizontal" role="form">
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-addon">Device ID</span>
                        <input type="text" class="form-control" id="deviceId">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-addon">Latitude</span>
                        <input type="text" class="form-control" id="latitude">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-addon">Longitude</span>
                        <input type="text" class="form-control" id="longitude">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button" id="addressBTN"> Address</button></span>
                        <input type="text" class="form-control" id="address">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button" id="barangaybtn"> Category</button></span>
                        <select class="form-control" id="confirmation">
                            <option value="0">No Category</option>
                            <option value="1">Alpha</option>
                            <option value="2">Beta</option>
                        </select>
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button" id="substationbtn"> Substation</button></span>
                        <select class="form-control" id="confirmation">
                            <option value="4">Gaudalupe</option>
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
                        <span class="input-group-btn"><button class="btn btn-primary getTime" type="button" id="spbtn"> Notification</button></span>
                        <input type="time" class="form-control" id="notification">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary getTime" type="button"> Arrival</button></span>
                        <input type="time" class="form-control" id="arrival">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary getTime" type="button"> Response</button></span>
                        <input type="time" class="form-control" id="response">
                    </div>
                    <div class="form-group input-group" id="alertElement">
                        <span class="input-group-btn"><button class="btn btn-primary getTime" type="button"> Fire Out</button></span>
                        <input type="time" class="form-control" id="fireOut">
                    </div>
                  </form>
                  <div class="text-center row">
                    <button type="button" class="btn btn-sm btn-success icon-menu" id="marker"> SUBMIT</button>
                  </div> -->
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
