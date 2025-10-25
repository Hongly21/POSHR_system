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
                            <h4 class="mb-0">Create New Allowance</h4>
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
                                        <option value="">Select Employee</option>
                                        <?php
                                        $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile Order by EmpName";
                                        $run = $con->query($sql);
                                        while ($row = $run->fetch_array()) {
                                        ?>
                                            <option value="<?php echo $row['EmpCode']; ?>"><?php echo $row['EmpName']; ?></option>

                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="AllowanceType" class="form-label">Allowance Type</label>
                                    <select class="form-select" name="AllowanceType" id="AllowanceType" required>
                                        <option value="">Select Type</option>
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
                                        step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="FromDate" class="form-label">From Date</label>
                                    <input type="date" class="form-control" name="FromDate" id="FromDate" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="ToDate" class="form-label">To Date</label>
                                    <input type="date" class="form-control" name="ToDate" id="ToDate" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select" name="Status" id="Status" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea class="form-control" name="Description" id="Description" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="Remark" class="form-label">Remark</label>
                                    <textarea class="form-control" name="Remark" id="Remark" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-primary" id="saveAllowance">
                                    <i class="fas fa-save me-2"></i>Save Allowance
                                </button>
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
        $('#saveAllowance').click(function() {
            var empcode = $('#EmpCode').val();
            var allowanceType = $('#AllowanceType').val();
            var amount = $('#Amount').val();
            var fromDate = $('#FromDate').val();
            var toDate = $('#ToDate').val();
            var status = $('#Status').val();
            var description = $('#Description').val();
            var remark = $('#Remark').val();


            $.ajax({
                url: '../../action/PRAllowance/create.php',
                method: 'POST',
                data: {
                    empcode: empcode,
                    allowanceType: allowanceType,
                    amount: amount,
                    fromDate: fromDate,
                    toDate: toDate,
                    status: status,
                    description: description,
                    remark: remark
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Allowance created successfully!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        })
                    } else if (response == 'errorfield') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Please fill in all required fields!'
                        })
                    } else if (response == 'error') {
                        alert('Something went wrong! Please try again.');
                    }
                }
            })
        })
    })
</script>