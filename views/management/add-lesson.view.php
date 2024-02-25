<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Lesson</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="courses">Courses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Lesson</a></li>
        </ol>
    </div>
</div>
 
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lesson Details</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="course" value=<?=$context['course']['id']; ?> required>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Course <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?=$context['course']['title']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Lesson Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" maxlength="100" placeholder="Lesson 1" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Lesson Content</label>
                                <textarea class="summernote" rows="5" name="content" maxlength="30000"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">Upload Lesson Video</label>
                                <input type="file" class="dropify" name="video">
                                <div><small class="text-danger">File size limit - 1GB, Allowed formats - [mp4, mkv]</small></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">Upload Lesson Documents & Materials</label>
                                <input type="file" class="dropify" name="documents[]" multiple>
                                <div><small class="text-danger">File size limit - 500MB, Allowed formats - [zip, rar, pdf, doc, docs, docx, csv, xlsx, ppt, jpeg, jpg]</small></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="lessons?course_id=<?=$context['course']['id']; ?>" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
