<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payment - Hustle</title>
    <link rel="stylesheet" href="ViewPayment.css?v=2" type="text/css">
</head>

<body>
    <?php 
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    include('head.php'); 
    include('connect.php');
    
    $gig_id = $_GET['id'] ??  $_POST['gig_id'] ?? '';

    if (isset($_POST['submit_all']))
    {
        $star = $_POST['star'] ?? '';
        $feedback = $_POST['feedbackMessage'] ?? '';

        if (!empty($_FILES['paymentProof']['name']))
        {
            $file = $_FILES['paymentProof'];
            $filename = basename($file['name']);
            $upload_path = 'images/' . $filename;

            if (move_uploaded_file($file['tmp_name'], $upload_path))
            {
                $conn->query("UPDATE gig_application 
                SET star = '$star', feedback_message = '$feedback', payment_proof = '$filename' 
                WHERE GIG_ID = '$gig_id'");
                echo "<script>alert('Upload Successful!');</script>";
            }
        }
    }

    $sql = "SELECT gd.*, g.gig_name, c.category_name
    FROM gig_detail gd
    INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
    LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
    WHERE gd.GIG_ID = '$gig_id'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $address_parts = explode(',', $row['location']);
    $short_location = trim(end($address_parts));
    ?>

    <div class="payment-container">
        <div class="back-btn">
        <a href="progress.php">
            <img src="images/back.png" alt="Back" class="icon">
            View Payment
        </a>
        </div>

        <div class="item-container">
                <div class="gig-left">
                    <div class="gig-img">
                        <img src="<?php echo getCategoryImage($row['category_name'] ?? ''); ?>"
                        alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
                    </div>

                    <div class="gig-info">
                        <p class="gig-name"><?php echo htmlspecialchars($row['gig_name']); ?></p>
                        <p class="gig-salary">RM <?php echo htmlspecialchars($row['salary']); ?></p>
                    </div>
                </div>

                <div class="gig-right">
                    <button class="gig-filter"><?php echo htmlspecialchars($row['category_name'] ?? ''); ?></button>
                    <button class="gig-filter"><?php echo htmlspecialchars($short_location); ?></button>
                </div>
        </div>

        <h2>Gig Completion Proof</h2>
            <ul id="fileList">
               <?php  
                    $sql_proof = "SELECT proof FROM gig_application WHERE GIG_ID = '$gig_id'";
                    $result_proof = $conn->query($sql_proof);
                    $row_proof = $result_proof->fetch_assoc();

                    if (!empty($row_proof['proof']))
                    {
                        $files = explode(',', $row_proof['proof']);
                        foreach ($files as $f)
                        {
                            echo '<li>' . htmlspecialchars($f) . '
                            <a href="images/' . htmlspecialchars($f) . '" target="_blank">
                            <button class="view-btn">View</button></a></li>';

                        }
                    }
                    else
                    {
                         echo '<li>No proof uploaded yet.</li>';
                    }
               ?>
            </ul>

            <hr class="divider">

        <?php
            $sql_fb = "SELECT ga.star, ga.feedback_message, ga.payment_proof, u.name AS worker_name, u.bank_account, u.username
                       FROM gig_application ga
                       LEFT JOIN user u ON ga.USER_ID = u.USER_ID
                       WHERE ga.GIG_ID = '$gig_id'";
            $result_fb = $conn->query($sql_fb);
            $row_fb = $result_fb->fetch_assoc();
            $payment_files = $row_fb['payment_proof'] ?? '';
            $role = $_SESSION['role'] ?? '';
        ?>

        <?php if ($role == 'gig owner' && empty($payment_files)) { ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gig_id" value="<?php echo $gig_id; ?>">
            <div class="rating-container">
                <h3>Your Rating</h3>
                <div class="formSection">
                    <input type="number" name="star" id="rateInput" required placeholder="1 - 5" min="1" max="5">
                </div>
            </div>

            <div class="rating-container">
                <h3>Give a Feedback Message</h3>
                <div class="formSection">
                    <textarea name="feedbackMessage" id="feedbackMessage" rows="4" placeholder="Type your message here..."></textarea>
                </div>
            </div>

            <h2>Upload Payment Proof</h2>

            <p><?php echo htmlspecialchars($row_fb['username']); ?>'s Bank Account Details: 
            <?php echo htmlspecialchars($row_fb['bank_account'] ?? 'Not Provided'); ?> (<?php echo htmlspecialchars($row_fb['worker_name']); ?>)</p>

            <div class="file-upload-container">
                <input type="file" name="paymentProof" accept="image/*,.pdf">
                <button class="view-btn" type="button" id="viewBtn">View</button>
            </div>
            <button type="submit" name="submit_all" class="upload-btn">Upload</button>
        </form>

        <?php } else { ?>

        <div class="rating-container">
            <h3>Rating</h3>
            <div class="formSection">
                <p><?php echo htmlspecialchars($row_fb['star'] ?? '-'); ?> / 5</p>
            </div>
        </div>

        <div class="rating-container">
            <h3>Feedback Message</h3>
            <div class="formSection">
                <p><?php echo htmlspecialchars($row_fb['feedback_message'] ?? '-'); ?></p>
            </div>
        </div>

        <h2>Payment Proof</h2>
        <ul id="paymentList">
            <?php
                if (!empty($payment_files))
                {
                    $files = explode(',', $payment_files);
                    foreach ($files as $f)
                    {
                        echo '<li>' . htmlspecialchars($f) . '
                        <a href="images/' . htmlspecialchars($f) . '" target="_blank">
                        <button class="view-btn">View</button></a></li>';
                    }
                }
                else
                {
                    echo '<li>No payment proof uploaded yet.</li>';
                }
            ?>
        </ul>

        <?php } ?>
    </div>
</div>

    <script>
        var paymentInput = document.querySelector('[name="paymentProof"]');
        if (paymentInput)
        {
            paymentInput.addEventListener('change', function()
            {
                var file = this.files[0];
                if (file)
                {
                    var url = URL.createObjectURL(file);
                    document.getElementById('viewBtn').onclick = function() 
                    {
                        window.open(url, '_blank');
                    };
                }
            });
        }
        </script>

    <?php include('footer.php'); ?>

</body>
</html>