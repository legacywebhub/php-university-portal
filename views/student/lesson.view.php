<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><?=ucwords(truncate_string($context['lesson']['title'], 60)); ?></h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="lessons?course_id=<?=$context['lesson']['course_id']; ?>">Lessons</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="border-bottom-1 pb-4">
                    <?=$context['lesson']['content']; ?>
                </div>

                <?php if(!empty($context['videos'])): ?>
                    <?php foreach($context['videos'] as $video): ?>
                        <div class="my-2">
                            <video src="<?=MEDIA_ROOT; ?>/lessons/videos/<?=$video['video']; ?>" height="100%" controls></video>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

                <?php if(!empty($context['documents'])): ?>
                    <div class="pt-4 border-bottom-1">
                        <h4 class="text-primary">Course Materials</h4>
                        <?php foreach($context['documents'] as $key => $document): ?>
                            <div class="my-2">
                                <span class="mr-2"><?=$key + 1, "."; ?></span><a href="<?=MEDIA_ROOT; ?>/lessons/documents/<?=$document['document']; ?>" target="_blank"><?=$document['document']; ?></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>