<!DOCTYPE html>
<html lang="en">

<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?=$context['title']; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=STATIC_ROOT; ?>/dashboard/images/favicon.png">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/jqvmap/css/jqvmap.min.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/chartist/css/chartist.min.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/skin-2.css">
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
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="<?=STATIC_ROOT; ?>/dashboard/images/logo-white.png" alt="">
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
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
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
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
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
                                    <img src="images/profile/education/pic1.jpg" width="20" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="page-login.html" class="dropdown-item ai-icon">
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
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="index.html">Dashboard 1</a></li>
                            <li><a href="index-2.html">Dashboard 2</a></li>
                            <li><a href="index-3.html">Dashboard 3</a></li>
                        </ul>
                    </li>
					<li><a class="ai-icon" href="event-management.html" aria-expanded="false">
							<i class="la la-calendar"></i>
							<span class="nav-text">Event Management</span>
						</a>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-user"></i>
							<span class="nav-text">Staffs</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="staffs">All Staffs</a></li>
                            <li><a href="add-staff">Add Staffs</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-users"></i>
							<span class="nav-text">Students</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="students">All Students</a></li>
                            <li><a href="add-student">Add Students</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-building"></i>
							<span class="nav-text">Faculties & Departments</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="faculties">All Faculties</a></li>
                            <li><a href="add-faculty">Add Faculty</a></li>
                            <li><a href="departments">All Departments</a></li>
                            <li><a href="add-department">Add Department</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-graduation-cap"></i>
							<span class="nav-text">Courses</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="courses">All Courses</a></li>
                            <li><a href="add-course">Add Courses</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-book"></i>
							<span class="nav-text">Library</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="#">All Library</a></li>
                            <li><a href="#">Add Library</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-gift"></i>
							<span class="nav-text">Holiday</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-holiday.html">All Holiday</a></li>
                            <li><a href="add-holiday.html">Add Holiday</a></li>
                            <li><a href="edit-holiday.html">Edit Holiday</a></li>
                            <li><a href="holiday-calendar.html">Holiday Calendar</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-dollar"></i>
							<span class="nav-text">Fees</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="fees-collection.html">Fees Collection</a></li>
                            <li><a href="add-fees.html">Add Fees</a></li>
                            <li><a href="fees-receipt.html">Fees Receipt</a></li>
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
	<script src="<?=STATIC_ROOT; ?>/dashboard/js/dlabnav-init.js"></script>

    <!-- Chart ChartJS plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/chart.js/Chart.bundle.min.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Chart sparkline plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
	
	<!-- Demo scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/dashboard/dashboard-3.js"></script>
	
	<!-- Svganimation scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/vivus.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/svg.animation.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/styleSwitcher.js"></script>
	
    <script>
        // This function
        let previewImage = (file) => {
            document.querySelector('.image-preview').src = URL.createObjectURL(file);
            // use onchange="previewImage(this.files[0]);" on the input field
        };

        // This function only allows input fields to accept number keystrokes
        function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
        // use onkeypress="return onlyNumberKey(event)" on the input field
        }

        // Copy texts js
        function copyText(arg) {
        console.log('clicked a button');
        // Get the input or text field
        // var copyText = document.getElementById("myInput");

        // Select the text field
        arg.select();
        arg.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(arg.value).then(()=>{
            // Alert the copied text
            alert("Copied");
        }).catch(()=>{
            // Alert the copied text
            alert("Something went wrong");
        });
        }
    </script>
</body>
</html>