<?php
session_start();
// Include the database configuration file
include 'config.php';

// Check if the database connection was successful (check if $conn is not null)
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize search query
$search_query = "";

// Check if the search form was submitted
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

// Query to retrieve all customer details with optional search filter
$query = "SELECT * FROM application";

// Append search filter to the query if a search query was provided
if (!empty($search_query)) {
    $query .= " WHERE fname LIKE '%$search_query%' OR lname LIKE '%$search_query%' OR email LIKE '%$search_query%'";
}

$result = $conn->query($query);

// Check if there are customers
if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Dashboard</title>
        <!-- Add your CSS styles here -->
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
        <h1>Customer Details</h1>

        <!-- Search form -->
        <form method="POST">
            <label for="search_query">Search:</label>
            <input type="text" id="search_query" name="search_query" value="<?php echo $search_query; ?>">
            <input type="submit" name="search" value="Search">
        </form>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Income</th>
                <th>Loan Amount</th>
                <th>Purpose</th>
                <th>Tenure</th>
                <th>Status</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['income']; ?></td>
                    <td><?php echo $row['loan_amt']; ?></td>
                    <td><?php echo $row['purpose']; ?></td>
                    <td><?php echo $row['tenure']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    </body>
    </html>
    <?php
} else {
    echo "No customer records found.";
}
?>
