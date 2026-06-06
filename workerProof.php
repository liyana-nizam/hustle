<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Proof Page</title>
    <link rel="stylesheet" href="wproof.css">
</head>

<body>
    <?php include('header-worker.php') ?>

    <div class="proof-container"><!-- Container besar untuk page tu -->

        <div class="back-btn">
            <a href="progress-worker.php">
                <img src="images/back.png" alt="Back" class="icon">
                Completed
            </a>
        </div>



        <div class="item-container">
            <div class="gig-left">
                <div class="gig-img"><img src="images/job.png"></div>
                <div class="gig-info">
                    <p class="gig-name">Need Help with Laundry</p>
                    <p class="gig-salary">RM 20</p>
                </div>
            </div>

            <div class="gig-right">
                <button class="gig-filter">Cleaning</button>
                <button class="gig-filter">Melaka Tengah</button>
            </div>
        </div>

        <h2>Proof: Upload Files</h2>
        <div class="file-upload-container">
            <button class="choose-btn">Choose Files</button>
            <label>Only .jpg and .png files. 500kb max file size</label>
        </div>


        <button class="upload-btn">Upload</button>

        <h2>Proof: Uploaded Files</h2>
        <ul id="fileList">
            <li> Job Title.jpg <button class="delete-btn">Delete</button></li>
        </ul>
    </div>

    <footer>
        <?php include('footer-worker.php') ?>
    </footer>
</body>

</html>