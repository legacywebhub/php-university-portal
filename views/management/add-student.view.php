<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Student</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="students">Students</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Student</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Info</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
                <?php endif ?>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <img class="image-preview" alt="">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Select Passport</label>
                            <div class="form-group fallback w-100">
                                <input type="file" class="dropify" data-default-file="" name="passport" onchange="previewImage(this.files[0]);">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" required>
                                    <option value="">Select Department</option>
                                    <?php foreach($context['departments'] as $department): ?>
                                    <option value=<?=$department['id']; ?>><?=$department['name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" class="form-control" maxlength="30" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="mname" maxlength="30" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lname" class="form-control" maxlength="30" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" required>
                                    <option value="">Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input name="dob" id="datepicker1" class="datepicker-default form-control" maxlength="10" placeholder="Day-Month-Year i.e 30-12-2003">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" maxlength="60" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" maxlength="20" required>
                            </div>
                        </div>

                        <div class="mt-3 col-lg-12 col-md-12 col-sm-12">
                            <h3 class="card-title">Parent Info</h3>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Parent Name</label>
                                <input type="text" maxlength="30" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Parent Address</label>
                                <input type="text" maxlength="100" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Parent Email</label>
                                <input type="email" maxlength="60" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Parents Mobile Number</label>
                                <input type="text" maxlength="30" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="submit" href="students" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>