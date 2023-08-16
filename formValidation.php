<!DOCTYPE html>
<html>
<head>
    <title>Form Validation in PHP</title>
</head>
<body>

<?php
// Define variables and set to empty values
$name = $email = $message = "";
$nameErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate message
    $message = test_input($_POST["message"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form Validation Example </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p style="color: red"> * required field <p>
    Name: <input type="text" name="name">
    <span class="error"> <?php echo $nameErr;?></span>
    <br><br>
    Email: <input type="text" name="email">
    <span class="error"> <?php echo $emailErr;?></span>
    <br><br>
    website: <input type="text" name="email">
    <span class="error"> <?php echo $emailErr;?></span>
    <br><br>

    Comments: <textarea name="message" rows="5" cols="40"></textarea>
    <br><br>
    Gender:
<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="other">Other 

<br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr)) {
    echo "<h2>Your Input:</h2>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Message: " . $message . "<br>";
}
?>

</body>
</html>
