<?php $maxDate = date('Y-m-d', strtotime('-16 years')); ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="signup-style.css">

    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');</style>

</head>

<body id="backgroundColor">

    <header>
    <div class="imgLogo"><img src="images/logo.svg" alt="Hustle Logo"></div>
    </header>

    <div id="formGroup">

        <div class="imgIcon">
            <img src="images/iconuser.png" alt="User Icon">  
        </div>

        <h1>Sign up Hustle</h1>

        <form action="signupUser.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

            <div class="formSection">
                <label>Create username</label>
                <input type="text" id="usernameInput" name="usernameInput" required placeholder="e.g. amelia123">
            </div>

            <div class="formSection">
                <label>Password</label>
                <input type="password" id="passwordInput" name="passwordInput" required oninput="clearPasswordError()">
            </div>

            <div class="formSection">
                <label>Confirm Password</label>
                <input type="password" id="confirmPasswordInput" required oninput="clearPasswordError()">
                <p id="passwordError" class="error"></p>
            </div>

            <div class="formRole">
                <label for="userType">Role</label>
                <div class="roleOptions">
                    <input type="radio" name="role" id="roleWorker" value="gig worker" onclick="toggleBankRequired()" required>Gig Worker
                    <input type="radio" name="role" id="roleOwner" value="gig owner" onclick="toggleBankRequired()" required>Gig Owner
                </div>
            </div>

            <div class="formSection">
                <label>Full name</label>
                <input type="text" id="nameInput" name="nameInput" required placeholder="e.g. Amelia Henderson">
            </div>

            <div class="formSection">
                <label>Birthday</label>
                <input type="date" id="birthdayInput" name="birthdayInput" required max="<?php echo $maxDate; ?>">
            </div>

            <div class="formRole">
              <label>Gender</label>
              <div class="roleOptions">
                <input type="radio" name="gender" id="male" value="male" required>Male
                <input type="radio" name="gender" id="female" value="female" required>Female
              </div>
            </div>

            <div class="formSection">
                <label>Full address</label>
                <input type="text" id="addressInput" name="addressInput" required>
            </div>

            <div class="formSection">
                <label>Phone number</label>
                <input type="tel" id="phoneInput" name="phoneInput" required placeholder="e.g. 0123456789">
            </div>

            <div class="formSection" id="bankAccountSection" style="display:none;">
                <label>Bank Account</label>
                <input type="text" id="bankAccount" name="accInput" placeholder="e.g. Maybank - 162991174909">
            </div>

            <div class="formSection">
                <label>Profile Picture</label>
                <input type="file" id="profileInput" name="profileInput" accept="image/*">
            </div>

            <button type="submit">Sign In</button>

        </form>

        <h2>Already have an account? <a href="login.php">Log In</a></h2>

    </div>
    
    <script>

        function toggleBankRequired()
        {
            const role = document.querySelector('input[name="role"]:checked');
            const bankSection = document.getElementById("bankAccountSection");
            const bankInput = document.getElementById("bankAccount");

            if (role && role.value === "gig worker")
            {
                bankSection.style.display = "block";
                bankInput.required = true;
            }
            else
            {
                bankSection.style.display = "none";
                bankInput.required = false;
                bankInput.value = ""
            }
        }

        
        function clearPasswordError() 
        {
            const password = document.getElementById("passwordInput").value;
            const confirmPassword = document.getElementById("confirmPasswordInput").value;

            if (password !== confirmPassword)
            {
                document.getElementById("passwordError").innerHTML = "Password does not match";
            }
            else
            {
                document.getElementById("passwordError").innerHTML = "";
            }
        }

        function validateForm()
        {
            const password = document.getElementById("passwordInput").value;
            const confirmPassword = document.getElementById("confirmPasswordInput").value;

            if (password !== confirmPassword)
            {
                document.getElementById("passwordError").innerHTML = "Password does not match";
                return false;
            }

            return true;
        }



    </script>
    
</body>
</html>


