<?php
include 'classes/Ethosdistrocontent.php';
$file = new Ethosdistrocontent(); 
$arr_values = $file->showContents();
$countarray = $file->countArray();
$header_values = $file->showHeaderValues();
?>
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/header-menu.php'); ?>
<table>
    <tr>
        <td><strong>Total Rigs:</strong> <?php echo $header_values[0]["per_total_rigs"]."&nbsp;&nbsp;&nbsp;&nbsp;<strong> Date Time: </strong>".date('m/d/Y H:i:s A',$header_values[0]["current_time"]); ?></td>
    </tr>
</table>
<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Version</th>
                <th scope="col">Name</th>
                <th scope="col">Hashes</th>
                <th scope="col">Temps</th>
                <th scope="col">PTune</th>
                <th scope="col">Volts</th>
                <th scope="col">Watts</th>
                <th scope="col">Fans</th>
                <th scope="col">Cores</th>
                <th scope="col">Mem</th>
            </tr>
        </thead>
        <tbody>                  
            <?php
            for($cnt = 0;$cnt < $countarray;$cnt++) {
                echo "<tr>";
                $result = $arr_values[$cnt];
                echo "<td>".$result["version"]."</td>";
                echo "<td>".$result["rack_loc"]."</td>";
                echo "<td class='hashes'>".$result["miner_hashes"]."</td>";
                echo "<td>".$result["temp"]."</td>";
                echo "<td>".$result["powertune"]."</td>";
                echo "<td>".$result["voltage"]."</td>";
                echo "<td>".$result["watts"]."</td>";
                echo "<td>".$result["fanrpm"]."</td>";
                echo "<td>".$result["core"]."</td>";
                echo "<td>".$result["mem"]."</td>";
                echo "</tr>";
            ?>
            <?php } ?>        
        </tbody>
    </table>
</div>
<?php include_once('includes/footer.php'); ?>