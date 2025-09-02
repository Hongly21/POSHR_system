<?php
include('../../root/Header.php');
include('../../root/DataTable.php');
include('../../Config/conect.php');
?>

<body>
    <div class="container-fluid mt-3" style="max-width: 1400px;">
        <div class="card">
            <!-- <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Staff Profile</h5>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div> -->
            <div class="card-body">
                <form action="../../action/StaffProfile/create.php" method="post" id="staffForm" enctype="multipart/form-data">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalInfoa">
                                <i class="fas fa-user"></i> Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#jobInfoa">
                                <i class="fas fa-briefcase"></i> Job Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#contactInfoa">
                                <i class="fas fa-address-book"></i> Contact Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#familyInfoa">
                                <i class="fas fa-users"></i> Family
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#educationInfoa">
                                <i class="fas fa-graduation-cap"></i> Education
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#documentInfoa">
                                <i class="fas fa-file-alt"></i> Staff Document
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" style="padding: 16px 5px 0px 5px; box-sizing: border-box;">
                        <!-- Personal Information  -->
                        <div class="tab-pane fade show active" id="personalInfoa">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="empCode" class="form-label  ">Employee Code</label>
                                    <input type="text" class="form-control" id="empCode" name="empCode">
                                </div>
                                <div class="col-md-6">
                                    <label for="empName" class="form-label  ">Employee Name</label>
                                    <input type="text" class="form-control" id="empName" name="empName">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label  ">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="dob" class="form-label  ">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label  ">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="salary" class="form-label  ">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary">
                                </div>
                                <div class="row mb-3">
                                    <!-- <div class="col-md-6">
                                        <label for="photo" class="form-label">Profile Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="text-center mt-2">
                                            <div class="img-preview border rounded p-2">
                                                <!-- <img id="photoPreview" src="../../assets/images/images.jpg" alt="Profile Preview" class="img-fluid rounded" style="object-fit: cover;"> -->

                                                <img id="photoPreview" src="../../assets/images/images.jpg" alt="Profile Preview" class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;">

                                                <input type="file" name="photo" id="imageInput" accept="image/*" class="form-control mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Job Information  -->
                        <div class="tab-pane fade show" id="jobInfoa">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="company" class="form-label  ">Company</label>
                                    <!-- <input type="text" class="form-control" id="company" name="company"  > -->
                                    <select class="form-select" id="company" name="company">
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
                                    <select class="form-select" id="department" name="department">
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
                                    <select class="form-select" id="position" name="position">
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
                                    <select class="form-select" id="division" name="division">
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
                                    <select class="form-select" id="level" name="level">
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
                                    <input type="date" class="form-control" id="startDate" name="startDate">
                                </div>
                                <div class="col-md-4">
                                    <label for="probationDate" class="form-label">Probation End Date</label>
                                    <input type="date" class="form-control" id="probationDate" name="probationDate">
                                </div>
                                <div class="col-md-4">
                                    <label for="isProb" class="form-label">Probation Status</label>
                                    <select class="form-select" id="isProb" name="isProb">
                                        <option value="1">In Probation</option>
                                        <option value="0">Passed Probation</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="telegram" class="form-label">Telegram</label>
                                    <!-- <input type="text" class="form-control" id="telegram" name="telegram"> -->
                                    <select name="telegram" id="telegram" class="form-select">
                                        <option value="">Select Telegram</option>
                                        <option value="">Reqeust Leave</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade " id="contactInfoa">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Family Information Tab -->
                        <div class="tab-pane fade" id="familyInfoa">
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Family Members</h6>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add New Member 
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
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start mt-3" style="padding: 10px; box-sizing: border-box;">
        <button type="submit" class="btn btn-primary me-2" name="btnSubmit">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Family Member Modal -->
    <!-- <div class="modal fade" id="familyMemberModal" tabindex="-1">
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
    </div> -->

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("change", "#imageInput", function(event) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#photoPreview").attr("src", e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>