<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>All Courses</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Courses</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Courses List </h4>
                        <a href="add-course" class="btn btn-primary">+ Add new</a>
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
                                        <th>#</th>
                                        <th>Departent</th>
                                        <th>Level</th>
                                        <th>Semester</th>
                                        <th>Course Code</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($context['courses']['result'])): ?>
                                    <tr role="row" class="even">
                                        <td>
                                            No Course
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach($context['courses']['result'] as $course): ?>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);">
                                                    <?php if (empty($course['course_image'])): ?>
                                                        <img class="rounded-circle" width="35" src="<?=STATIC_ROOT; ?>/no-image.png" alt="no image">
                                                    <?php else: ?>
                                                        <img class="my-1" src="<?=MEDIA_ROOT; ?>/courses/<?=$course['course_image']; ?>" alt="image">
                                                    <?php endif ?>
                                                    </a>
                                                </td>
                                                <td><?=fetch_department($course['department_id']); ?></td>
                                                <td><?=$course['level']; ?></td>
                                                <td><?=$course['semester']; ?></td>
                                                <td><?=$course['course_code']; ?></td>
                                                <td><?=truncate_string($course['title'], 20); ?></td>
                                                <td>
                                                    <a href="edit-course?id=<?=$course['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>