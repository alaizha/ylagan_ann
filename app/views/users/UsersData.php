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
            height: 100vh;
        }
        .container { margin-top: 50px; color: white; }
        .table { background: #111827; border-radius: 10px; overflow: hidden; }
        .table th, .table td { color: #e5e7eb; vertical-align: middle; }
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
        .search-bar input {
            background: #1f2937;
            border: 1px solid #374151;
            color: #fff;
        }
        .search-bar input::placeholder {
            color: #9ca3af;
        }
        .pagination .page-link {
            background: #1f2937;
            border: 1px solid #374151;
            color: #fff;
        }
        .pagination .page-item.active .page-link {
            background: #3b82f6;
            border-color: #3b82f6;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Users List</h2>
        <a href="/index.php/users/create" class="btn-add">Add New User</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" class="d-flex search-bar mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search users..."
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="btn btn-success">Search</button>
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

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($_GET['search'] ?? '') ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
