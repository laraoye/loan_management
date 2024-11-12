<?php
session_start();
require_once('config.php');

if (isset($_SESSION['email'])) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "project";

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_select_user = "SELECT fname, lname, email FROM registration WHERE email = '" . $_SESSION['email'] . "' LIMIT 1";
    $result_user = mysqli_query($con, $sql_select_user);
    $user_row = mysqli_fetch_array($result_user);

    if ($user_row) {
        // Display user details
        echo "<h3>User Details</h3>";
        echo "<p>First Name: " . $user_row['fname'] . "</p>";
        echo "<p>Last Name: " . $user_row['lname'] . "</p>";
        echo "<p>Email: " . $user_row['email'] . "</p>";

        // Form to submit loan application
        if (isset($_POST['submit_application'])) {
            $fname = $user_row['fname'];
            $lname = $user_row['lname'];
            $email = $user_row['email'];
            $age = $_POST['age'];
            $date_of_birth = $_POST['date_of_birth'];
            $income = $_POST['income'];
            $loan_amt = $_POST['loan_amt'];
            $purpose = $_POST['purpose'];
            $tenure = $_POST['tenure'];
            $status = 'Pending'; // Assuming you start with a 'Pending' status

            $sql_insert_loan = "INSERT INTO loan_application (fname, lname, email, age, date_of_birth, income, loan_amt, purpose, tenure, status)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql_insert_loan);
            mysqli_stmt_bind_param($stmt, 'sssissdssi', $fname, $lname, $email, $age, $date_of_birth, $income, $loan_amt, $purpose, $tenure, $status);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Loan application submitted successfully.</p>";
            } else {
                echo "<p>Error submitting the loan application: " . mysqli_error($con) . "</p>";
            }

            mysqli_stmt_close($stmt);
        }

        // Form to submit loan application
        echo "<h3>Loan Application</h3>";
        echo "<form method='POST'>";
        echo "<label for='age'>Age:</label>";
        echo "<input type='text' name='age' required><br>";
        echo "<label for='date_of_birth'>Date of Birth:</label>";
        echo "<input type='date' name='date_of_birth' required><br>";
        echo "<label for='income'>Monthly Income:</label>";
        echo "<input type='text' name='income' required><br>";
        echo "<label for='loan_amt'>Loan Amount Needed:</label>";
        echo "<input type='text' name='loan_amt' required><br>";
        echo "<label for='purpose'>Purpose:</label>";
        echo "<input type='text' name='purpose' required><br>";
        echo "<label for='tenure'>Tenure:</label>";
        echo "<input type='text' name='tenure' required><br>";
        echo "<input type='submit' name='submit_application' value='Submit Application'>";
        echo "</form>";
    } else {
        echo "User not found.";
    }

    mysqli_close($con);
} else {
    echo "User is not logged in.";
}
?>
