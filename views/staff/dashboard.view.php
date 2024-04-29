<style>
    .hidden {
        display: none;
    }
</style>
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Hi, <?=$context['staff']['firstname']; ?>!</h4>
            <p class="mb-0">Welcome back to your portal</p>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="profile">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo"></div>
                </div>
                <div class="profile-info">
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="profile-photo">
                                <?php if (empty($context['staff']['passport'])): ?>
                                <img class="img-fluid rounded-circle" width="100" src="<?=STATIC_ROOT; ?>/default_user.png">
                                <?php else: ?>
                                <img class="img-fluid rounded-circle" width="100" src="<?=MEDIA_ROOT; ?>/users/<?=$context['staff']['passport']; ?>">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-sm-9 col-12">
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 border-right-1">
                                    <div class="profile-name">
                                        <h4 class="text-primary mb-0"><?=$context['staff']['firstname']." ".$context['staff']['lastname']; ?></h4>
                                        <p><?=$context['staff']['staff_id']; ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 border-right-1">
                                    <div class="profile-email">
                                        <h4 class="text-muted mb-0"><?=$context['staff']['email']; ?></h4>
                                        <p>Gender: 
                                            <b>
                                            <?php if ($context['staff']['gender']=="M"): ?>Male<?php else: ?>Female<?php endif ?>
                                            </b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h4 class="card-title">Total Professors</h4>
                        <h3><?=$context['staff']['total_professors']; ?></h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-success" style="width: 30%"></div>
                        </div>
                        <small>10% Increase in 30 Days</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h4 class="card-title">Total Staffs</h4>
                        <h3><?=$context['staff']['total_staffs']; ?></h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                        </div>
                        <small>80% Increase in 20 Days</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h4 class="card-title">Total Students</h4>
                        <h3><?=$context['staff']['total_students']; ?></h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                        </div>
                        <small>50% Increase in 25 Days</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h4 class="card-title">Total Courses</h4>
                        <h3><?=$context['staff']['total_courses']; ?></h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-red" style="width: 76%"></div>
                        </div>
                        <small>76% Increase in 20 Days</small>
                    </div>
                </div>
            </div>
        </div>
    </div>					

    <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
        <div class="card profile-tab">
            <div class="card-header">
                <h4 class="card-title">Your colleagues in <?=fetch_department($context['staff']['department_id']); ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($context['colleagues'] as $colleague): ?>
                            <tr>
                                <td>
                                    <?php if($colleague['passport']): ?>
                                    <img src="<?=MEDIA_ROOT; ?>/users/<?=$colleague['passport']; ?>" class="rounded-circle" width="35" alt="">
                                    <?php else: ?>
                                    <img src="<?=STATIC_ROOT; ?>/default_user.png" class="rounded-circle" width="35" alt="">
                                    <?php endif ?>
                                </td>
                                <td><?=$colleague['title']." ". $colleague['firstname']." ".$colleague['lastname']; ?></td>
                                <td><?=$colleague['gender']; ?></td>
                                <td><?=ucfirst($colleague['role']); ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>