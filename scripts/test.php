<?php
// This is the data you want to pass to Python
$data = $_POST['content'];
echo $data;
// Execute the python script with the JSON data
//$result = shell_exec('python /python/AutoSpamMain.py ' . escapeshellarg(json_encode($data)));
// Decode the result
//$resultData = json_decode($result, true);
//echo $resultData;
?>
