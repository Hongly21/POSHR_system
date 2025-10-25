<?php

include('../../Config/conect.php');
include('../../root/Header.php');


?>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">New Overtime </h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="overtimeForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Employee</label>
                                    <select name="empcode" class="form-select" required id="empcode">
                                        <option value="">Select Employee</option>
                                        <?php
                                        $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile ORDER BY EmpName";
                                        $run = $con->query($sql);
                                        while ($row = $run->fetch_assoc()): ?>
                                            <option value="<?php echo ($row['EmpCode']); ?>">
                                                <?php echo ($row['EmpName'] . ' (' . $row['EmpCode'] . ')'); ?>
                                            </option>
                                        <?php endwhile;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">OT Type</label>
                                    <select name="ottype" class="form-select" required>
                                        <option value="">Select OT Type</option>
                                        <?php
                                        $otTypeQuery = "SELECT Code, Des, Rate FROM protrate ORDER BY Code";
                                        $otTypeResult = $con->query($otTypeQuery);

                                        while ($ot = $otTypeResult->fetch_assoc()): ?>
                                            <option value="<?php echo ($ot['Code']); ?>">
                                                <?php echo ($ot['Des'] . ' (Rate: ' . $ot['Rate'] . ')'); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label required">OT Date</label>
                                    <input type="date" name="otdate" class="form-control date-picker" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">From Time</label>
                                    <input type="time" name="fromtime" class="form-control time-picker" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">To Time</label>
                                    <input type="time" name="totime" class="form-control time-picker" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Reason</label>
                                <textarea name="reason" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="d-flex justify-content-start gap-2">
                                <button type="button" class="btn btn-primary" id="saveOvertime">
                                    <i class="fas fa-save me-2"></i>Save
                                </button>
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    $(document).ready(function() {
        $("#saveOvertime").click(function() {
            var empcode = $("#empcode").val();
            var ottype = $("select[name=ottype]").val();
            var otdate = $("input[name=otdate]").val();
            var fromtime = $("input[name=fromtime]").val();
            var totime = $("input[name=totime]").val();
            var reason = $("textarea[name=reason]").val();

            $.ajax({
                url: "../../action/PROvertime/create.php",
                type: "POST",
                data: {
                    empcode: empcode,
                    ottype: ottype,
                    otdate: otdate,
                    fromtime: fromtime,
                    totime: totime,
                    reason: reason
                },
                success: function(response) {
                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Overtime has been created successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            window.location.href = "index.php";
                        })
                    } else if (response === "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to create overtime. Please try again.',
                        })
                    } else if (response === 'errortime') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'From Time must be less than To Time',
                        })

                    } else if (response === 'All field are required') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'All field are required',
                        })
                    }
                }
            })

        })
    })
</script>