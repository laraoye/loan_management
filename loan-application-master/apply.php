<?php
session_start();
require_once('config.php');
?>
<html>
<head>
    <title>Application</title>
    <link href="application.css" rel="stylesheet">
</head>

<body>

<?php

//if the user clicks on the "Submit" button
if(isset($_POST['done']))
{
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "project";

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $first = $_POST['firstname'];
        $last = $_POST['lastname'];
        $email = $_SESSION['email'];
        $age = $_POST['age'];
        $dob = $_POST['dob'];
        $income = $_POST['income'];
        $loan = $_POST['loan'];
        $purpose = $_POST['purpose'];
        $tenure = $_POST['tenure'];
        $cus_email = $_POST['cus_email'];

        $sql = "INSERT into application (fname, lname, email, age, date_of_birth, income, loan_amt, purpose, tenure, cus_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$first, $last, $email, $age, $dob, $income, $loan, $purpose, $tenure, $cus_email]);

        if ($result) {
            $_SESSION['app_msg'] = "Your loan application was successfully submitted.";
            $_SESSION['app_location'] = "application_details.php";
            $_SESSION['firstname'] = $first;
        } else {
            $_SESSION['app_msg'] = "There were errors submitting your form. Please try again.";
            $_SESSION['app_location'] = "application.php";
        }

        header('location: application_action.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
if (isset($_SESSION['lname'])) {
    $last = $_SESSION['lname'];
    // Perform further actions with the $last variable
} else {
    // Handle the case when the 'lname' key is not set
}
?>

<div class="details">

<h1>Loan Application Form</h1>
<form method="POST" class="info">
    <label class="labels">First Name</label><br>
    <input class="select" type="text" placeholder="Enter Firstname" name="firstname" id="firstname" required></input>
    <br>
    <label class="labels">Last Name</label><br>
    <input class="select" name="lastname" placeholder="Enter Lastname" name="lastname" id="lastname" required></input>
    <br>
    <label class="labels">Email</label><br>
    <input class="select select1" name="email" placeholder="<?php echo $_SESSION['email']; ?>" disabled></input>
    <br>
    <label class="labels">Age</label><br>
    <input class="select" name="age" placeholder="Enter age" maxlength="3" id="age" required></input>
    <br>
    <label class="labels">Date Of Birth</label><br>
    <input class="select" name="dob" placeholder="Enter date of birth" type="date" required></input>
    <br>
    <label class="labels">Monthly income</label><br>
    <input class="select" name="income" placeholder="Enter monthly income" id="income" required></input>
    <br>
    <label class="labels">Loan amount needed</label><br>
    <input class="select" name="loan" placeholder="Enter loan amount" id="loan_amt" required></input>
    <br>
    <label class="labels">Purpose :</label>
    <select name="purpose" id="purpose" required>
        <option value="housing" name="purpose1">Housing Loan</option>
        <option value="car" name="purpose2">Car Loan</option>
        <option value="personal" name="purpose3">Personal Loan</option>
    </select>
    <br><br>
    <label class="labels">Tenure : 
        <input type="radio" name="tenure" value="6" required>6 months
        <input type="radio" name="tenure" value="12">12 months
        <input type="radio" name="tenure" value="24">24 months
        <input type="radio" name="tenure" value="32">32 months
    </label><br>
    <label class="labels"> Customer's Email</label><br>
    <input class="select" type="email" placeholder="Enter Customer's Email" name="cus_email" id="cus_email" required></input>
    <br>
     <!-- File Upload Field -->
     <label for="fileToUpload">Upload File:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>

    <div class="btn">
        <button type="submit" name="done" class="btn_submit">Submit</button>
    </div>
    
</form>

</div>

<!-- function to input only numbers -->
<script>
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", 
    "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } 
            else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } 
            else {
                this.value = "";
            }
        });
    });
}

//accept only numbers in input field 'Age'
setInputFilter(document.getElementById("age"), function(value) {
    return /^-?\d*$/.test(value); });

//accept only numbers in input field 'Monthly income'
setInputFilter(document.getElementById("income"), function(value) {
    return /^-?\d*$/.test(value); });

//accept only numbers in input field 'Loan amount'
setInputFilter(document.getElementById("loan_amt"), function(value) {
    return /^-?\d*$/.test(value); });

</script>

<!-- Rest of your HTML code as is -->

</body>
  
