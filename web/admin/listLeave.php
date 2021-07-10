<div id="listLeaveModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="listLeaveClose" onclick="closeModal('listLeaveModal')" class="modal-form-close">&times;</span>
    <div class="well form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Leaves</b></h2></center></legend><br>

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
                    <table id="leaveTable" class="table table-bordered table-condensed table-striped">
                       <thead>
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
           
        </div>
</fieldset>
</div>
</div>
    </div><!-- /.container -->
    </div>
</div>
