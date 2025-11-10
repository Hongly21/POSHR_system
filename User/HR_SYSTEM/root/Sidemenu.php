<!DOCTYPE html>
<?php
include('../Config/conect.php');

$username = $_GET['username'];

$sql = "SELECT hrstaffprofile.*,
                    hrstaffprofile.EmpCode as Code,
                    hrstaffprofile.Dob as DOB, 
                    hrstaffprofile.Gender as Gender,
                    hrstaffprofile.Address as Address,
                    hrstaffprofile.Contact as Contact,
                    hrstaffprofile.Email as Email,
                    hrstaffprofile.Salary as Salary,
                    hrstaffprofile.Photo as Photo,

                    hrcompany.Description as CompanyName,
                    hrdepartment.Description as DepartmentName,
                    hrdivision.Description as DivisionName,
                    hrposition.Description as PositionName,
                    hrlevel.Description as LevelName 
                    FROM hrstaffprofile
                    LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
                    LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
                    LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
                    LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
                    LEFT JOIN hrlevel ON hrstaffprofile.Level = hrlevel.Code
                    WHERE hrstaffprofile.EmpName = '$username'";
$resutl = $con->query($sql);
$row = $resutl->fetch_assoc();



$photo = $row['Photo'];




?>
<html>

<head>
    <?php
    include("header.php");
    ?>
    <!-- Google Fonts - Professional font combination -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Noto+Sans+Khmer:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Style/sidemenu.css">
</head>
<style>
    .image-user {
        flex: 0 0 220px;
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin-right: 40px; */
    }

    .image-user img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #007bff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    }

    .dcs {
        /* background-color: green; */

        margin-top: 10px;
        padding: 0px 5px 0px 15px;
        box-sizing: border-box;
    }

    label {
        display: inline-block;
        color: white;
        width: 65px;
        /* adjust width to align labels neatly */
        font-weight: 600;
        margin-bottom: 8px;
    }


    .username {
        color: white;
        margin-top: 20px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .universtity-infor {
        margin-left: 10px;

    }

    .universtity-infor input {
        margin: 5px 0px 5px 12px;
        padding: 0px 0px 0px 5px;
        color: #333;
        box-sizing: border-box;

    }

    .universtity-infor td:first-child {
        font-weight: bold;
    }
</style>

<body>
    <div class="menu">
        <div class="image-user">
            <img src="../../../HR_SYSTEM/assets/images/<?php echo $photo; ?>" alt="">
        </div>
        <div class="name">
            <h1 class="username"><?php echo $username ?></h1>
        </div>
        <hr style="color: white; margin: 0px 0px 10px 0px;">

        <div class="universtity-infor">
            <?php
            $sql = "SELECT hrstaffprofile.EmpName, hreducation.* FROM hrstaffprofile INNER JOIN hreducation ON hrstaffprofile.EmpCode= hreducation.EmpCode 
            WHERE hrstaffprofile.EmpName='$username' ";
            $run = $con->query($sql);
            while ($resutlemp = $run->fetch_assoc()) {
                $institution = $resutlemp['Institution'];
            }
            ?>



            <table>
                <tr>
                    <td class="label"><label for="Code">Position</label></td>
                    <td><input type="text" id="Code" value="<?php echo $row['PositionName']; ?>" disabled></td>
                </tr>
                <tr>
                    <td class="label"><label for="EmpName">Address</label></td>
                    <td><input type="text" id="EmpName" value="<?php echo $row['Address']; ?>" disabled></td>
                </tr>
                <tr>
                    <td class="label"><label for="dob">Contact</label></td>
                    <td><input type="text" id="dob" value="<?php echo $row['Contact']; ?>" disabled></td>
                </tr>
                <tr>
                    <td class="label"><label for="Gender">Email</label></td>
                    <td><input type="text" id="Gender" value="<?php echo $row['Email']; ?>" disabled></td>
                </tr>
                <tr>
                    <td class="label"><label for="Gender">University</label></td>
                    <td><input type="text" id="Gender" value="<?php echo $institution; ?>" disabled></td>
                </tr>

            </table>
        </div>
        <!-- <ul class="list-unstyled components">
            <li>

            </li>

        </ul> -->


    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>