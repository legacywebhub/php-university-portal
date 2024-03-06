<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Lessons</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="courses">Courses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Lessons</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Course - <?=ucwords($context['course']['title']); ?></h4>
                <a href="add-lesson?course_id=<?=$context['course']['id']; ?>" class="btn btn-primary">+ Add lesson</a>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col">Lesson Title</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($context['lessons']['result'])): ?>
                            <tr role="row" class="even">
                                <td>
                                    No lesson for this course
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach($context['lessons']['result'] as $lesson): ?>
                                <tr>
                                    <td><?=$lesson['title']; ?></td>
                                    <td>
                                        <a href="lesson?lesson_id=<?=$lesson['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-eye"></i></a>
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