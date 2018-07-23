<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tannaaz</title>
<link rel="stylesheet" href="/public/css/common.css"/>
<link rel="stylesheet" href="/public/css/grid.css"/>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<?php 
 foreach ($css as $cssFile) { 
 		if(!empty($cssFile)) {?>
 			<link rel="stylesheet" href="/public/css/<?=$cssFile?>.css"/>
 <?php }}
?>
<script type="text/javascript" src="/public/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/public/js/common.js"></script>

<?php 
 foreach ($js as $jsFile) { 
 	if(!empty($jsFile)) {?>
 	<script type="text/javascript" src="/public/js/<?=$jsFile?>.js"></script>
 <?php }}
?>

