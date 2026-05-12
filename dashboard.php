    <?php
    session_start();
    include 'db.php';

    if (!isset($_SESSION['teacher'])) {
        header("Location: log_out.php");
        exit();
    }

    $search = $_GET['search'] ?? '';

    if ($search) {
        $stmt = $pdo->prepare("
            SELECT * FROM students 
            WHERE name LIKE ? 
            OR email LIKE ? 
            OR course LIKE ?
        ");

        $stmt->execute([
            "%$search%",
            "%$search%",
            "%$search%"
        ]);
    } else {
        $stmt = $pdo->query("SELECT * FROM students");
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <body class="bg-light">

    <div class="container mt-5">
  
            </li> <!-- TOP AREA -->
<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- LEFT SIDE BUTTONS -->
    <div class="d-flex gap-2">

    
        <a href="create.php" class="btn btn-success">
            <i class="fa-solid fa-user-plus"></i> Add Student
        </a>

        <!-- PROFILE DROPDOWN -->
        <div class="dropdown">

            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i> Profile
            </button>

            <ul class="dropdown-menu">

                <li>
                    <a class="dropdown-item" href="profile.php">
                        <i class="fa-solid fa-user"></i> View Profile
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="settings.php">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger" href="log_out.php">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>

            </ul>
        </div>

    </div>

    <!-- RIGHT SIDE SEARCH -->
    <form method="GET" class="input-group w-50">

        <input type="text" name="search" class="form-control"
            placeholder="Search student (name, email, course)"
            value="<?= htmlspecialchars($search) ?>">

        <button type="submit" class="btn btn-primary px-4">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>

        <a href="dashboard.php" class="btn btn-secondary px-4">
            <i class="fa-solid fa-rotate-left"></i> Reset
        </a>

    </form>

</div>
        <!-- TABLE -->
        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Address</th>
                            <th>Actions</th>
                            <th>Gender</th>
                            <th>Year Level</th>
                            <th>Section</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                        </tr>
                    </thead>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                    <tbody>
                    <?php while ($row = $stmt->fetch()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['course'] ?></td>
                            <td><?= $row['address'] ?></td>
                           <td><?= $row['gender'] ?></td>
                           <td><?= $row['year_level'] ?></td>
                           <td><?= $row['section'] ?></td>
                           <td><?= $row['birthday'] ?></td>
                           <td><?= $row['phone'] ?></td>
                                <a href="edit.php?id=<?= $row['id'] ?>" 
   class="btn btn-warning btn-sm"
   title="Edit">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

<a href="delete.php?id=<?= $row['id'] ?>" 
   class="btn btn-danger btn-sm"
   title="Delete"
   onclick="return confirm('Are you sure?')">
    <i class="fa-solid fa-trash"></i>
</a>
                            </td>
                            
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
              </div>
               </div>
            <div class="mt-3 text-end">
    <div class="mt-2 text-end">
   <div class="mt-2 text-end">
    <a href="delete_all.php"
       class="text-danger small"
       onclick="return confirm('Delete all students?')">
 Delete All
    </a>
</div>
</div>
        </div>

    </div>

    </body>
    </html>