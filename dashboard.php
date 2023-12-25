<?php

include "./init/header.php";

?>

<header>

        <div class="banner h-100">
        <span style="font-size:20px;text-align:left;color:rgb(0, 255, 157);">Welcome back, <?php echo $_SESSION['user_fname']; ?></span><br>
       Create a poll with simple steps
       
    </div>
    </header>

<div class="container">

    <main>

        <br>
        <h1 class="title"> Public Polls:</h1>
        <div class="card-container">
            <div class="poll-container">

                <?php
                $sqlgetpoll = $db->query("SELECT * FROM `polls`  LIMIT 6");
                $totalvotes = 0;
                while ($getInfo = $sqlgetpoll->fetch()) {
                    $question = $getInfo['question'];
                    $qid = $getInfo['qid'];
                    $status = $getInfo['status'];
                    $currentDate = new DateTime();
                    $expiryDateTime = new DateTime($getInfo['edate']);
                    if ($getInfo['edate'] != '0000-00-00') {
                        if ($status == 0 || $currentDate >= $expiryDateTime) {
                            $error = "the poll is expired or deactivated";
                        }
                    } else {
                        if ($status == 0) {
                            $error = "the poll is expired or deactivated";
                        }
                    }
                ?>

                    <div class="card">
                        <div class="card-content">
                            <h2>
                                <?php echo htmlspecialchars($question); ?>
                            </h2>
                            <a href="./vote.php?id=<?php echo $qid; ?>"><button class="btn">More Details</button></a>
                            <a href="results.php?id=<?php echo $qid; ?>"><button class="btn">View Results</button></a>
                            <?php
                            if (isset($error)) {
                                echo '<br>   <span  style="color:#EC8E23;font-size:12px">';
                                echo $error;
                                echo '</span>';
                            }
                            ?>
                           
                        </div>
                    </div>

                <?php $error = null; } ?>

            </div>
            
        </div>
        <a class="link" style="color:#058081;text-align:center;display:inline-block;margin-left: 50%;
transform: translateX(-50%);margin-bottom:7px" href="./viewallpolls.php">View more..</a>
    </main>

</div>

<?php

include "./init/footer.php";
?>
