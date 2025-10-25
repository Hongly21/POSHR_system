<?php
include('../../Config/conect.php');
include('../../root/Header.php');

$ID=$_GET['id'];
$sql = "SELECT * FROM prbonus WHERE ID = '$ID'";
$run = $con->query($sql);
while ($row = $run->fetch_assoc()) {
    $empcode = $row['EmpCode'];
    $bonustype = $row['BonusType'];
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
                            <h4 class="mb-0">Edit Bouns</h4>
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
                                         $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE EmpCode = '$empcode'";
                                         $run = $con->query($sql);
                                         $row = $run->fetch_assoc();
                                         echo $row['EmpName'] . ' (' . $empcode . ')';
                                        ?></option>
                                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="bonusType" class="form-label">Bonus Type</label>
                                    <select name="BonusType" id="BonusType" class="form-select" required>
                                        <option value="<?php echo $bonustype; ?>"><?php echo $bonustype; ?></option>
                                        <option value="Performance">Performance</option>
                                        <option value="Senority">Senority Pay</option>
                                        <option value="Annual">Annual Bonus</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="Amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" name="Amount" id="Amount" value="<?php echo $amount; ?>"
                                        step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="FromDate" class="form-label">From Date</label>
                                    <input type="date" class="form-control" name="FromDate" id="FromDate" required value="<?php echo $fromdate; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="ToDate" class="form-label">To Date</label>
                                    <input type="date" class="form-control" name="ToDate" id="ToDate" required  value="<?php echo $todate; ?>">
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
                                <button type="button" id="updateBonus" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Bouns
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
            $('#updateBonus').click(function() {
                var data = $('#allowanceForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '../../action/PRBouns/update.php',
                    data: data,
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: 'Bouns Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = 'index.php';
                            });
                        } else {
                            alert('Error updating Bouns: ' + response);
                        }
                    }
                });

            })
        });
    </script>
</body>