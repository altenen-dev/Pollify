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
                                    $status = $getInfo['status'];
                                    $currentDate = new DateTime();
                                    $expiryDateTime = new DateTime($getInfo['edate']);
                                    if (!$expiryDateTime == '0000-00-00') {
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
                                        <h2>  <?php echo htmlspecialchars($question); ?> </h2>
                                        <a href="./vote.php?id=<?php echo $qid; ?>" ><button  class="btn">More details</button></a>
                                        <button href="" class="">view results</button>
                                        <?php
                            if (isset($error)) {
                                echo '<br>   <span  style="color:#EC8E23;font-size:12px">';

                                echo $error;

                                echo '</span>';

                            }
                            ?>
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