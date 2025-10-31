<?php
include("../../root/Header.php");
include("../../Config/conect.php");
?>

<table id="UserTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th style="width: 150px"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-user-plus me-2"></i>Add User</button></th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Last Login</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM hrusers ORDER BY CreatedAt DESC";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td>
                        <?php
                        if ($row['Username'] !== 'admin') {
                        ?>
                            <button class="btn btn-primary editButton" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                data-id="<?php echo $row['UserID']; ?>"
                                data-username="<?php echo $row['Username']; ?>"
                                data-email="<?php echo $row['Email']; ?>"
                                data-role="<?php echo $row['Role']; ?>"
                                data-status="<?php echo $row['Status']; ?>">
                                <i class="fas fa-user-edit me-2"></i> <i class="fas fa-edit"></i>
                            </button>
                        <?php
                        }
                        ?>
                        <button class="btn btn-danger" onclick="deleteUser(<?php echo $row['UserID']; ?>)">
                            <i class="fas fa-user-times me-2"></i> <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td><?php echo ($row['Username']); ?></td>
                    <td><?php echo ($row['Email']); ?></td>
                    <td>
                        <span class="badge bg-<?php echo $row['Role'] === 'admin' ? 'danger' : ($row['Role'] === 'manager' ? 'warning' :
                                                    'info'); ?>"><?php echo ucfirst($row['Role']);
                                        ?>
                        </span>
                    </td>
                    <td><span class="badge bg-<?php echo $row['Status'] === 'active' ? 'success' : 'secondary'; ?>"><?php echo ucfirst($row['Status']); ?></span></td>
                    <td><?php echo !empty($row['LastLogin']) ? date('Y-m-d H:i', strtotime($row['LastLogin'])) : 'Never'; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addTaxSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="addUserModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Add New User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addUserForm" class="needs-validation" novalidate>
                    <div class="mb-4">
                        <label for="username" class="form-label fw-semibold">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-at text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="username" required
                                placeholder="Enter username / Must be same as your real name" maxlength="50" pattern="[a-zA-Z0-9_]+">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" id="email" required
                                placeholder="Enter email address" maxlength="100">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-key me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" id="password" required
                                placeholder="Enter password" minlength="8">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold">
                            <i class="fas fa-user-tag me-2"></i>Role
                        </label>
                        <select class="form-select" id="role" required>
                            <option value="">Select role...</option>
                            <option value="staff">Staff</option>
                            <option value="manager">Manager</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="invalid-feedback">Please select a role.</div>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">
                            <i class="fas fa-toggle-on me-2"></i>Status
                        </label>
                        <select class="form-select" id="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary fw-semibold" id="saveUser">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editTaxSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="editUserModalLabel">
                    <i class="fas fa-user-edit me-2"></i>Edit User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editUserForm" class="needs-validation" novalidate>
                    <input type="hidden" id="edit_user_id">
                    <div class="mb-4">
                        <label for="edit_username" class="form-label fw-semibold">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-at text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="edit_username" required
                                placeholder="Enter username" maxlength="50" pattern="[a-zA-Z0-9_]+">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" id="edit_email" required
                                placeholder="Enter email address" maxlength="100">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_password" class="form-label fw-semibold">
                            <i class="fas fa-key me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" id="edit_password"
                                placeholder="Enter new password (leave blank to keep current)" minlength="8">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_role" class="form-label fw-semibold">
                            <i class="fas fa-user-tag me-2"></i>Role
                        </label>
                        <select class="form-select" id="edit_role" required>
                            <option value="">Select role...</option>
                            <option value="staff">Staff</option>
                            <option value="manager">Manager</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="invalid-feedback">Please select a role.</div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_status" class="form-label fw-semibold">
                            <i class="fas fa-toggle-on me-2"></i>Status
                        </label>
                        <select class="form-select" id="edit_status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <input type="hidden" id='iduser' value="">
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary fw-semibold" id="updateUser">
                    <i class="fas fa-save me-2"></i>Update Changes
                </button>
            </div>
        </div>
    </div>
</div>


<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $('#saveUser').click(function() {
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var role = $('#role').val();
        var status = $('#status').val();

        if (username && email && password && role && status) {
            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password must be at least 8 characters long.',
                });
                return false;
            } else if (email.indexOf("@") == -1 || email.indexOf(".") == -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter a valid email address.',
                });
                return false;
            } else {
                $.ajax({
                    url: '../../action/User/create.php',
                    method: 'POST',
                    data: {
                        username: username,
                        email: email,
                        password: password,
                        role: role,
                        status: status
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User has been created successfully!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            })

                        } else if (response == 'nameexists') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: 'Username already exists!',
                            });

                        } else if (response == 'mailexists') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: 'Email already exists!',
                            });

                        } else if (response == 'cannotuse') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: 'Can not use this password',
                            })

                        } else if (response == 'error') {
                            alert('Error creating user.');
                        }
                    }

                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please fill in all required fields.',
            });
            return false;
        }

    })

    $('.editButton').click(function() {
        var username = $(this).data('username');
        var email = $(this).data('email');
        var role = $(this).data('role');
        var status = $(this).data('status');
        var id = $(this).data('id');


        $('#edit_username').val(username);
        $('#edit_email').val(email);
        $('#edit_role').val(role);
        $('#edit_status').val(status);
        $('#iduser').val(id);

        $('#updateUser').click(function() {
            var id = $('#iduser').val();
            var username = $('#edit_username').val();
            var email = $('#edit_email').val();
            var password = $('#edit_password').val();
            var role = $('#edit_role').val();
            var status = $('#edit_status').val();

            $.ajax({
                url: '../../action/User/update.php',
                method: 'POST',
                data: {
                    id: id,
                    username: username,
                    email: email,
                    password: password,
                    role: role,
                    status: status
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User has been updated successfully!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        })
                    } else if (response == 'passwordnotmatch') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: 'Password not match!',
                        });

                    } else if (response == 'enterpassword') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: 'Please enter password!',
                        });

                    } else if (response == 'error') {
                        alert('Error updating user.');
                    }
                }
            })
        });

    })
</script>

<script>
    //function delete 
    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/User/delete.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User has been deleted successfully!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            })
                        } else {
                            alert('Error deleting user.');
                        }
                    }
                })
            }
        })
    }
</script>