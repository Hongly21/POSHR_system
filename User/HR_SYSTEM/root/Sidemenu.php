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

    input {
        width: calc(100% - 90px);
        /* make input align beside label */
        padding: 6px 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #f9f9f9;
        font-size: 14px;
        color: #333;
    }
    .username{
        color: white;
        margin-top: 20px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 40px;
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
        <div class="universtity-infor">
            <?php
            $sql = "SELECT hrstaffprofile.EmpName, hreducation.* FROM hrstaffprofile INNER JOIN hreducation ON hrstaffprofile.EmpCode= hreducation.EmpCode 
            WHERE hrstaffprofile.EmpName='$username' ";
            $run = $con->query($sql);
            while ($resutlemp = $run->fetch_assoc()) {
                $institution = $resutlemp['Institution'];
                $degree = $resutlemp['Degree'];
                $fieldstudy = $resutlemp['FieldOfStudy'];



            ?>
                <!-- <label for="universtiy">Universtity</label> -->
                <div class="dcs">
                    <label for="">EUD:</label>
                    <input type="text" id="university" value="<?php echo $institution ?>" disabled><br>
                    <label for="">Degree:</label>

                    <input type="text" id="degree" value="<?php echo $degree ?>" disabled><br>
                    <label for="">Major:</label>

                    <input type="text" id="major" value="<?php echo $fieldstudy ?>" disabled><br>
                </div>


            <?php
            }
            ?>
        </div>
        <ul class="list-unstyled components">
            <li>
                <!-- <a href="../view/Dashboard/index.php" target="content">
                    <i class="fa fa-home"></i>Dasborad
                </a> -->
            </li>

        </ul>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>