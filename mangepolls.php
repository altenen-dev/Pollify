<?php 

include "./init/header.php";

?>

<div class="viewpoll" >
<table style='color:black;border:1px solid black;margin:10px;padding:50px'>
       <tr><th colspan=2 style='text-align:center;'><h1>Poll</h1></th>
    <th  ><h1>status</h1></th>
    <th ><h1>end date</h1></th>
    <th  ><h1>Actions</h1></th>
    </tr>
    <tr>
     <?php
            $sql =  $db -> query("SELECT * from polls where uid='{$_SESSION['user_id']}'");
            while ($getpolls = $sql -> fetch())
            {
                echo "<tr><td > ";
                echo $getpolls["question"]; ;
                echo "</td>";
                if ($getpolls["status"] == '1'){
                    echo "<td >";
                    echo "active" ;
                    echo "</td></tr>";
                }else {
                    echo "<td >";
                    echo "deactivated" ;
                    echo "</td></tr>";
                }
                if ($getpolls["status"] == '0000-00-00'){
                echo "<tr><td > ";
                echo $getpolls["edate"]; ;
                echo "</td>";
                }
            }
     
     
     ?>
    </tr>

</table>
</div>










<?php 

include "./init/footer.php";
?>


