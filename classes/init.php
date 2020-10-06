<?php 
	defined('DS')? null : define('DS', "/");
	define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'CMS-blog' );
	defined('INCLUDE_PATH')? null : define('INCLUDE_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
	require_once 'functions.php';
	require_once 'config.php';
	require_once 'database.php';
	require_once 'db_object.php';
	require_once 'user.php';
	require_once 'photo.php';
	require_once 'comment.php';
	require_once 'session.php';
	require_once 'paginate.php';
	require_once 'posts.php';
	require_once 'category.php';
	require_once 'validator.php';
?>
