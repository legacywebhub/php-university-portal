<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Course</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="courses">Courses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Course</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Courses Details</h4>
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
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Course Title</label>
                                <input type="text" class="form-control" name="course_title" maxlength="100" placeholder="Introductory mathematics" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Course Code</label>
                                <input type="text" class="form-control" name="course_code" maxlength="7" placeholder="MAT 101" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Course description</label>
                                <textarea class="form-control" rows="5" name="course_description" maxlength="250" placeholder="Course detail/overview"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Level</label>
                                <input type="text" class="form-control" name="level" maxlength="3" placeholder="100" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Semester</label>
                                <select class="form-control" name="semester" required>
                                    <option value=""></option>
                                    <option value=1>First Semester</option>
                                    <option value=2>Second Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Main Lecturer</label>
                                <select class="form-control" name="lecturer" required>
                                    <option value=""></option>
                                    <option value=1><?=$lecturer['name']; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">Course Photo</label>
                                <input type="file" class="dropify" data-default-file="" name="course_image">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="submit" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>