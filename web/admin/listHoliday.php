<div class="container-fuild" style="height:100%">
    <div class="list-form-content">
        <fieldset>

        <!-- Form Name -->
        <div class="legent-header border-bottom"><center><h4>Holidays</h4></center></div><br>
         <div class="row mb-4"> 
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <select name="year" id="year"  class="form-control"  type="select" onchange="listHolidayInyear(this.value)">
                      <?php
                         $latest_year = date('Y');
                         $earliest_year = $latest_year - 2;
                         foreach ( range( $latest_year, $earliest_year ) as $i ) {
                             echo '<option value="'.$i.'"'.($i === $latest_year ? ' selected="selected"' : '').'>'.$i.'</option>';
                         }
                      ?>
                      </select>
                </div>
            </div>
            <div class="col-md-9 selectContainer">
                <div class="col-md-12">
                    <button class="btn btn-primary float-right" type="submit" onclick="displayModal('insertHolidayModal')">Add Holiday</button>
                </div>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-12 selectContainer">
                <div class="input-group">
                    <table id="listTable" class="table table-bordered table-condensed table-striped table-sm">
                       <thead class="thead-dark-hdr">
                        <tr>
                          <th>Holiday Name</th>
                          <th>Holiday Date</th>
                          <th>Year</th>
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
