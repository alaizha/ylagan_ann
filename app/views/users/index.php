<!DOCTYPE html>
<html lang="en">
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
    </style>
</head>
<body>
  <h1>Students Info</h1>

  <!-- Search -->
  <form action="<?= site_url('users'); ?>" method="get" class="search-form">
    <?php
      $q = '';
      if(isset($_GET['q'])) {
        $q = $_GET['q'];
      }
    ?>
    <input class="form-control" name="q" type="text" placeholder="Search..." value="<?= html_escape($q); ?>" style="max-width: 300px;">
    <button type="submit" class="btn-search">Search</button>
  </form>

  <!-- Table -->
  <table class="table table-hover text-center align-middle">
    <thead>
      <tr>
        <th width="10%">ID</th>
        <th width="30%">Name</th>
        <th width="40%">Email</th>
        <th width="20%">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (html_escape($user) as $users): ?>
        <tr>
          <td><?= html_escape($users['id']); ?></td>
          <td><?= html_escape($users['username']); ?></td>
          <td><?= html_escape($users['email']); ?></td>
          <td>
            <a href="<?= site_url('/users/update/'.$users['id']); ?>" class="action-btn update">Update</a>
            <a href="<?= site_url('/users/delete/'.$users['id']); ?>" class="action-btn delete" onclick="return confirm('Delete this user?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="d-flex justify-content-center">
    <?= $page; ?>
  </div>

  <!-- Create Button -->
  <div class="text-center mt-4">
    <a href="<?= site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
  </div>
</body>
</html>