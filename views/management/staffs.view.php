<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>All Staff</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Staffs</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Staffs List  </h4>
                        <a href="add-staff" class="btn btn-primary">+ Add new</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (isset($_SESSION['message'])): ?>
                            <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                                <?=$_SESSION['message']; ?>
                            </h6>
                            <?php endif ?>
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Passport</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Department</th>
                                        <th>Staff ID</th>
                                        <th>Year Admitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($context['staffs']['result'])): ?>
                                    <tr role="row" class="even">
                                        <td>
                                            No staff
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach($context['staffs']['result'] as $staff): ?>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);">
                                                    <?php if (empty($staff['passport'])): ?>
                                                        <img class="rounded-circle" width="35" src="<?=STATIC_ROOT; ?>/default_user.png">
                                                    <?php else: ?>
                                                        <img class="rounded-circle" width="35" src="<?=MEDIA_ROOT; ?>/users/<?=$staff['passport']; ?>">
                                                    <?php endif ?>
                                                    </a>
                                                </td>
                                                <td><?=fetch_staff($staff['id']); ?></td>
                                                <td><?=$staff['email']; ?></td>
                                                <td><?=$staff['gender']; ?></td>
                                                <td><?=fetch_department($staff['department_id']); ?></td>
                                                <td><?=$staff['staff_id']; ?></td>
                                                <td><?=extract_year($staff['reg_date']); ?></td>
                                                <td>
                                                    <a href="edit-staff?id=<?=$staff['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            <span>Showing Page <b><?=$context['staffs']['page'] ?></b> 0f <b><?=$context['staffs']['num_of_pages'] ?></b></span>
                            <ul class="pagination pagination-sm">
                                <?php if ($context['staffs']['has_previous']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['staffs']['previous_page'] ?>">
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

                                <li class="page-item active"><a class="page-link" href="javascript:void()"><?=$context['staffs']['page'] ?></a></li>
                                
                                <?php if ($context['staffs']['has_next']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['staffs']['next_page'] ?>">
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