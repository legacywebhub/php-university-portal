
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>404 Error</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=STATIC_ROOT; ?>/dashboard/images/favicon.png">
    <link href="<?=STATIC_ROOT; ?>/dashboard/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text font-weight-bold">404</h1>
                        <h4><i class="fa fa-exclamation-triangle text-warning"></i> The page you were looking for is not found!</h4>
                        <p>You may have mistyped the address or the page may have moved.</p>
						<div>
                          <a class="btn btn-primary" onclick="goBack()" style="cursor: pointer;">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Go Back Function -->
    <script>
        function goBack() {
            // Check if the referring page is not the current page itself to avoid redirecting to the same page
            if (document.referrer !== window.location.href) {
                window.history.back();
            } else {
                // If the referring page is the same as the current page, simply redirect to a desired page
                window.location.href = 'dashboard';
            }
        }
    </script>
    <script>
        let searchForm = document.forms['search-form'];

        searchForm.addEventListener('submit', (e)=>{
            e.preventDefault();
        })
    </script>
</body>

</html>