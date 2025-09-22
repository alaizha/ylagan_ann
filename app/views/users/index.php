<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Students Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
/* Darker Background with Soft Aesthetic Blobs */
body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #1e2f28, #2e3f35); /* dark muted green */
  min-height: 100vh;
  margin: 0;
  padding: 20px;
  position: relative;
  overflow-x: hidden;
  color: #e0f2f1;
}

body::before,
body::after {
  content: "";
  position: absolute;
  border-radius: 50%;
  filter: blur(120px);
  opacity: 0.2;
  z-index: 0;
}

body::before {
  width: 400px;
  height: 400px;
  background: #81c784;
  top: -100px;
  left: -100px;
}

body::after {
  width: 500px;
  height: 500px;
  background: #4db6ac;
  bottom: -120px;
  right: -100px;
}

h1, .search-form, table, .btn-create, .pagination {
  position: relative;
  z-index: 1;
}

/* Header */
h1 {
  text-align: center;
  color: #a5d6a7;
  margin-bottom: 30px;
  font-size: 36px;
  font-weight: 700;
  letter-spacing: 1px;
}

/* Search Form */
.search-form {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-bottom: 20px;
}

.search-form .form-control {
  background: #263a33;
  color: #fff;
  border: 1px solid #4caf50;
}

.search-form .form-control::placeholder {
  color: #a5a5a5;
}

.search-form .btn-search {
  background: #66bb6a;
  color: #fff;
  font-weight: 600;
  border: none;
  border-radius: 6px;
  padding: 10px 18px;
  transition: all 0.3s ease;
}

.search-form .btn-search:hover {
  background: #4caf50;
}

/* Table Style */
table {
  width: 95%;
  margin: 0 auto 40px;
  border-collapse: separate;
  border-spacing: 0 8px;
  background: transparent;
}

thead {
  background: transparent;
}

th {
  background: #2e7d32;
  color: #ffffff;
  padding: 16px;
  font-size: 14px;
  font-weight: 700;
  text-transform: uppercase;
  border: none;
  border-radius: 8px 8px 0 0;
}

tbody tr {
  background: #374940;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
  transition: all 0.2s ease;
}

tbody td {
  padding: 16px;
  font-size: 15px;
  color: #e0f2f1;
  border-top: 1px solid #2e3f35;
  border-bottom: 1px solid #2e3f35;
}

tbody tr:hover {
  background-color: #455a49;
  transform: scale(1.005);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}

/* Action Buttons */
a.action-btn {
  display: inline-block;
  padding: 6px 14px;
  font-size: 13px;
  font-weight: 600;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.2s ease-in-out;
}

a.action-btn.update {
  background: #66bb6a;
  color: white;
}

a.action-btn.update:hover {
  background: #4caf50;
}

a.action-btn.delete {
  background: #e57373;
  color: white;
}

a.action-btn.delete:hover {
  background: #d32f2f;
}

/* Create Button */
.btn-create {
  display: inline-block;
  padding: 12px 22px;
  background: #388e3c;
  color: #fff;
  border-radius: 8px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-create:hover {
  background: #2e7d32;
  transform: translateY(-2px);
}

/* Pagination Styling */
.pagination {
  justify-content: center;
}

.pagination a,
.pagination strong {
  margin: 0 3px;
  padding: 8px 12px;
  border-radius: 6px;
  border: 1px solid #66bb6a !important;
  font-size: 14px;
  text-decoration: none;
  color: #ffffff !important;
  background: #388e3c !important;
}

.pagination a:hover {
  background: #ffffff !important;
  color: #388e3c !important;
}

.pagination strong {
  background: #ffffff !important;
  color: #388e3c !important;
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