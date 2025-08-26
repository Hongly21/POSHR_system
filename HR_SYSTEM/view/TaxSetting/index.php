<?php include_once('../../root/Header.php');
include '../../root/DataTable.php';
include '../../Config/conect.php';
?>
<style>
    .modal-container {
        background-color: #f9f9f9;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 500px;
        margin: auto;
    }

    .modal-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .modal-container label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-container input[type="text"],
    .modal-container select {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-container input[type="text"]:focus,
    .modal-container select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    .modal-container select {
        background-color: #fff;
        cursor: pointer;
    }

    .modal-container button {
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-container button:hover {
        background-color: #0056b3;
    }
</style>

<h3 class="text-center"
    style="margin: 20px 0px;">TAX RATE SETTING</h3>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <?php
    $sql = "SELECT * FROM prtaxrate";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaxRateModal">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add
                    </button>
                </th>
                <th>AmountFrom</th>
                <th>AmountTo </th>
                <th>Rate (%)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateTaxRateModal" class="btn btn-primary editButton"
                            data-id="<?php echo $row['id']; ?>"
                            data-amountfrom="<?php echo $row['AmountFrom']; ?>"
                            data-amountto="<?php echo $row['AmountTo']; ?>"
                            data-rate="<?php echo $row['rate']; ?>"
                            data-status="<?php echo $row['status']; ?>">

                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deletetax('<?php echo $row['id']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td> $ <?php echo $row['AmountFrom']; ?></td>
                    <td> $ <?php echo $row['AmountTo']; ?></td>
                    <td> <?php echo $row['rate']; ?> %</td>
                    <td><?php if ($row['status'] == 1) {
                            echo 'Active';
                        } else {
                            echo 'Inactive';
                        }
                        ?>
                    </td>
                </tr>

            <?php
            } ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTaxRateModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New Tax Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTaxRateForm">
                    <div class="mb-3">
                        <label for="amountFrom" class="form-label">Amount From</label>
                        <input type="number" class="form-control" id="amountFrom" name="amountFrom" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountTo" class="form-label">Amount To</label>
                        <input type="number" class="form-control" id="amountTo" name="amountTo" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate (%)</label>
                        <input type="number" class="form-control" id="rate" name="rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveTax">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Updata Modal -->
<div class="modal fade" id="updateTaxRateModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Edit Tax Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTaxRateForm">
                    <div class="mb-3">
                        <label for="amountFrom" class="form-label">Amount From</label>
                        <input type="number" class="form-control" id="amountFromUpdate" name="amountFrom" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountTo" class="form-label">Amount To</label>
                        <input type="number" class="form-control" id="amountToUpdate" name="amountTo" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate (%)</label>
                        <input type="number" class="form-control" id="rateUpdate" name="rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="statusUpdate" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateTax">Update</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#saveTax').click(function() {
            var amountform = $('#amountFrom').val();
            var amountto = $('#amountTo').val();
            var status = $('#status').val();
            var rate = $('#rate').val();
            $.ajax({
                url: '../../action/TaxSetting/action.php',
                method: 'POST',
                data: {
                    action: 'add',
                    amountform: amountform,
                    amountto: amountto,
                    rate: rate,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'TaxRate added successfully.',
                        confirmButtonColor: '#3085d6',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // 🔄 Refresh the page
                    })
                }
            })
        })
        $('.editButton').click(function() {
            var id = $(this).data('id');
            var amountfrom = $(this).data('amountfrom');
            var amountto = $(this).data('amountto');
            var rate = $(this).data('rate');
            var status = $(this).data('status');
            $('#amountFromUpdate').val(amountfrom);
            $('#amountToUpdate').val(amountto);
            $('#rateUpdate').val(rate);
            $('#statusUpdate').val(status);
            $('#updateTax').data('id', id);
        })
        $('#updateTax').click(function() {
            var id = $(this).data('id');
            var amountfrom = $('#amountFromUpdate').val();
            var amountto = $('#amountToUpdate').val();
            var rate = $('#rateUpdate').val();
            var status = $('#statusUpdate').val();
            $.ajax({
                url: '../../action/TaxSetting/action.php',
                method: 'POST',
                data: {
                    action: 'update',
                    id: id,
                    amountfrom: amountfrom,
                    amountto: amountto,
                    rate: rate,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'TaxRate updated successfully.',
                        confirmButtonColor: '#3085d6',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Refresh the page
                    })
                }
            })
        })



    })
</script>

<!-- //delete alert mesaages -->
<script>
    function deletetax(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the TaxRate record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/TaxSetting/action.php',
                    method: 'GET',
                    data: {
                        action: 'delete',
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The TaxRate has been removed.',
                            confirmButtonColor: '#3085d6',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // 🔄 Refresh the page
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: 'Could not delete the TaxRate .',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>