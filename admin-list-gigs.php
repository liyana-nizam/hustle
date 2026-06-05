<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
    <link rel="stylesheet" href="list-style.css" type="text/css">
</head>
<body>
    <?php include('header-admin.php') ?>
    <div class="content-container">
        <!-- Search Bar & Filter -->
        <div class="search-filter-container">
            <form onsubmit="event.preventDefault();">
                <div class="search-section">
                    <label for="searchUser" class="accessibility">Username</label>
                    <input type="search" id="searchUser" placeholder="Search by gig name...">
                </div>
                <div class="filter-section">
                    <label for="filterCategory" class="accessibility">Category</label>
                    <select id="filterCategory" name="filterCategory">
                        <option value="" disabled selected>Category</option>
                        <option value="Cleaning">Cleaning</option>
                        <option value="rErrands">Running Errands</option>
                        <option value="hFixing">Home Fixing</option>
                        <option value="Gardening">Gardening</option>
                        <option value="Tutoring">Tutoring</option>
                        <option value="Caregiving">Caregiving</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="filter-section">
                    <label for="filterDistrict" class="accessibility">District</label>
                    <select id="filterDistrict" name="filterDistrict">
                        <option value="" disabled selected>District</option>
                        <option value="Alor Gajah">Alor Gajah</option>
                        <option value="Jasin">Jasin</option>
                        <option value="Melaka Tengah">Melaka Tengah</option>
                    </select>
                </div>                
                <button type="submit">Search</button>
            </form>
        </div>
        <!-- List of Gigs -->
        <div class="list-container">
            <ul class="gig-list">
                <li class="item-container">
                    <a href="">
                    <div class="gig-left">
                        <div class="gig-img"><img src="images/cleaning.png" alt="Gig Photo"></div>
                        <div class="gig-info">
                            <p class="gig-name">Need Help with Laundry</p>
                            <p class="gig-salary">RM 20</p>                            
                        </div>
                    </div>
                    <div class="gig-right">
                        <p class="gig-filter">Cleaning</p>
                        <p class="gig-filter">Melaka Tengah</p>
                    </div>
                    </a>
                </li>

                <!-- List Bawah Akan Dibuang Kemudian -->
                <li class="item-container">
                    <a href="">
                    <div class="gig-left">
                        <div class="gig-img"><img src="images/errands.png" alt="Gig Photo"></div>
                        <div class="gig-info">
                            <p class="gig-name">Need a Groceries Runner</p>
                            <p class="gig-salary">RM 40</p>                            
                        </div>
                    </div>
                    <div class="gig-right">
                        <p class="gig-filter">Running Errands</p>
                        <p class="gig-filter">Alor Gajah</p>
                    </div>
                    </a>
                </li>
                <li class="item-container">
                    <a href="">
                    <div class="gig-left">
                        <div class="gig-img"><img src="images/tutoring.png" alt="Gig Photo"></div>
                        <div class="gig-info">
                            <p class="gig-name">Looking for English Tutor</p>
                            <p class="gig-salary">RM 50</p>                            
                        </div>
                    </div>
                    <div class="gig-right">
                        <p class="gig-filter">Tutoring</p>
                        <p class="gig-filter">Jasin</p>
                    </div>
                    </a>
                </li>
                <li class="item-container">
                    <a href="">
                    <div class="gig-left">
                        <div class="gig-img"><img src="images/fixing.png" alt="Gig Photo"></div>
                        <div class="gig-info">
                            <p class="gig-name">Need a Handyman</p>
                            <p class="gig-salary">RM 30</p>                            
                        </div>
                    </div>
                    <div class="gig-right">
                        <p class="gig-filter">Homefixing</p>
                        <p class="gig-filter">Alor Gajah</p>
                    </div>
                    </a>
                </li>
                <!-- Sampai Sini -->

            </ul>                
        </div>
    </div>
    <?php include('footer-admin.php') ?>
</body>
</html>