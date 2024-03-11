<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>

<body>
    <nav>
        <img src="Assets/images/logo.png" alt="Cineplex" id="logo">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="showing.html">Movies</a></li>
            <li><a href="showing.html">Schedule</a></li>
            <li><a href="showing.html">Buy Tickets</a></li>
            <li><a href="showing.html">Contact</a></li>
            <li><a id="active" href="showing.html">Sign in</a></li>
        </ul>
    </nav>
    
    <form action="dbSignin.php" method="POST" id="signInForm">
        <label for="">Username : </label>
        <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required>
        <br>
        <label for="">Password : </label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
        <br>
        <button type="submit">Sign in</button>
        <!-- <input type="button" value="" id="btnSignin"> -->
        <br>
        <label for="">Don't Have an acoount?</label>
        <input type="button" value="Sign up" id="btnSignup" onclick="displaySignUp()">
    </form>
    
    <form action="dbSignUp.php" method="post" id="signUpForm" style="display: none;">
        <label for="">First name : </label>
        <input type="text" name="txtUsername" id="txtFirstname" placeholder="First Name" required>
        <br>
        <label for="">Last name : </label>
        <input type="text" name="txtUsername" id="txtLastname" placeholder="Last Name" required>
        <br>
        <label for="">Email : </label>
        <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" required>
        <br>
        <label for="">Address : </label>
        <input type="text" name="txtAddress" id="txtAddress" placeholder="Home Address" required>
        <br>
        <label for="">Telephone Number : </label>
        <input type="tel" name="txtTel1" id="txtTel1" placeholder="Mobile Number" required>
        <input type="tel" name="txtTel2" id="txtTel2" placeholder="Mobile Number">
        <br>
        <label for="">Username : </label>
        <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required>
        <br>
        <label for="">Password : </label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
        <br>
        <input type="button" value="Sign up" id="btnSignup2">
        <br>
        <label for="">Already Have an acoount?</label>
        <input type="button" value="Sign in" id="btnSignin2" onclick="displaySignIn()">
    </form>

    <script>
        function displaySignUp() {
            document.getElementById("signInForm").style.display = "none";
            document.getElementById("signUpForm").style.display = "block";
            
        }

        function displaySignIn() {
            document.getElementById("signInForm").style.display = "block";
            document.getElementById("signUpForm").style.display = "none";
            
        }
    </script>
</body>

</html>