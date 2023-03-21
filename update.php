<?php 
    include('connection.php');
    $id = $_GET['user_id'];
    $q = "SELECT * FROM users WHERE user_id = $id";

    $result = mysqli_query($conn, $q);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top">
                <span>Update</span>
            </div>
            <?php $row = mysqli_fetch_assoc($result);?>
            <form method="POST" action="actionUpdate.php?user_id=<?php echo $row['user_id']?>">
                <div name="user_id"><?php echo $row['user_id']?></div>

                <div class="input">
                    <input type="text" name="user_name" class="form-control" placeholder="<?php echo $row['user_name']?>">
                    
                </div>
                <div class="input">
                    <input type="text" name="user_email" class="form-control" placeholder="<?php echo $row['user_email']?>">
                    
                </div>
                <div class="input">
                    <input type="text" name="user_phone" class="form-control" placeholder="<?php echo $row['user_phone']?>">
                    
                </div>
                <div class="input">
                    <input type="text" name="user_address" class="form-control" placeholder="<?php echo $row['user_address']?>">
                    
                </div>
                <div class="input">
                    <input type="text" name="user_city" class="form-control" placeholder="<?php echo $row['user_city']?>">
                    
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>