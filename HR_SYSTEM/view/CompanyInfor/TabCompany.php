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
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <?php
    $sql = "SELECT * FROM hrcompany";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add
                    </button>
                </th>
                <th>CompanyCode</th>
                <th>CompanyName</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary editButton" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-id="<?php echo $row['Code']; ?>"
                            data-name="<?php echo $row['Description']; ?>"
                            data-status="<?php echo $row['Status']; ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deleteCompanyc('<?php echo $row['Code']; ?>')"><i class="fa fa-trash"></i></button>

                    </td>


                    <td><?php echo $row['Code']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>

            <?php
            }
            ?>



        </tbody>
    </table>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Company</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <form>
                        <label for="companyCode">CompanyCode:</label>
                        <input type="text" id="companyCode" name="companyCode">
                        <label for="companyName">CompanyName:</label>
                        <input type="text" id="companyName" name="companyName">
                        <label for="status">Status:</label>
                        <select name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='btnsave' class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

</div>


<!-- Modal Update-->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <form>
                        <input type="hidden" id="companyCodeupdate" name="companyCode">
                        <label for="companyName">CompanyName:</label>
                        <input type="text" id="companyNameupdate" name="companyName">
                        <label for="status">Status:</label>
                        <select id="statusupdate">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='btnupdate' class="btn btn-primary">Upadate</button>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {
        $('#btnsave').click(function() {
            $.ajax({
                url: '../../action/CompanyInfor/TabCompany/add.php',
                method: 'POST',
                data: {
                    action: 'btnsave',
                    comCode: $('#companyCode').val(),
                    comName: $('#companyName').val(),
                    comStatus: $('#status').val()
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Add Successfully',
                        text: response
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            })
        })
    })

    $(document).ready(function() {
        $('.editButton').click(function() {
            const comCode = $(this).data('id');
            const comName = $(this).data('name'); // Get the value of the data-name attribute
            const comStatus = $(this).data('status');

            $('#companyCodeupdate').val(comCode); // Set the value of the input field
            $('#companyNameupdate').val(comName);
            $('#statusupdate').val(comStatus);
            $('#updateModal').modal('show');

            $('#btnupdate').click(function() {
                const ComCode = $('#companyCodeupdate').val();
                const ComName = $('#companyNameupdate').val();
                const ComStatus = $('#statusupdate').val();
                $.ajax({
                    url: '../../action/CompanyInfor/TabCompany/update.php',
                    method: 'GET',
                    data: {
                        action: 'btnupdate',
                        ComCode: ComCode,
                        ComName: ComName,
                        ComStatus: ComStatus,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update Successfully',
                            text: response
                        }).then(function() {
                            location.reload();
                        });

                    },
                    error: function(error_reporting) {
                        alert('Error: ' + error_reporting);
                    }

                })
            })




        })
    })
</script>

<!-- //delete alert mesaages -->
<script>
    function deleteCompanyc(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the company record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/CompanyInfor/TabCompany/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The company has been removed.',
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
                            text: 'Could not delete the company.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>