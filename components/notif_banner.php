<?php

$user = getUserBySession();
$cookie_banner_name = $user->user_id . "_showbanner";

if (!$cookie_banner_name) exit; 

if (!$user->verified ) {
    ob_start(); ?>
    <style>
        .__banner-body {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 30px;
            background-color: red;
            position: fixed;
            width: 100%;
            z-index: 101;
            color: white;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        .__banner-body>a {
            color: white;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>

    <div class="__banner-body">
        <span>Your email address is not verified.</span>
        &nbsp;
        <a href="verify_email.php">Verify Now</a>
        &nbsp;|&nbsp;
        <span onclick="removeNotif()" style="cursor: pointer;"><u>Do not show me this again.</u></span>
    </div>

    <script>
        function removeNotif() {
            var banner = document.querySelector('.__banner-body');
            banner.style.display = 'none';
        }
    </script>
<?php ob_get_flush();
}
