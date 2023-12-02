<?php
include "./init/header.php"

?>


    <header>
        <h1>Welcome to Pollmaker!</h1>
    </header>

    <main>
        <section class="polls">
        <?php

$query = "SELECT qid, question, status, edate FROM polls WHERE status = 1";
$result = $db ->query($query);

if($result->rowCount() > 0){
    while($row= $result->fetch()){
        echo "
        <div class='poll-card'>
            <h2 class='poll-title'>".$row['question']."</h2>
            ";
            if (!($row['edate'] == "")){

          echo"  <p class='poll-date'>Expiry Date: ".$row['edate']."</p>";
        }
         echo "  <a href='vote.php?qid=".$row['qid']."' class='poll-vote'>Vote Now</a>
        </div>
        ";
    }
} else {
    echo "No active polls available.";
}
?>
        </section>
    </main>

    <?php 
    include './init/footer.php'
    
    ?>