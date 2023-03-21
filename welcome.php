<?php
session_start();
include('connection.php');

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $q = "SELECT * FROM users WHERE user_id LIKE '%$keyword%' OR user_name LIKE '%$keyword%' OR user_email LIKE '%$keyword%'";
}else{
    $q = "SELECT * FROM users";
}

$result = mysqli_query($conn, $q);

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Document</title>
</head>
<body>
    <!-- <h1>Selamat Datang, <?php echo $_SESSION['user_name']?><br></h1>
    <h3>User data</h3>
    <table border="1">
        <thead>
            <td>Nama</td>
            <td>Alamat</td>
            <td>Kota</td>
            <td>Nomor Telepon</td>
            <td>Foto</td>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $_SESSION['user_name']?></td>
                <td><?php echo $_SESSION['user_address']?></td>
                <td><?php echo $_SESSION['user_city']?></td>
                <td><?php echo $_SESSION['user_phone']?></td>
                <td><img src="<?php echo $_SESSION['user_photo']?>" alt="face" width="60" height="72"></td>
            </tr>
        </tbody>
    </table>
    <br> -->

    <div class="box">
        <div class="container mt-4">
            <form action="" method="post">
                <input type="text" name="keyword" placeholder="Masukkan Keyword">
                <button type="submit" class="btn btn-primary" name="cari">Cari</button>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) {?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><a href="actionDelete.php?user_id=<?php echo $row['user_id']; ?>"
                                role="button" onclick="return confirm('Data ini akan dihapus?')">Hapus</a></td>
                            <td><a href="update.php?user_id=<?php echo $row['user_id']; ?>" role="button">Update</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="welcome.php?logout=1" id="logout-btn" class="btn btn-danger">LOG OUT</a>
</body>
</html>