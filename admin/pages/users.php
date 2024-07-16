<?php
// Start session
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Fetch all users from the database
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = trim($_GET['search']);
    $sql_users = "SELECT * FROM users WHERE username LIKE :search OR full_name LIKE :search OR email LIKE :search";
    $stmt_users = $pdo->prepare($sql_users);
    $stmt_users->execute(['search' => '%' . $search_query . '%']);
} else {
    $sql_users = "SELECT * FROM users";
    $stmt_users = $pdo->query($sql_users);
}
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $sql_delete_user = "DELETE FROM users WHERE user_id = :user_id";
    $stmt_delete_user = $pdo->prepare($sql_delete_user);
    $stmt_delete_user->execute(['user_id' => $user_id]);
    header("Location: users.php");
    exit();
}

// Pagination settings
$limit = 10; // Number of users per page
$total_users = count($users);
$total_pages = ceil($total_users / $limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$users = array_slice($users, $start, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .sidebar {
            position: fixed;
            height: 100%;
            width: 250px;
            background: #343a40;
            color: #fff;
            transition: width 0.3s;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .sidebar .logo {
            text-align: center;
            padding: 15px;
            background: #212529;
            font-size: 20px;
            font-weight: bold;
        }
        .sidebar .nav-item {
            margin: 10px 0;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <a href="dashboard.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="orders.php">Orders</a>
        <a href="products.php">Products</a>
        <a href="categories.php">Categories</a>
        <a href="reports.php">Reports</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Manage Users</h2>
        <form class="form-inline mb-3" method="GET" action="users.php">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search users..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="viewUser(<?php echo $user['user_id']; ?>)">View</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $user['user_id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="users.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search_query); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- User Details Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>User Details</h2>
            <div id="userDetails"></div>
        </div>
    </div>

    <script>
        function viewUser(userId) {
            // Make an AJAX request to fetch user details
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'user_details.php?user_id=' + userId, true);
            xhr.onload = function () {
                if (this.status == 200) {
                    document.getElementById('userDetails').innerHTML = this.responseText;
                    document.getElementById('userModal').style.display = "block";
                }
            };
            xhr.send();
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'users.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'user_id';
                input.value = userId;
                form.appendChild(input);
                var deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_user';
                deleteInput.value = '1';
                form.appendChild(deleteInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function closeModal() {
            document.getElementById('userModal').style.display = "none";
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
