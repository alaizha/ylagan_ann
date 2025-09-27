<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-card {
            background: #111827;
            color: #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
        }
        .form-card h4 {
            margin-bottom: 20px;
            color: white;
            text-align: center;
        }
        .btn-submit {
            background: #22c55e;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-submit:hover {
            background: #16a34a;
        }
    </style>
</head>
<body>

    <div class="form-card">
        <h4>Update User Information</h4>

        <!-- ✅ Form with username, email, role -->
        <form method="post" action="/index.php/users/update/<?= $user['id'] ?>">
            
            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" 
                       value="<?= $user['username'] ?>" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" 
                       value="<?= $user['email'] ?>" required>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role" required>
                    <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="Student" <?= $user['role'] === 'Student' ? 'selected' : '' ?>>Student</option>
                    <option value="Teacher" <?= $user['role'] === 'Teacher' ? 'selected' : '' ?>>Teacher</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
