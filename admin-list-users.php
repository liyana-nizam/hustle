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
                    <input type="search" id="searchUser" placeholder="Search by username...">
                </div>
                <div class="filter-section">
                    <label for="filterRole" class="accessibility">Role</label>
                    <select id="filterRole" name="filterRole">
                        <option value="" disabled selected>Role</option>
                        <option value="Gig Worker">Gig Worker</option>
                        <option value="Gig Owner">Gig Owner</option>
                    </select>
                </div>
                <button type="submit">Search</button>
            </form>
        </div>
        <!-- List of User -->
        <div class="list-container">
            <ul class="user-list">
                <li class="item-container">
                    <a href="">
                    <div class="user-left">
                        <div class="user-img"><img src="" alt="Icon User"></div>
                        <div class="user-info">
                            <p class="user-name">Liyana </p>                           
                        </div>
                    </div>
                    <div class="user-right">
                        <p class="user-filter">Gig Owner</p>
                    </div>
                    </a>
                </li>

                <!-- List Bawah Akan Dibuang Kemudian -->
                <li class="item-container">
                    <a href="">
                    <div class="user-left">
                        <div class="user-img"><img src="" alt="Icon User"></div>
                        <div class="user-info">
                            <p class="user-name">Miza</p>                           
                        </div>
                    </div>
                    <div class="user-right">
                        <p class="user-filter">Gig Worker</p>
                    </div>
                    </a>
                </li>
                <li class="item-container">
                    <a href="">
                    <div class="user-left">
                        <div class="user-img"><img src="" alt="Icon User"></div>
                        <div class="user-info">
                            <p class="user-name">Zafreen</p>                           
                        </div>
                    </div>
                    <div class="user-right">
                        <p class="user-filter">Gig Worker</p>
                    </div>
                    </a>
                </li>
                <li class="item-container">
                    <a href="">
                    <div class="user-left">
                        <div class="user-img"><img src="" alt="Icon User"></div>
                        <div class="user-info">
                            <p class="user-name">Syu</p>                           
                        </div>
                    </div>
                    <div class="user-right">
                        <p class="user-filter">Gig Worker</p>
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