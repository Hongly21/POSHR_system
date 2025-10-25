<?php
include('../../Config/conect.php');
include('../../root/Header.php');



$id = $_GET['id'];
$sql = "SELECT * FROM prallowance WHERE ID = '$id'";
$run = $con->query($sql);
while ($row = $run->fetch_assoc()) {
    $empcode = $row['EmpCode'];
    $allowancetype = $row['AllowanceType'];
    $description = $row['Description'];
    $fromdate = $row['FromDate'];
    $todate = $row['ToDate'];
    $amount = $row['Amount'];
    $status = $row['Status'];
    $remark = $row['Remark'];
}

?>


<body>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Allowance</h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="allowanceForm">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="EmpCode" class="form-label">Employee</label>
                                    <select class="form-select" name="EmpCode" id="EmpCode" required>
                                        <option value="<?php echo $empcode; ?>"><?php
                                                                                $sql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                                                                $run = $con->query($sql);
                                                                                $row = $run->fetch_assoc();
                                                                                echo $row['EmpName'] . ' (' . $empcode . ')';
                                                                                ?></option>
                                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="AllowanceType" class="form-label">Allowance Type</label>
                                    <select class="form-select" name="AllowanceType" id="AllowanceType" required>
                                        <option value=" <?php echo $allowancetype; ?> "><?php echo $allowancetype; ?></option>
                                        <option value="Transportation">Transportation</option>
                                        <option value="Housing">Housing</option>
                                        <option value="Meal">Meal</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="Amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" name="Amount" id="Amount"
                                        step="0.01" min="0" required value="<?php echo $amount; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="FromDate" class="form-label">From Date</label>
                                    <input type="date" class="form-control" name="FromDate" id="FromDate" required value="<?php echo $fromdate; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="ToDate" class="form-label">To Date</label>
                                    <input type="date" class="form-control" name="ToDate" id="ToDate" required value="<?php echo $todate; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select" name="Status" id="Status" required>
                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea class="form-control" name="Description" id="Description" rows="3" required> <?php echo $description; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="Remark" class="form-label">Remark</label>
                                    <textarea class="form-control" name="Remark" id="Remark" rows="2"> <?php echo $remark; ?></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-primary" id="updateAllowance">
                                    <i class="fas fa-save me-2"></i>Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#updateAllowance').click(function() {
                var id = $('#id').val();
                var EmpCode = $('#EmpCode').val();
                var AllowanceType = $('#AllowanceType').val();
                var Amount = $('#Amount').val();
                var FromDate = $('#FromDate').val();
                var ToDate = $('#ToDate').val();
                var Status = $('#Status').val();
                var Description = $('#Description').val();
                var Remark = $('#Remark').val();



                $.ajax({
                    url: '../../action/PRAllowance/update.php',
                    type: 'POST',
                    data: {
                        id: id,
                        EmpCode: EmpCode,
                        AllowanceType: AllowanceType,
                        Amount: Amount,
                        FromDate: FromDate,
                        ToDate: ToDate,
                        Status: Status,
                        Description: Description,
                        Remark: Remark
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Allowance updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        } else if (response == 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update allowance. Please try again.',
                            })
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
                })
            })
        })
    </script>
</body>