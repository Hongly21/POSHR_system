<?php
include("../../Config/conect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Leave Request</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../../style/career.css" rel="stylesheet">
    <style>
        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Leave Request</h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM lmleaverequest WHERE ID=$id";
                        $run = $con->query($sql);
                        while ($row = $run->fetch_assoc()) {
                            $empCode = $row['EmpCode'];
                            $leavetype = $row['LeaveType'];
                            $fromDate = $row['FromDate'];
                            $toDate = $row['ToDate'];
                            $reason = $row['Reason'];
                            $status = $row['Status'];
                            $leaveDay = $row['LeaveDay'];
                        }
                    }
                    ?>
                    <div class="card-body">
                        <form id="leaveRequestForm" action="../../action/LeaveRequest/edit.php" method="POST" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <select class="form-select" id="employeeID" name="empCode" required>
                                            <option value="<?php echo $empCode ?>" readonly><?php echo $empCode ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leaveType" class="form-label required">Leave Type</label>
                                        <select class="form-select" id="leaveType" name="leaveType" required>
                                            <option value="<?php echo $leavetype ?>" readonly><?php echo $leavetype ?></option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fromDate" class="form-label required">From Date</label>
                                        <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo $fromDate; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="toDate" class="form-label required">To Date</label>
                                        <input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo $toDate ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="leaveDay" class="form-label required">Leave Day</label>
                                        <input type="number" class="form-control" id="leaveDay" name="leaveDay" value="<?php echo $leaveDay ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="reason" class="form-label required">Reason</label>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                        <textarea class="form-control" id="reason" name="reason" rows="3" value="<?php echo $reason ?>" required><?php echo $reason; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Submit Request
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>