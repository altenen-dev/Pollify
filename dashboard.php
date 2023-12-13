<?php 

include "./init/header.php";

?>



<div class="container">

            <h1>Poll Maker</h1>
        <div class="poll-container">
            <?php 
            
            $sqlgetpoll = $db -> query("SELECT * FROM `polls` WHERE status='true' LIMIT 3");
          
								while ($getInfo = $sqlgetpoll -> fetch(PDO::FETCH_ASSOC)){
                                    $question = $getInfo['question'];
                                    $qid =$getInfo['qid'];
                                

                                $sqlgetresult = $db -> prepare("SELECT * FROM `choices` WHERE qid= ?");
                                $sqlgetresult -> bind_param(1, $id);
                                $sqlgetresult -> execute();
            ?>
            <div class="poll">
                <h2>  <?php echo htmlspecialchars($row['poll_title']); ?> </h2>
                <p>Poll Description</p>
                <div class="poll-options">
                    <?php 
                     while($sqlgetresult -> FETCH_ASSOC()) {
                        $choice = $sqlgetresult['choice'];
                        $chid = $sqlgetresult['chid'];
                    echo '<input type="radio" name="options" value="'. $chid.'" class="space">'. htmlspecialchars($choice) . '<br>';
                }

                    ?>
                            <input type="submit" value="Vote" name="vote" class="vote">
                            <button onclick="loadResults(<?php echo $qid; ?>)">Results</button>
                </div>
                <div id="results">

                </div>
            </div>

            <?php } ?>
            <!-- Add more poll elements as needed -->
        </div>

</div>

<?php 

include "./init/footer.php";
?>