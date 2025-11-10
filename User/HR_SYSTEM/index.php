<?php
include('Config/conect.php');
// $username = isset($_GET['username']) ? urlencode(trim($_GET['username'])) : 'Guest';

//if user login in gmail we gmail to find username in usersetting 
if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $_GET['username']; // can be username or email
    // Check if user entered an email or username
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        // If it's an email, find the real username
        $sql = "SELECT Username FROM hrusers WHERE Email = '$username'";
        $result = $con->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['Username'];
        }
    } else {
        // If it's a normal username
        $username = $_GET['username']; // can be username or email


    }
}
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