<div id="insertEmpModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
            <span class="modal-form-close" onclick="closeDisplayForm('insertEmpModal', 'empForm')">&times;</span>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <form  action=" " method="post"  id="empForm" onsubmit="return insertEmp()">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle     mt-5" src="        http://localhost/lms/web/asserts/img/user.jpg"><span class="font-weight-bold">    Amelly</span><span class="        text-black-50">    amelly12@bbb.com</span><span> </span></div>
                        </div>
                        
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Employee Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="firstName" type="text" class="form-control" placeholder="first name" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="lastName" type="text" class="form-control" value="" placeholder="surname">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email ID</label>
                                        <input name="email" type="text" class="form-control" placeholder="enter email id" value=""    >
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Manager Name</label>
                                        <input id="managerName" name="managerName" type="text" class="form-control" placeholder="enter manger name" onkeyup="searchManager(this.value)">
                                        <label id="searchedMgr" class="searchResult"></label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Phone Number</label>
                                        <input name="contact" type="text" class="form-control" placeholder="enter phone number"     value="">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Employee Role</label>
                                        <input name="empRole" type="text" class="form-control" placeholder="enter employee role"     value="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Date of Birth</label>
                                        <input name="dateOfBirth" type="date" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">State/Region</label>
                                        <input name="location" type="text" class="form-control" placeholder="enter location" value    ="">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Manager</label>
                                        <input name="manager" id='managerId' type="text" class="form-control" placeholder="manager id" readonly="true" >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Employee ID</label>
                                        <label name="empId" type="text" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="mt-5 text-center" id="empProfilebtn" style="display: none;">
                                    <button class="btn btn-primary profile-button" type="submit" >Save Profile</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <span>Edit Official</span>
                                    <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Official</span>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <label class="labels">Employee Type </label>
                                    <select name="empType" class="form-control"  type="select">
                                        <option value="PRO">Provistion</option>
                                        <option value="PER">Permanent</option>
                                        <option value="TMP">Temporary</option>
                                        <option value="INT">Intern</option>
                                        <option value="CNT">Contractor</option>
                                    </select>
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">Employee Status</label>
                                    <select name="empStatus" class="form-control"  type="select">
                                        <option value="ACT">Active</option>
                                        <option value="INA">In-Active</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Date of Joining</label>
                                    <input name="dateOfJoin" type="date" class="form-control" value="">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Depertment</label>
                                    <input name="departmentId" type="text" class="form-control" placeholder="enter depertment"     value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>