<?php
session_start();
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
    <tbody id="data">
        <?php
        $sql = "SELECT * FROM hrusers ORDER BY CreatedAt DESC";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr data-id="<?php echo $row['UserID']; ?>">
                    <td>
                        <?php
                        if ($row['Username'] != "admin") {
                        ?>
                            <button class="btn btn-danger btn-sm delete-user-btn" data-id="<?php echo $row['UserID']; ?>">
                                <i class="fas fa-trash"></i> Delete
                            </button>

                        <?php
                        }
                        ?>
                        <?php if (!isset($_SESSION['UserID']) || $row['UserID'] != $_SESSION['UserID']) { ?>
                            <button class="btn btn-primary btn-sm edit-user-btn"
                                data-id="<?php echo $row['UserID']; ?>"
                                data-username="<?php echo $row['Username']; ?>"
                                data-email="<?php echo $row['Email']; ?>"
                                data-role="<?php echo $row['Role']; ?>"
                                data-status="<?php echo $row['Status']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['Username']); ?></td>
                    <td><?php echo htmlspecialchars($row['Email']); ?></td>
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
                                placeholder="Enter username" maxlength="50" pattern="[a-zA-Z0-9_]+">
                            <div class="invalid-feedback">Please provide a valid username (letters, numbers, and underscore only).</div>
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
                            <div class="invalid-feedback">Please provide a valid email address.</div>
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
                            <div class="invalid-feedback">Password must be at least 8 characters long.</div>
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
                            <div class="invalid-feedback">Please provide a valid username (letters, numbers, and underscore only).</div>
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
                            <div class="invalid-feedback">Please provide a valid email address.</div>
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
    $(document).ready(function() {
        // Initialize DataTable for Users
        let userTable;
        if (!$.fn.DataTable.isDataTable('#UserTable')) {
            userTable = $('#UserTable').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ] // Sort by Username by default
            });
        } else {
            userTable = $('#UserTable').DataTable();
        }

        // Toggle password visibility
        $('.toggle-password').click(function() {
            const passwordField = $(this).siblings('input[type="password"]');
            const icon = $(this).find('i');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Add new User
        $('#saveUser').click(function() {
            if (!$('#addUserForm')[0].checkValidity()) {
                $('#addUserForm')[0].reportValidity();
                return;
            }

            const username = $('#username').val();
            const email = $('#email').val();
            const password = $('#password').val();
            const role = $('#role').val();
            const status = $('#status').val();

            $.ajax({
                url: "../../action/User/create.php",
                type: "POST",
                data: {
                    type: "User",
                    username: username,
                    email: email,
                    password: password,
                    role: role,
                    status: status
                },
                success: function(response) {
                    try {
                        const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                        if (jsonResponse.status === 'success') {
                            // Add new row to DataTable
                            userTable.row.add([
                                `<div class="btn-group">
                                <button class="btn btn-primary btn-sm edit-user-btn" 
                                    data-id="${jsonResponse.id}" 
                                    data-username="${username}"
                                    data-email="${email}"
                                    data-role="${role}"
                                    data-status="${status}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm delete-user-btn" data-id="${jsonResponse.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>`,
                                username,
                                email,
                                `<span class="badge bg-${role === 'admin' ? 'danger' : (role === 'manager' ? 'warning' : 'info')}">${role}</span>`,
                                `<span class="badge bg-${status === 'active' ? 'success' : 'secondary'}">${status}</span>`,
                                'Never'
                            ]).draw(false);

                            // Hide modal and clean up
                            $('#addUserModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            // Clear form
                            $('#username').val('');
                            $('#email').val('');
                            $('#password').val('');
                            $('#role').val('');

                            showToast('success', jsonResponse.message || 'User added successfully');
                        } else {
                            showToast('error', jsonResponse.message || 'Error adding user');
                        }
                    } catch (e) {
                        showToast('error', 'Error processing server response');
                    }
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error adding user');
                }
            });
        });

        // Edit button click handler for Users
        $(document).on('click', '.edit-user-btn', function() {
            const id = $(this).data('id');
            const username = $(this).data('username');
            const email = $(this).data('email');
            const role = $(this).data('role');
            const status = $(this).data('status');

            $('#edit_user_id').val(id);
            $('#edit_username').val(username);
            $('#edit_email').val(email);
            $('#edit_role').val(role);
            $('#edit_status').val(status);
            $('#edit_password').val(''); // Clear password field

            $('#editUserModal').modal('show');
        });

        // Update User
        $('#updateUser').click(function() {
            if (!$('#editUserForm')[0].checkValidity()) {
                $('#editUserForm')[0].reportValidity();
                return;
            }

            const id = $('#edit_user_id').val();
            const username = $('#edit_username').val();
            const email = $('#edit_email').val();
            const password = $('#edit_password').val();
            const role = $('#edit_role').val();
            const status = $('#edit_status').val();

            // Get current logged-in user ID from PHP session
            const currentUserId = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

            $.ajax({
                url: "../../action/User/update.php",
                type: "POST",
                data: {
                    type: "User",
                    id: id,
                    username: username,
                    email: email,
                    password: password, // Will be handled server-side if empty
                    role: role,
                    status: status
                },
                success: function(response) {
                    try {
                        const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                        if (jsonResponse.status === 'success') {
                            // Update row in DataTable
                            const row = $(`button[data-id="${id}"]`).closest('tr');
                            userTable.row(row).data([
                                `<div class="btn-group">
                            <button class="btn btn-primary btn-sm edit-user-btn" 
                                data-id="${id}" 
                                data-username="${username}"
                                data-email="${email}"
                                data-role="${role}"
                                data-status="${status}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            ${id != currentUserId ? `
                            <button class="btn btn-danger btn-sm delete-user-btn" data-id="${id}">
                                <i class="fas fa-trash"></i> Delete
                            </button>` : ''}
                        </div>`,
                                username,
                                email,
                                `<span class="badge bg-${role === 'admin' ? 'danger' : (role === 'manager' ? 'warning' : 'info')}">${role}</span>`,
                                `<span class="badge bg-${status === 'active' ? 'success' : 'secondary'}">${status}</span>`,
                                row.find('td:last').text() // Preserve last login time
                            ]).draw(false);

                            // Hide modal and clean up
                            $('#editUserModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            showToast('success', jsonResponse.message || 'User updated successfully');
                        } else {
                            showToast('error', jsonResponse.message || 'Error updating user');
                        }
                    } catch (e) {
                        showToast('error', 'Error processing server response');
                    }
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error updating user');
                }
            });
        });


        // Delete User
        $(document).on('click', '.delete-user-btn', function() {
            const row = $(this).closest('tr');
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the user account!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../../action/User/delete.php",
                        type: "POST",
                        data: {
                            type: "User",
                            id: id
                        },
                        success: function(response) {
                            try {
                                const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                                if (jsonResponse.status === 'success') {
                                    userTable.row(row).remove().draw(false);
                                    showToast('success', jsonResponse.message || 'User deleted successfully');
                                } else {
                                    showToast('error', jsonResponse.message || 'Error deleting user');
                                }
                            } catch (e) {
                                showToast('error', 'Error processing server response');
                            }
                        },
                        error: function(xhr) {
                            showToast('error', xhr.responseText || 'Error deleting user');
                        }
                    });
                }
            });
        });

        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Input animation
        $('.form-control').on('focus', function() {
            $(this).closest('.input-group').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.input-group').removeClass('focused');
        });

        // Helper function for showing toasts
        function showToast(icon, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-right",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                willClose: () => {
                    $('.swal2-container').remove();
                },
                customClass: {
                    popup: 'colored-toast',
                    timerProgressBar: 'timer-progress'
                },
                iconColor: '#fff',
                background: icon === 'success' ? '#4CAF50' : icon === 'error' ? '#F44336' : '#2196F3'
            });
            Toast.fire({
                icon,
                title
            });
        }
    });
</script>