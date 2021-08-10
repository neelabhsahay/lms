<div id="viewEmpModal" class="modal-form">
    <div class="modal-form-content">
        <span class="modal-form-close" onclick="closeDisplayForm('viewEmpModal', 'viewEmpForm')">&times;</span>
        <div class="container">
            
            <div class="container rounded bg-white mt-5 mb-5">
                <form  action=" " method="post"  id="viewEmpForm">
                    <div class="row legent-header">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Employee Profile</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" src="http://localhost/lms/web/assets/img/avatar.png" width="120" height="120">
                                <span id="viewName" class="font-weight-bold">Aashvi Sahay</span>
                                <span id="viewEmail" class="text-black-50">aashvi@ashivi.com</span>
                                <span> </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="firstName" type="text" class="form-control" placeholder="first name" readonly="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="lastName" type="text" class="form-control" value="" placeholder="surname" readonly="true">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email ID</label>
                                        <input name="email" type="text" class="form-control" placeholder="enter email id" readonly="true"    >
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Manager Name</label>
                                        <input id="managerName" name="managerName" type="text" class="form-control" readonly="true">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Phone Number</label>
                                        <input name="contact" type="text" class="form-control" readonly="true">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Employee Role</label>
                                        <input name="empRole" type="text" class="form-control" readonly="true">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Date of Birth</label>
                                        <input name="dateOfBirth" type="date" class="form-control" readonly="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">State/Region</label>
                                        <input name="location" type="text" class="form-control" readonly="true">
                                    </div>
                                </div>

                        </div>
                        <div class="col-md-4">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Employee Type </label>
                                    <select name="empType" class="form-control"  type="select" readonly="true">
                                        <option value="PRO">Provistion</option>
                                        <option value="PER">Permanent</option>
                                        <option value="TMP">Temporary</option>
                                        <option value="INT">Intern</option>
                                        <option value="CNT">Contractor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Employee Status</label>
                                    <select name="empStatus" class="form-control"  type="select" readonly="true">
                                        <option value="ACT">Active</option>
                                        <option value="INA">In-Active</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Date of Joining</label>
                                    <input name="dateOfJoin" type="date" class="form-control" value="" readonly="true">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Depertment</label>
                                    <input name="departmentId" type="text" class="form-control" placeholder="enter depertment"value="" readonly="true">
                                </div>
                                    <div class="col-md-6">
                                        <label class="labels">Manager</label>
                                        <input name="manager" id='managerId' type="text" class="form-control" placeholder="manager id" readonly="true" >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Employee ID</label>
                                        <input name="empId" id='empId' type="text" class="form-control" readonly="true" >
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
