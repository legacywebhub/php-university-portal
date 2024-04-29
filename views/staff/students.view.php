<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>All Student</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Student</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Students List  </h4>
                        <a href="add-student" class="btn btn-primary">+ Add new</a>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                        <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                            <?=$_SESSION['message']; ?>
                        </h6>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Passport</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Department</th>
                                        <th>Level</th>
                                        <th>Matric Number</th>
                                        <th>Year Admitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($context['students']['result'])): ?>
                                    <tr role="row" class="even">
                                        <td>
                                            No student
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach($context['students']['result'] as $student): ?>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);">
                                                    <?php if (empty($student['passport'])): ?>
                                                        <img class="rounded-circle" width="35" src="<?=STATIC_ROOT; ?>/default_user.png">
                                                    <?php else: ?>
                                                        <img class="rounded-circle" width="35" src="<?=MEDIA_ROOT; ?>/users/<?=$student['passport']; ?>">
                                                    <?php endif ?>
                                                    </a>
                                                </td>
                                                <td><?=$student['firstname']." ".$student['lastname']; ?></td>
                                                <td><?=$student['email']; ?></td>
                                                <td><?=$student['gender']; ?></td>
                                                <td><?=fetch_department($student['department_id']); ?></td>
                                                <td><?=$student['level']; ?></td>
                                                <td><?=$student['matric_number']; ?></td>
                                                <td><?=extract_year($student['reg_date']); ?></td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            <span>Showing Page <b><?=$context['students']['page'] ?></b> 0f <b><?=$context['students']['num_of_pages'] ?></b></span>
                            <ul class="pagination pagination-sm">
                                <?php if ($context['students']['has_previous']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['students']['previous_page'] ?>">
                                        <i class="icon-arrow-left"></i>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void()">
                                        <i class="icon-arrow-left"></i>
                                    </a>
                                </li>
                                <?php endif ?>

                                <li class="page-item active"><a class="page-link" href="javascript:void()"><?=$context['students']['page'] ?></a></li>
                                
                                <?php if ($context['students']['has_next']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['students']['next_page'] ?>">
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void()">
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>