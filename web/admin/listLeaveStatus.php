<div class="container">
    <div class="well form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Leave Status</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
         	<div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchLeaveStatus" onkeyup="searchEmployee(this.value)" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="input-group">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayLeaveStatus()">Add Leave Status</button>
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="lvStTable" class="table table-bordered table-condensed table-striped">
                       <thead>
                        <tr>
                          <th>Employee Name</th>
                          <th>Leave Type</th>
                          <th>Year</th>
                          <th>Carried</th>
                          <th>Max Leave</th>
                          <th>Max Prov. Leave</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
           
        </div>
        <!--        Start Pagination -->
        <div class="pagination-container" id="pagerDIV">
        </div>
</fieldset>
</div>
</div>
