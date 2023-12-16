<?php
include "./init/header2.php"

?>
    <header>
        <div class="banner h-100">
       Create a poll with simple steps
       
    </div>
    </header>

    <main>
<br>
    <h1 class="title"> Public Polls:</h1>
    <div class="card-container">
    <div class="poll-container">
   

            <?php 
            
            $sqlgetpoll = $db -> query("SELECT * FROM `polls` WHERE status='1' LIMIT 6");
            $totalvotes = 0;
								while ($getInfo = $sqlgetpoll -> fetch()){
                                    $question = $getInfo['question'];
                                    $qid =$getInfo['qid'];
                                
                         
                                $sqlgetresult = $db -> prepare("SELECT * FROM `choices` WHERE qid= ?");
                                $sqlgetresult -> bindValue(1, $qid);
                                $sqlgetresult -> execute();
            ?>
            <form action="votepoll.php" method="post">
            <div class="card">
            <div class="card-content">
                <h2>  <?php echo htmlspecialchars($question); ?> </h2>
                <!-- <a href="" class="btn">More details</a>
              -->
                <p>Poll Description</p>
                <div class="poll-options">
                    <?php 
                     while($result = $sqlgetresult->fetch(PDO::FETCH_ASSOC)) {
                    
                        $choice = $result['choice'];
                        $chid = $result['chid'];
                    echo '<input type="radio" name="options" value="'. $chid.'" class="space">'. htmlspecialchars($choice) . '<br>';
                }

                    ?>
                            <input type="submit" value="Vote" name="vote" class="vote">
                            <button onclick="loadResults(<?php echo $qid; ?>)">Results</button>
                </div>
                <div id="results">

                </div>
                </div>
                </div>
            </div>
            </form>
            <?php } ?>
            <!-- Add more poll elements as needed -->
        </div>
  


    </div>

        
    </main>

    <?php 
    include './init/footer.php'
    
    ?>