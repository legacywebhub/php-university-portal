<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Department</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="departments">Departments</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Department</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Department</h3>
            </div>
            <?php if (isset($_SESSION['message'])): ?>
            <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                <?=$_SESSION['message']; ?>
            </h6>
            <?php endif ?>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Faculty <span class="text-danger">*</span></label>
                                <select class="form-control" name="faculty_id" required>
                                    <option value="">Select Faculty</option>
                                    <?php foreach($context['faculties'] as $faculty): ?>
                                    <option value=<?=$faculty['id']; ?>><?=$faculty['name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="department_code" maxlength="3" placeholder="374" onkeypress="return onlyNumberKey(event)" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" maxlength="160" placeholder="Computer science" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department Short Name <span class="text-danger">*</span></label>
                                <input type="text" name="short_name" maxlength="3" class="form-control" placeholder="CSC" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Start Level <span class="text-danger">*</span></label>
                                <select class="form-control" name="start_level" required>
                                    <option value="">Select Level</option>
                                    <option value=100>100</option>
                                    <option value=200>200</option>
                                    <option value=300>300</option>
                                    <option value=400>400</option>
                                    <option value=500>500</option>
                                    <option value=600>600</option>
                                    <option value=700>700</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">End Level <span class="text-danger">*</span></label>
                                <select class="form-control" name="end_level" required>
                                    <option value="">Select Level</option>
                                    <option value=100>100</option>
                                    <option value=200>200</option>
                                    <option value=300>300</option>
                                    <option value=400>400</option>
                                    <option value=500>500</option>
                                    <option value=600>600</option>
                                    <option value=700>700</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Head of Department</label>
                                <input type="text" name="HOD" maxlength="100" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="departments" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>