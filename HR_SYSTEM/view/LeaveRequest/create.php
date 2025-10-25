<?php
include("../../Config/conect.php");

include('../../root/Header.php');

?>
<!DOCTYPE html>
<html lang="en">


<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Create Leave Request</h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="leaveRequestForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <select class="form-select" id="employeeID" name="empCode" required>
                                            <option value="">Select Employee</option>
                                            <?php
                                            $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE Status = 'Active' ORDER BY EmpName";
                                            $result = $con->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['EmpCode']) . "'>" .
                                                    htmlspecialchars($row['EmpCode'] . ' - ' . $row['EmpName']) . "</option>";
                                            }
                                            ?>
                                        </select>
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
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary btnsubmit">
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
        $('.btnsubmit').click(function(e) {
            e.preventDefault(); // ✅ prevent form submit reload

            var empcode = $('#employeeID').val();
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
                    console.log(response); // ✅ see what PHP returns
                    response = response.trim(); // ✅ remove spaces/newlines

                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Leave request submitted successfully',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../view/LeaveRequest/index.php';
                            }
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