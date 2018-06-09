<?php
if (isset($_GET['worker']) && $_GET['worker'] != "") {
include 'includes/constant.php';
include 'classes/Etherminecontent.php';
$ethermine = new Etherminecontent();
$worker_name = $_GET['worker'];
$rig_info = $ethermine->showContents(3,$worker_name);
$worker_reported_hashrate = $ethermine::getHashRate($rig_info["reportedHashrate"],1,1);
$worker_current_hashrate = $ethermine::getHashRate($rig_info["currentHashrate"],1,1);
$worker_average_hashrate = $ethermine::getHashRate($rig_info["averageHashrate"],1,1);
?>
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/header-menu.php'); ?>
<div class="header_menu">
    <a class="btn btn-info" href="index.php">Back to Ethermine Dashboard</a>
</div>
<hr>
<h1 class="text-center">Worker Name <?=$worker_name?></h1>
<div id="active_workers">
    <div class="row">
        <div class="col-sm-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Reported Hashrate</h5>
                    <h3 class="card-text text-center"><?php echo $worker_reported_hashrate; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Current Hashrate</h5>
                    <h3 class="card-text text-center"><?php echo $worker_current_hashrate; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Average Hashrate</h5>
                    <h3 class="card-text text-center"><?php echo $worker_average_hashrate; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Valid Share</h5>
                    <h3 class="card-text text-center"><?php echo $rig_info["validShares"]; ?></h3>
                </div>
            </div>
        </div>
    </div>  
</div>
<?php include_once('includes/footer.php'); ?>
<?php } else {
    echo "Oops you've accessed a wrong page.";
} ?>