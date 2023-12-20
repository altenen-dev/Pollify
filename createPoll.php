<?php

include "./init/header.php";

?>
<?php

include "./init/header.php";

?>

<?php

$db = new PDO('mysql:host=localhost;dbname=pollmaker;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $options = $_POST["op"];
    $endDate = $_POST["enddate"];
    $status = (strtotime($endDate) >= strtotime(date("Y-m-d"))) ? 1 : 0;
    $creationDate = date("Y-m-d");

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
            $stmt->execute();
        }

        $db->commit();
        echo "Poll created successfully!";
    } catch (PDOException $e) {
        $db->rollBack();
        echo "Error creating poll: " . $e->getMessage();
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
    <span id="error-m"></span>
    Question: <textarea name="" name="q" col="20" maxlength="255" rows="3"></textarea><br>

    <div id="pollBlock">
      <span class="title">Options:</span>
      <br>
      Option 1 <input class="options" type="text" name="op[]" required<br>
      Option 2 <input class="options" type="text" name="op[]" required<br>
    </div>
    End date : <input class="" type="date" name="enddate" <br>
    <button type="submit">Create Poll</button>
    <button type="button" onclick="addMoreOp()">Add More Options</button>
  </form>
</div>
<script>
  let c = 2;
  function addMoreOp() {
    if (c == 6) {
      document.getElementById('error-m').innerHTML = 'Error..Max is 6 Options';
      document.getElementById("error-m").classList.add("error")
    } else {
      ++c;
      $("#pollBlock").append("Option " + c + " <input type='text' name='op[]'><br>");

    }
  }
</script>

<?php include './init/footer.php'; ?>
