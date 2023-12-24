<?php
include './init/header2.php';

try {
    $db = new PDO("mysql:host=localhost;dbname=pollmaker", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
// Retrieve the poll ID from the URL query parameter
if (isset($_GET['id'])) {
    $qid = $_GET['id'];

    // Query the database to get poll information and choices
    $sql = $db->prepare("SELECT question FROM polls WHERE qid = ?");
    $sql->execute([$qid]);
    $pollInfo = $sql->fetch(PDO::FETCH_ASSOC);

    $question = $pollInfo['question'];

    // Query the database to get the choices and their vote counts for the poll
    $sql = $db->prepare("SELECT choice, votes FROM choices WHERE qid = ?");
    $sql->execute([$qid]);
    $choices = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Calculate the total number of votes
    $totalVotes = 0;
    foreach ($choices as $choice) {
        $totalVotes += $choice['votes'];
    }
    
    // Define an array of colors
    $colors = ['#FF6384', '#00C853', '#FFCE56', '#0D47A1', '#9966FF', '#FF9F40'];

    ?>

    <style>
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        .choice {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            margin-right: 50px;
            margin-left: 50px;
        }

        .choice-label {
            flex: 1;
            font-weight: bold;
        }

        .choice-bar {
            flex: 2;
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #ddd;
        }

        .choice-progress {
            height: 100%;
            transition: width 0.5s ease-in-out;
        }
        .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #45a049;
    }

    
    .back-button-container {
        margin-top: 20px;
        text-align: center;
    }

    .footer {
        margin-top: 10px;
    }


    </style>

    <h2><?= htmlspecialchars($question) ?></h2>
    <ul>
        <?php $index = 0; ?>
        <?php foreach ($choices as $choice) : ?>
            <?php
            $choiceText = htmlspecialchars($choice['choice']);
            $votes = $choice['votes'];
            $percentage = $totalVotes > 0 ? ($votes / $totalVotes) * 100 : 0;
            $color = $colors[$index % count($colors)];
            $index++;
            ?>
            <li class="choice">
                <div class="choice-label"><?= $choiceText ?></div>
                <div class="choice-bar">
                    <div class="choice-progress" style="width: <?= $percentage ?>%; background-color: <?= $color ?>;"></div>
                </div>
                <div><?= $votes ?> votes (<?= $percentage ?>%)</div>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="back-button-container">
    <a class="back-button" href="vote.php?id=<?= $qid ?>">Back to Poll</a>
    </div>

<?php
} else {
    echo "Invalid poll ID.";
}

include './init/footer.php';
?>