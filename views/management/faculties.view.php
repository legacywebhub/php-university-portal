<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Faculties</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Faculties</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Faculties </h4>
                        <a href="add-faculty" class="btn btn-primary">+ Add new</a>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                        <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                            <?=$_SESSION['message']; ?>
                        </h6>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Faculty Name</th>
                                        <th>Registered Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($context['faculties']['result'])): ?>
                                    <tr role="row" class="even">
                                        <td class="my-5">
                                            No Faculty
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach($context['faculties']['result'] as $faculty): ?>
                                            <tr>
                                                <td><?=$faculty['id']; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);"><?=$faculty['name']; ?></a>
                                                </td>
                                                <td><?=format_date($faculty['reg_date']); ?></td>
                                                <td>
                                                    <a href="edit-faculty?id=<?=$faculty['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            <span>Showing Page <b><?=$context['faculties']['page'] ?></b> 0f <b><?=$context['faculties']['num_of_pages'] ?></b></span>
                            <ul class="pagination pagination-sm">
                                <?php if ($context['faculties']['has_previous']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['faculties']['previous_page'] ?>">
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

                                <?php foreach(range(1, $context['faculties']['end']) as $page): ?>
                                <li class="page-item <?php if ($context['faculties']['page']==$page): ?>active<?php endif ?>">
                                    <a class="page-link" href="javascript:void()"><?=$page; ?></a>
                                </li>
                                <?php endforeach ?>

                                
                                <?php if ($context['faculties']['has_next']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['faculties']['next_page'] ?>">
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