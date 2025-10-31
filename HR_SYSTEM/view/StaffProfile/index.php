<?php
include('../../root/Header.php');
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
<h3 class="text-center" style="margin-top: 15px; text-transform: uppercase;">Staff Profile</h3>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <table class="table" id="example" border="1">
        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddstaffModal" style="margin-bottom: 8px; font-size: 14px; ">
            Add New
        </button> -->
        <!-- Button trigger modal -->

        <a href="create.php" style="text-decoration: none; color:white;">
            <button class="btn btn-sm btn-success me-2" style="margin-bottom: 8px; font-size: 14px;"> <i class="fa fa-plus" style="margin-right: 4px;"></i> Add New </button>

        </a>
        <!-- export -->
        <button class="btn btn-sm btn-warning me-2 btnExport" style="margin-bottom: 8px; font-size: 14px;" id="export"> <i class="fa fa-file-excel" style="margin-right: 4px;"></i> Export Excel </button>
        <button class="btn btn-sm btn-danger me-2 btnExportpdf" style="margin-bottom: 8px; font-size: 14px;" id="exportPDF"> <i class="fa fa-file-pdf" style="margin-right: 4px;"></i> Export PDF </button>


        <thead>
            <tr>
                <th style="width: 120px;">Action</th>
                <th>Photo</th>
                <th>Code</th>
                <th>EmpName</th>
                <th>Company</th>
                <th>Position</th>
                <th>Department</th>
                <th>Division</th>
                <th>StartDate</th>
                <th>Status</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT hrstaffprofile.*, 
                    hrcompany.Description as CompanyName,
                    hrdepartment.Description as DepartmentName,
                    hrdivision.Description as DivisionName,
                    hrposition.Description as PositionName,
                    hrlevel.Description as LevelName 
                    FROM hrstaffprofile
                    LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
                    LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
                    LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
                    LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
                    LEFT JOIN hrlevel ON hrstaffprofile.Level = hrlevel.Code
                    ORDER BY EmpCode DESC";
            $resutl = $con->query($sql);
            while ($row = $resutl->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <a href="edit.php?code=<?php echo $row['EmpCode']; ?>
                         " style="font-size: 13px;" class="btn btn-warning editButton"><i class="fa fa-edit"></i></a>
                        <button style="font-size: 13px;" class="btn btn-danger " onclick="deleteCompany('<?php echo $row['EmpCode']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><img src="../../assets/images/<?php echo $row['Photo']; ?>" style="width: 60px; height: 60px; border-radius: 50%;"></td>
                    <td><?php echo $row['EmpCode']; ?></td>
                    <td><?php echo $row['EmpName']; ?></td>
                    <td><?php echo $row['CompanyName']; ?></td>
                    <td><?php echo $row['PositionName']; ?></td>
                    <td><?php echo $row['DepartmentName']; ?></td>
                    <td><?php echo $row['DivisionName']; ?></td>
                    <td><?php echo $row['StartDate']; ?></td>
                    <td>
                        <span class="badge bg-<?php echo $row['Status'] === 'Active' ? 'success' : 'danger'; ?>"><?php echo $row['Status']; ?></span>
                    </td>
                    <td><?php echo $row['Contact']; ?></td>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
</div>



<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('.editButton').on('click', function() {
            var code = $(this).data('code');
            var empname = $(this).data('empname');
            var company = $(this).data('company');
            var position = $(this).data('position');
            var department = $(this).data('department');
            var division = $(this).data('division');
            var startdate = $(this).data('startdate');
            var status = $(this).data('status');
            var contact = $(this).data('contact');
            var gender = $(this).data('gender');
            var address = $(this).data('address');
            var email = $(this).data('email');
            var tel = $(this).data('tel');
            var dob = $(this).data('dob');
            var salary = $(this).data('salary');
            var level = $(this).data('level');
            var isProb = $(this).data('isprob');
            var probationDate = $(this).data('probationdate');
            var telegram = $(this).data('tel');
            var dob = $(this).data('dob');
            var photo = $(this).data('photo');

            $('#codeupdate').val(code);

        })
        $('.btnExport').click(function() {
            window.location.href = 'exportExcel.php';
        })
        $('.btnExportpdf').click(function() {
            window.location.href = 'exportPDF.php';
            
        })


    });
</script>

<!-- //delete alert mesaages -->
<script>
    function deleteCompany(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the payroll record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/StaffProfile/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The payroll has been removed.',
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
                            text: 'Could not delete the payroll.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>