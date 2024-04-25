<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference Call</title>
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/connect/css/main.css">
    <script>
        let room = "<?=$context['room']['name']; ?>";
        console.log(room);
    </script>
</head>
<body>
    <div id="videos">
        <video class="video-player" id="user-1" autoplay playsinline></video>
        <video class="video-player" id="user-2" autoplay playsinline></video>
    </div>

    <div id="controls">
        <div class="control-container camera-btn">
            <img src="<?=STATIC_ROOT; ?>/connect/icons/camera.png" alt="">
        </div>
        <div class="control-container mic-btn">
            <img src="<?=STATIC_ROOT; ?>/connect/icons/mic.png" alt="">
        </div>

        <div class="control-container leave-btn" onclick="goBack()">
            <img src="<?=STATIC_ROOT; ?>/connect/icons/phone.png" alt="">
        </div>

    </div>


    <script src="<?=STATIC_ROOT; ?>/connect/js/agora-rtm-sdk-1.4.4.js"></script>
    <script src="<?=STATIC_ROOT; ?>/connect/js/main.js"></script>

    <script>
        function goBack() {
            // Check if the referring page is not the current page itself to avoid redirecting to the same page
            if (document.referrer !== window.location.href) {
                window.history.back();
            } else {
                // If the referring page is the same as the current page, simply redirect to a desired page
                window.location.href = '<?=ROOT; ?>/home';
            }
        }
    </script>
</body>
</html>
