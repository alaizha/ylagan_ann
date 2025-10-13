<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    /* Background Gradient with Glow */
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: radial-gradient(circle at top left, #0b132b, #1c2541, #3a506b);
      overflow: hidden;
      position: relative;
      color: #fff;
    }

    /* Animated light blobs */
    body::before,
    body::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(200px);
      opacity: 0.6;
      animation: float 10s infinite alternate ease-in-out;
      z-index: 0;
    }

    body::before {
      width: 400px;
      height: 400px;
      background: #00e5ff;
      top: -100px;
      left: -120px;
    }

    body::after {
      width: 500px;
      height: 500px;
      background: #00ffa3;
      bottom: -150px;
      right: -150px;
      animation-delay: 3s;
    }

    @keyframes float {
      from { transform: translateY(0); }
      to { transform: translateY(60px); }
    }

    /* Glassmorphic Card */
    .form-card {
      position: relative;
      width: 380px;
      padding: 40px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
      text-align: center;
      z-index: 1;
    }

    .form-card h1 {
      font-size: 2em;
      font-weight: 700;
      color: #00ffa3;
      margin-bottom: 25px;
      text-shadow: 0 0 15px #00ffa3;
    }

    /* Form Inputs */
    .form-group {
      position: relative;
      margin-bottom: 18px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      font-size: 1em;
      border-radius: 8px;
      border: 2px solid transparent;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      transition: 0.3s;
    }

    .form-group input::placeholder {
      color: #bbb;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #00e5ff;
      box-shadow: 0 0 10px #00e5ff, 0 0 20px #00ffa3;
      background: rgba(255, 255, 255, 0.15);
    }

    /* Toggle Password Icon */
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #00e5ff;
      cursor: pointer;
      transition: 0.3s;
    }

    .toggle-password:hover {
      color: #00ffa3;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(90deg, #00ffa3, #00e5ff);
      color: #0f0f1a;
      font-size: 1.1em;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
      transition: 0.3s;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 35px rgba(0, 255, 255, 0.8);
    }

    /* Return Button */
    .btn-return {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 18px;
      border-radius: 8px;
      color: #00ffa3;
      text-decoration: none;
      border: 1px solid #00ffa3;
      transition: 0.3s;
      font-weight: 500;
    }

    .btn-return:hover {
      background: #00ffa3;
      color: #0f0f1a;
      box-shadow: 0 0 15px #00ffa3;
    }
  </style>
</head>
<body>
  <div class="form-card">
    <h1>Update User</h1>
    <form action="<?= site_url('users/update/'.$user['id']) ?>" method="POST">
      <div class="form-group">
        <input type="text" name="username" value="<?= html_escape($user['username']); ?>" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="email" name="email" value="<?= html_escape($user['email']); ?>" placeholder="Email" required>
      </div>

      <?php if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
        <div class="form-group">
          <select name="role" required>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
          </select>
        </div>

        <div class="form-group">
          <input type="password" placeholder="Password" name="password" id="password" required>
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>
      <?php endif; ?>

      <button type="submit" class="btn-submit">Update User</button>
    </form>
    <a href="<?= site_url('/users'); ?>" class="btn-return">Return to Home</a>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    if (togglePassword && password) {
      togglePassword.addEventListener('click', function () {
        const type = password.type === 'password' ? 'text' : 'password';
        password.type = type;
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    }
  </script>
</body>
</html>
