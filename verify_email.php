<?php
require("controller/AuthController.php");

$hasToken = verifyRememberMeToken();

if (!$hasToken) {
    header("Location: index.php");
} else {
    $user = getUserBySession();

    if ($user->verified) {
        header("Location: index.php");
        exit;
    }

    if (!isVerificationCodeActive($user->user_id)) {
        $token = generateVerificationToken($user->user_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("config.php") ?>
</head>

<body>
    <?php require("components/navbar.php") ?>
    <?php if (isset($_GET["token"])) : ?>
        <?php if (verifyEmail($user->email, $_GET["token"])) : ?>
            <div style="display: flex; flex-direction:column; justify-content:center; align-items:center; width: 100%; padding: 50px;">
                <h1>Your email address has been verified!</h1>

                <a href="index.php">Back to main page</a>
            </div>
        <?php endif; ?>
    <?php else : ?>

        <?php
        $r = sendVerificationEmail($user->email, $token);
        ?>

        <?php if ($r) : ?>
            <div style="display: flex; flex-direction:column; justify-content:center; align-items:center; width: 100%; padding: 50px;">
                <span>An email verification has been sent to <strong><?= $user->email ?></strong> </span>
                <span> The token will expire on <strong><?php echo date('F j, Y H:i:s A', strtotime('+30 minutes')) ?></strong> </span>

                <a href="index.php">Back to main page</a>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</body>

</html>