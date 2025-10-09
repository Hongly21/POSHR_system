<?php

include('../../Config/conect.php');
include('../../root/Header.php');

?>

<body>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Deduction</h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/PRDeduction/update.php" method="POST" id="deductionForm">
                            <input type="hidden" name="id" value="<?php

                                                                    $id = $_GET['id'];
                                                                    echo $id;

                                                                    ?>">
                            <?php $sql = "SELECT * FROM prdeduction WHERE ID = '$id'";
                            $run = $con->query($sql);
                            while ($row = $run->fetch_assoc()) :
                                $empCode = $row['EmpCode'];
                                $deductType = $row['DeductType'];
                                $amount = $row['Amount'];
                                $description = $row['Description'];
                                $status = $row['Status'];
                                $remark = $row['Remark'];
                                $formdate = $row['FromDate'];
                                $toDate = $row['ToDate'];

                            ?>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="empCode" class="form-label">Employee</label>
                                        <select class="form-select" name="empCode" id="empCode" required>
                                            <option value="<?php echo $empCode; ?>"><?php
                                                                                    $empcode = $row['EmpCode'];
                                                                                    $sql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                                                                    $run = $con->query($sql);
                                                                                    $row = $run->fetch_assoc();
                                                                                    echo $row['EmpName'] . ' (' . $empcode . ')';

                                                                                    ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="deductType" class="form-label">Deduction Type</label>
                                        <select class="form-select" name="deductType" id="deductType" required>
                                            <option value="<?php echo $deductType ?>"><?php echo $deductType; ?></option>
                                            <option>Early</option>
                                            <option>Late</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" required><?php echo $description; ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="fromDate" class="form-label">From Date</label>
                                        <input type="date" class="form-control" name="fromDate" id="fromDate"
                                            value="<?php echo $formdate; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="toDate" class="form-label">To Date</label>
                                        <input type="date" class="form-control" name="toDate" id="toDate"
                                            value="<?php echo $toDate; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" class="form-control" name="amount" id="amount"
                                            step="0.01" min="0" value="<?php echo $amount; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="Active" <?php echo ($status === 'Active') ? 'selected' : ''; ?>>Active</option>
                                            <option value="Inactive" <?php echo ($status === 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" name="remark" id="remark" rows="2"><?php echo $remark; ?></textarea>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Deduction
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endwhile; ?>
<script>
    $(document).ready(function() {

        // Form validation before submit
        $('#bonusForm').on('submit', function(e) {
            const amount = parseFloat($('#amount').val());
            const fromDate = new Date($('#fromDate').val());
            const toDate = new Date($('#toDate').val());

            if (amount <= 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Amount',
                    text: 'Amount must be greater than 0',
                    timer: 3000,
                    timerProgressBar: true
                });
                return false;
            }

            if (fromDate > toDate) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Date Range',
                    text: 'To Date must be after From Date',
                    timer: 3000,
                    timerProgressBar: true
                });
                return false;
            }
        });

        // Check for error message
        const urlParams = new URLSearchParams(window.location.search);
        const errorMsg = urlParams.get('error');
        if (errorMsg) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: decodeURIComponent(errorMsg),
                timer: 3000,
                timerProgressBar: true
            });
        }
    });
</script>
</body>