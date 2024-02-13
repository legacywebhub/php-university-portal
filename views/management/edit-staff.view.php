<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Staff</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="staffs">Staffs</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Staff</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Staff Info</h3>
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
                            <?php if($context['staff']['passport']): ?>
                                <img class="image-preview" src="<?=MEDIA_ROOT; ?>/users/<?=$context['staff']['passport']; ?>">
                            <?php else: ?>
                                <img class="image-preview" src="<?=STATIC_ROOT; ?>/default_user.png">
                            <?php endif ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Select Passport</label>
                            <div class="form-group fallback w-100">
                                <input type="file" class="dropify" data-default-file="" name="passport" onchange="previewImage(this.files[0]);">
                            </div>
                            <small class="text-danger">Allowed extensions - Jpeg, jpg & png. Image must not be more than 2mb</small>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" required>
                                    <option value=<?=$context['staff']['department_id']; ?>><?=fetch_department($context['staff']['department_id']); ?></option>
                                    <?php foreach($context['departments'] as $department): ?>
                                    <option value=<?=$department['id']; ?>><?=$department['name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role" required>
                                    <option value="<?=$context['staff']['role']; ?>"><?=ucwords($context['staff']['role']); ?></option>
                                    <option value="lecturer">Lecturer</option>
                                    <option value="professor">Professor</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="HOD">Head Of Department</option>
                                    <option value="dean">Dean</option>
                                    <option value="sub-dean">Sub.Dean</option>
                                    <option value="non-teaching staffs">Non-Teaching staffs</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" required>
                                    <option value="<?=$context['staff']['gender']; ?>"><?=$context['staff']['gender']; ?></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <select class="form-control" name="title" required>
                                    <option value="<?=$context['staff']['title']; ?>"><?=$context['staff']['title']; ?></option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Engr.">Engr.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Engr. Dr.">Engr. Dr.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fname" maxlength="30" value="<?=$context['staff']['firstname']; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="mname" class="form-control" maxlength="30" value="<?=$context['staff']['middlename']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lname" maxlength="30" class="form-control" value="<?=$context['staff']['lastname']; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input name="dob" class="form-control" maxlength="10" value="<?=$context['staff']['dob']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" maxlength="60" value="<?=$context['staff']['email']; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" maxlength="20" value="<?=$context['staff']['phone']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_superuser" required>
                                    <option value=<?=$context['staff']['is_superuser']; ?>>
                                        <?php if($context['staff']['is_superuser']==1): ?>
                                            Management staff
                                        <?php else: ?>
                                            Non-management staff
                                        <?php endif ?>
                                    </option>
                                    <option value=1>Management staff</option>
                                    <option value=0>Non-management staff</option>
                                </select>
                            </div>
                            <small class="text-danger">Only management staffs can access this portal</small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="submit" href="staffs" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>