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
    $sql = "SELECT * FROM hrdepartment";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departmentModal">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add
                    </button>
                </th>
                <th>DepartmentCode</th>
                <th>DepartmentName</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary editButton1" data-bs-toggle="modal" data-bs-target="#DepartmentupdateModal"
                            data-id="<?php echo $row['Code']; ?>"
                            data-name="<?php echo $row['Description']; ?>"
                            data-status="<?php echo $row['Status']; ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deleteCompany('<?php echo $row['Code']; ?>')"><i class="fa fa-trash"></i></button>

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
<div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <form>
                        <label for="departmentCode">DepartmentCode:</label>
                        <input type="text" id="departmentCode" name="departmentCode">
                        <label for="departmentName">DepartmentName:</label>
                        <input type="text" id="departmentName" name="departmentName">
                        <label for="status">Status:</label>
                        <select name="status" id="Departmentstatus">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='btnsave1' class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

</div>


<!-- Modal Update-->
<div class="modal fade" id="DepartmentupdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <form>
                        <input type="hidden" id="departmentCodeupdate" name="departmentCodeupdate">
                        <label for="departmentName">DepartmentName:</label>
                        <input type="text" id="departmentNameupdate" name="departmentNameupdate">
                        <label for="status">Status:</label>
                        <select id="Departmentstatusupdate">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='btnupdate1' class="btn btn-primary">Upadate</button>
            </div>
        </div>
    </div>

</div>

<!-- for active on tab page -->
<script>

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            localStorage.setItem('activeTab', event.target.getAttribute('data-bs-target'));
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        const activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            const triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('#btnsave1').click(function() {
            $.ajax({
                url: '../../action/CompanyInfor/TabDepartment/add.php',
                method: 'POST',
                data: {
                    action: 'btnsave',
                    Dcode: $('#departmentCode').val(),
                    Dname: $('#departmentName').val(),
                    Dstatus: $('#Departmentstatus').val()
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
        $('.editButton1').click(function() {
            const Dcode = $(this).data('id');
            const Dname = $(this).data('name'); // Get the value of the data-name attribute
            const Dstatus = $(this).data('status');

            $('#departmentCodeupdate').val(Dcode); // Set the value of the input field
            $('#departmentNameupdate').val(Dname);
            $('#Departmentstatusupdate').val(Dstatus);
            $('#DepartmentupdateModal').modal('show');

            $('#btnupdate1').click(function() {
                const Dcode = $('#departmentCodeupdate').val();
                const Dname = $('#departmentNameupdate').val();
                const Dstatus = $('#Departmentstatusupdate').val();
                $.ajax({
                    url: '../../action/CompanyInfor/TabDepartment/update.php',
                    method: 'GET',
                    data: {
                        action: 'btnupdate1',
                        Dcode: Dcode,
                        Dname: Dname,
                        Dstatus: Dstatus,
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
    function deleteCompany(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the Department record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/CompanyInfor/TabDepartment/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The Department has been removed.',
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
                            text: 'Could not delete the Department.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>