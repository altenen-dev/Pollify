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
    <h1 class="title" style="margin-left:20%;margin-top:4px;"> Public Polls:</h1>
    <div class="card-container">
   
   

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
             <div class="poll-container">
            <!-- <form action="vote.php" method="post"> -->
            <div class="card">
            <div class="card-content">
                <h2>  <?php echo htmlspecialchars($question); ?> </h2>
                <a href="./vote.php?id=<?php echo $qid; ?>" ><button  class="btn">Vote</button></a>
                <button href="" class="">view results</button>
                <div id="results">

                </div>
                </div>
                </div>
                
            </div>
            <!-- </form> -->
            <?php } ?>
            <!-- Add more poll elements as needed -->
        </div>
  


    </div>

        
    </main>

    <?php 
    include './init/footer.php'
    
    ?>