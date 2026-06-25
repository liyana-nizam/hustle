<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Proof Page</title>
    <link rel="stylesheet" href="wproof.css">
</head>

<body>

    <?php 
    if(session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    include("head.php"); 
    include('connect.php');
    
    

    $gig_id = $_GET['id'] ?? '';
    $sql = "SELECT gd.*, g.gig_name, c.category_name
            FROM gig_detail gd
            INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID
            LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
            WHERE gd.GIG_ID = '$gig_id'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (isset($_POST['upload']))
    {
        $file = $_FILES['profileInput'];
        $filename = basename($file['name']);
        $upload_path = 'images/' . $filename;

        $sql_old = "SELECT proof FROM gig_application WHERE GIG_ID = '$gig_id'";
        $result_old = $conn->query($sql_old);
        $row_old = $result_old->fetch_assoc();
        $old_proof = $row_old['proof'] ?? '';

        if (!empty($old_proof))
        {
            $new_proof = $old_proof . ',' . $filename;
        }
        else
        {
            $new_proof = $filename;
        }

        if (move_uploaded_file($file['tmp_name'], $upload_path))
        {
            $conn->query("UPDATE gig_application SET proof = '$new_proof' WHERE GIG_ID = '$gig_id'");
            echo "<script>alert('Upload successful!');</script>";
        }
    }

    $address_parts = explode(',', $row['location']);
    $short_location = trim(end($address_parts));

     if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
    ?>

    <div class="proof-container"><!-- Container besar untuk page tu -->

        <div class="back-btn">
            <a href="progress.php">
                <img src="images/back.png" alt="Back" class="icon">
                Completed
            </a>
        </div>

        <div class="item-container">

            <div class="gig-left">
                <div class="gig-img">
                    <?php $img = getCategoryImage($row['category_name'] ?? ''); ?>
                    <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
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

        <h2>Proof: Upload Files</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gig_id" value="<?php echo $gig_id; ?>">
            <div class="file-upload-container">
                <input type="file" id="profileInput" name="profileInput" accept="image/*">
            </div>

            <button type="submit" name="upload" class="upload-btn">Upload</button>
        </form>
        

        <h2>Proof: Uploaded Files</h2>
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
                        echo '<li>' . htmlspecialchars($f) . ' <a href="images/' . htmlspecialchars($f) . '" target="_blank">
                        <button class="view-btn">View</button></a></li>';
                    }
                }
            ?> 
        </ul>
        <?php } ?>
    </div>

    <script>
        document.getElementById('profileInput').addEventListener('change', function()
        {
            var file = this.files[0];
            if (file)
            {
                var li = document.createElement('li');
                li.innerHTML = file.name + '<button class="view-btn">View</button>';
                document.getElementById('fileList').appendChild(li);
            }
        });
    </script>

    <?php $conn->close(); 
    include("footer.php"); ?>
    
</body>
</html>