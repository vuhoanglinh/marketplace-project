<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8" >
</head>
<body>
<?php 
	foreach ($query['parent'] as $row) {		
		echo "--".$row->name."<br />";
		foreach ($query['child'][$index] as $value) {
			echo $value->id."----".$value->name."<br />";
		}
		$index++;
	}
?>
</body>
</html>