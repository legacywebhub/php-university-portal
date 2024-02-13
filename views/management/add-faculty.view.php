<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Add Faculty</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="faculties">Faculties</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Faculty</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Faculty</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                    <?php endif ?>
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Faculty Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" maxlength="60" placeholder="Faculty of Environmental Sciences" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="faculties" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>