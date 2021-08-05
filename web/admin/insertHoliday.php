<div id="insertHolidayModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="insertHolidayClose" onclick="closeDisplayForm('insertHolidayModal', 'holidayForm')" class="modal-form-close">&times;</span>
    <form action=" " method="post"  id="holidayForm" onsubmit="return insertUpdateHoliday()">
        <fieldset>

        <!-- Form Name -->
        <legend class="legent-header border-bottom"><center><h4>Holiday Details</h4></center></legend><br>
         <div class="row mb-4"> 

         <label class="col-md-3 control-label" >Holiday Name</label>
            <div class="col-md-3 inputGroupContainer">
             <input name="holidayName" placeholder="Holiday Name" class="form-control"  type="text">
          </div>
          <label class="col-md-3 control-label">Holiday Date</label>
            <div class="col-md-3 selectContainer">
               <input name="holidayDate" placeholder="Holiday Date" class="form-control"  type="date">
          </div>
        </div>
        
       
          <div class="row mb-4"> 

         <label class="col-md-3 control-label" >Holiday Year</label>
            <div class="col-md-3 inputGroupContainer">
           <input name="year" placeholder="Holiday Year" class="form-control"  type="text">
          </div>
            <div class="col-md-3 selectContainer" hidden="true">
            <input id='holidayId' name="holidayId" placeholder="Holiday Id"  class="form-control"  type="text">
        </div>
        </div>
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="row mb-4">
         <div class="col-md-12">
         <div class="mt-5 text-center">
          <button type="submit" id="holidayBtn" class="btn btn-primary profile-button" >SUBMIT</button>
        </div>
        </div>
        </div>
</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>
