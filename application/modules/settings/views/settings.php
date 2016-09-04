   <div class="edit_settings modal fade">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-primary">
                    <h3 class="modal-title">Settings</h3>
                  </div>
                  <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Username: </label>
                                <div class="col-sm-5 uname_error">
                                    <input type="text" class="form-control" name="user_name"/>
                                    <span class="text-danger error_uname error" style="display:block; width:100%; font-size:12px;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Old Password:</label>
                                <div class="col-sm-5 oldpass_error">
                                    <input type="password" class="form-control" name="user_old_password"/>
                                    <span class="text-danger error_oldpass error" style="display:block; width:100%; font-size:12px;"></span>
                                </div>
                            </div>
                            <div class="form-group">        
                                <label class="col-sm-5 control-label">New Password:</label>
                                <div class="col-sm-5 newpass_error">
                                    <input type="password" class="form-control" name="user_new_password"/>
                                    <span class="text-danger error_newpass error" style="display:block; width:100%; font-size:12px;"></span>
                                </div>
                            </div>
                            <div class="form-group">      
                                <label class="col-sm-5 control-label">Confirm Password:</label>
                                <div class="col-sm-5 confirmpass_error">
                                    <input type="password" class="form-control" name="user_confirm_password"/>
                                    <span class="text-danger error_confirmpass error" style="display:block; width:100%; font-size:12px;"></span>
                                </div>
                            </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                        <button type="submit" id="cancelEditBTN" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> cancel</button>
                      <button type="submit" id="submitEditBTN" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> save</button>
                  </div>
                </div>
              </div>
            </div>