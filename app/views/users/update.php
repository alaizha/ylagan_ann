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

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: #fff;
      overflow: hidden;
      position: relative;
    }

    /* Floating gradient circles */
    .bg-circle {
      position: absolute;
      border-radius: 50%;
      filter: blur(100px);
      opacity: 0.5;
      animation: float 10s ease-in-out infinite alternate;
      z-index: 0;
    }
    .bg-circle:nth-child(1) {
      width: 300px;
      height: 300px;
      background: #ff9ff3;
      top: 15%;
      left: 10%;
    }
    .bg-circle:nth-child(2) {
      width: 350px;
      height: 350px;
      background: #18dcff;
      bottom: 10%;
      right: 10%;
      animation-delay: 3s;
    }
    @keyframes float {
      from { transform: translateY(0px); }
      to { transform: translateY(-40px); }
    }

    /* Form card (glassmorphism) */
    .form-card {
      position: relative;
      width: 380px;
      padding: 40px 35px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 35px rgba(0, 0, 0, 0.3);
      text-align: center;
      z-index: 2;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-card h1 {
      font-size: 2em;
      font-weight: 700;
      color: #fff;
      text-shadow: 0 0 12px rgba(37, 117, 252, 0.8);
      margin-bottom: 25px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      font-size: 1em;
      border-radius: 10px;
      border: 2px solid transparent;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      transition: 0.3s ease;
    }

    .form-group input::placeholder {
      color: #ccc;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #2575fc;
      box-shadow: 0 0 15px rgba(37, 117, 252, 0.8);
      background: rgba(255, 255, 255, 0.15);
    }

    /* Password toggle icon */
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #18dcff;
      cursor: pointer;
      transition: 0.3s;
    }

    .toggle-password:hover {
      color: #6a11cb;
    }

    /* Submit button */
    .btn-submit {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      font-size: 1.1em;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 0 20px rgba(37, 117, 252, 0.5);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 25px rgba(37, 117, 252, 0.8);
    }

    /* Return button */
    .btn-return {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 18px;
      border-radius: 8px;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      border: 1px solid rgba(255, 255, 255, 0.4);
      transition: 0.3s;
    }

    .btn-return:hover {
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
    }
  </style>
</head>
<body>
  <!-- Background circles -->
  <div class="bg-circle"></div>
  <div class="bg-circle"></div>

  <div class="form-card">
    <h1>Update User</h1>
    <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST">
      <div class="form-group">
        <input type="text" name="username" value="<?=html_escape($user['username']);?>" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="email" name="email" value="<?=html_escape($user['email']);?>" placeholder="Email" required>
      </div>

      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
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
    <a href="<?=site_url('/users');?>" class="btn-return">Return to Home</a>
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
