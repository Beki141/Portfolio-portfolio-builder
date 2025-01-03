<?php
include 'include/Database.php';
include 'include/Portfolio.php';

$db = new Database();
$portfolio = new Portfolio($db);

// Fetch all users for management
$users_result = $db->query("SELECT * FROM person");

// Handle user deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $portfolio->deletePerson($delete_id);
    header("Location: manage_users.php");
    exit();
}

// Handle user update
if (isset($_POST['update'])) {
    $update_id = intval($_POST['user_id']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];

    $portfolio->updatePerson($update_id, $name, $description, $picture);
    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #00796b;
            color: white;
        }

        button {
            background-color: #e57373;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
            <?php while ($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['description']; ?></td>
                    <td><img src="<?php echo $user['picture']; ?>" alt="Picture" width="50"></td>
                    <td>
                        <form action="manage_users.php" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
                            <input type="text" name="deiption" value="<?php echo $user['description']; ?>" required>
                            <input type="text" name="picture" value="<?php echo $user['picture']; ?>">
                            <button type="submit" name="update">Update</button>
                        </form>
                        <a href="manage_users.php?delete_id=<?php echo $user['id']; ?>"><button>Delete</button></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>