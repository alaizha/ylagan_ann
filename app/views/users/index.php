<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users Data</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #0f172a; /* dark navy */
      color: #f9fafb; /* light gray text */
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px;
    }

    h1 {
      margin-bottom: 20px;
      font-weight: 700;
      color: #f9fafb;
    }

    /* Container styling */
    .container {
      width: 100%;
      max-width: 1000px;
    }

    /* Search Form */
    .search-form {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 20px;
    }
    .search-form input {
      border-radius: 8px;
      padding: 8px 12px;
    }
    .btn-search {
      background-color: #3b82f6;
      color: #fff;
      border: none;
      padding: 8px 15px;
      border-radius: 8px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-search:hover {
      background-color: #2563eb;
    }

    /* Table Styling */
    .table {
      background: #1e293b;
      border-radius: 12px;
      overflow: hidden;
    }
    .table th {
      background: #334155;
      color: #f8f6f6ff;
      font-weight: 600;
    }
    .table td {
      color: #0f0f0fff;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #273449;
    }
    .table-hover tbody tr:hover {
      background-color: #374151;
    }

    /* Action Buttons */
    .action-btn {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }
    .action-btn.update {
      background: #f59e0b;
      color: #fff;
    }
    .action-btn.update:hover {
      background: #d97706;
    }
    .action-btn.delete {
      background: #ef4444;
      color: #fff;
    }
    .action-btn.delete:hover {
      background: #dc2626;
    }

    /* Create Button */
    .btn-create {
      display: inline-block;
      background-color: #10b981;
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      font-weight: 700;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-create:hover {
      background-color: #059669;
      color: #fff;
    }

    /* Pagination */
    .pagination {
      margin-top: 20px;
    }
    .page-link {
      background-color: #1e293b;
      border: none;
      color: #f9fafb;
    }
    .page-link:hover {
      background-color: #334155;
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