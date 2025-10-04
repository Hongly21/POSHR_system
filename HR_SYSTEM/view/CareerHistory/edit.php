<?php include('../../root/Header.php');
include('../../Config/conect.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Career History</title>
    <!-- Career History CSS -->
    <link href="../../style/career.css" rel="stylesheet">
</head>


<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Career History</h4>
                            <a href="index.php" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="careerHistoryForm" action="../../action/CareerHistory/update.php" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <select class="form-select" id="employeeIDUpdate" name="employeeID" required>
                                            <?php
                                            if (isset($_GET['empid'])) {
                                                $employeeID = $_GET['empid'];
                                                $sql = "SELECT * FROM `careerhistory` WHERE `EmployeeID`='$employeeID'";
                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    $company = $row['Company'];
                                                    $position = $row['PositionTitle'];
                                                    $department = $row['Department'];
                                                    $division = $row['Division'];
                                                    $level = $row['Level'];
                                                    $startDate = $row['StartDate'];
                                                    $endDate = $row['EndDate'];
                                                    $increase = $row['Increase'];
                                                    $careerCode = $row['CareerHistoryType'];
                                                    $remark = $row['Remark'];
                                                    echo "<option value='{$employeeID}' selected>{$employeeID}</option>";
                                                }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" readonly value="<?php echo $company; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" readonly value="<?php echo $department; ?>">
                                        <input type="hidden" name="department" id="department_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="position" readonly value="<?php echo $position; ?>">
                                        <input type="hidden" name="positionTitle" id="position_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text" class="form-control" id="division" readonly value="<?php echo $division; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <input type="text" class="form-control" id="level" readonly
                                            value="<?php
                                                    $sql1 = "SELECT `level` FROM `hrstaffprofile` WHERE `EmpCode`='$employeeID'";
                                                    $result = $con->query($sql1);
                                                    while ($row = $result->fetch_assoc()) {
                                                        $level = $row['level'];
                                                        $sql2= "SELECT `Description` FROM `hrlevel` WHERE `Code`='$level'";
                                                        $result2 = $con->query($sql2);
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            echo $row2['Description'];
                                                        }
                                                    }
                                                    ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label required">Effective Date</label>
                                        <input type="date" class="form-control" id="startDateUpdate" name="startDate" required value="<?php echo $startDate; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="endDate" class="form-label">Resignation Date</label>
                                        <input type="date" class="form-control" id="endDateUpdate" name="endDate" value="<?php echo $endDate; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="increase" class="form-label">Increase Amount</label>
                                        <input type="number" step="0.01" class="form-control" id="increaseUpdate" name="increase" value="<?php echo $increase; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="careerCode" class="form-label required">Career Code</label>
                                        <select name="careerCode" id="careerCodeUpdate" class="form-select">
                                            <option value=""><?php echo $careerCode; ?></option>
                                            <option value="NEW">New Join</option>
                                            <option value="PROMOTE">Promote</option>
                                            <option value="TRANSFER">Transfer</option>
                                            <option value="RESIGN">Resign</option>
                                            <option value="INCREASE">Increase Salary</option>
                                            <?php
                                            // $careerCodes = [
                                            //     'NEW' => 'New Join',
                                            //     'PROMOTE' => 'Promote',
                                            //     'TRANSFER' => 'Transfer',
                                            //     'RESIGN' => 'Resign',
                                            //     'INCREASE' => 'Increase Salary'
                                            // ];
                                            // foreach ($careerCodes as $code => $label) {
                                            //     $badgeClass = 'badge-' . strtolower($code);
                                            //     echo "
                                            //     <option value='{$code}' class='{$badgeClass}' >{$label}</option>
                                            //     ";
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="remark" class="form-label">Remark</label>
                                        <textarea class="form-control" id="remarkUpdate" name="remark" rows="3"> <?php echo $remark; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Career History</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>