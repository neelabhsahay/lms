<div class="container">
    <div class="well form-horizontal">
        <!-- Form Name -->
        <legend><center><h2><b>Leaves Request History</b></h2></center></legend><br>
         <div class="form-group"> 
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="input-group">
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="leaveRequestHistoryTable" class="table table-bordered table-condensed table-striped">
                       <thead>
                        <tr>
                          <th>Leave Type</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Request Status</th>
                          <th>Leave Status</th>
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