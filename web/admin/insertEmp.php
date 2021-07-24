<div id="insertEmpModal" class="modal-form">
    <div class="modal-form-content">
        <span class="modal-form-close" onclick="closeDisplayForm('insertEmpModal', 'empForm')">&times;</span>
        <div class="container">
            
            <div class="container rounded bg-white mt-5 mb-5">
                <form  action=" " method="post"  id="empForm" onsubmit="return insertEmp()">
                    <div class="row legent-header">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Employee Profile</h4>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 border-right">                               
                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="firstName" type="text" class="form-control" placeholder="first name" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="lastName" type="text" class="form-control" value="" placeholder="surname">
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-12">
                                        <label class="labels">Email ID</label>
                                        <input name="email" type="email" class="form-control" placeholder="enter email id" value=""    >
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Manager Name</label>
                                        <input id="managerName" list="searchOptions" name="managerName" onchange="selectMgr('managerId')" type="text"  autocomplete="off" class="form-control" placeholder="enter manger name" onkeyup="searchManager(this.value)">
                                        <datalist id="searchOptions" >
                                        </datalist>
                                        
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label class="labels">Phone Number</label>
                                        <input name="contact" type="text" class="form-control" placeholder="enter phone number"     value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Date of Birth</label>
                                        <input name="dateOfBirth" type="date" class="form-control" value="">
                                    </div>
                                    
                                </div>
                                
                                
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-6">
                                <div class="col-md-6">
                                    <label class="labels">Employee Type </label>
                                    <select name="empType" class="form-control"  type="select">
                                        <option value="PRO">Provistion</option>
                                        <option value="PER">Permanent</option>
                                        <option value="TMP">Temporary</option>
                                        <option value="INT">Intern</option>
                                        <option value="CNT">Contractor</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Employee Status</label>
                                    <select name="empStatus" class="form-control"  type="select">
                                        <option value="ACT">Active</option>
                                        <option value="INA">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-md-6">
                                    <label class="labels">Date of Joining</label>
                                    <input name="dateOfJoin" type="date" class="form-control" value="">
                                </div>
                                <div class="col-md-6">
                                        <label class="labels">State/Region</label>
                                        <input name="location" type="text" class="form-control" placeholder="enter location" value    ="">
                                    </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-md-6">
                                    <label class="labels">Depertment</label>
                                    <input name="departmentId" type="text" class="form-control" placeholder="enter depertment"     value="">
                                </div>
                                <div class="col-md-6">
                                     <label class="labels">Employee Role</label>
                                     <input name="empRole" type="text" class="form-control" placeholder="enter employee role"     value="">
                                </div>
                            </div>
                            <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label class="labels">Manager</label>
                                        <input name="manager" id='managerId' type="text" class="form-control" placeholder="manager id" readonly="true" >
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-5 text-center" id="empProfilebtn" style="display: none;">
                                <button class="btn btn-primary profile-button" type="submit" >Save Profile</button>
                            </div>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>