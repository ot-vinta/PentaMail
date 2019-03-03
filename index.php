<!DOCTYPE html>
<html>
<head>
	<title>Main page</title>
</head>
<body>
	<h1>Hello</h1>
	<form method="post">
		<textarea maxlength="255" name="content">
			Type smth
		</textarea>
		<input type="submit">
	</form>
</body>
</html>
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
