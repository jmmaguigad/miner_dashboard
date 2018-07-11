<?php
include 'includes/constant.php';
include 'classes/Sparkpoolcontent.php';
$sparkpool = new Sparkpoolcontent();
$miner_values = $sparkpool->showContents(1,'');
$countarray = count($miner_values);
$miners_active = end($sparkpool->showContents(3,''));
$miners_hashrate_info = end($sparkpool->showContents(4,''));
$balance = $sparkpool->showContents(5,'');
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
                    <h3 class="card-text text-center"><?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reported Hashrate">'. $sparkpool::getHashRate($miners_hashrate_info["localHashrate"],2,3) . '</span><span data-toggle="tooltip" data-placement="bottom" title="Current Hashrate">' ." " . $sparkpool::getHashRate($miners_hashrate_info["hashrate"],2,2).'</span>'; ?></h3>
                </div>
            </div>
        </div> 
        <div class="col-sm-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Active Workers</h5>
                    <h3 class="card-text text-center"><?php echo $miners_active['count']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Balance</h5>
                    <h3 class="card-text text-center"><?php echo $sparkpool::getUnpaidValue($balance["balance"]); ?></h3>
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
                $reportedHashRate = round($result["meanLocalHashrate1d"],2);
                $currentHashRate = $sparkpool::getHashRate($result["hashrate"],2,4);                
                echo '<td><a href="#">'.$result["rig"].'</a></td>';
                echo "<td>".round($result["meanLocalHashrate1d"],2)." MH/s"."</td>";
                echo "<td class='hashes' ".$sparkpool::hashRateCheck($reportedHashRate,$currentHashRate).">".$sparkpool::getHashRate($result["hashrate"],1,1)."</td>";
                echo "<td>".$sparkpool::getHashRate($result["hashrate1d"],1,1)."</td>";
                echo "<td>". $sparkpool::lastSeen(date('Y-m-d H:i',strtotime($result["time"]))) ."</td>";
                echo "</tr>";
            ?>
            <?php } ?>        
        </tbody>
    </table>
</div>
<?php include_once('includes/footer.php'); ?>