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
                    hrlevel.Description as LevelName 
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
    }
}

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
                                        <option value=""><?php echo $gender; ?></option>
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
                                    <input type="file" class="form-control" id="photoupdate" name="photo" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="salary" class="form-label  ">Salary</label>
                                    <input type="number" class="form-control" id="salaryupdate" name="salary" value="<?php echo $salary; ?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center mt-2">
                                        <div class="img-preview border rounded p-2">
                                            <img id="photoPreview" src="../../assets/images/images.jpg" alt="Profile Preview" class="img-fluid rounded">
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
                                        <option value=""><?php echo $company; ?></option>
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
                                        <option value=""><?php echo $department; ?></option>
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
                                        <option value=""><?php echo $position; ?></option>
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
                                        <option value=""><?php echo $division; ?></option>
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
                                        <option value=""><?php echo $level; ?></option>

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
                                        <option value=""><?php if ($isProb == 1) echo "In Probation";
                                                            else echo "Passed Probation"; ?></option>
                                        <option value="1">In Probation</option>
                                        <option value="0">Passed Probation</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="telegram" class="form-label">Telegram</label>
                                    <!-- <input type="text" class="form-control" id="telegram" name="telegram"> -->
                                    <select name="telegram" id="telegramupdate" class="form-select">
                                        <option value=""><?php
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
                                        <option value=""><?php $sql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$lineManager'";
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
                                        <option value="">
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
                                        <option value=" "><?php $sql1 = "SELECT * FROM prpaypolicy WHERE id=$payParamter";
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

                        <!-- Family Information Tab -->
                        <div class="tab-pane fade" id="familyInfo">
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Family Members</h6>
                                    <button type="button" class="btn btn-success btn-sm" id="addFamilyMember">
                                        <i class="fas fa-plus"></i> Add Member
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="familyMembersTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Relation Type</th>
                                                    <th>Gender</th>
                                                    <th>Is Tax</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id=familytbl>
                                                <!-- Display family mebmber form database to table for edit and delete or add more -->
                                                <?php
                                                $sql = "SELECT * FROM hrfamily WHERE EmpCode = '$empcode'";
                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    $isTax = $row['IsTax'] ? 'Yes' : 'No';
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['RelationName']; ?></td>
                                                        <td><?php echo $row['RelationType']; ?></td>
                                                        <td><?php echo $row['Gender']; ?></td>
                                                        <td><?php echo $isTax; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-primary editFamilyMember">Edit</button>
                                                            <button type="button" class="btn btn-sm btn-danger deleteFamilyMember">Delete</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Education Information Tab -->
                        <div class="tab-pane fade" id="educationInfo">
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Education Details</h6>
                                    <button type="button" class="btn btn-success btn-sm" id="addEducation">
                                        <i class="fas fa-plus"></i> Add Education
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="educationTable">
                                            <thead>
                                                <tr>
                                                    <th>Institution</th>
                                                    <th>Degree</th>
                                                    <th>Field of Study</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="educationtbl">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Information Tab -->
                        <div class="tab-pane fade" id="documentInfo">
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Staff Documents</h6>
                                    <button type="button" class="btn btn-success btn-sm" id="addDocument">
                                        <i class="fas fa-plus"></i> Add Document
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="documentsTable">
                                            <thead>
                                                <tr>
                                                    <th>Document Type</th>
                                                    <th>Description</th>
                                                    <th>File</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="documenttbl">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <button type="button" id="saveStaff" class="btn btn-primary" style="margin-right: 5px;">Save</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Family Member Modal -->
    <div class="modal fade" id="familyMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Family Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="familyMemberForm">
                        <input type="hidden" id="familyMemberIndex" value="">
                        <div class="mb-3">
                            <label for="relationName" class="form-label  ">Name</label>
                            <input type="text" class="form-control" id="relationName">
                        </div>
                        <div class="mb-3">
                            <label for="relationType" class="form-label  ">Relation Type</label>
                            <select class="form-select" id="relationType">
                                <option value="">Select Relation</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Parent">Parent</option>
                                <option value="Sibling">Sibling</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="relationGender" class="form-label  ">Gender</label>
                            <select class="form-select" id="relationGender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="isTax">
                                <label class="form-check-label" for="isTax">Include in Tax Calculation</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveFamilyMember">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Education Modal -->
    <div class="modal fade" id="educationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Education Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="educationIndex">
                    <div class="mb-3">
                        <label for="institution" class="form-label  ">Institution</label>
                        <input type="text" class="form-control" id="institution">
                    </div>
                    <div class="mb-3">
                        <label for="degree" class="form-label  ">Degree</label>
                        <select class="form-select" id="degree">
                            <option value="">Select Degree</option>
                            <option value="High School">High School</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Bachelor">Bachelor's Degree</option>
                            <option value="Master">Master's Degree</option>
                            <option value="Doctorate">Doctorate</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fieldOfStudy" class="form-label  ">Field of Study</label>
                        <input type="text" class="form-control" id="fieldOfStudy">
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label  ">Start Date</label>
                        <input type="date" class="form-control" id="Datestart">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEducation">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="documentForm" enctype="multipart/form-data">
                        <input type="hidden" id="documentIndex" value="">
                        <div class="mb-3">
                            <label for="docType" class="form-label  ">Document Type</label>
                            <select class="form-select" id="docType">
                                <option value="">Select Document Type</option>
                                <option value="Contract">Contract</option>
                                <option value="CV">CV</option>
                                <option value="Certificate">Certificate</option>
                                <option value="IDCard">ID card</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="docFile" class="form-label  ">Document File</label>
                            <input type="file" class="form-control" id="docFile" name="docFile">
                            <!-- <input type="file" class="form-control" id="photo" name="photo" accept="image/*"> -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveDocument">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document View Modal -->
    <div class="modal fade" id="viewdocumentModal" tabindex="-1" style="overflow-y: scroll; margin-bottom: 40px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Document Type:</label>
                            <p id="viewDocType" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description:</label>
                            <p id="viewDescription" class="form-control-plaintext"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">File Name:</label>
                            <p id="viewFileName" class="form-control-plaintext"></p>
                        </div>
                    </div>
                    <iframe id="docPreview" style="width:100%; height:360px;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <a id="downloadDocument" class="btn btn-success mt-2">Download</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



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



    // Initialize Toast notification
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    $(document).ready(function() {

        // family member management===============================================

        var familyMembers = [];
        var editIndex = -1;

        $('#addFamilyMember').on('click', function() {
            editIndex = -1;
            $('#relationName').val('');
            $('#relationType').val('');
            $('#relationGender').val('');
            $('#isTax').prop('checked', false);
            $('#familyMemberModal').modal('show');
        });

        // save family member (add or edit)
        $("#saveFamilyMember").on('click', function() {
            var name = $('#relationName').val();
            var relation = $('#relationType').val();
            var gender = $('#relationGender').val();
            var istax = $('#isTax').is(':checked') ? 1 : 0;

            if (editIndex === -1) {
                // add new
                familyMembers.push({
                    name: name,
                    relation: relation,
                    gender: gender,
                    istax: istax
                });
            } else {
                // update existing
                familyMembers[editIndex] = {
                    name: name,
                    relation: relation,
                    gender: gender,
                    istax: istax
                };
            }

            displaymember();
            $('#familyMemberModal').modal('hide');
            // alert('Family member saved successfully!');
            Toast.fire({
                icon: 'success',
                title: editIndex === -1 ? 'Family member added successfully!' : 'Family member updated successfully!'
            });
        });

        // function to display family members in table
        function displaymember() {
            var member = '';

            for (var i in familyMembers) {
                member += `
                <tr>
                    <td>${familyMembers[i].name}</td>
                    <td>${familyMembers[i].relation}</td>
                    <td>${familyMembers[i].gender}</td>
                    <td>${familyMembers[i].istax ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeFamilyMember" data-index="${i}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-sm editFamilyMember" data-index="${i}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            `;
            }
            $('#familytbl').html(member);
        }

        // remove family member
        $(document).on('click', '.removeFamilyMember', function() {
            var index = $(this).data('index');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    familyMembers.splice(index, 1); //index remove
                    displaymember();
                    Toast.fire({
                        icon: 'success',
                        title: 'Family member removed'
                    });
                }
            });
        });

        // edit family member
        $(document).on('click', '.editFamilyMember', function() {
            var index = $(this).data('index');
            editIndex = index;

            $('#relationName').val(familyMembers[index].name);
            $('#relationType').val(familyMembers[index].relation);
            $('#relationGender').val(familyMembers[index].gender);
            $('#isTax').prop('checked', familyMembers[index].istax == 1);

            $('#familyMemberModal').modal('show');
        });

        // Education management===============================================

        var educationList = [];
        var educationIndex = -1;

        $('#addEducation').on('click', function() {
            educationIndex = -1;
            $('#institution').val('');
            $('#degree').val('');
            $('#fieldOfStudy').val('');
            $('#Datestart').val('');
            $('#endDate').val('');
            $('#educationModal').modal('show');

        });

        $('#saveEducation').on('click', function() {
            var institution = $('#institution').val();
            var degree = $('#degree').val();
            var fieldOfStudy = $('#fieldOfStudy').val();
            var startDate = $('#Datestart').val();
            var endDate = $('#endDate').val();

            if (educationIndex === -1) {
                // add new
                educationList.push({
                    institution: institution,
                    degree: degree,
                    fieldOfStudy: fieldOfStudy,
                    startDate: startDate,
                    endDate: endDate
                });
            } else {
                // update existing
                educationList[educationIndex] = {
                    institution: institution,
                    degree: degree,
                    fieldOfStudy: fieldOfStudy,
                    startDate: startDate,
                    endDate: endDate
                };
            }

            displayEducation();
            $('#educationModal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: educationIndex === -1 ? 'Education added successfully!' : 'Education updated successfully!'
            });
        });

        function displayEducation() {
            var education = '';

            for (var i in educationList) {
                education += `
                <tr>
                    <td>${educationList[i].institution}</td>
                    <td>${educationList[i].degree}</td>
                    <td>${educationList[i].fieldOfStudy}</td>
                    <td>${educationList[i].startDate}</td>
                    <td>${educationList[i].endDate}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeEducation" data-index="${i}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-sm editEducation" data-index="${i}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            `;
            }
            $('#educationtbl').html(education);
        }

        $(document).on('click', '.removeEducation', function() {
            var index = $(this).data('index');
            // educationList.splice(index, 1);
            // displayEducation();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    educationList.splice(index, 1); //index remove
                    displayEducation();
                    Toast.fire({
                        icon: 'success',
                        title: 'Education removed'
                    });
                }
            });
        });

        $(document).on('click', '.editEducation', function() {
            var index = $(this).data('index');
            educationIndex = index;

            $('#institution').val(educationList[index].institution);
            $('#degree').val(educationList[index].degree);
            $('#fieldOfStudy').val(educationList[index].fieldOfStudy);
            $('#Datestart').val(educationList[index].startDate);
            $('#endDate').val(educationList[index].endDate);

            $('#educationModal').modal('show');
        })




        // staff document===============================================

        var documentList = [];
        var documentIndex = -1;
        $('#addDocument').on('click', function() {
            documentIndex = -1;
            $('#docType').val('');
            $('#description').val('');
            $('#docFile').val('');

            $('#documentModal').modal('show');
        });

        $('#saveDocument').on('click', function() {

            var docType = $('#docType').val();
            var description = $('#description').val();
            var docFileInput = $('#docFile')[0].files[0]; // actual file object


            if (documentIndex === -1) {
                // add new
                documentList.push({
                    docType: docType,
                    description: description,
                    docFile: docFileInput
                });
            } else {
                // update existing
                documentList[documentIndex] = {
                    docType: docType,
                    description: description,
                    docFile: docFileInput
                };
            }

            displayDocument();
            $('#documentModal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: documentIndex === -1 ? 'Document added successfully!' : 'Document updated successfully!'
            });
        });

        function displayDocument() {
            var documentHtml = '';
            for (var i in documentList) {
                let fileName = "";

                if (documentList[i].docFile) {
                    if (documentList[i].docFile.name) {
                        fileName = documentList[i].docFile.name;
                    } else {

                        fileName = documentList[i].docFile;
                    }
                }

                documentHtml += `
            <tr>
                <td>${documentList[i].docType}</td>
                <td>${documentList[i].description}</td>
                <td>${fileName}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info view-document" data-index="${i}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm removeDocument" data-index="${i}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm editDocument" data-index="${i}">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>
        `;
            }
            $('#documenttbl').html(documentHtml);
        }

        // view document
        $(document).on('click', '.view-document', function() {
            var index = $(this).data('index');
            var document = documentList[index];

            $('#viewDocType').text(document.docType);
            $('#viewDescription').text(document.description);

            let fileName = "";
            if (document.docFile) {
                if (document.docFile.name) {
                    fileName = document.docFile.name;
                } else {
                    fileName = document.docFile;
                }
            }
            $('#viewFileName').text(fileName);

            if (document.docFile && document.docFile instanceof File) {
                var objectUrl = URL.createObjectURL(document.docFile);
                $('#docPreview').attr('src', objectUrl);
                $('#downloadDocument').attr('href', objectUrl);
                $('#downloadDocument').attr('download', fileName);

                $('#viewdocumentModal').modal('show');

                $('#viewdocumentModal').one('hidden.bs.modal', function() {
                    URL.revokeObjectURL(objectUrl);
                });
            } else {
                $('#docPreview').attr('src', "../../assets/documents/" + fileName);
                $('#downloadDocument').attr('href', "../../assets/documents/" + fileName);
                $('#downloadDocument').attr('download', fileName);

                $('#viewdocumentModal').modal('show');
            }
        });


        $(document).on('click', '.removeDocument', function() {
            var index = $(this).data('index');
            // documentList.splice(index, 1);
            // displayDocument();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    documentList.splice(index, 1);
                    displayDocument();
                    Toast.fire({
                        icon: 'success',
                        title: 'Document removed'
                    });
                }
            });
        });

        $(document).on('click', '.editDocument', function() {
            var index = $(this).data('index');
            documentIndex = index;

            $('#docType').val(documentList[index].docType);
            $('#description').val(documentList[index].description);
            // $('#docFile').val(documentList[index].docFile);
            $('#docFile').val('');

            $('#documentModal').modal('show');
        })






        // save staff ===============================================

        $("#saveStaff").on("click", function(event) {
            event.preventDefault();

            // collect all form data
            var formData = new FormData($("#staffForm")[0]);

            // add familyMembers array
            formData.append("family", JSON.stringify(familyMembers));

            // add education array
            formData.append("education", JSON.stringify(educationList));

            // add document array
            formData.append("document", JSON.stringify(documentList));

            $.ajax({
                url: "../../action/StaffProfile/create.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    response = response.trim(); // clean spaces/newlines

                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Staff and all related data saved successfully!'
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    } else if (response === "Success add only staff") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Partial Success',
                            text: 'Staff saved, but family, education, or documents were not added.'
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    } else if (response === "Employee Code already exists!") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: 'Employee Code already exists!'
                        });
                    } else if (response === "All fields are required! Please fill all the required fields on Staff Profile form.") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: 'All required fields must be filled!'
                        });
                        // } else if (response === "fail") {
                        //     Swal.fire({
                        //         icon: 'error',
                        //         title: 'Error',
                        //         text: 'Failed to save staff profile.'
                        //     });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Success add only staffDetail!',
                            // text: response
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong while saving staff!'
                    });
                }
            });

        });




    });
</script>