<div class="container">
    <div class="well form-horizontal">
        <legend><center><h2><b>Leave for Approve</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchLeave" id="searchLeave" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="input-group">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayModal('insertLeaveModal')">Add Leave</button>
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="leaveRequestApproverTable" class="table table-bordered table-condensed table-striped">
                       <thead>
                        <tr>
                          <th>Leave Type</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
           
        </div>
        <!--        Start Pagination -->
        <div class='pagination-container' style="position:sticky;">
            <nav>
              <ul class="pagination">
               <li data-page="prev" >
                <span> < <span class="sr-only">(current)</span></span>
                 </li>
                 <!-- Here the JS Function Will Add the Rows -->
                 <li data-page="next" id="prev">
                  <span> > <span class="sr-only">(current)</span></span>
                 </li>
              </ul>
            </nav>
        </div>
     </div>
</div>