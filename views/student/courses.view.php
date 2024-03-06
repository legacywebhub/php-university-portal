<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Here are courses related to you</h4>
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
    <?php if(empty($context['courses']['result'])): ?>
       <div>
       No courses yet
       </div>
    <?php else: ?>
        <?php foreach($context['courses']['result'] as $course): ?>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
            <div class="card">
                <img class="img-fluid" src="<?=STATIC_ROOT; ?>/dashboard/images/courses/pic1.jpg" alt="">
                <div class="card-body">
                    <h4><a href="lessons?course_id=<?=$course['id'];?>"><?=$course['title']; ?></a></h4>
                    <ul class="list-group mb-3 list-group-flush">
                        <li class="list-group-item px-0 border-top-0 d-flex justify-content-between">
                            <span class="mb-0">Course Code:</span>
                            <a href="javascript:void(0);"><?=$course['course_code']; ?></strong></a>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">Department:</span><strong><?=fetch_department($course['department_id']); ?></strong>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">Level:</span><strong><?=$course['level']."L"; ?></strong>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">Semester:</span><strong><?php if($course['semester']==1){echo "First";} else{echo "Second";} ?></strong>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">Total Lessons:</span>
                            <a href="javascript:void(0);"><?=query_fetch("SELECT COUNT(*) AS total_lessons FROM lessons WHERE course_id = ".$course['id'])[0]['total_lessons']; ?></strong></a>
                        </li>
                    </ul>
                    <a href="lessons?course_id=<?=$course['id'];?>" class="btn btn-primary">View course</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    <?php endif ?>
</div>