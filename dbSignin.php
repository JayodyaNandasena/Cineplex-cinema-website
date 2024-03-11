<?php
include("dbConnection.php");
session_start();

if (isset($_POST['txtUsername']) && isset($_POST['txtPassword'])) {
    $inUsername = $_POST['txtUsername'];
    $inPassword = $_POST['txtPassword'];

    if (empty($inUsername)) {
        header("Location:SignIn.php");
        exit();
    } else if (empty($inPassword)) {
        header("Location:SignIn.php");
        exit();
    } else {
        if (strpos($inUsername, "4dm!N") === 0) {
            $sql="Select * from admindetails where username='$inUsername' and loginPassword='$inPassword'";

            $result=mysqli_query($conn,$sql);

            if (mysqli_num_rows($result)) {
                $row=mysqli_fetch_assoc($result);
                if ($row['username']==$inUsername && $row['loginPassword']==$inPassword) {
                    $_SESSION['username']=$row['username'];
                    $_SESSION['firstName']=$row['firstName'];
                    header("Location:index.php");
                    //header("Location:adminProfile.php");
                } else {
                    echo "Invalid";
                }
                
            } else {
                header("Location:index.php");
            }
        } else{
            
                $sql="Select * from customerdetails where username='$inUsername' and loginPassword='$inPassword'";
    
                $result=mysqli_query($conn,$sql);
    
                if (mysqli_num_rows($result)) {
                    $row=mysqli_fetch_assoc($result);
                    if ($row['username']==$inUsername && $row['loginPassword']==$inPassword) {
                        $_SESSION['username']=$row['username'];
                        $_SESSION['firstName']=$row['firstName'];
                        header("Location:index.php");
                    } else {
                        echo "Invalid";
                    }
                    
                } else {
                    header("Location:index.php");
                
                }
        
        

            }
        }
} else {
    echo "Empty";
    header("Location:SignIn.php");
    exit(); /*exit from this page*/
}

?>
