<?php

include "./init/header.php";

?>

<div class="viewpoll">
    <h2 class="tm">Manage polls</h2>
    <p>Welcome to the dashboard page! Here you can view your own polls.</p>
    <a href="./createPoll.php" class="create-p">Create new poll</a>
    <table class="mpoll">
        <thead>
            <td>
                <h1>Poll</h1>
            </td>
            <td>
                <h1>status</h1>
            </td>
            <td>
                <h1>end date</h1>
            </td>
            <td>
                <h1>Actions</h1>
            </td>
        </thead>
        <tbody>
            <tr>
                <?php
                $sql = $db->query("SELECT * from polls where uid='{$_SESSION['user_id']}'");
                while ($getpolls = $sql->fetch()) {
                    echo "<tr><td > ";
                    echo $getpolls["question"];
                    ;
                    echo "</td>";
                    if ($getpolls["status"] == '1') {
                        $currentDate = new DateTime();
                        $expiryDateTime = new DateTime($getpolls['edate']);
                        if ($getpolls['edate'] != '0000-00-00') {
                            if ($currentDate >= $expiryDateTime) {
                                $active = true;
                                echo "<td >";
                                echo "expired";
                                echo "</td>";
                            }else {
                                $active = true;
                                echo "<td >";
                                echo "active";
                                echo "</td>";
                            }
                        }else{
                            $active = true;
                            echo "<td >";
                            echo "active";
                            echo "</td>";
                        }
                    
                    } elseif ($getpolls["status"] == '0') {
                        $active = false;
                        echo "<td >";
                        echo "deactivated";
                        echo "</td>";
                    }
                    if ($getpolls["edate"] != '0000-00-00') {
                        echo "<td > ";
                        echo $getpolls["edate"];
                        ;
                        echo "</td>";
                    } else {
                        echo "<td > ";
                        echo "not specified";
                        echo "</td>";
                    }
                    ?>
                    <td class="actions">
                        <?php
                        if ($active) {

                            ?>

                            <a href="deactivate.php?id=<?php echo $getpolls["qid"]; ?>" class="edit" title="deactivate poll"><i
                                    class="fa fa-ban" aria-hidden="true"></i></a>
                        <?php
                        } else {
                            ?>

                            <a href="activate.php?id=<?php echo $getpolls["qid"]; ?>" class="turnon" title="activate poll"><i
                                    class="fa-solid fa-power-off" style="color: #80ff00;"></i></a>
                            <?php
                        }
                        ?>

                        <a href="vote.php?id=<?php echo $getpolls["qid"]; ?>" class="view" title="View Poll"><i
                                class="fas fa-eye fa-l"></i></a>
                        <a href="deletepoll.php?q=<?php echo $getpolls["qid"] ?>" class="delete-p" title="Delete Poll"><i
                                class="fas fa-trash fa-l"></i></a>
                    </td>
                </tr>
                <?php
                }


                ?>
            </tr>
        </tbody>
    </table>
</div>










<?php

include "./init/footer.php";
?>