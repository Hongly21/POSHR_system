<?php
include('../../root/Header.php');
include('../../root/DataTable.php');
include('../../Config/conect.php');
?>
<h3 style="text-align: center;">Edit Staff</h3>
<?php
if (isset($_GET['code'])) {
    $empCode = $_GET['code'];
    // $sql="SELECT * FROM hrstaffprofile WHERE EmpCode = '$empCode'";
    $sql = "SELECT hrstaffprofile.*, 
                    hrcompany.Description as CompanyName,
                    hrdepartment.Description as DepartmentName,
                    hrdivision.Description as DivisionName,
                    hrposition.Description as PositionName,
                    hrlevel.Description as LevelName,
                    hrstaffprofile.Department as DeptCode
                    FROM hrstaffprofile
                    LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
                    LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
                    LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
                    LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
                    LEFT JOIN hrlevel ON hrstaffprofile.Level = hrlevel.Code
                    WHERE hrstaffprofile.EmpCode = '$empCode'";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $empcode = $row['EmpCode'];
        $empname = $row['EmpName'];
        $gender = $row['Gender'];
        $dob = $row['Dob'];
        $email = $row['Email'];
        $address = $row['Address'];
        $position = $row['PositionName'];
        $division = $row['DivisionName'];
        $level = $row['LevelName'];
        $department = $row['DepartmentName'];
        $company = $row['CompanyName'];
        $status = $row['Status'];
        $startDate = $row['StartDate'];
        $salary = $row['Salary'];
        $level = $row['Level'];
        $isProb = $row['IsProb'];
        $probationDate = $row['ProbationDate'];
        $contact = $row['Contact'];
        $telegram = $row['Telegram'];
        $photo = $row['Photo'];
        $lineManager = $row['LineManager'];
        $hod = $row['Hod'];
        $payParamter = $row['PayParameter'];


?>


        <body style="margin: 40px">
            <div class="container-fluid mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Staff Profile</h5>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="staffForm" method="POST" enctype="multipart/form-data">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalInfo">
                                        <i class="fas fa-user"></i> Personal Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#jobInfo">
                                        <i class="fas fa-briefcase"></i> Job Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#contactInfo">
                                        <i class="fas fa-address-book"></i> Contact Information
                                    </a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <!-- Personal Information Tab -->
                                <div class="tab-pane fade show active" id="personalInfo">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="empCode" class="form-label  ">Employee Code</label>
                                            <input type="text" class="form-control" id="empCode" name="empCode" value="<?php echo $empcode; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="empName" class="form-label  ">Employee Name</label>
                                            <input type="text" class="form-control" id="empNameupdate" name="empName" value="<?php echo $empname; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label  ">Gender</label>
                                            <select class="form-select" id="genderupdate" name="gender">
                                                <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dobupdate" name="dob" value="<?php echo $dob; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="photo" class="form-label">Profile Photo</label>
                                            <input type="file" class="form-control" id="photoupdate" accept="image/*" value="<?php echo $photo ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="salary" class="form-label  ">Salary</label>
                                            <input type="number" class="form-control" id="salaryupdate" name="salary" value="<?php echo $salary; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center mt-2">
                                                <div class="img-preview border rounded p-2">
                                                    <img id="photoPreview" src="../../assets/images/<?php echo $photo; ?>" alt="Profile Preview" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Information Tab -->
                                <div class="tab-pane fade" id="jobInfo">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="company" class="form-label  ">Company</label>
                                            <!-- <input type="text" class="form-control" id="company" name="company"  > -->
                                            <select class="form-select" id="companyupdate" name="company">
                                                <option value="<?php
                                                                $companyname = $row['CompanyName'];
                                                                //find company code for hr company by company name
                                                                $stmt = $con->prepare("SELECT Code FROM hrcompany where Description = '$companyname'");
                                                                if ($stmt) {
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $companycode = $row['Code'];
                                                                    }
                                                                }
                                                                echo $companycode;

                                                                ?>"><?php echo $company; ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT Code, Description FROM hrcompany where Status = 'Active'");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department" class="form-label  ">Department</label>
                                            <!-- <input type="text" class="form-control" id="department" name="department"  > -->
                                            <select class="form-select" id="departmentupdate" name="department">
                                                <option value="<?php
                                                                $stmt = $con->prepare("SELECT Code FROM hrdepartment where Description = '$department'");
                                                                if ($stmt) {
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row['Code'];
                                                                    }
                                                                }
                                                                ?> "><?php echo $department; ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT Code, Description FROM hrdepartment where Status = 'Active'");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="position" class="form-label  ">Position</label>
                                            <!-- <input type="text" class="form-control" id="position" name="position"  > -->
                                            <select class="form-select" id="positionupdate" name="position">
                                                <option value="<?php
                                                                $stmt = $con->prepare("SELECT Code FROM hrposition where Description = '$position'");
                                                                if ($stmt) {
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $poscode = $row['Code'];
                                                                    }
                                                                }
                                                                echo $poscode;
                                                                ?>"><?php echo $position; ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT Code, Description FROM hrposition where Status = 'Active'");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="division" class="form-label">Division</label>
                                            <!-- <input type="text" class="form-control" id="division" name="division"> -->
                                            <select class="form-select" id="divisionupdate" name="division">
                                                <option value="<?php

                                                                $stmt = $con->prepare("SELECT Code FROM hrdivision where Description = '$division'");
                                                                if ($stmt) {
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $divisioncode = $row['Code'];
                                                                    }
                                                                }
                                                                echo $divisioncode;

                                                                ?>"><?php echo $division; ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT Code, Description FROM hrdivision where Status = 'Active'");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="level" class="form-label">Level</label>
                                            <!-- <input type="text" class="form-control" id="level" name="level"> -->
                                            <select class="form-select" id="levelupdate" name="level">
                                                <option value="<?php
                                                                echo $level;
                                                                ?>"><?php
                                                                    $sql = "SELECT Description FROM hrlevel where Code = '$level'";
                                                                    $result = $con->query($sql);
                                                                    $row = $result->fetch_assoc();
                                                                    echo $row['Description'];
                                                                    ?></option>

                                                <?php
                                                $stmt = $con->prepare("SELECT Code, Description FROM hrlevel where Status = 'Active'");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-md-4">
                                            <label for="startDate" class="form-label  ">Start Date</label>
                                            <input type="date" class="form-control" id="startDateupdate" name="startDate" value="<?php echo $startDate; ?>">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="probationDate" class="form-label">Probation End Date</label>
                                            <input type="date" class="form-control" id="probationDateupdate" name="probationDate" value="<?php echo $probationDate; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="isProb" class="form-label">Probation Status</label>
                                            <select class="form-select" id="isProbupdate" name="isProb">
                                                <option value="<?php echo $isProb; ?>"><?php if ($isProb == 1) echo "In Probation";
                                                                                        else echo "Passed Probation"; ?></option>
                                                <option value="1">In Probation</option>
                                                <option value="0">Passed Probation</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="telegram" class="form-label">Telegram</label>
                                            <!-- <input type="text" class="form-control" id="telegram" name="telegram"> -->
                                            <select name="telegram" id="telegramupdate" class="form-select">
                                                <option value="<?php echo $telegram; ?>"><?php
                                                                                            $sql = "SELECT chat_name FROM sytelegram_config WHERE chat_id = '$telegram'";
                                                                                            $result = $con->query($sql);
                                                                                            $row = $result->fetch_assoc();
                                                                                            echo $row['chat_name'];
                                                                                            ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT chat_id, chat_name FROM sytelegram_config");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['chat_id']; ?>"><?php echo $row['chat_name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="status" class="form-label  ">Status</label>
                                            <select class="form-select" id="statusupdate" name="status" value="<?php echo $status; ?>">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lineManager" class="form-label">Line Manager</label>
                                            <!-- <input type="text" class="form-control" id="lineManager" name="lineManager"> -->
                                            <select name="lineManager" id="lineManagerupdate" class="form-select">
                                                <option value="<?php echo $lineManager; ?>"><?php $sql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$lineManager'";
                                                                                            $result = $con->query($sql);
                                                                                            $row = $result->fetch_assoc();
                                                                                            echo $row['EmpName'];

                                                                                            ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT empcode, empname FROM hrstaffprofile");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['empcode']; ?>"><?php echo $row['empname']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="hod" class="form-label">Head of Department</label>
                                            <!-- <input type="text" class="form-control" id="hod" name="hod"> -->
                                            <select name="hod" id="hodupdate" class="form-select">
                                                <option value="<?php echo $hod; ?>">
                                                    <?php
                                                    $sql = " SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$hod'";
                                                    $result = $con->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    echo $row['EmpName'];
                                                    ?>
                                                </option>
                                                <?php
                                                $stmt = $con->prepare("SELECT empcode, empname FROM hrstaffprofile");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['empcode']; ?>"><?php echo $row['empname']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="payParamter" class="form-label">Pay Parameter</label>
                                            <!-- <input type="text" class="form-control" id="payParamter" name="payParamter"> -->
                                            <select name="payParamter" id="payParamterupdate" class="form-control">
                                                <option value="<?php echo $payParamter; ?> "><?php $sql1 = "SELECT * FROM prpaypolicy WHERE id=$payParamter";
                                                                                                $result1 = $con->query($sql1);
                                                                                                $row1 = $result1->fetch_assoc();
                                                                                                echo $row1['description']; ?></option>
                                                <?php
                                                $stmt = $con->prepare("SELECT id, description FROM prpaypolicy");
                                                if ($stmt) {
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['description']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information Tab -->
                                <div class="tab-pane fade" id="contactInfo">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="contact" class="form-label">Contact Number</label>
                                            <input type="tel" class="form-control" id="contactupdate" name="contact" value="<?php echo $contact; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="emailupdate" name="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="addressupdate" name="address" rows="3"><?php echo $address; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mt-3">
                                <button type="button" id="updateStaff" class="btn btn-primary" style="margin-right: 5px;">Update</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

    <?php

    }
}
    ?>

        </body>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            /// profile image preview after select file
            $('#photo').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#photoPreview').attr('src', URL.createObjectURL(file));
                }
            });
            //preview image after select file
            $('#photoupdate').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#photoPreview').attr('src', URL.createObjectURL(file));
                }
            });

            // Update staff information
            $('#updateStaff').on('click', function() {
                var empcode = $('#empCode').val();
                var empname = $('#empNameupdate').val();
                var gender = $('#genderupdate').val();
                var dob = $('#dobupdate').val();
                var salary = $('#salaryupdate').val();
                var company = $('#companyupdate').val();
                var department = $('#departmentupdate').val();
                var position = $('#positionupdate').val();
                var division = $('#divisionupdate').val();
                var level = $('#levelupdate').val();
                var startDate = $('#startDateupdate').val();
                var probationDate = $('#probationDateupdate').val();
                var isProb = $('#isProbupdate').val();
                var email = $('#emailupdate').val();
                var contact = $('#contactupdate').val();
                var address = $('#addressupdate').val();
                var payParamter = $('#payParamterupdate').val();
                var lineManager = $('#lineManagerupdate').val();
                var hod = $('#hodupdate').val();
                var status = $('#statusupdate').val();
                var startdate = $('#startDateupdate').val();
                var telegram = $('#telegramupdate').val();
                var photo = $('#photoupdate')[0].files[0];
                if (empcode && empname && dob && salary && company && department && position) {

                    var formData = new FormData();
                    formData.append('empcode', empcode);
                    formData.append('empname', empname);
                    formData.append('gender', gender);
                    formData.append('dob', dob);
                    formData.append('salary', salary);
                    formData.append('company', company);
                    formData.append('department', department);
                    formData.append('position', position);
                    formData.append('division', division);
                    formData.append('level', level);
                    formData.append('startDate', startDate);
                    formData.append('probationDate', probationDate);
                    formData.append('isProb', isProb);
                    formData.append('email', email);
                    formData.append('contact', contact);
                    formData.append('address', address);
                    formData.append('payParamter', payParamter);
                    formData.append('lineManager', lineManager);
                    formData.append('hod', hod);
                    formData.append('status', status);
                    formData.append('startdate', startdate);
                    formData.append('telegram', telegram);
                    if (photo) {
                        formData.append('photo', photo);
                    }

                    $.ajax({
                        url: '../../action/StaffProfile/edit.php',
                        method: 'POST',
                        data: formData,
                        processData: false, 
                        contentType: false, 
                        success: function(response) {
                            if (response.trim() === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Update Staff Successfully'
                                }).then(function() {
                                    window.location.href = 'index.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'AJAX Error',
                                text: error
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Please fill in all required fields',
                        showConfirmButton: true
                    });
                }
            });
        </script>