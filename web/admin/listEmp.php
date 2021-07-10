<div id="listEmpModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="listEmpClose" onclick="closeModal('listEmpModal')" class="modal-form-close">&times;</span>
    <div class="well form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Employees</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
         	<div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="searchLeave" id="searchLeave" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control"  type="text">
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="empTable" class="table table-bordered table-condensed table-striped">
                       <thead>
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
           
        </div>
        <!--        Start Pagination -->
        <div class='pagination-container' >
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
</fieldset>
</div>
</div>
    </div><!-- /.container -->
    </div>
</div>
