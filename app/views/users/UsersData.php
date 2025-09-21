<!DOCTYPE html>
<html>
<head>
    <title>Users Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0f172a;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }
        .container { margin-top: 50px; color: white; }
        .table { background: #111827; border-radius: 10px; overflow: hidden; }
        .table th, .table td { color: #080808ff; vertical-align: middle; }
        .table-striped tbody tr:nth-of-type(odd) { background-color: #1f2937; }
        .btn-warning { background-color: #f59e0b; border: none; }
        .btn-warning:hover { background-color: #d97706; }
        .btn-danger { background-color: #ef4444; border: none; }
        .btn-danger:hover { background-color: #dc2626; }
        .btn-add {
            background-color: #3b82f6;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-add:hover {
            background-color: #2563eb;
            color: #fff;
        }
        /* ✅ Center pagination */
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Users List</h2>
        <!-- ✅ Add New User button -->
        <a href="/index.php/users/create" class="btn-add">Add New User</a>
    </div>

    <form action="<?=site_url('users');?>" method="get" class="col-sm-4 float-end d-flex search-form">
        <?php
        $q = '';
        if(isset($_GET['q'])) {
            $q = $_GET['q'];
        }
        ?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary">Search</button>    
    </form>

    <?php if (!empty($users)): ?>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <!-- ✅ Update + Delete -->
                            <a href="/index.php/users/update/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="/index.php/users/delete/<?= $user['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this user?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- ✅ Pagination block -->
        <nav>
            <?= $page ?>
        </nav>

    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
