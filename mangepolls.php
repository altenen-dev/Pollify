<?php 

include "./init/header.php";

?>

<div class="viewpoll" >
<table style='color:black;border:1px solid black;margin:10px;padding:50px'>
    <tr style="padding: 200px;"><th colspan=2 style='text-align:center;'><h1>View Poll</h1></th>
    <th  ><h1>status</h1></th>
    <th ><h1>end date</h1></th>
    <th  ><h1>Actions</h1></th>
    </tr>
    <tr>
     <?php
            $sql =  $db -> query("SELECT * from polls where uid='{$_SESSION['user_id']}'");
            while ($getpolls = $sql -> fetch())
            {
                echo "<tr><td valign='top'>Question : ";
                echo $getpolls["question"]; ;
                echo "</td><tr>";
            }
     
     
     ?>
    </tr>

</table>
</div>










<?php 

include "./init/footer.php";
?>


