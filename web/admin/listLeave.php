<div class="container-fuild" style="height:100%">
    <div class="list-form-content">
        <fieldset>

        <!-- Form Name -->
        <div class="legent-header border-bottom"><center><h4>Leaves</h4></center></div><br>
         <div class="row mb-4"> 
         	<div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchLeave" id="searchLeave" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="col-md-12">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayModal('insertLeaveModal')">Add Leave</button>
                </div>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="leaveTable" class="table table-bordered table-condensed table-striped table-sm">
                       <thead class="thead-dark">
                        <tr>
                          <th>Leave Id</th>
                          <th>Leave Type</th>
                          <th>Max Allowed</th>
                          <th>Max Allowed Prov</th>
                          <th>Modified On</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
            <!--        Start Pagination -->
            <div class="col-md-12 pagination-container" id="pagerDIV">
            </div>
        </div>
    </fieldset>
</div>
</div>