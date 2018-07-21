<link rel="stylesheet" href="/public/css/common.css"/>
<?php 
 foreach ($css as $cssFile) { 
 		if(!empty($cssFile)) {?>
 			<link rel="stylesheet" href="/public/css/<?=$cssFile?>.css"/>
 <?php }}
?>
<script type="text/javascript" src="/public/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/public/js/mason.min.js"></script>
<script type="text/javascript" src="/public/js/common.js"></script>

<?php 
 foreach ($js as $jsFile) { 
 	if(!empty($jsFile)) {?>
 	<script type="text/javascript" src="/public/js/<?=$jsFile?>.js"></script>
 <?php }}
?>