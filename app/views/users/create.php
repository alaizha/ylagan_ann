<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>

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
            max-width: 400px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
        }
        .form-card h4 {
            margin-bottom: 15px;
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
        .form-select, .form-control {
            background: #1f2937;
            color: #e5e7eb;
            border: 1px solid #374151;
        }
        .form-select:focus, .form-control:focus {
            background: #1f2937;
            color: #fff;
            border-color: #22c55e;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <div class="form-card">
        <h4>User Information</h4>

        <form method="post" action="/index.php/users/create">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>

            <!-- ✅ New Role field -->
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
