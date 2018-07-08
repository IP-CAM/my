<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />
<style type="text/css">
.express-btns{
	padding:20px;
}
</style>
</head>
<body>
<div class="express-btns">
<?php foreach ($expresses as $express) { ?>
<a href="<?php echo $express['href']; ?>" class="btn btn-primary"><?php echo $express['name']; ?></a>
<?} ?>
</div>
</body>
</html>