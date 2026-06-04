<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Owner Profile - Hustle</title>
    <link rel="stylesheet" href="personal-style.css?v=2" type="text/css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');
    </style>
</head>

<body id="backgroundColor">


    <div id="formGroup">

        <div class="imgIcon">
            <img src="images/iconuser.png" alt="User Icon">
        </div>

        <h1>Personal Information</h1>

        <form onsubmit="event.preventDefault(); showData();">

            <div class="formSection">
                <label>Full name</label>
                <input type="text" id="nameInput" required placeholder="e.g. Amelia Henderson">
            </div>

            <div class="formSection">
                <label>Birthday</label>
                <input type="date" id="birthdayInput" required>
            </div>

            <div class="formGender">
                <label>Gender</label>
                <div class="radioGroup">
                    <input type="radio" name="gender" id="male" value="male"> <span class="radio-text">Male</span>
                    <input type="radio" name="gender" id="female" value="female"> <span class="radio-text">Female</span>
                </div>
            </div>

            <div class="formSection">
                <label>Full address</label>
                <input type="text" id="addressInput" required>
            </div>

            <div class="formSection">
                <label>Phone number</label>
                <input type="text" id="phoneInput" required placeholder="e.g. +0123456789">
            </div>

            <button type="submit" class="save-changes-btn">Save Changes</button>

        </form>

    </div>

    <div id="main" class="hidden">
        <p id="fullName"></p>
        <p id="birthday"></p>
        <p id="gender"></p>
        <p id="fullAddress"></p>
        <p id="phone"></p>
    </div>


    <script>
        function showData() {
            let fullName = document.getElementById("nameInput").value;
            let birthday = document.getElementById("birthdayInput").value;
            let gender = document.querySelector('input[name="gender"]:checked');
            let fullAddress = document.getElementById("addressInput").value;
            let phone = document.getElementById("phoneInput").value;

            document.getElementById("main").classList.remove("hidden");

            // Contoh alert ringkas tanda berjaya simpan
            alert("Changes saved successfully!");
        }
    </script>

</body>

</html>