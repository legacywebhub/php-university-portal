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
                                        <th>Course Title</th>
                                        <th>Course Code</th>
                                        <th>Departent</th>
                                        <th>Level</th>
                                        <th>Semester</th>
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
                                                <td><?=truncate_string($course['title'], 20); ?></td>
                                                <td><?=$course['course_code']; ?></td>
                                                <td><?=fetch_department($course['department_id']); ?></td>
                                                <td><?=$course['level']; ?></td>
                                                <td><?=$course['semester']; ?></td>
                                                <td>
                                                    <a href="edit-course?id=<?=$course['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="delete-course?id=<?=$course['id']; ?>" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                    <a href="lessons?course_id=<?=$course['id']; ?>" class="btn btn-sm btn-success text-light" title="Add lesson"><i class="fa fa-book"></i></a>
                                                </td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            <span>Showing Page <b><?=$context['courses']['page'] ?></b> 0f <b><?=$context['courses']['num_of_pages'] ?></b></span>
                            <ul class="pagination pagination-sm">
                                <?php if ($context['courses']['has_previous']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['courses']['previous_page'] ?>">
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

                                <?php foreach(range(1, $context['courses']['end']) as $page): ?>
                                <li class="page-item <?php if ($context['courses']['page']==$page): ?>active<?php endif ?>">
                                    <a class="page-link" href="javascript:void()"><?=$page; ?></a>
                                </li>
                                <?php endforeach ?>

                                
                                <?php if ($context['courses']['has_next']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['courses']['next_page'] ?>">
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