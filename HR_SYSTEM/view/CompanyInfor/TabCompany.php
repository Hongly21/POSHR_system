<?php include_once('../../root/Header.php');
include '../../root/DataTable.php';
include '../../Config/conect.php';
?>

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
                        Add New
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
                            Edit
                        </button>
                        <button class="btn btn-danger" onclick="deleteCompany('<?php echo $row['Code']; ?>')">Delete</button>

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
                    <Form>
                        <label for="companyCode">CompanyCode:</label>
                        <input type="text" id="companyCode" name="companyCode"><br><br>
                        <label for="companyName">CompanyName:</label>
                        <input type="text" id="companyName" name="companyName"> <br>
                        <label for="status">Status:</label>
                        <select name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>


                    </Form>
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
                    <Form>
                        <input type="hidden" id="companyCodeupdate" name="companyCode">
                        <label for="companyName">CompanyName:</label>
                        <input type="text" id="companyNameupdate" name="companyName"> <br>
                        <label for="status">Status:</label>
                        <select id="statusupdate">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </Form>
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
                    url: '../../action/CompanyInfor/add.php',
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
                        url: '../../action/CompanyInfor/update.php',
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
        function deleteCompany(code) {
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
                        url: '../../action/CompanyInfor/delete.php',
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

</div>