<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>All Department</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Departments</a></li>
        </ol>
    </div>
</div>
        
<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Department List  </h4>
                        <a href="add-department" class="btn btn-primary">+ Add new</a>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                        <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                            <?=$_SESSION['message']; ?>
                        </h6>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table id="example3" class="table header-border table-hover verticle-middle" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Dept. Name</th>
                                        <th>Dept. Short Name</th>
                                        <th>Dept. Code</th>
                                        <th>Faculty</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($context['departments']['result'])): ?>
                                    <tr role="row" class="even">
                                        <td>
                                            No Department
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach($context['departments']['result'] as $department): ?>
                                            <tr>
                                                <td><?=$department['name']; ?></td>
                                                <td><?=$department['short_name']; ?></td>
                                                <td><?=$department['department_code']; ?></td>
                                                <td><?=fetch_faculty($department['faculty_id']); ?></td>
                                                <td>
                                                    <a href="edit-department?id=<?=$department['id']; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>												
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            <span>Showing Page <b><?=$context['departments']['page'] ?></b> 0f <b><?=$context['departments']['num_of_pages'] ?></b></span>
                            <ul class="pagination pagination-sm">
                                <?php if ($context['departments']['has_previous']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['departments']['previous_page'] ?>">
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

                                <?php foreach(range(1, $context['departments']['end']) as $page): ?>
                                <li class="page-item <?php if ($context['departments']['page']==$page): ?>active<?php endif ?>">
                                    <a class="page-link" href="javascript:void()"><?=$page; ?></a>
                                </li>
                                <?php endforeach ?>

                                
                                <?php if ($context['departments']['has_next']): ?>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="?page=<?=$context['departments']['next_page'] ?>">
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