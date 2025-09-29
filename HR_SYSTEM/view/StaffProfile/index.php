<?php
include('../../root/Header.php');
include '../../root/DataTable.php';
include '../../Config/conect.php';
?>
<style>
    .modal-container {
        background-color: #f9f9f9;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 500px;
        margin: auto;
    }

    .modal-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .modal-container label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-container input[type="text"],
    .modal-container select {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-container input[type="text"]:focus,
    .modal-container select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    .modal-container select {
        background-color: #fff;
        cursor: pointer;
    }

    .modal-container button {
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-container button:hover {
        background-color: #0056b3;
    }
</style>
<h3 class="text-center" style="margin-top: 15px; text-transform: uppercase;">Staff Profile</h3>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <table class="table" id="example" border="1">
        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddstaffModal" style="margin-bottom: 8px; font-size: 14px; ">
            Add New
        </button> -->
        <!-- Button trigger modal -->

        <a href="create.php" style="text-decoration: none; color:white;">
            <button class="btn btn-success" style="margin-bottom: 8px; font-size: 14px;"> <i class="fa fa-plus" style="margin-right: 4px;"></i> Add New </button>

        </a>

        <thead>
            <tr>
                <th style="width: 120px;">Action</th>
                <th>Photo</th>
                <th>Code</th>
                <th>EmpName</th>
                <th>Company</th>
                <th>Position</th>
                <th>Department</th>
                <th>Division</th>
                <th>StartDate</th>
                <th>Status</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT hrstaffprofile.*, 
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
                    ORDER BY EmpCode DESC";
            $resutl = $con->query($sql);
            while ($row = $resutl->fetch_assoc()) {
            ?>
                <tr>
                    <td style="width: 90px;">
                        <button style="font-size: 13px;" type="button" data-bs-toggle="modal" data-bs-target="#updateTaxRateModal" class="btn btn-primary editButton"
                            data-code="<?php echo $row['EmpCode']; ?>"
                            data-empname="<?php echo $row['EmpName']; ?>"
                            data-company="<?php echo $row['Company']; ?>"
                            data-position="<?php echo $row['Position']; ?>"
                            data-department="<?php echo $row['Department']; ?>"
                            data-division="<?php echo $row['Division']; ?>"
                            data-level="<?php echo $row['Level']; ?>"
                            data-startdate="<?php echo $row['StartDate']; ?>"
                            data-status="<?php echo $row['Status']; ?>"
                            data-contact="<?php echo $row['Contact']; ?>"
                            data-gender="<?php echo $row['Gender']; ?>"
                            data-contact="<?php echo $row['Contact']; ?>"
                            data-address="<?php echo $row['Address']; ?>"
                            data-email="<?php echo $row['Email']; ?>"
                            data-tel="<?php echo $row['Telegram']; ?>"
                            data-dob="<?php echo $row['Dob']; ?>"
                            data-probationdate="<?php echo $row['ProbationDate']; ?>"
                            data-salary="<?php echo $row['Salary']; ?>"
                            data-photo="<?php echo $row['Photo']; ?>">
                            <i style="color: white;" class="fa fa-edit"></i>
                        </button>
                        <button style="font-size: 13px;" class="btn btn-danger" onclick="deleteCompany('<?php echo $row['EmpCode']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><img src="../../assets/images/<?php echo $row['Photo']; ?>" style="width: 60px; height: 60px;"></td>
                    <td><?php echo $row['EmpCode']; ?></td>
                    <td><?php echo $row['EmpName']; ?></td>
                    <td><?php echo $row['Company']; ?></td>
                    <td><?php echo $row['Position']; ?></td>
                    <td><?php echo $row['Department']; ?></td>
                    <td><?php echo $row['Division']; ?></td>
                    <td><?php echo $row['StartDate']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td><?php echo $row['Contact']; ?></td>
                </tr>

            <?php

            }
            ?>

        </tbody>
    </table>
</div>



<!-- Updata Modal -->
<div class="modal fade" id="updateTaxRateModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Edit Staff Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid mt-3" style="max-width: 1400px;">
                    <div class="card">
                        <div class="card-body">
                            <form action="../../action/StaffProfile/edit.php" method="post" id="staffForm" enctype="multipart/form-data">
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#familyInfo">
                                            <i class="fas fa-users"></i> Family
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#educationInfo">
                                            <i class="fas fa-graduation-cap"></i> Education
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#documentInfo">
                                            <i class="fas fa-file-alt"></i> Staff Document
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="padding: 10px 5px 0px 5px; box-sizing: border-box;">
                                    <!-- Personal Information  -->
                                    <div class="tab-pane fade show active" id="personalInfo">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="empCode" class="form-label  ">Employee Code</label>
                                                <input type="text" class="form-control" id="empCodeUpdate" name="empCode">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="empName" class="form-label  ">Employee Name</label>
                                                <input type="text" class="form-control" id="empNameUpdate" name="empName">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="gender" class="form-label  ">Gender</label>
                                                <select class="form-select" id="genderUpdate" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dob" class="form-label  ">Date of Birth</label>
                                                <input type="date" class="form-control" id="dobUpdate" name="dob">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="form-label  ">Status</label>
                                                <select class="form-select" id="statusUpdate" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="salary" class="form-label  ">Salary</label>
                                                <input type="number" class="form-control" id="salaryUpdate" name="salary">
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="text-center mt-2">
                                                        <div class="img-preview border rounded p-2">
                                                            <img id="photoPreviewUpdate" src="../../assets/images/images.jpg" alt="Profile Preview" class="img-fluid rounded" style="width: 300px; height: 300px; object-fit: cover;">
                                                            <input type="file" name="photo" id="imageInput" accept="image/*" class="form-control mt-2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Job Information  -->
                                    <div class="tab-pane fade show" id="jobInfo">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="company" class="form-label  ">Company</label>
                                                <!-- <input type="text" class="form-control" id="company" name="company"  > -->
                                                <select class="form-select" id="companyUpdate" name="company">
                                                    <option value="">Select Company</option>
                                                    <?php
                                                    $SQL = "Select *from hrcompany where Status = 'Active'";
                                                    $stmt = $con->query($SQL);
                                                    while ($row = $stmt->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?php echo $row['Description']; ?>"><?php echo $row['Description']; ?></option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="department" class="form-label  ">Department</label>
                                                <!-- <input type="text" class="form-control" id="department" name="department"  > -->
                                                <select class="form-select" id="departmentUpdate" name="department">
                                                    <option value="">Select Department</option>
                                                    <?php
                                                    $stmt = $con->prepare("SELECT Code, Description FROM hrdepartment where Status = 'Active'");
                                                    if ($stmt) {
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row['Description']; ?>"><?php echo $row['Description']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="position" class="form-label  ">Position</label>
                                                <!-- <input type="text" class="form-control" id="position" name="position"  > -->
                                                <select class="form-select" id="positionUpdate" name="position">
                                                    <option value="">Select Position</option>
                                                    <?php
                                                    $stmt = $con->prepare("SELECT Code, Description FROM hrposition where Status = 'Active'");
                                                    if ($stmt) {
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row['Description']; ?>"><?php echo $row['Description']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="division" class="form-label">Division</label>
                                                <!-- <input type="text" class="form-control" id="division" name="division"> -->
                                                <select class="form-select" id="divisionUpdate" name="division">
                                                    <option value="">Select Division</option>
                                                    <?php
                                                    $stmt = $con->prepare("SELECT Code, Description FROM hrdivision where Status = 'Active'");
                                                    if ($stmt) {
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row['Description']; ?>"><?php echo $row['Description']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="level" class="form-label">Level</label>
                                                <!-- <input type="text" class="form-control" id="level" name="level"> -->
                                                <select class="form-select" id="levelUpdate" name="level">
                                                    <option value="">Select Level</option>
                                                    <?php
                                                    $stmt = $con->prepare("SELECT Code, Description FROM hrlevel where Status = 'Active'");
                                                    if ($stmt) {
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row['Description']; ?>"><?php echo $row['Description']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-md-4">
                                                <label for="startDate" class="form-label  ">Start Date</label>
                                                <input type="date" class="form-control" id="startDateUpdate" name="startDate">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="probationDate" class="form-label">Probation End Date</label>
                                                <input type="date" class="form-control" id="probationDateUpdate" name="probationDate">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="isProb" class="form-label">Probation Status</label>
                                                <select class="form-select" id="isProbUpdate" name="isProb">
                                                    <option value="1">In Probation</option>
                                                    <option value="0">Passed Probation</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="telegram" class="form-label">Telegram</label>
                                                <!-- <input type="text" class="form-control" id="telegram" name="telegram"> -->
                                                <select name="telegram" id="telegramUpdate" class="form-select">
                                                    <option value="">Select Telegram</option>
                                                    <option value="">Reqeust Leave</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Contact Information Tab -->
                                    <div class="tab-pane fade " id="contactInfo">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="contact" class="form-label">Contact Number</label>
                                                <input type="tel" class="form-control" id="contactUpdate" name="contact">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="emailUpdate" name="email">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="addressUpdate" name="address" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="updatestaff">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('.editButton').on('click', function() {
            var code = $(this).data('code');
            var empname = $(this).data('empname');
            var company = $(this).data('company');
            var position = $(this).data('position');
            var department = $(this).data('department');
            var division = $(this).data('division');
            var startdate = $(this).data('startdate');
            var status = $(this).data('status');
            var contact = $(this).data('contact');
            var gender = $(this).data('gender');
            var address = $(this).data('address');
            var email = $(this).data('email');
            var tel = $(this).data('tel');
            var dob = $(this).data('dob');
            var salary = $(this).data('salary');
            var level = $(this).data('level');
            var isProb = $(this).data('isprob');
            var probationDate = $(this).data('probationdate');
            var telegram = $(this).data('tel');
            var dob = $(this).data('dob');
            var photo = $(this).data('photo');

            //set value to modal update
            $('#empCodeUpdate').val(code);
            $('#empNameUpdate').val(empname);
            $('#companyUpdate').val(company);
            $('#positionUpdate').val(position);
            $('#departmentUpdate').val(department);
            $('#divisionUpdate').val(division);
            $('#startDateUpdate').val(startdate);
            $('#statusUpdate').val(status);
            $('#contactUpdate').val(contact);
            $('#genderUpdate').val(gender);
            $('#addressUpdate').val(address);
            $('#emailUpdate').val(email);
            $('#telUpdate').val(tel);
            $('#dobUpdate').val(dob);
            $('#salaryUpdate').val(salary);
            $('#levelUpdate').val(level);
            $('#isProbUpdate').val(isProb);
            $('#probationDateUpdate').val(probationDate);
            $('#telegramUpdate').val(telegram);
            $('#photoPreviewUpdate').attr('src', '../../assets/images/' + photo);

        })

    });
</script>

<!-- //delete alert mesaages -->
<script>
    function deleteCompany(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the payroll record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/StaffProfile/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The payroll has been removed.',
                            confirmButtonColor: '#3085d6',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // 🔄 Refresh the page
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: 'Could not delete the payroll.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>