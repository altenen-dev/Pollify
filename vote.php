<?php
include './init/header2.php';
$flag = false;
if (!isset($_GET['id'])) {

    exit('you didn\'t entered the poll id right');
    // exit('Poll with that ID does not exist.');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!($user->LoggedIn())) {


        // If they are not logged in, redirect them to the login page.
        header("Location: login.php");

        die("Redirecting to login.php");



    }
    try {
        $db->beginTransaction();
        $sqlgetpoll = $db->query("SELECT * FROM `polls` WHERE  qid={$_GET['id']}");
        while ($getInfo = $sqlgetpoll->fetch()) {

            $qid = $getInfo['qid'];
            $status = $getInfo['status'];
            $currentDate = new DateTime();
            $expiryDateTime = new DateTime($getInfo['edate']);
            if (($expiryDateTime != '0000-00-00')) {
                if ($status == 0 || $currentDate >= $expiryDateTime) {
                    $flag =true;
                    $error = "the poll is expired or deactivated";
                }
            } else {
                if ($status == 0) {
                    $flag =true;
                    $error = "the poll is expired or deactivated";
                
                }
            }
        }

        $uid = $_SESSION['user_id'];
        $checkifv = $db->query("SELECT * FROM responses WHERE qid= '{$_GET['id']}' and uid='$uid'");
        $voted = false;
        if ($checkifv->rowCount() != 0) {
            $voted = true;
        }
        if ($voted) {
            $error = 'you have voted already';

        }
        if (empty($error) && !$flag) {


            $insertresponse = "INSERT INTO responses  VALUES (null,$uid,:questionId, :chid)";
            $stmt = $db->prepare($insertresponse);
            $stmt->bindValue(':questionId', $qid);
            $stmt->bindValue(':chid', $_POST['poll_answer']);

            $stmt->execute();


            // Update and increase the vote for the answer the user voted for
            $stmt = $db->prepare('UPDATE choices SET votes = votes + 1 WHERE chid = ?');
            $stmt->execute([$_POST['poll_answer']]);

            $db->commit();
            $created = "voted successfully!";
            // Redirect user to the result page
            //  header('Location: result.php?id=' . $_GET['id']);
        }
    } catch (PDOException $e) {
        $db->rollBack();
        $error = "Error creating vote";

    }


}






?>



<style>
    .poll-vote form {
        display: flex;
        flex-flow: column;
    }

    .poll-vote form label {
        padding-bottom: 10px;
    }

    .poll-vote form input[type="radio"] {
        transform: scale(1.1);
    }

    .poll-vote form input[type="submit"],
    .poll-vote form a {
        display: inline-block;
        padding: 8px;
        border-radius: 5px;
        background-color: #38b673;
        border: 0;
        font-weight: bold;
        font-size: 14px;
        color: #FFFFFF;
        cursor: pointer;
        width: 150px;
        margin-top: 15px;
    }

    .poll-vote form input[type="submit"]:hover,
    .poll-vote form a:hover {
        background-color: #32a367;
    }

    .poll-vote form a {
        text-align: center;
        text-decoration: none;
        background-color: #37afb7;
        margin-left: 5px;
    }

    .poll-vote form a:hover {
        background-color: #319ca3;
    }

    .total-votes {
        color: white;
        padding: 5px 10px;
        background-color: #058081;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<?php

$sqlgetpoll = $db->query("SELECT * FROM `polls` WHERE  qid={$_GET['id']}");
$totalvotes = 0;
while ($getInfo = $sqlgetpoll->fetch()) {
    $question = $getInfo['question'];
    $qid = $getInfo['qid'];
    $status = $getInfo['status'];
    $currentDate = new DateTime();
    $expiryDateTime = new DateTime($getInfo['edate']);
    if (!$expiryDateTime == '0000-00-00') {
        if ($status == 0 || $currentDate >= $expiryDateTime) {
            die("the poll is expired or deactivated");
        }
    } else {
        if ($status == 0) {
            $flag =true;
            $error = "the poll is expired or deactivated";
          
        }
    }


    $sqlgetresult = $db->prepare("SELECT * FROM `choices` WHERE qid= ?");
    $sqlgetresult->bindValue(1, $qid);
    $sqlgetresult->execute();
    ?>
    <form action="vote.php?id=<?= $_GET['id'] ?>" method="post">
        <div class="container poll-vote">
            <?php
            if (isset($error)) {
                echo '   <span id="error-m" class="error">';

                echo $error;

                echo '</span>';

            }

            if (isset($created)) {
                echo '<span class="success">';
                echo $created;
                echo '</span>';
            }
            ?>
            <h2>
                <?php echo htmlspecialchars($question); ?>
            </h2>

            <div class="poll-options">
                <?php
                while ($result = $sqlgetresult->fetch(PDO::FETCH_ASSOC)) {

                    $choice = $result['choice'];
                    $chid = $result['chid'];

                    ?>
                    <label>
                        <input type="radio" name="poll_answer" value="<?= htmlspecialchars($chid) ?>">
                        <?= htmlspecialchars($choice) ?>
                    </label><br>

                    <?php
                    // $percentage = (($result['votes']) / $totalvotes) * 100 ;
                }
                echo ' </div>';

                ?>
                <div class="btn-container">
                    <button style="" type="submit" value="Vote" name="vote">Vote</button>
                    <button style="" onclick="loadResults(<?php echo $qid; ?>)">Results</button>

                </div>


                <div id="results">

                </div>




    </form>
    <?php
            $sqlTotalVotes = $db->prepare("SELECT COUNT(*) as total_votes FROM `responses` WHERE qid = ?");
            $sqlTotalVotes->execute([$qid]);
            $totalVotesResult = $sqlTotalVotes->fetch(PDO::FETCH_ASSOC);
            $totalVotes = $totalVotesResult['total_votes'];
    ?>

    <div class="total-votes">
        Total Votes:
        <?php echo $totalVotes; ?>
    </div>
    </div>
<?php } ?>




</div>


<?php
include './init/footer.php';

?>