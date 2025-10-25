<?php
include("../../Config/conect.php");
include('../../root/Header.php');

?>


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
                        <form id="leaveRequestForm">
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
                                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                        <textarea class="form-control" id="reason" name="reason" rows="3" value="<?php echo $reason ?>" required><?php echo $reason; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btnupdate">
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


</body>

</html>
<script>
    $(document).ready(function() {
        $('.btnupdate').click(function(e) {
            e.preventDefault(); // ✅ stop default reload

            var id = $('#id').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var reason = $('#reason').val();

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
                    console.log(response); // ✅ debug
                    response = response.trim(); // ✅ fix spacing issue

                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Leave request updated successfully',
                            showConfirmButton: true
                        }).then(() => {
                            window.location.href = '../../view/LeaveRequest/index.php';
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
        });
    });
</script>