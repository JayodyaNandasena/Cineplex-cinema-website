<?php
include("dbConnection.php");

$sql='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["formType"] == "admin") {
        if (isset($_POST['txtEmpID']) && isset($_POST['txtFirstname']) && isset($_POST['txtLastname']) && isset($_POST['txtEmail']) && isset($_POST['txtUsername']) && isset($_POST['txtPassword']) ){
            $extra=$_POST['txtEmpID'];
            $fName=$_POST['txtFirstname'];
            $lName=$_POST['txtLastname'];
            $email=$_POST['txtEmail'];
            $username=$_POST['txtUsername'];
            $password=$_POST['txtPassword'];

            $sql = "INSERT INTO admindetails (username, firstName, lastName, email, loginPassword, empID) VALUES (?, ?, ?, ?, ?, ?)";
            
        }
    } else if ($_POST["formType"] == "customer") {
        if (isset($_POST['txtcFirstname']) && isset($_POST['txtcLastname']) && isset($_POST['txtcEmail']) && isset($_POST['txtcUsername']) && isset($_POST['txtcPassword']) ){
            $fName=$_POST['txtcFirstname'];
            $lName=$_POST['txtcLastname'];
            $email=$_POST['txtcEmail'];
            $extra=$_POST['txtcAddress'];
            $tel1=$_POST['txtcTel1'];
            $tel2=$_POST['txtcTel2'];
            $username=$_POST['txtcUsername'];
            $password=$_POST['txtcPassword'];

            $sql = "INSERT INTO customerdetails (username, firstName, lastName, email, loginPassword, address) VALUES (?, ?, ?, ?, ?, ?)";
        }
    }
}



// Using a prepared statement to insert the data
$stmt = mysqli_prepare($conn, $sql);

if($stmt) {
    // Binding the parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $fName, $lName, $email, $password,$extra);

    // Executing the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "New record added successfully!";
    } else {
        echo "Error executing the statement: " . mysqli_stmt_error($stmt);
    }

    // Closing the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the statement: " . mysqli_error($conn);
}

?>