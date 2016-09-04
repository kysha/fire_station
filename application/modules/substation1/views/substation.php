<div class="container" style="margin-top:10px;">
  <div class="row">
    <div class="col-md-4 form-inline" style="float:right;">
      <div class="form-group">
        <input type="text" id="search_sub" class="form-control" placeholder="Search Substation" onkeyup="listSubstation()">
      </div>
      <div class="form-group">
        <input type="button" class="form-control btn-danger input-sm" style="float: right; margin-right:20px" id="export_info" onclick="to_pdf('toprint')" value="Export to PDF"/>
      </div>
    </div>
  </div>
  <h1>List of Substation Contact Numbers</h1>
  <div class="row">
    <div class="col-lg-12" >
      <div class="table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>Substation Name</th>
                      <th>Contact Numbers</th>
                      <th>Controls</th>
                  </tr>
              </thead>
              <tbody id="ContactsData">
              </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="ContactsModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Contact Information</h3>
      </div>
      <div class="modal-body">
        <form url="<?=base_url('api/c_substation/editContacts')?>" method="post" class="form-horizontal" id="EventForm">
        <div class="row">
          <div class="form-group">
              <label for="Title" class="col-sm-5 control-label">Substation Name</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="sub_name" name="sub_name" disabled>
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

<div class="prototype" style="display:none">
  <table>
    <tr class="dataToClone">
      <td class="sub_name"></td>
      <td class="contact_numbers"></td>
      <td>
          <button type="submit" class="btn btn-primary btn-xs EditContactsBTN" id="EditContactsBTN" data-toggle="modal" data-target="#ContactsModal"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit </button>
      </td>
    </tr>
  </table>
</div>
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
            <h2>Delete</h2>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this record?</p>
        </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-md delBTN" id="delete"> <span class="glyphicon glyphicon-edit" aria-hidden="true"> Yes </button>
        <button type="submit" data-dismiss="modal" class="btn btn-success btn-md delBTN" id="delCancel"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> No </button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->

<div id="toprint" style="display:none;">
  <h1 style="text-align:center">Cebu City Fire Station</h1>
    <h3 style="text-align:center">SUBSTATION CONTACT NUMBERS
    <div style="text-transform: uppercase;" class="sort_type"></div></h3>
    <div style="margin-top:50px;" class="table-responsive">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Substation Name</th>
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
          <td class="sub_name"></td>
          <td class="contact_numbers"></td>
        </tr>
      </table>`
    </div>
    <div><?php //echo "Printed on: ".date("Y/m/d");?></div>
</div> 

<div class="modal fade" id="submitted" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header modal-header-success">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
            <h1 class="header"><i class="glyphicon glyphicon-thumbs-up"></i>Substation Information</h1>
        </div>
        <div class="modal-body">
            <p class="msg"><b>User Information Edited Successfully!</b></p>
        </div>
      <div class="modal-footer">
        <button type="submit" data-dismiss="modal" class="btn btn-success btn-md delBTN" id="delCancel"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ok </button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
