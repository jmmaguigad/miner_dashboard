<?php
include 'includes/constant.php';
include 'classes/Etherminecontent.php';
$ethermine = new Etherminecontent();
$dash_values = $ethermine->showContents(1,'');
$miner_values = $ethermine->showContents(2,'');
$countarray = count($miner_values);
?>
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/header-menu.php'); ?>
<hr>
<div id="active_workers">
    <div class="row">
        <div class="col-sm-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Hash Rates</h5>
                    <h3 class="card-text text-center"><?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reported Hashrate">'.$ethermine::getHashRate($dash_values["currentStatistics"]["reportedHashrate"],1,2) . '</span><span data-toggle="tooltip" data-placement="bottom" title="Your effective current hashrate">' ." " . $ethermine::getHashRate($dash_values["currentStatistics"]["currentHashrate"],1,2).'</span>'; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Active Workers</h5>
                    <h3 class="card-text text-center"><?php echo $dash_values["currentStatistics"]["activeWorkers"]; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Unpaid Balance</h5>
                    <h3 class="card-text text-center"><?php echo $ethermine::getUnpaidValue($dash_values["currentStatistics"]["unpaid"]); ?></h3>
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Reported Hash Rate</th>
                <th scope="col">Current Hash Rate</th>
                <th scope="col">Average Hash Rate</th>
                <th scope="col">Last Seen</th>
            </tr>
        </thead>
        <tbody>                  
            <?php
            for($cnt = 0;$cnt < $countarray;$cnt++) {
                echo "<tr>";
                $result = $miner_values[$cnt];
                echo '<td><a href="riginfo.php?worker='.$result["worker"].'">'.$result["worker"].'</a></td>';
                echo "<td>".$ethermine::getHashRate($result["reportedHashrate"],1,1)."</td>";
                echo "<td class='hashes'>".$ethermine::getHashRate($result["currentHashrate"],1,1)."</td>";
                echo "<td>".$ethermine::getHashRate($result["averageHashrate"],1,1)."</td>";
                echo "<td>". $ethermine::lastSeen(date('Y-m-d H:i',$result["lastSeen"])) ."</td>";
                echo "</tr>";
            ?>
            <?php } ?>        
        </tbody>
    </table>
</div>
<?php include_once('includes/footer.php'); ?>