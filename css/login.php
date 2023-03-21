<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['user_email'];
    $password = ($_POST['user_password']);

    $query = "SELECT user_id, user_name, user_email, user_password, user_phone,
        user_address, user_city, user_photo FROM users
        WHERE user_email = ? AND user_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result(
            $user_id,
            $user_name,
            $user_email,
            $user_password,
            $user_phone,
            $user_address,
            $user_city,
            $user_photo
        );
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_address'] = $user_address;
            $_SESSION['user_city'] = $user_city;
            $_SESSION['user_photo'] = $user_photo;
            $_SESSION['logged_in'] = true;

            header('location:welcome.php?message=Logged in successfully');
        } else {
            header('location:login.php?error=Could not verify your account');
        }
    } else {
        // Error
        header('location: login.php?error=Something went wrong!');
    }
}
?>
<!-- Login Section Begin -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>

<body>
    <section>
        <div>
            <form id="login-form" method="POST" action="login.php">
                <?php if (isset($_GET['error'])) ?>
                <div>
                    <h6>Login</h6>
                    <p>Email</p>
                    <input type="email" name="user_email" placeholder="your e-mail">
                    <p>Password</p>
                    <input type="password" name="user_password" placeholder="password">
                    <div role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </div>
                    <input type="submit" class="site-btn" id="login-btn" name="login_btn" value="LOGIN" />
                </div>
            </form>
        </div>
        </div>
        <div>
            <img src="assets/gif1.gif" alt="Cover" class="login-cover">
        </div>
    </section>


    <!-- <section>
        <div>
        <form id="login-form">
    <div className="card_img" id="card_img">
            <img src="assets/image1.png" alt="Card Image"/>
    </form>
        </div>
    </section> -->

</body>

</html>