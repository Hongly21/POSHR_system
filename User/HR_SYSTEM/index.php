<?php
$username = isset($_GET['username']) ? urlencode(trim($_GET['username'])) : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?></title>
</head>
<frameset rows="8%,92%" frameborder="0" border="0">
    <frame src="navbar.php?username=<?php echo $username; ?>" name="">
        <frameset cols="19%,*">
            <frame src="root/Sidemenu.php?username=<?php echo $username; ?>" name="menu">
                <frame src="view/Dashboard/index.php?username=<?php echo $username; ?>" name="content">
        </frameset>
</frameset>

</html>