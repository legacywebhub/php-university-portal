﻿<!DOCTYPE html>
<html lang="en">

<head>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?=$context['title']; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=STATIC_ROOT; ?>/dashboard/images/favicon.png">
    <!-- Summernote -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/jqvmap/css/jqvmap.min.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/chartist/css/chartist.min.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/skin.css">
    <!-- Inline style -->
    <style>
        .image-preview {
            width: 150px !important;
            margin-right: 5px;
        }
        .pagination-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pagination-container span {
            margin-right: 30px;
        }
    </style>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="dashboard" class="brand-logo">
                <img class="logo-abbr" src="<?=STATIC_ROOT; ?>/dashboard/images/logo-white-2.png" alt="">
                <img class="logo-compact" src="<?=STATIC_ROOT; ?>/dashboard/images/logo-text-white.png" alt="">
                <img class="brand-title" src="<?=STATIC_ROOT; ?>/dashboard/images/logo-text-white.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input name="search" class="form-control" placeholder="Search" maxlength="30" required>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
                                <a href="join-room" class="btn btn-primary">Create or join room</a>
                            </li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
										<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
										<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
									</svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <?php if (empty($context['staff']['passport'])): ?>
                                    <img class="rounded-circle" width="30" src="<?=STATIC_ROOT; ?>/default_user.png">
                                    <?php else: ?>
                                    <img class="rounded-circle" width="30" src="<?=MEDIA_ROOT; ?>/users/<?=$context['staff']['passport']; ?>">
                                    <?php endif ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0);" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="logout" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="dashboard" aria-expanded="false">
							<i class="la la-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
					<li><a href="students" aria-expanded="false">
							<i class="la la-users"></i>
							<span class="nav-text">Students</span>
						</a>
                    </li>
					<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
							<i class="la la-graduation-cap"></i>
							<span class="nav-text">Courses</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="courses">All Courses</a></li>
                            <li><a href="add-course">Add Courses</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
				    
                <!-- Content Goes Here -->
                <?php require("$name.view.php"); ?>
                <!-- End Content -->

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/global/global.min.js"></script>
	<script src="<?=STATIC_ROOT; ?>/dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="<?=STATIC_ROOT; ?>/dashboard/js/custom.min.js"></script>

    <!-- Summernote -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/plugins-init/summernote-init.js"></script>
		
    <!-- Chart Morris plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/raphael/raphael.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/morris/morris.min.js"></script>
		
	
	<!-- Chart piety plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/peity/jquery.peity.min.js"></script>
	
		<!-- Demo scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/dashboard/dashboard-2.js"></script>
	
	<!-- Svganimation scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/vivus.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/svg.animation.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/styleSwitcher.js"></script>

		
	
</body>
</html>