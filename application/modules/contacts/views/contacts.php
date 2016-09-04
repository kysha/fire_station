<!-- Table Barangay Contact Numbers-->
<div class="container" style="margin-top:10px;">
  <div class="row">
    <div class="col-md-4 form-inline" style="float:right;padding: 10px 0px 10px 0px;">
      <div class="form-group">
        <input type="text" id="search_brgy" class="form-control input-sm" placeholder="Search Barangay" onkeyup="listContacts()">
      </div>
      <div class="form-group">
        <input type="button" class="form-control btn-danger input-sm" style="float: right; margin-right:20px" id="export_info" onclick="to_pdf('toprint')" value="Export to PDF"/>
      </div>
    </div>
  </div>
  <!--<h2>List of Barangay Contact Numbers</h2>-->
  <div class="row">
    <div class="col-lg-12" >
      <div class="table-responsive">
        <table class="table table-hover table-striped"> 
          <thead>
            <tr>
              <th>BARANGAY NAME</th>
              <th>CONTACT NUMBERS</th>
              <th>CONTROLS</th>
            </tr>
          </thead>
          <tbody id="ContactsData">
          </tbody>
        </table>
        <div id="table_contacts_error" style="display:none;text-align:center;color:#a94442;"><b>NO RESULTS FOUND!</b></div>
      </div>
    </div>
    <div class="buttons_pagination">
      <div style="text-align: center;">
        <div  style="display: inline-block">
          <button id="previous" type="button"class="btn btn-sm" onclick="buttonchoice('previous')"><span class = "glyphicon glyphicon-menu-left"></span></button>
        </div>
        <div style="display: inline-block" class="paging text-center"></div>
        <div style="display: inline-block">
          <button id="next" type="button" class="btn btn-sm" onclick="buttonchoice('next')"><span class = "glyphicon glyphicon-menu-right"></span></button>
        </div>
      </div>
      <div class="pagebuttons" style="display:none">
        <input type="button" class="btn btn-sm page_count "/>
      </div>      
    </div>
  </div>
</div>
<!-- end of table -->

<!-- Contact Modal -->
<div class="modal fade" id="ContactsModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Contact Information</h3>
      </div>
      <div class="modal-body">
        <form url="<?=base_url('api/c_contacts/editContacts')?>" method="post" class="form-horizontal" id="EventForm">
        <div class="row">
          <div class="form-group">
              <label for="Title" class="col-sm-5 control-label">Barangay Name</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="barangay_name" name="barangay_name" disabled>
              </div>
          </div>
          <div class="appendInput">
          </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
          <button type="button" id="AddContactBTN" name="AddContactBTN" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus"></span> add</button>
          <button type="submit" name="SaveContactBTN" id="SaveContactBTN" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> save</button>
      </div>
    </div>
  </div>
</div> 
<!-- end of modal -->

<!-- Prototype clone_contactnumber-->
<div class="prototypeDiv" style="display:none">
  <div class="form-group cloneInput" id="cn">
    <label for="Title" class="col-sm-5 control-label">Contact Number/s</label>
    <div class="col-sm-4 contactnum">
      <input type="text" class="form-control" id="contact_number" name="contact_number">
      <span class="text-danger" id ="" style="display:block; width:100%; font-size:12px;"></span>
    </div>
    <button type="button" id="DeleteContactBTN" name="DeleteContactBTN" class="btn btn-danger btn-xs pull-left"><span class="glyphicon glyphicon-remove"></span></button>
  </div>
</div>
<!-- end of prototype-->

<!-- Prototype clone_retrieve-->
<div class="prototype" style="display:none">
  <table>
    <tr class="dataToClone">
      <td class="barangay_name"></td>
      <td class="contact_numbers"></td>
      <td>
        <button type="submit" class="btn btn-primary btn-xs EditContactsBTN" id="EditContactsBTN" data-toggle="modal" data-target="#ContactsModal"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit </button>
      </td>
    </tr>
  </table>
</div>
<!-- end of prototype-->

<!-- Prototype clone_addContact-->
<div class="prototypep">
    <p class="contact_number"></p>
</div>
<!-- end of prototype-->

<!-- confirm delete modal -->
<div class="modal fade" id_t = "" id="confirmDel" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
        <h2 class="header"><i class="glyphicon glyphicon-alert"></i> Delete</h2>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-md delBTN" id="delete"> <span class="glyphicon glyphicon-ok" aria-hidden="true"> Yes </button>
        <button type="submit" data-dismiss="modal" class="btn btn-success btn-md delBTN" id="delCancel"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> No </button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->

<!-- submitted modal -->
<div class="modal fade" id="submitted" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
        <h2 class="header"><i class="glyphicon glyphicon-thumbs-up"></i> Barangay Information</h2>
      </div>
      <div class="modal-body">
        <p class="msg"><b>User Information Edited Successfully!</b></p>
      </div>
      <div class="modal-footer">
        <button type="submit" data-dismiss="modal" class="btn btn-success btn-md delBTN" id="delCancel"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Ok </button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->

<!-- export table -->
<div id="toprint" style="display:none;">
  <h1 style="text-align:center">Cebu City Fire Station</h1>
  <h3 style="text-align:center">BARANGAY CONTACT NUMBERS
  <div style="text-transform: uppercase;" class="sort_type"></div></h3>
  <div style="margin-top:50px;" class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Barangay Name</th>
          <th>Contact Numbers</th>
        </tr>
      </thead>
    <tbody id="tablecontacts">
    </tbody>
   </table>
  </div>
  <div class="clone1">
    <table>
      <tr class="toBeCloned1">
        <td class="barangay_name"></td>
        <td class="contact_numbers"></td>
      </tr>
    </table>`
  </div>
  <div><?php //echo "Printed on: ".date("Y/m/d");?></div>
</div> 
<!-- end of table -->