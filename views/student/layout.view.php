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
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/sweetalert2/dist/sweetalert2.min.css"><!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/summernote/summernote.css"><!-- Summernote -->
	<link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/skin-3.css">
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
                <img class="logo-abbr" src="<?=STATIC_ROOT; ?>/dashboard/images/logo-white-3.png" alt="">
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
                            <li class="nav-item">
                                <a href="join-room" class="btn btn-secondary">Join room</a>
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
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
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
                                <?php if (empty($context['student']['passport'])): ?>
                                <img class="rounded-circle" width="30" src="<?=STATIC_ROOT; ?>/default_user.png">
                                <?php else: ?>
                                <img class="rounded-circle" width="30" src="<?=MEDIA_ROOT; ?>/users/<?=$context['student']['passport']; ?>">
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
                    <li><a class="has-arrow" href="dashboard" aria-expanded="false">
							<i class="la la-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
					<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
							<i class="la la-book"></i>
							<span class="nav-text">Courses</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="courses">My Courses</a></li>
                            <li><a href="javascript:void(0);">Register Courses</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
							<i class="la la-dollar"></i>
							<span class="nav-text">Fees</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="fees">My Fees</a></li>
                            <li><a href="fees-portal">Fees Portal</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
							<i class="la la-calendar"></i>
							<span class="nav-text">Holiday</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="javascript:void(0);">All Holiday</a></li>
                            <li><a href="javascript:void(0);">Add Holiday</a></li>
                            <li><a href="javascript:void(0);">Edit Holiday</a></li>
                            <li><a href="javascript:void(0);">Holiday Calendar</a></li>
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
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">Dexignlab</a> 2020</p>
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
	
	<!-- Chart sparkline plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="<?=STATIC_ROOT; ?>/dashboard/js/plugins-init/sparkline-init.js"></script>
	
	<!-- Chart Morris plugin files -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/raphael/raphael.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/morris/morris.min.js"></script> 
	
    <!-- Init file -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/plugins-init/widgets-script-init.js"></script>
	
	<!-- Demo scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/dashboard/dashboard.js"></script>
	
	<!-- Summernote -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/summernote/js/summernote.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/plugins-init/summernote-init.js"></script>

    <!-- Sweet alert -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
	
	<!-- Svganimation scripts -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/vivus.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/svganimation/svg.animation.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/styleSwitcher.js"></script>
	
    <!-- Font Awesome -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/all.min.js"></script>
    
    <!-- In-page scripts -->
    
    <!-- Return only number keystrokes -->
    <script>
      // This functions only allows input fields to accept numbers
      function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
        // use  onkeypress="return onlyNumberKey(event)" on the input field
      }
    </script>

    <!-- Return only alphabet keystrokes -->
    <script>
        // This functions enforce input fields to only accept alphabet keystrokes
        function onlyAlphabeticalKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if ((ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 97 && ASCIICode <= 122)) {
                return true; // Allow alphabetical characters
            } else {
                return false; // Block other characters
            }
            // Use onkeypress="return onlyAlphabeticalKey(event)" on the input field
        }
    </script>

    <!-- Copy texts js -->
    <script>
    function copyText(arg) {
        console.log('clicked a button');
        // Get the input or text field
        //var copyText = document.getElementById("myInput");

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