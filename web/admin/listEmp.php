<div class="container-fuild" style="height:100%">
    <div class="list-form-content">
        <div class="legent-header border-bottom"><center><h4>Employees</h4></center></div><br>
        <div class="row mb-4"> 
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchEmp" onkeyup="searchEmployeeInList(this.value)" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="col-md-12">
                    <button class="btn btn-primary float-right" type="submit" onclick="addNewEmployee()">Add Employee</button>
                </div>
            </div>
        </div>
         
        <div class="row mb-4" style="position:relative;"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="empTable" class="table table-bordered table-condensed table-striped table-sm">
                       <thead class="thead-dark-hdr">
                        <tr>
                          <th>Emp Id</th>
                          <th>Name</th>
                          <th>Location</th>
                          <th>Manager</th>
                          <th>Contact</th>
                          <th>E-Mail</th>
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
    </div>
</div>
