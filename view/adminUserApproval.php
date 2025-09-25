<?php
require_once '../controller/adminUserApprovalController.php';
$controller = new AdminUserApprovalController();
$pendingUsers = $controller->index();
?>

<div class="user-approval-container">
    <h2>Pending User Approvals</h2>
    <table class="user-approval-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pendingUsers)): ?>
                <?php foreach ($pendingUsers as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['usertype']); ?></td>
                        <td><span class="status-pending"><?php echo htmlspecialchars($user['clearance_status']); ?></span></td>
                        <td>
                            <a href="#" class="btn-approve" data-username="<?php echo htmlspecialchars($user['username']); ?>">Approve</a>
                            <a href="#" class="btn-reject" data-username="<?php echo htmlspecialchars($user['username']); ?>">Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No pending users.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
