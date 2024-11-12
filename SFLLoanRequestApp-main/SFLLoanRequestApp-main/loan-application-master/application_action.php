<?php
session_start();
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Action</title>
    <link href="login_act.css" rel="stylesheet">
</head>
<body>
<!DOCTYPE html>
<html>
<head>
    <title>Application Action</title>
    <link href="login_act.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <?php if (isset($_SESSION['fname'])) : ?>
        <h3>Hello, <?php echo $_SESSION['fname']; ?>!</h3>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['app_msg'])) : ?>
        <p><?php echo $_SESSION['app_msg']; ?></p>
    <?php endif; ?>
    
If you want to add a file upload input to an already existing HTML form, you can simply include the file input field within your existing form. Here's an example of how you can modify your existing form to include a file upload input:

html
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>Existing Form with File Upload</title>
</head>
<body>
    <h2>Existing Form</h2>
    <form action="process_form.php" method="POST">
        <!-- Your existing form fields here -->
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>

        <!-- File Upload Field -->
        <label for="fileToUpload">Upload File:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>

        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
In the code above, we added a new file upload input field within the existing form. The file input field has the name attribute set to "fileToUpload," which will be used to identify the uploaded file in your server-side PHP script (process_form.php in this example).

When the user submits the form, you can process both the existing form fields and the uploaded file in your PHP script (process_form.php). You'll need to modify your PHP script to handle the new file upload input in addition to the existing form data.

Here's an example of how you can process the file upload in your PHP script (process_form.php):

php
Copy code
<?php
if (isset($_POST["submit"])) {
    // Process existing form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Process file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

    // Check if the file was uploaded successfully
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully.";
        // Additional processing for the uploaded file if needed
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Additional processing for other form fields and database insertion
    // ...
}
?>
</div>

<button onclick="window.location.href='<?php echo $_SESSION['app_location']; ?>'">Back</button>

</body>
</html>

<div class="container">
    <?php if (isset($_SESSION['fname'])) : ?>
        <h3>Hello, <?php echo $_SESSION['fname']; ?>!</h3>
    <?php endif; ?>
    <p><?php echo $_SESSION['app_msg']; ?></p>
</div>

<button onclick="window.location.href='<?php echo $_SESSION['app_location']; ?>'">Back</button>

</body>
</html>
