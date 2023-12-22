<?php 

include "./init/header.php";

?>



<div class="container">

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
                                
                         
                                // $sqlgetresult = $db -> prepare("SELECT * FROM `choices` WHERE qid= ?");
                                // $sqlgetresult -> bindValue(1, $qid);
                                // $sqlgetresult -> execute();
            ?>

                                    <div class="card">
                                    <div class="card-content">
                                        <h2>  <?php echo htmlspecialchars($question); ?> </h2>
                                        <a href="./vote.php?id=<?php echo $qid; ?>" ><button  class="btn">More details</button></a>
                                        <button href="" class="">view results</button>
                                        <div id="results">

                                        </div>


                                    </div>

                                      </div>


        
            <?php } ?>
          



        </div>
  


    </div>

        
    </main>

</div>

<?php 

include "./init/footer.php";
?>