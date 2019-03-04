<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Check</title>
</head>
<body>
	<h1>Hello</h1>
	<form method="post">
		<textarea maxlength="255" name="content">
			Привет! Как дела? Что делаешь? А я ничего.
		</textarea>
		<input type="submit" name="submit" value="Send">
	</form>
	<?php
		$data = $_POST['content'];
        // Execute the python script with the JSON data
        $result = exec("python python/AutoSpamMain.py $data");
        // Decode the result
        echo "<p>$result</p>";
	?>
</body>
</html>