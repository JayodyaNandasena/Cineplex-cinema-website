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

    <form action="dbSignin.php" method="POST" id="signInForm" style="display: none;">
        <label for="">Username : </label>
        <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required>
        <br>
        <label for="">Password : </label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
        <br>
        <button type="submit">Sign in</button>
        <br>
        <label for="">Don't Have an account?</label>
        <input type="button" value="Sign up" id="btnSignup" onclick="displaySignUp()">
    </form>

    <form action="" method="post" id="selectAccountTypeForm">
        <h2>Select the account type</h2>
        <label for="rdoAdmin">
            <input type="radio" id="rdoAdmin" name="rdoGroup" value="rdoAdmin"> Admin
        
        </label><br>
        <label for="rdoCustomer">
            <input type="radio" id="rdoCustomer" name="rdoGroup" value="rdoCustomer"> Customer
        </label><br>
        <!-- <input type="submit" id="submitButton"> -->
    </form>

    <form action="dbSignUp.php" method="post" id="adminForm" style="display:none;">
        <input type="hidden" name="formType" value="admin">    
        <label for="txtEmpID">Employee ID : </label>
        <input type="text" name="txtEmpID" id="txtEmpID" placeholder="Employee ID" required>
        <br>
        <label for="">First name : </label>
        <input type="text" name="txtFirstname" id="txtFirstname" placeholder="First Name" required>
        <br>
        <label for="">Last name : </label>
        <input type="text" name="txtLastname" id="txtLastname" placeholder="Last Name" required>
        <br>
        <label for="">Email : </label>
        <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" required>
        <br>
        <label for="">Username : </label>
        <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required>
        <br>
        <label for="">Password : </label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
        <br>
        <button type="submit" id="btnSignup1">Sign up</button>
        <br>
        <label for="">Already Have an account?</label>
        <input type="button" value="Sign in" id="btnSignin2" onclick="displaySignIn()">
    
    </form>

    <form action="dbSignUp.php" method="post" id="customerForm" style="display:none;">
        <input type="hidden" name="formType" value="customer">    
        <label for="">First name : </label>
        <input type="text" name="txtcFirstname" id="txtcFirstname" placeholder="First Name" required>
        <br>
        <label for="">Last name : </label>
        <input type="text" name="txtcLastname" id="txtcLastname" placeholder="Last Name" required>
        <br>
        <label for="">Email : </label>
        <input type="email" name="txtcEmail" id="txtcEmail" placeholder="Email" required>
        <br>
        <label for="">Address : </label>
        <input type="text" name="txtcAddress" id="txtcAddress" placeholder="Home Address" required>
        <br>
        <label for="">Telephone Number : </label>
        <input type="tel" name="txtcTel1" id="txtcTel1" placeholder="Mobile Number" required>
        <input type="tel" name="txtcTel2" id="txtcTel2" placeholder="Mobile Number">
        <br>
        <label for="">Username : </label>
        <input type="text" name="txtcUsername" id="txtcUsername" placeholder="Username" required>
        <br>
        <label for="">Password : </label>
        <input type="password" name="txtcPassword" id="txtcPassword" placeholder="Password" required>
        <br>
        <button type="submit" id="btnSignup2">Sign up</button>
        <br>
        <label for="">Already Have an account?</label>
        <input type="button" value="Sign in" id="btnSignin2" onclick="displaySignIn()">
    </form>

    

    <script>
        document.getElementById('rdoAdmin').addEventListener('change', function() {
        document.getElementById('adminForm').style.display = 'block';
        document.getElementById('customerForm').style.display = 'none';
        });

        document.getElementById('rdoCustomer').addEventListener('change', function() {
            document.getElementById('adminForm').style.display = 'none';
            document.getElementById('customerForm').style.display = 'block';
        });

        function displaySignUp() {
            document.getElementById("signInForm").style.display = "none";
            document.getElementById("selectAccountTypeForm").style.display = "block";

        }

        function displaySignIn() {
            document.getElementById("signInForm").style.display = "block";
            document.getElementById('selectAccountTypeForm').style.display = 'none';
            document.getElementById('adminForm').style.display = 'none';
            document.getElementById('customerForm').style.display = 'none';

        }
    </script>
</body>

</html>