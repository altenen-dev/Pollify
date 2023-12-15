<?php
include "./init/header.php"

?>

<style>
    .container h2 {
      margin: 0;
      padding: 25px 0;
      font-size: 22px;
      border-bottom: 1px solid #ebebeb;
      color: #666666;
}

.deletepoll .choices {
      display: flex;
}
.deletepoll .choices a {
      display: inline-block;
      text-decoration: none;
      background-color: #38b673;
      font-weight: bold;
      color: #FFFFFF;
      padding: 10px 15px;
      margin: 15px 10px 15px 0;
      border-radius: 5px;
}
.deletepoll .choices a:hover {
      background-color: #32a367;
    }
    

    </style>
<?php 

if (isset($_GET['q'])) {
    $stmt = $db->prepare('SELECT * FROM polls WHERE qid = ?');
    $stmt->execute([ $_GET['q'] ]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        exit('Poll doesn\'t exist!!');
    }
 
    if (isset($_GET['choice'])) {
        if ($_GET['choice'] == 'yes') {
            $stmt = $db->prepare('DELETE FROM polls WHERE qid = ?');
            $stmt->execute([ $_GET['q'] ]);
            $stmt = $db->prepare('DELETE FROM choices WHERE qid = ?');
            $stmt->execute([ $_GET['q'] ]);
            $msg = 'You have deleted the poll!';
        } else {
            header('Location: dashboard.php');
            exit;
        }
    }
} else {
    exit('Error No Poll Specified!!!');
}
?>
<div class="container deletepoll">
	<h2>Delete Poll :<?=$poll['question']?></h2>
    <?php if (isset($msg)): ?>
    <p><?=$msg?></p>
    <div class="success-icon">
    <div class="success-icon tip"></div>
    <div class="success-icon long"></div>
  </div>
    <?php else: ?>
	<p>Are you sure you want to delete poll <?=$poll['question']?>?</p>
    <div class="choices">
        <a href="deletepoll.php?q=<?=$poll['qid']?>&choice=yes">Yes</a>
        <a href="deletepoll.php?q=<?=$poll['qid']?>&choice=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?php
include "./init/footer.php"

?>