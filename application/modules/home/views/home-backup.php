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
            <div class="panel panel-danger" id="dataFireAlert" style="display:none;">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed" aria-expanded="false"><i id="arrowDown" style="display:none;" class="fa fa-arrow-circle-down"></i><i id="arrowRight" class="fa fa-arrow-circle-right"></i> Fire Alert</a>
                  <span class="pull-right" id="deleteAlert"><i class="fa fa-times-circle"></i></span>                
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                  <form class="form-horizontal" role="form">
                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Latitude:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="pwd">
                      </div>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Longitude:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="pwd">
                      </div>
                    </div>
                    <div class="form-group input-group" id="alertElement" style="margin:1px;margin-top:12px;">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-search"><b> Locate</b></i></button></span>
                        <input type="text" class="form-control" placeholder="Address" id="address">
                    </div>
                    <div class="form-group input-group" id="alertElement" style="margin:1px;margin-top:12px;">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button"><b> Notification</b></button></span>
                        <input type="text" class="form-control" placeholder="Address" id="address">
                    </div>
                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Notification Time:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="date" class="form-control" id="pwd">
                      </div>
                    </div>
                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Arrival Time:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="date" class="form-control" id="pwd">
                      </div>
                    </div>
                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Response Time:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="date" class="form-control" id="pwd">
                      </div>
                    </div>
                    <div class="form-group" id="alertElement">
                      <h5><label class="control-label col-sm-3">Fire Out Time:</label></h5>
                      <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="pwd">
                      </div>
                    </div>
<!--                     <div class="form-group">
                      <h5><label class="conrol-label col-sm-3">Fire Out Time:</label></h5>
                       <div class="col-sm-9">  
                        <span class="input-group-btn col-sm-2"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                        <input type="text" class="form-control ">
                      </div>
                    </div> -->

                  </form>
                  <button type="button" class="btn btn-sm btn-primary icon-menu" id="marker" style="margin:10px;"> SUBMIT</button>
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
