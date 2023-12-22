<?php 
include './init/header2.php';

if (isset($_GET['id'])){
    if (!($user ->LoggedIn())){
   
    
        // If they are not logged in, redirect them to the login page.
        header("Location: login.php");
    
        die("Redirecting to login.php");
    
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
.poll-vote form input[type="submit"], .poll-vote form a {
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
.poll-vote form input[type="submit"]:hover, .poll-vote form a:hover {
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
    </style>

<?php 
            
            $sqlgetpoll = $db -> query("SELECT * FROM `polls` WHERE  qid={$_GET['id']}");
            $totalvotes = 0;
								while ($getInfo = $sqlgetpoll -> fetch()){
                                    $question = $getInfo['question'];
                                    $qid =$getInfo['qid'];
                                $status = $getInfo['status']; 
                                $currentDate = new DateTime();
                                $expiryDateTime = new DateTime($getInfo['edate']);
                                if(! $expiryDateTime == '0000-00-00'){
                                    if ($status == 0 || $currentDate >= $expiryDateTime ){
                                        die("the poll is expired or deactivated");
                                    }
                                }else {
                                    if ($status == 0  ){
                                        die("the poll is expired or deactivated");
                                    }
                                }
                                
                         
                                $sqlgetresult = $db -> prepare("SELECT * FROM `choices` WHERE qid= ?");
                                $sqlgetresult -> bindValue(1, $qid);
                                $sqlgetresult -> execute();
            ?>
       <form action="vote.php?id=<?=$_GET['id']?>" method="post">
            <div class="container poll-vote">
                <h2>  <?php echo htmlspecialchars($question); ?> </h2>
               
                <div class="poll-options">
                    <?php 
                     while($result = $sqlgetresult->fetch(PDO::FETCH_ASSOC)) {
                    
                        $choice = $result['choice'];
                        $chid = $result['chid'];
                   
                    ?>
         <label>
            <input type="radio" name="poll_answer" value="<?=htmlspecialchars($chid)?>">
            <?= htmlspecialchars($choice) ?>
        </label><br>
                    <?php
                    // $percentage = (($result['votes']) / $totalvotes) * 100 ;
                }

                    ?>
                            <input type="submit" value="Vote" name="vote" class="vote">
                            <button onclick="loadResults(<?php echo $qid; ?>)">Results</button>

                            <div>
            <input type="submit" value="Vote" name="vote" class="vote">
            <a href="result.php?id=<?=$poll['id']?>">View Result</a>
        </div>
                </div>
                <div id="results">

                </div>
                </div>
                </div>
         
            </form>
            <?php } ?>





     
    </form>
</div>


<?php 
    include './init/footer.php';
    
    ?>