    <!-- filter top -->
            <div id="first" style="text-align:center;width:100%;padding: 10px 0px 10px 0px;">
                        <div id="second" class="form-inline" style="position: relative;">
                            <select class="btn btn-default dropdown-toggle" id="notiftypechoice">
                              <option value="">All</option>
                              <option value="Device">Device</option>
                              <option value="Walk-in">Walk-in</option>
                              <option value="Phonecall">Phonecall</option>
                              <option value="Radio">Radio</option>
                            </select>
                            <input type="text" style="width: 55px" class="form-control input-sm" id="yearchoice" name="yearchoice" class="year" placeholder="Year"/>
                            <input type="text" style="width: 55px"class="form-control input-sm" id="monthchoice" name="monthchoice" class="month" placeholder="Month"/>
                            <input type="text" style="width: 55px"class="form-control input-sm" id="daychoice" name="daychoice" class="day" placeholder="Day"/>
                            <input type="text" class="form-control input-sm" id="locchoice" name="locchoice" class="location" placeholder="Barangay"/>
                            <input type="text" class="form-control input-sm" id="subchoice" name="subchoice" class="substation" placeholder="Substation"/>
                            <input type="text" list="dlcategory" class="form-control input-sm" id="categchoice" name="categchoice" class="category" placeholder="Category"/>
                            <input type="button" class="form-control btn-primary input-sm" id="submitc" onclick="submitchoice()" value="Submit"/>
                            <button class="form-control input-sm" id="cleara" onclick="clearAll()"><span class="glyphicon glyphicon-refresh"></span></button>
                            <input type="button" class="form-control btn-danger input-sm" id="export_info" style="float: right; margin-right:20px" onclick="to_pdf('toprint')" value="Export to PDF"/>
                        </div>
            </div>
    <!-- /filter top end -->
            <div><h2></h2>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>NOTIFICATION</th>
                                <th>RESPONSE TIME</th>
                                <th>ARRIVAL TIME</th>
                                <th>FIRE OUT</th>
                                <th>BARANGAY</th>
                                <th>SUBSTATION</th>
                                <th>CATEGORY</th>
                                <th>TYPE</th>
                                <th>CONTROLS</th>
                            </tr>
                        </thead>
                        <tbody id="tablelogs">
                        </tbody>
                    </table>
                    <div id="table_logs_error" style="display:none;text-align:center;color:#a94442;"><b>NO RESULTS FOUND!</b></div>
                </div>
                 <div style="text-align: center;">
                    <div  style="display: inline-block">
                        <button id="previous" type="button" class="btn btn-sm" onclick="buttonchoice('previous')"><span class = "glyphicon glyphicon-menu-left"></span></button>
                    </div>
                    <div style="display: inline-block" class="paging text-center">
                    </div>
                    <div style="display: inline-block">
                        <button id="next" type="button" class="btn btn-sm" onclick="buttonchoice('next')"><span class = "glyphicon glyphicon-menu-right"></span></button>
                    </div>
                 </div>
                <div class="clone" style="display:none;">
                  <table>
                    <tr class="toBeCloned">
                        <td class="notification_time"></td>
                        <td class="response_time"></td>
                        <td class="arrival_time"><p class="arrival_timenew"></p></td>
                        <td class="fireout_time"></td>
                        <td class="location"></td>
                        <td class="substation"><p class="substationnew"></p></td>
                        <td class="category"></td>
                        <td class="notiftype"></td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-xs EditLogsBTN" id="EditLogsBTN" data-toggle="modal" data-target="#LogsModal"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                            <button type="button" class="btn btn-danger btn-xs DeleteLogsBTN" id="DeleteLogsBTN" data-toggle="modal" data-target="#DeleteModal"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </td>
                    </tr>
                  </table>
                </div>
                <div class="pagebuttons" style="display:none">
                  <input type="button" class="btn btn-sm page_count"/>
                </div>
            </div>
        <!--
        --
        -- DELETE MODAL
        --
        -->
            <div id="DeleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div id="del_head" class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h1><i class="glyphicon glyphicon-alert"></i>
                            Delete
                            </h1>
                        </div>
                        <div id="del_body" class="modal-body">
                            <p>You are about to delete this Log Information.</p>
                            <p>Are you sure you want to proceed?</p>
                            <input type="hidden" class="form-control" name="deleteID"/>
                        </div>
                        <div id="del_foot" class="modal-footer">
                            <button type="button" id="btn_yes" class="btn btn-danger btn-md"> <span class="glyphicon glyphicon-ok" aria-hidden="true"> Yes </button>
                            <button type="button" id="btn_no" class="btn btn-primary btn-md"> <span class="glyphicon glyphicon-remove" aria-hidden="true"> No </button>
                        </div>
                        <div id="delete_header" style="display: none;"></div>
                        <div class="modal-body" id="delete_body" style="display: none;"></div>
                        <div class="modal-footer" id="delete_footer" style="display: none;"></div>
                    </div>
                </div>
            </div>
        <!-- end of logs modal -->
        <!--
        --
        -- LOGS MODAL
        --
        -->
            <div class="modal fade" id="LogsModal" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div id="logs_header">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Edit Log</h3>
                    </div>
                  </div>
                  <div style="display:none" id="logs_headSuccess"></div>                  
                  <div class="modal-body">
                    <div id="logs_body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Information</a></li>
                            <li><a href="#tab2" data-toggle="tab">Respondents</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <!-- tab 1 -->
                        <div class="tab-pane active" id="tab1">
                            <form class="form-horizontal" style="padding-top: 10px;">
                                <div class="row" style="position: relative;">
                                    <input type="hidden" class="form-control" name="logID"/>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-5 control-label">Address</label>
                                          <div class="col-sm-4 address_error">
                                              <input type="text" class="form-control" name="addressmodal"/>
                                              <span class="text-danger error_address error" style="display:block; width:100%; font-size:12px;"></span>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="barangay" class="col-sm-5 control-label">Barangay</label>
                                          <div class="col-sm-4 barangay_error">
                                              <input type="text" class="form-control" list="dlbarangay" name="locationmodal" onclick="listbarangay()" />
                                              <span class="text-danger error_barangay error" style="display:block; width:100%; font-size:12px;"></span>
                                              <datalist id="dlbarangay"></datalist>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category" class="col-sm-5 control-label">Category</label>
                                        <div class="col-sm-4 categ_error">
                                            <select class="btn btn-default dropdown-toggle" name="categorymodal">
                                              <option value="alpha">Alpha</option>
                                              <option value="bravo">Bravo</option>
                                              <option value="charlie">Charlie</option>
                                              <option value="delta">Delta</option>
                                              <option value="No Category">No Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="edit_infoerror" style="text-align: center;color:#a94442;"></div>
                              <div id="logs_footer">
                                <button type="submit" name="SaveLogsBTN" id="SaveLogsBTN" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> save</button>
                              </div>
                            </div>
                        </div><!-- end of tab-1-->
                        <!-- tab 2 -->
                        <div class="tab-pane" id="tab2">
                            <form class="form-horizontal" style="padding-top: 10px;">
                            <div class="row" style="position: relative;">
                                <div class="form-group">
                                    <label for="notification date" class="col-sm-5 control-label">Notification Time</label>
                                    <div class="col-sm-4 notiftime_error">
                                        <input type="text" class="form-control" name="notification_timemodal"/>
                                        <span class="text-danger error_notiftime error" style="display:block; width:100%; font-size:12px;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="response" class="col-sm-5 control-label">Response Time</label>
                                    <div class="col-md-4 response_error">
                                        <input type="text" class="form-control" name="response_timemodal" disabled=""/>
                                        <span class="text-danger error_response error" style="display:block; width:100%; font-size:12px;"></span>
                                    </div>
                                </div>
                                <div class="form-group time">
                                    <label for="fire out" class="col-sm-5 control-label">Fire Out Time</label>
                                    <div class="col-sm-4 firetime_error">
                                        <input type="text" class="form-control" name="fireout_timemodal"/>
                                        <span class="text-danger error_firetime error" style="display:block; width:100%; font-size:12px;"></span>
                                    </div>
                                </div>
                               <div class="show_arvlsubstn"></div>
                            </div>
                            </form>
                            <div class="modal-footer">
                                <div class="edit_resperror" style="text-align: center;color:#a94442;"></div>
                            </div>
                        </div><!--end of tab2 -->
                    </div><!--end of tab-content-->
                    </div><!--end of #logs_body-->
                    <div style="display:none" id="logs_bodySuccess"></div>
                    </div><!--end of modal body-->
                    <div class="modal-footer" id="logs_footSuccess" style="display:none">
                    </div>
                </div>
                
              </div>
            </div>
        <!-- end of logs modal -->
        <div class="arrival_substn" style="display: none;">
            <div class="form-group arval_substn_clone">
                <label for="arrival time" class="col-sm-5 control-label">Arrival Time</label>
                <div class="col-sm-4 arvl_error">
                  <input type="text" class="form-control arrival_timemodal" name="arrival_timemodal"/>
                  <span class="text-danger error_arvl error" style="display:block; width:100%; font-size:12px;"></span>
                </div>
                <label for="substation" class="col-sm-5 control-label">Substation</label>
                <div class="col-sm-4" id="substn_error">
                    <select class="btn btn-default dropdown-toggle" name="substationmodal" id="substn">
                        <option value="Guadalupe">Guadalupe</option>
                        <option value="Labangon">Labangon</option>
                        <option value="Lahug">Lahug</option>
                        <option value="Mabolo">Mabolo</option>
                        <option value="Pahina">Pahina</option>
                        <option value="Parian">Parian</option>
                        <option value="Pardo">Pardo</option>
                        <option value="San Nicolas">San Nicolas</option>
                        <option value="Talamban">Talamban</option>
                    </select>
                </div>
            </div>
        </div>
        <!--
        --
        -- DISPLAY PRINT
        --
        -->
            <div id="toprint" style="display:none;">
            <h1 style="text-align:center">Cebu City Fire Station</h1>
                <h3 style="text-align:center;text-transform: uppercase;"><span class="notiftype"></span>FIRE INCIDENT REPORT
                <div style="text-align:center;text-transform: uppercase;" class="sort_type"></div></h3>
            
                <div style="margin-top:50px;" class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>NOTIF</th>
                                <th>RESPONSE TIME</th>
                                <th>ARRIVAL TIME</th>
                                <th>FIRE OUT</th>
                                <th>BARANGAY</th>
                                <th>SUBSTATION</th>
                                <th>CATEGORY</th>
                                <th>TYPE</th>
                            </tr>
                        </thead>
                        <tbody id="tablelogs1">
                        </tbody>
                    </table>
                </div>
                <div class="clone1">
                  <table>
                    <tr class="toBeCloned1">
                        <td class="notification_time1"></td>
                        <td class="response_time1"></td>
                        <td class="arrival_time1"><p class="arrival_time1new"></p></td>
                        <td class="fireout_time1"></td>
                        <td class="location1"></td>
                        <td class="substation1"><p class="substation1new"></p></td>
                        <td class="category1"></td>
                        <td class="notiftype1"></td>
                    </tr>
                  </table>
                </div>
            </div>
        <!-- end of display print -->
</body>