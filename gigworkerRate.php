<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Proof Page</title>
    <link rel="stylesheet" href="gigworkerRate.css">
</head>

<body>
    <?php include('header-owner.php') ?>

    <h1>View Gig Completion</h1>

    <div class="item-container">
        <div class="gig-left">
            <div class="gig-img"><img src="images/job.png"></div>
            <div class="gig-info">
                <p class="gig-name">Gig Name</p>
                <p class="gig-salary">Salary</p>
            </div>
        </div>

        <div class="gig-right">
            <button class="gig-filter">Category</button>
            <button class="gig-filter">District</button>
        </div>
    </div>

    <h2>Gig Completion Proof</h2>
    <ul id="fileList">
        <li> Job Title.jpg <button class="view-btn">View</button></li>
    </ul>

    <hr class="divider">

    <div class="rating-container">
        <h3>Rate your Gig Worker</h3>
        <div class="formSection">
            <input type="number" id="rateInput" required placeholder="1 - 5" min="1" max="5">
        </div>
    </div>

    <div class="rating-container">
        <h3>Give a Feedback Message</h3>
        <div class="formSection">
            <textarea name="feedbackMessage" id="feedbackMessage" rows="4" placeholder="Type your message here..."></textarea>
        </div>
    </div>

    <h2>Proof: Upload Payment Receipt</h2>
    <div class="file-upload-container">
        <button class="choose-btn">Choose Files</button>  
    </div>
    
    <button class="submit-btn">Submit</button>

    <footer>
        <?php include('footer-owner.php') ?>
    </footer>
</body>
</html>
