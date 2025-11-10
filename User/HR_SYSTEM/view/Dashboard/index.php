<?php

include('../../Config/conect.php');
include('../../root/Header.php');
//find empcde by username 

$username = $_GET['username'];
$sql = "SELECT EmpCode FROM hrstaffprofile WHERE EmpName='$username'";
$run = $con->query($sql);

if ($run->num_rows > 0) {
    $row = $run->fetch_assoc();
    $empcode = $row['EmpCode'];
}

?>

<style>
    .pwd-container {
        margin: 30px;
        display: flex;
        justify-content: center;
        align-items: center;

    }





    .tbl-user-detail {
        display: flex;
        align-items: flex-start;
        background: #ffffff;
        padding: 20px 10px 10px 10px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); */
        max-width: 100%;
        margin: 10px 15px 5px 15px;
        font-family: "Poppins", sans-serif;
        color: #333;
    }

    /* --- Description section --- */
    .dcs {
        float: left;
        width: 100%;
        overflow: hidden;
    }

    /* LEFT SIDE layout like Code : [input] */
    .dcs-left {
        width: 33%;
        float: left;
    }

    .dcs-left input {
        margin: 0px 2px 0px 5px;
    }

    .dcs-left label {
        font-weight: bold;

    }


    /* RIGHT SIDE */
    .dcs-right {
        width: 65%;
        float: left;
        margin-left: 2%;


    }

    .dcs-right th {
        background-color: #c5daf3ff;
    }

    .dcs-left td:first-child {

        background-color: #c5daf3ff;
    }



    /* --- User info box --- */
    .user-infor {
        background: #f8f9fc;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .user-infor .datial-user label {
        margin-top: 12px;
        display: inline-block;
        width: 110px;
        /* adjust width to align labels neatly */
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .user-infor .datial-user input {
        margin-bottom: 8px;
        width: calc(100% - 130px);
        /* make input align beside label */
        padding: 6px 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #f9f9f9;
        font-size: 14px;
        color: #333;
    }

    .datial-user label {
        margin-top: 12px;
        display: inline-block;
        width: 110px;
        /* adjust width to align labels neatly */
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .datial-user input {
        margin-bottom: 8px;
        width: calc(100% - 130px);
        /* make input align beside label */
        padding: 6px 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #f9f9f9;
        font-size: 14px;
        color: #333;
    }

    /* --- Button --- */
    .user-infor button {
        margin-top: 15px;
        width: 100%;
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 0;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .user-infor button:hover {
        background: #0056b3;
    }



    .user-infor button:hover {
        background: #0056b3;
    }

    /* --- Responsive --- */
    @media (max-width: 900px) {
        .tbl-user-detail {
            flex-direction: column;
            align-items: center;
        }

        .dcs {
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        .dcs-left label {
            width: 100%;
            margin-bottom: 5px;
        }

        .dcs-left input {
            width: 100%;
        }

        .image-user {
            margin-bottom: 20px;
        }
    }
</style>

<body>

    <h2 style="text-align: center; margin-top: 10px; text-transform: uppercase;"><i class="fa fa-user"></i> Employee Profile</h2>

    <div class="container" style="margin-top: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <nav>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Employee Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Leave Request</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Family Member</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document-tab-pane" type="button" role="tab" aria-controls="document-tab-pane" aria-selected="false">Document</button>
                </li> -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pwd-tab" data-bs-toggle="tab" data-bs-target="#pwd-tab-pane" type="button" role="tab" aria-controls="pwd-tab-pane" aria-selected="false">Change Password</button>
                </li>

            </ul>
        </nav>
        <div class="tab-content" id="myTabContent">
            <!-- User Information -->
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <?php
                include('../../Config/conect.php');

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

                $Code = $row['EmpCode'];
                $empName = $row['EmpName'];
                $dob = $row['DOB'];
                $gender = $row['Gender'];
                $address = $row['Address'];
                $contact = $row['Contact'];
                $email = $row['Email'];
                $company = $row['CompanyName'];
                $department = $row['DepartmentName'];
                $division = $row['DivisionName'];
                $position = $row['PositionName'];
                $level = $row['LevelName'];
                $salary = $row['Salary'];
                $photo = $row['Photo'];


                ?>
                <div class="tbl-user-detail">
                    <div class="dcs">
                        <div class="dcs-left">
                            <h3 style="text-align: center; margin-bottom: 1rem; text-transform: uppercase;">User Information</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td class="label"><label for="Code">Code</label></td>
                                    <td><input type="text" id="Code" value="<?php echo $Code; ?>" disabled></td>
                                </tr>

                                <tr>
                                    <td class="label"><label for="dob">DOB</label></td>
                                    <td><input type="text" id="dob" value="<?php echo $dob; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Gender">Gender</label></td>
                                    <td><input type="text" id="Gender" value="<?php echo $gender; ?>" disabled></td>
                                </tr>

                                <tr>
                                    <td class="label"><label for="Contact">Contact</label></td>
                                    <td><input type="text" id="Contact" value="<?php echo $contact; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Email">Email</label></td>
                                    <td>
                                        <input type="text" id="Email" value="<?php
                                                                                $sqlemail = "SELECT Email FROM hrusers WHERE Username='$username'";
                                                                                $resultemail = $con->query($sqlemail);
                                                                                $rowemail = $resultemail->fetch_assoc();
                                                                                echo $rowemail['Email'];
                                                                                ?>" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Salary">Salary</label></td>
                                    <td><input type="text" id="Salary" value="$ <?php echo $salary; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Company">Company</label></td>
                                    <td><input type="text" id="Company" value="<?php echo $company; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Position">Position</label></td>
                                    <td><input type="text" id="Position" value="<?php echo $position; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Department">Department</label></td>
                                    <td><input type="text" id="Department" value="<?php echo $department; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="Division">Division</label></td>
                                    <td><input type="text" id="Division" value="<?php echo $division; ?>" disabled></td>
                                </tr>
                            </table>

                        </div>
                        <div class="dcs-right">
                            <h3 class="text-center" style="text-transform: uppercase; margin-bottom: 1rem;">Education</h3>
                            <!-- education information -->
                            <?php
                            $no = 1;
                            $sqleducation = "SELECT * FROM hreducation WHERE EmpCode='$empcode'";
                            $resulteducation = $con->query($sqleducation);;

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Institution</th>
                                        <th>Degree</th>
                                        <th>Field of Study</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($roweducation = $resulteducation->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td> <?php echo $roweducation['Institution']; ?> </td>
                                            <td> <?php echo $roweducation['Degree']; ?> </td>
                                            <td> <?php echo $roweducation['FieldOfStudy']; ?> </td>
                                            <td> <?php echo $roweducation['StartDate']; ?> </td>
                                            <td> <?php echo $roweducation['EndDate']; ?> </td>
                                        </tr>

                                    <?php

                                    }
                                    ?>

                                </tbody>
                            </table>



                            <h4 style="text-align: center; margin-top:45px;">DOCUMENTS</h4>
                            <table class="table table-bordered" style="margin-top:15px">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>EmpCode</th>
                                        <th>Document Type</th>
                                        <th>Description</th>
                                        <th>File Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    $slqduc = "SELECT * FROM hrstaffdocument WHERE EmpCode='$empcode'";
                                    $resduc = $con->query($slqduc);
                                    while ($rowduc = $resduc->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rowduc['EmpCode']; ?></td>
                                            <td><?php echo $rowduc['DocType']; ?></td>
                                            <td><?php echo $rowduc['Description']; ?></td>
                                            <td><?php echo $rowduc['Photo']; ?></td>
                                            <td>



                                                <button type="button" class="btn btn-sm btn-info view-document" data-bs-toggle="modal" data-bs-target="#viewdocumentModal" data-file="<?php echo $rowduc['Photo']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    <?php
                                    }

                                    ?>

                                </tbody>
                            </table>

                            <!-- modal view document -->
                            <div class="modal fade" id="viewdocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">View Document</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="documentPreviewViewuser" src="../../../assets/documents/" style="width:100%; height:400px;  display:none;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a id="downloadDocument" class="btn btn-success mt-2">Download</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //view document  -->
                            <script>
                                $('.view-document').on('click', function() {
                                    var fileName = $(this).data('file');
                                    var preview = $('#documentPreviewViewuser');
                                    var filePath = '../../../../HR_SYSTEM/assets/documents/' + fileName;
                                    var fileExtension = fileName.split('.').pop().toLowerCase();

                                    if (fileName == '') {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Preview not available',
                                            text: 'This user does not have any document.',
                                        })
                                        preview.hide();
                                    } else {
                                        preview.attr('src', filePath).show();
                                    }


                                    //dowload file
                                    $('#downloadDocument').attr('href', filePath);
                                    $('#downloadDocument').attr('download', fileName);

                                });
                            </script>




                        </div>
                    </div>
                </div>
                <hr>

                <?php
                ?>


            </div>
            <!-- Leave request form -->
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <?php
                $sql = "SELECT hrstaffprofile.EmpName, lmleaverequest.* FROM hrstaffprofile
             INNER JOIN lmleaverequest ON hrstaffprofile.EmpCode = lmleaverequest.EmpCode 
             WHERE hrstaffprofile.EmpName = '$username' ORDER BY FromDate DESC";
                $result = $con->query($sql);
                ?>
                <div class="container-fluid mt-4 mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0">Leave Request List</h4>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <i class="fas fa-plus me-2"></i>New Leave Request
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="leaveRequestTable" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Actions</th>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Leave Type</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td class="action-buttons">
                                                        <button type="button" class="btn btn-sm btn-warning editbtn"
                                                            data-code="<?php echo $row['ID']; ?>"
                                                            data-empcode="<?php echo $row['EmpCode']; ?>"
                                                            data-leavetype="<?php echo $row['LeaveType']; ?>"
                                                            data-fromdate="<?php echo $row['FromDate']; ?>"
                                                            data-todate="<?php echo $row['ToDate']; ?>"
                                                            data-leaveday="<?php echo $row['LeaveDay']; ?>"
                                                            data-reason="<?php echo $row['Reason']; ?>"

                                                            data-bs-toggle="modal" data-bs-target="#staticBackdropupdate">
                                                            <i class="fas fa-edit"></i>
                                                        </button>


                                                        <button class="btn btn-sm btn-danger" onclick="deleteCompanyd('<?php echo $row['ID']; ?>')"><i class="fa fa-trash"></i></button>




                                                    </td>
                                                    <td><?php echo htmlspecialchars($row['EmpCode']); ?></td>
                                                    <td>
                                                        <?php $empcode = ($row['EmpCode']);
                                                        $slq = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                                        $result1 = $con->query($slq);
                                                        $row1 = $result1->fetch_assoc();
                                                        echo $row1['EmpName'];
                                                        ?></td>
                                                    <td><?php
                                                        $leavetype = ($row['LeaveType']);
                                                        $sql = "SELECT LeaveType FROM lmleavetype WHERE Code='$leavetype'";
                                                        $result2 = $con->query($sql);
                                                        $row2 = $result2->fetch_assoc();
                                                        echo $row2['LeaveType'];
                                                        ?></td>
                                                    <td><?php echo date('d M Y', strtotime($row['FromDate'])); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($row['ToDate'])); ?></td>
                                                    <td>
                                                        <span class="badge bg-<?php echo $row['Status'] === 'Approved' ? 'success' : ($row['Status'] === 'Rejected' ? 'danger' : 'warning'); ?>"><?php echo $row['Status']; ?></span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($row['Reason'] ?? '-'); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- for active on tab page -->
                <script>
                    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                        tab.addEventListener('shown.bs.tab', function(event) {
                            localStorage.setItem('activeTab', event.target.getAttribute('data-bs-target'));
                        });
                    });

                    window.addEventListener('DOMContentLoaded', () => {
                        const activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            const triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
                            if (triggerEl) {
                                const tab = new bootstrap.Tab(triggerEl);
                                tab.show();
                            }
                        }
                    });
                </script>

                <!-- //delete alert mesaages -->
                <script>
                    function deleteCompanyd(code) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This will permanently delete the Leave record.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '../../action/LeaveRequest/delete.php',
                                    method: 'GET',
                                    data: {
                                        Code: code
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'The Leave request has been removed.',
                                            confirmButtonColor: '#3085d6',
                                            timer: 1500,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location.reload();
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Delete Failed',
                                            text: 'Could not delete the Leave request.',
                                            footer: error
                                        });
                                    }
                                });
                            }
                        });
                    }
                </script>

                <!-- Modal add leave request -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Leave Request</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="leaveRequestForm">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="employeeName" class="form-label required">Employee Name</label>
                                                                    <input type="text" class="form-control" id="employeeName" name="employeeName" readonly
                                                                        value="<?php
                                                                                $username = $_GET['username'];
                                                                                $sql = "SELECT EmpCode FROM hrstaffprofile WHERE EmpName='$username'";
                                                                                $result = $con->query($sql);
                                                                                $row = $result->fetch_assoc();
                                                                                echo $row['EmpCode'];

                                                                                ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="leaveType" class="form-label required">Leave Type</label>
                                                                    <select class="form-select" id="leaveType" name="leaveType" required>
                                                                        <option value="">Select Leave Type</option>
                                                                        <?php
                                                                        $sql = "SELECT * FROM lmleavetype";
                                                                        $result = $con->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo "<option value='" . htmlspecialchars($row['Code']) . "'>" .
                                                                                htmlspecialchars($row['LeaveType']) . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="fromDate" class="form-label required">From Date</label>
                                                                    <input type="date" class="form-control" id="fromDate" name="fromDate" onchange="calculateLeaveDays()" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="toDate" class="form-label required">To Date</label>
                                                                    <input type="date" class="form-control" id="toDate" name="toDate" onchange="calculateLeaveDays()" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="leaveDay" class="form-label required">Leave Day</label>
                                                                    <input type="number" class="form-control" id="leaveDay" name="leaveDay" value="0" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="reason" class="form-label required">Reason</label>
                                                                    <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.btnsubmit').click(function(e) {
                                            e.preventDefault();

                                            var empcode = $('#employeeName').val();
                                            var leaveType = $('#leaveType').val();
                                            var fromDate = $('#fromDate').val();
                                            var toDate = $('#toDate').val();
                                            var reason = $('#reason').val();


                                            $.ajax({
                                                url: '../../action/LeaveRequest/create.php',
                                                method: 'POST',
                                                data: {
                                                    empcode: empcode,
                                                    leaveType: leaveType,
                                                    fromDate: fromDate,
                                                    toDate: toDate,
                                                    reason: reason,
                                                },
                                                success: function(response) {
                                                    console.log(response); // 
                                                    response = response.trim();

                                                    if (response === 'success') {
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: 'Leave request created successfully',
                                                            showConfirmButton: true
                                                        }).then((result) => {
                                                            location.reload();
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: response,
                                                            showConfirmButton: true
                                                        });
                                                    }
                                                },
                                                error: function(error) {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'Something went wrong: ' + error,
                                                        showConfirmButton: true
                                                    });
                                                }
                                            });
                                        });
                                    });
                                </script>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btnsubmit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Update   Modal -->
                <div class="modal fade" id="staticBackdropupdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Leave Request</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="leaveRequestForm">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="employeeID" class="form-label required">Employee ID</label>
                                                                    <input type="text" class="form-control" id="employeeIDupdate" name="employeeIDupdate" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="leaveType" class="form-label required">Leave Type</label>
                                                                    <input type="text" class="form-control" id="leaveTypeupdate" name="leaveTypeupdate" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="fromDate" class="form-label required">From Date</label>
                                                                    <input type="date" class="form-control" id="fromDateupdate" name="fromDateupdate" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="toDate" class="form-label required">To Date</label>
                                                                    <input type="date" class="form-control" id="toDateupdate" name="toDateupdate" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="leaveDay" class="form-label required">Leave Day</label>
                                                                    <input type="number" class="form-control" id="leaveDayupdate" name="leaveDayupdate" value="">
                                                                    <input type="hidden" name="id" id="id" value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="reason" class="form-label required">Reason</label>
                                                                    <textarea class="form-control" id="reasonupdate" name="reasonupdate" rows="3" value=""> </textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.editbtn').click(function(e) {
                                            e.preventDefault();

                                            var id = $(this).data('code');
                                            var empcode = $(this).data('empcode');
                                            var leavetype = $(this).data('leavetype');
                                            var fromDate = $(this).data('fromdate');
                                            var toDate = $(this).data('todate');
                                            var leaveday = $(this).data('leaveday');
                                            var reason = $(this).data('reason');

                                            // set value to modal update
                                            $('#employeeIDupdate').val(empcode);
                                            $('#leaveTypeupdate').val(leavetype);
                                            $('#fromDateupdate').val(fromDate);
                                            $('#toDateupdate').val(toDate);
                                            $('#leaveDayupdate').val(leaveday);
                                            $('#reasonupdate').val(reason);
                                            $('#id').val(id);


                                        });

                                        $('.btnupdate').click(function() {
                                            var id = $('#id').val();
                                            var fromDate = $('#fromDateupdate').val();
                                            var toDate = $('#toDateupdate').val();
                                            var reason = $('#reasonupdate').val();

                                            $.ajax({
                                                url: '../../action/LeaveRequest/edit.php',
                                                method: 'POST',
                                                data: {
                                                    action: 'btnupdate',
                                                    id: id,
                                                    fromDate: fromDate,
                                                    toDate: toDate,
                                                    reason: reason,
                                                },
                                                success: function(response) {
                                                    console.log(response); // 
                                                    response = response.trim();

                                                    if (response === 'success') {
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: 'Leave request updated successfully',
                                                            showConfirmButton: true
                                                        }).then(() => {
                                                            location.reload();
                                                        });
                                                    } else if (response === 'Already Approved or Rejected') {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Cannot update leave request',
                                                            text: 'This request is already approved or rejected.',
                                                            showConfirmButton: true
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: response,
                                                            showConfirmButton: true
                                                        });
                                                    }
                                                },
                                                error: function(error) {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'Something went wrong: ' + error,
                                                        showConfirmButton: true
                                                    });
                                                }
                                            });

                                        })
                                    });
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btnupdate">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- family member tab -->
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <h2 style="text-align: center; margin-bottom: 20px; text-transform: uppercase; margin-top: 15px;">Family Member</h2>
                <div class="family_member">
                    <?php
                    $sqlfamily = "SELECT hrstaffprofile.EmpName, hrfamily.* FROM hrstaffprofile INNER JOIN hrfamily ON hrstaffprofile.EmpCode= hrfamily.EmpCode 
                        WHERE hrstaffprofile.EmpName='$username'";
                    $runfamily = $con->query($sqlfamily);

                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> No</th>
                                <th>Relation Name</th>
                                <th>Relation Type</th>
                                <th>Gender</th>
                                <th>Is Tax</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $runfamily->fetch_assoc()) {

                            ?>

                                <tr>
                                    <td><?php
                                        //count number of family member
                                        echo $no++;

                                        ?></td>
                                    <td><?php echo $row['RelationName']; ?></td>
                                    <td><?php echo $row['RelationType']; ?></td>
                                    <td><?php echo $row['Gender']; ?></td>
                                    <td><?php if ($row['IsTax'] == 1) echo '<span class="badge bg-success">Yes</span>';
                                        else echo '<span class="badge bg-danger">No</span>'; ?></td>
                                </tr>
                            <?php


                            }


                            ?>
                        </tbody>
                    </table>
                    <?php

                    ?>
                </div>
            </div>
            <!-- document -->
            <!-- <div class="tab-pane fade" id="document-tab-pane" role="tabpanel" aria-labelledby="document-tab" tabindex="0">
            </div> -->
            <!-- change password -->
            <div class="tab-pane fade" id="pwd-tab-pane" role="tabpanel" aria-labelledby="pwd-tab" tabindex="0">
                <?php
                $sqluser = "SELECT * FROM hrusers WHERE Username = '$username'";
                $resultuser = $con->query($sqluser);
                $rowuser = $resultuser->fetch_assoc();

                $password = $rowuser['Password'];
                $role = $rowuser['Role'];
                $Username = $rowuser['Username'];
                ?>

                <div class="pwd-container">
                    <div class="user-infor">
                        <div class="datial-user">
                            <label for="Username">Username</label>
                            <input type="text" name="Username" id="Username" value=" <?php echo $Username; ?>" disabled> <br>

                            <label class="label" for="Password">Password</label>
                            <input type="password" name="Password" id="Password" value=" <?php echo $password; ?>" disabled> <br>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdroppws">
                            Change Password
                        </button>
                    </div>
                    <!-- Modal Change password -->
                    <div class="modal fade" id="staticBackdroppws" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="datial-user">
                                        <label>Username</label>
                                        <input type="text" id="username" value=""><br>

                                        <label>New Password</label>
                                        <input type="text" id="newpwd"><br>

                                        <label>Old Password</label>
                                        <input type="text" id="oldpwd"><br>

                                        <input type="hidden" id="usernameforupdate" value="<?php echo $username; ?>">
                                        <input type="hidden" id="passwordforupdate" value="<?php echo $password; ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary updatepwd">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- change pwd user -->
                    <script>
                        $(document).ready(function() {
                            $('.updatepwd').click(function() {
                                var username = $('#username').val().trim();
                                var newpwd = $('#newpwd').val().trim();
                                var oldpwd = $('#oldpwd').val().trim();
                                var usernameforupdate = $('#usernameforupdate').val().trim();
                                var passwordforupdate = $('#passwordforupdate').val().trim();

                                // Check if username matches
                                if (username === usernameforupdate) {
                                    // Compare password correctly (trim spaces and match exactly)
                                    if (oldpwd === passwordforupdate) {
                                        // Old password matched — now update
                                        $.ajax({
                                            url: '../../action/User/update.php',
                                            type: 'POST',
                                            data: {
                                                usernameforupdate: usernameforupdate,
                                                newpwd: newpwd
                                            },
                                            success: function(response) {
                                                if (response.trim() === 'success') {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        text: 'Password updated successfully.'
                                                    }).then(() => {
                                                        location.reload();
                                                    });
                                                } else if (response === 'pwdnotshort') {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        text: 'Password must be at least 8 characters.'
                                                    })

                                                } else if (response === 'cannotuse') {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        text: 'Can not use password.'
                                                    })

                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        text: 'Update failed.'
                                                    });
                                                }
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Old password is incorrect.'
                                        });
                                    }
                                } else {
                                    Swal.fire({
                                        icon: 'info',
                                        text: 'Invalid username.'
                                    });
                                }
                            });
                        });
                    </script>
                </div>


                <?php

                ?>

            </div>

        </div>

</body>

</html>