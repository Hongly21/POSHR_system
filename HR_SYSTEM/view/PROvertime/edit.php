<?php
include('../../Config/conect.php');
include('../../root/Header.php');

$id = $_GET['id'];
$sql = "SELECT * FROM provertime WHERE ID = '$id'";
$run = $con->query($sql);
while ($row = $run->fetch_assoc()) {
    $empcode = $row['Empcode'];
    $ottype = $row['OTType'];
    $otdate = $row['OTDate'];
    $fromtime = $row['FromTime'];
    $totime = $row['ToTime'];
    $reason = $row['Reason'];
}
?>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Overtime </h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/PROvertime/update.php" method="POST" id="overtimeForm" novalidate>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Employee</label>
                                    <select name="empcode" class="form-select" required id="empcode" readonly>
                                        <option value=""><?php
                                                            $sql2 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                                            $run2 = $con->query($sql2);
                                                            $row2 = $run2->fetch_assoc();
                                                            echo $row2['EmpName'] . ' (' . $empcode . ')';
                                                            ?></option>
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">OT Type</label>
                                    <select name="ottype" class="form-select" required>
                                        <option value="<?php 
                                        echo $ottype;
                                        ?>"><?php
                                                            $sql3 = "SELECT Des FROM protrate WHERE Code='$ottype'";
                                                            $run3 = $con->query($sql3);
                                                            $row3 = $run3->fetch_assoc();
                                                            echo $row3['Des'] . ' (' . $ottype . ')';
                                                            ?></option>
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
                                    <input type="date" name="otdate" class="form-control date-picker" required value="<?php echo $otdate; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">From Time</label>
                                    <input type="time" name="fromtime" class="form-control time-picker" required value="<?php echo $fromtime; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">To Time</label>
                                    <input type="time" name="totime" class="form-control time-picker" required value="<?php echo $totime; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Reason</label>
                                <textarea name="reason" class="form-control" rows="3" required> <?php echo $reason; ?></textarea>
                            </div>
                            <div class="d-flex justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary">
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


    <!-- <script>
        $(document).ready(function() {
            $("#overtimeForm").on("submit", function(e) {
                e.preventDefault();

                // Validate required fields
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    $(this).addClass('was-validated');
                    return;
                }

                // Additional validation for times
                const fromTime = new Date(`2000-01-01 ${$("input[name='fromtime']").val()}`);
                const toTime = new Date(`2000-01-01 ${$("input[name='totime']").val()}`);

                if (fromTime >= toTime) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Times',
                        text: 'End time must be after start time'
                    });
                    return;
                }

                // Submit the form
                this.submit();
            });

        });
    </script> -->
</body>