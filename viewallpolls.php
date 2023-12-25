<?php

include "./init/header2.php";







if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 6;
$offset = ($pageno - 1) * $no_of_records_per_page;


$total_pages = "SELECT COUNT(*) FROM polls";
$result = $db->query($total_pages);
$total_rows = $result->fetchColumn();
$total_pages = ceil($total_rows / $no_of_records_per_page);





?>
<style>

</style>

<div class="container">

    <main>

        <br>
        <h1 class="title"> Public Polls:</h1>
        <p style="color:grey;margin-left:10px">Here you can see all the polls</p>
        <div class="card-container">
            <div class="poll-container">


                <?php

                $sql = "SELECT * FROM polls LIMIT $offset, $no_of_records_per_page";
                $res_data = $db->query($sql);
                while ($row = $res_data->fetch()) {
                    $question = $row['question'];
                    $qid = $row['qid'];
                    $status = $row['status'];
                    $currentDate = new DateTime();
                    $expiryDateTime = new DateTime($row['edate']);
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
                            <h2>
                                <?php echo htmlspecialchars($question); ?>
                            </h2>
                            <a href="./vote.php?id=<?php echo $qid; ?>"><button class="btn">More Details</button></a>
                            <a href="results.php?id=<?php echo $qid; ?>"><button class="btn">View Results</button></a>                            <?php
                            if (isset($error)) {
                                echo '<br>   <span  style="color:#EC8E23;font-size:12px">';

                                echo $error;

                                echo '</span>';

                            }
                            ?>
                          

                        </div>

                    </div>

                    <?php
                    $error = null;
                }
                ?>








            </div>



        </div>




        <div class="pagination pagination1">
            <a href="?pageno=1">&laquo;</a>

            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a href="?pageno=' . $i . '">' . $i . '</a>';
            }

            ?>
            <a href="?pageno=<?php echo $total_pages; ?>">&raquo;</a>
        </div>
    </main>

</div>

<?php

include "./init/footer.php";
?>
