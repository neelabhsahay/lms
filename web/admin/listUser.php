<div class="container">
    <div class="well form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Users</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
         	<div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchUsr" id="searchUsr" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="input-group">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayModal('insertUserModal')">Add User</button>
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="usrTable" class="table table-bordered table-condensed table-striped">
                       <thead>
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
           
        </div>
        <!--        Start Pagination -->
        <div class='pagination-container' id="pagerDIV">
        </div>
</fieldset>
</div>
</div>
