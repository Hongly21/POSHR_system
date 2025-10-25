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
                            <h4 class="mb-0">Create New Deduction</h4>
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
                                    <label for="deductType" class="form-label">Deduction Type</label>
                                    <select name="deductType" id="" class="form-select" required>
                                        <option value="">Select Deduction Type</option>
                                        <option value="Late">Late</option>
                                        <option value="Early">Early</option>
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
                                <button type="button" id="saveDed" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Deduction
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
            $('#saveDed').click(function() {
                var formData = $('#allowanceForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '../../action/PRDeduction/create.php',
                    data: formData,
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: 'Deduction Created Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = 'index.php';
                            });
                        }else if(response === 'errorfield'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Please fill in all required fields!'
                            });
                        }
                        else {
                            alert('Error creating Deduction: ' + response);
                        }
                    }
                });
            });

        });
    </script>
</body>