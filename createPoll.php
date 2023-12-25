<?php

include "./init/header.php";

?>


<?php
$created = null;
$optionsarr = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question = $_POST["question"];
    $options = $_POST["op"];
  

    foreach($options as $op){
      if (!preg_match("/^.{1,100}$/", $op)) {
        $error = "option must be not longer than 100 characters!";
    }
      if (trim($op) != '') {
          $optionsarr[] = $op;
      }
  }  
  if (count($optionsarr) <= 1) {
        $error ="Please enter at least two choices";
  }


    if (!preg_match("/^.{1,300}$/", $question)) {
      $errors = "question must be not longer than 300 characters!";
  }
    if (empty($question) || empty($options)) {
  
      $error = "please fill all the missing blanks !!";
    }
 

  $endDate = $_POST["enddate"];
  if ($endDate == null) {
    $status = 1;
  } else {
    if (strtotime($endDate) < strtotime(date("Y-m-d"))){
      $error = "Please enter valid end date!!";
    
    }
    $status = (strtotime($endDate) >= strtotime(date("Y-m-d"))) ? 1 : 0;
  }

  $creationDate = date("Y-m-d");

if(empty($error)){
  try {
    $db->beginTransaction();

    $signedInUserId = $_SESSION["user_id"];

    $insertPollQuery = "INSERT INTO polls (uid, question, status, qdate, edate)
                            VALUES (:uid, :question, :status, :qdate, :endDate)";
    $stmt = $db->prepare($insertPollQuery);
    $stmt->bindParam(':uid', $signedInUserId);
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':qdate', $creationDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();

    $questionId = $db->lastInsertId();

    $insertOptionQuery = "INSERT INTO choices (qid, choice) VALUES (:questionId, :option)";
    $stmt = $db->prepare($insertOptionQuery);
    $stmt->bindParam(':questionId', $questionId);
    $stmt->bindParam(':option', $option);

    foreach ($options as $option) {
      if(trim($option) != ""){
       
        $stmt->execute();
      }
     
    }

    $db->commit();
    $created = "Poll created successfully!!";
    sleep(1);
    

  } catch (PDOException $e) {
    $db->rollBack();
    $error = "Error in creating poll !!";

  }
}
}

?>

<style>
  #form-c {
    display: flex;
    flex-direction: column;
  }

  #form-c input,
  button {
    margin: 10px 0px;
  }

  .success,
  .error {
    border: 2px solid;
    border-radius: 5px;
    margin: 10px 0px;
    padding: 15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 10px center;
  }

  .success {
    color: #4F8A10;
    background-color: #DFF2BF;
    background-image: url('./css/svg/check-solid.svg');
  }

  .error {
    color: #D8000C;
    background-color: #FFBABA;
    background-image: url('./css/svg/xmark-solid.svg');

  }

  input,
  textarea {
    height: 24px;
    width: 480px;
    max-width: 480px;
    max-height: 60px;
    padding: 16px;
    display: block;
  }

  input[type="date"],
  input[type="text"],
  {

  font-size: 1.5em;
  color: #4682B4;
  border: 1px solid #4682B4;
  }

  @media (max-width:600px) {

    input,
    textarea {
      height: 24px;
      width: 200px;
      max-width: 480px;
      max-height: 60px;
      padding: 10px;
      display: block;
    }
  }
</style>
<div class="container">
  <h1 style="color:#ed9168;">Create Poll</h1>
  <form method="POST" id="form-c">
    <?php
    if (isset($error)) {
      echo '<span id="error-m" class="error">';

      echo $error;

      echo '</span>';
    }


    echo '<span id="error-m" class="error hide">';
    echo '</span>';
    if (isset($created)) {
      echo '<span class="success">';
      echo $created;
      echo '</span>';
      header('Location: managepolls.php');
    }
    ?>
    Question: <textarea name="question" col="20"  maxlength="300" rows="3"><?php echo htmlspecialchars(isset($_POST["question"]) ? $_POST["question"] : '') ?></textarea><br>

    <div id="pollBlock">
      <span class="title">Options:</span>
      <br>
      Option 1 <input class="options" type="text" name="op[]"/><br>
      Option 2 <input class="options" type="text" name="op[]" /><br>
    </div>
    End date : <input class="" type="date" value="<?php echo htmlspecialchars(isset($_POST['enddate']) ? $_POST['enddate'] : '') ?>"name="enddate" <br>
    <button name="create" type="submit">Create Poll</button>
    <button type="button" onclick="addMoreOp()">Add More Options</button>
  </form>
</div>
<script>
  let c = 2;
  function addMoreOp() {
    if (c == 6) {
      document.getElementById('error-m').classList.remove('hide');
      document.getElementById('error-m').innerHTML = 'Error..Max is 6 Options';
      document.getElementById("error-m").classList.add("error");
    } else {
      ++c;
      $("#pollBlock").append("Option " + c + " <input type='text' name='op[]'><br>");

    }
  }

</script>

<?php include './init/footer.php'; ?>