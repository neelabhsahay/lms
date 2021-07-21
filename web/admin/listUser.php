<div class="container">
    <div class="list-form-content">
        <fieldset>
        <div class="legent-header border-bottom"><center><h2><b>Users</b></h2></center></div><br>
         <div class="row mb-4"> 
         	<div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchUsr" id="searchUsr" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="col-md-12">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayModal('insertUserModal')">Add User</button>
                </div>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="usrTable" class="table table-bordered table-condensed table-striped table-sm">
                       <thead class="thead-dark">
                        <tr>
                          <th>Emp Id</th>
                          <th>Username</th>
                          <th>Account Type</th>
                          <th>Password Type</th>
                          <th>E-Mail</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
        <!--        Start Pagination -->
        <div class='col-md-12 pagination-container' id="pagerDIV">
        </div>
    </div>
</fieldset>
</div>
</div>
