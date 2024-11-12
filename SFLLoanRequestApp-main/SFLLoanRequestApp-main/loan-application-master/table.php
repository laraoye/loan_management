<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        /* Content Styles */
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#">Dashboard</a>
    <a href="#">Customer Details</a>
    <a href="#">Loan Applications</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
</div>

<!-- Content -->
<div class="content">
    <!-- Your content goes here -->
    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin dashboard. You can view customer details and loan applications here.</p>
</div>

</body>
</html>

<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="admin_act.css">
    <style>
        .customers {
            width: 100%;
        }

        table, th, td {
            border: 1px solid red;
            border-collapse: collapse;
        }

        th, td {
            padding: 20px;
            text-align: left;
            white-space: nowrap; /* Prevent text from wrapping */
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: rgb(53, 146, 56);
            color: white;
        }
    </style>
</head>
<body>

<?php
$query = "SELECT * FROM application WHERE status = 'pending'";
$supportQry = $conn->query($query);
$cntt = mysqli_num_rows($supportQry);

if ($cntt > 0) {
    ?>
    <table class="customers">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qryForm = $conn->query($query);
            while ($row = mysqli_fetch_array($qryForm)) {
                $email = $row['email'];
                ?>
                <tr onclick="window.location.href='custLFApproval.php?email=<?php echo $email; ?>'" style="cursor:pointer;">
                    <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['purpose']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <table class="customers">
        <tr>
            <th>NO RECORDS FOUND</th>
        </tr>
    </table>
    <?php
}
?>

</body>
</html>
