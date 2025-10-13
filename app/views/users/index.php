<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Students Info | Gradient Glass Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: #fff;
      overflow-x: hidden;
      position: relative;
    }

    /* Floating gradient circles */
    .bg-circle {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.6;
      animation: float 12s ease-in-out infinite alternate;
      z-index: 0;
    }
    .bg-circle:nth-child(1) {
      width: 250px;
      height: 250px;
      background: #ff9ff3;
      top: 10%;
      left: 15%;
    }
    .bg-circle:nth-child(2) {
      width: 300px;
      height: 300px;
      background: #18dcff;
      bottom: 15%;
      right: 10%;
      animation-delay: 2s;
    }
    @keyframes float {
      from { transform: translateY(0px); }
      to { transform: translateY(-30px); }
    }

    /* Dashboard container */
    .dashboard-container {
      position: relative;
      max-width: 1200px;
      margin: 80px auto;
      padding: 40px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.25);
      z-index: 2;
      animation: fadeIn 1.2s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .dashboard-header h2 {
      font-size: 2em;
      font-weight: 700;
      color: #fff;
      letter-spacing: 1px;
    }

    .logout-btn {
      padding: 10px 18px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(135deg, #ff416c, #ff4b2b);
      color: #fff;
      font-weight: 600;
      text-transform: uppercase;
      box-shadow: 0 0 10px rgba(255, 65, 108, 0.5);
      transition: 0.3s ease;
    }
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 20px rgba(255, 65, 108, 0.8);
    }

    .user-status {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 12px 18px;
      border-radius: 10px;
      margin-bottom: 25px;
      color: #fff;
      font-weight: 500;
      text-align: center;
    }

    .user-status.error {
      background: rgba(255, 65, 108, 0.15);
      border-color: rgba(255, 65, 108, 0.3);
      color: #ffbcbc;
    }

    .table-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
    }

    table {
      width: 100%;
      text-align: center;
      border-collapse: collapse;
      color: #fff;
    }

    th {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      text-transform: uppercase;
      font-weight: 600;
      padding: 12px;
      border-radius: 8px 8px 0 0;
    }

    td {
      background: rgba(255, 255, 255, 0.05);
      padding: 10px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    a.btn-action {
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 13px;
      text-decoration: none;
      color: #fff;
      font-weight: 500;
      transition: 0.3s ease;
      margin: 0 2px;
    }

    a.btn-update {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      box-shadow: 0 0 10px rgba(37, 117, 252, 0.4);
    }
    a.btn-update:hover {
      box-shadow: 0 0 20px rgba(37, 117, 252, 0.8);
    }

    a.btn-delete {
      background: linear-gradient(135deg, #ff416c, #ff4b2b);
      box-shadow: 0 0 10px rgba(255, 65, 108, 0.4);
    }
    a.btn-delete:hover {
      box-shadow: 0 0 20px rgba(255, 65, 108, 0.8);
    }

    .btn-create {
      display: block;
      width: 100%;
      padding: 14px;
      border: none;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      font-size: 1.1em;
      border-radius: 10px;
      font-weight: 600;
      transition: 0.3s ease;
      text-align: center;
      margin-top: 25px;
      text-transform: uppercase;
      text-decoration: none;
      box-shadow: 0 0 15px rgba(37, 117, 252, 0.4);
    }
    .btn-create:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.4);
    }

    /* Search bar */
    .search-form input {
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.4);
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
    }
    .search-form input:focus {
      outline: none;
      border-color: #fff;
      box-shadow: 0 0 10px #fff;
    }

    .search-form button {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 16px;
      transition: 0.3s ease;
    }
    .search-form button:hover {
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
    }

    .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 25px;
    }
  </style>
</head>
<body>
  <!-- Floating Gradient Circles -->
  <div class="bg-circle"></div>
  <div class="bg-circle"></div>

  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2><?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?></h2>
      <a href="<?= site_url('auth/logout'); ?>"><button class="logout-btn">Logout</button></a>
    </div>

    <?php if(!empty($logged_in_user)): ?>
      <div class="user-status">
        <strong>Welcome:</strong> <?= html_escape($logged_in_user['username']); ?>
      </div>
    <?php else: ?>
      <div class="user-status error">
        Logged in user not found
      </div>
    <?php endif; ?>

    <div class="table-card">
      <form action="<?= site_url('users'); ?>" method="get" class="d-flex mb-3 search-form">
        <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
        <input name="q" type="text" class="form-control me-2" placeholder="Search" value="<?= html_escape($q); ?>">
        <button type="submit">Search</button>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <th>Password</th>
              <th>Role</th>
            <?php endif; ?>
            <th>Action</th>
          </tr>
          <?php foreach ($user as $user): ?>
          <tr>
            <td><?= html_escape($user['id']); ?></td>
            <td><?= html_escape($user['username']); ?></td>
            <td><?= html_escape($user['email']); ?></td>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <td>*******</td>
              <td><?= html_escape($user['role']); ?></td>
            <?php endif; ?>
            <td>
              <a href="<?= site_url('/users/update/'.$user['id']); ?>" class="btn-action btn-update">Update</a>
              <a href="<?= site_url('/users/delete/'.$user['id']); ?>" class="btn-action btn-delete">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>

      <div class="pagination-container">
        <?php echo $page; ?>
      </div>
    </div>

    <a href="<?= site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
  </div>
</body>
</html>
