<style>
    .container h2 {
      margin: 0;
      padding: 25px 0;
      font-size: 22px;
      border-bottom: 1px solid #ebebeb;
      color: #666666;
}

.deactivatepoll .choices {
      display: flex;
}
.deactivatepoll .choices a {
      display: inline-block;
      text-decoration: none;
      background-color: #38b673;
      font-weight: bold;
      color: #FFFFFF;
      padding: 10px 15px;
      margin: 15px 10px 15px 0;
      border-radius: 5px;
}
.deactivatepoll .choices a:hover {
      background-color: #32a367;
    }
    

    </style>

<?php
include "./init/header.php";



if (isset($_GET['id'])){

    $stmt = $db->prepare('SELECT * FROM polls WHERE qid = ?');
    $stmt->execute([ $_GET['id'] ]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        exit('Poll doesn\'t exist!!');
    }
    if($_SESSION['user_id'] == $poll['uid'] ){

  
 
    if (isset($_GET['choice'])) {
        if ($_GET['choice'] == 'yes') {
            $stmt = $db->prepare('UPDATE polls SET status = 0 WHERE qid = ?');
            $stmt->execute([ $_GET['id'] ]);
          
            $msg = 'You have deactivated the poll!';
        } else {
            header('Location: managepolls.php');
            exit;
        }
    }
}else {
    exit('Error You are no authorized to delete this poll!!');
}

}else{
    die("No poll id specified!!!");
}

?>


<div class="container deactivatepoll">
	<h2>Deactivate Poll :<?=$poll['question']?></h2>
    <?php if (isset($msg)): ?>
    <p><?=$msg?></p>
    <div class="success-icon">
    <div class="success-icon tip"></div>
    <div class="success-icon long"></div>
  </div>
    <?php else: ?>
	<p>Are you sure you want to Deactivate poll <?=$poll['question']?></p>
    <div class="choices">
        <a href="deactivate.php?id=<?=$poll['qid']?>&choice=yes">Yes</a>
        <a href="deactivate.php?id=<?=$poll['qid']?>&choice=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?php
include "./init/footer.php"

?>