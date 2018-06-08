<?php
include 'classes/Filecontent.php';
$file = new Filecontent(); 
$arr_values = $file->showContents();
$countarray = $file->countArray();
$header_values = $file->showHeaderValues();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rigs Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<table>
    <tr>
        <td><strong>Total Rigs:</strong> <?php echo $header_values[0]["per_total_rigs"]."&nbsp;&nbsp;&nbsp;&nbsp;<strong> Date Time: </strong>".date('m/d/Y H:i:s A',$header_values[0]["current_time"]); ?></td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <td>Version</td>
            <td>Name</td>
            <td>Hashes</td>
            <td>Temps</td>
            <td>PTune</td>
            <td>Volts</td>
            <td>Watts</td>
            <td>Fans</td>
            <td>Cores</td>
            <td>Mem</td>
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
</body>
</html>