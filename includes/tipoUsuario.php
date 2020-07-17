<?php 

if (!isset($_SESSION)) {
	session_start();
}

$tipo = $_SESSION['user']['categoria'];

switch ($tipo) {
	case 1://Administrador
		require_once 'includes/layout/Admin/header.php';
		
		break;
	case 2://General
		require_once 'includes/layout/General/header.php';
		break;
	case 3://Mantenimiento
		require_once 'includes/layout/Mantenimiento/header.php';
		break;
	case 4://CIS
		require_once 'includes/layout/CIS/header.php';
		break;
	default:
		# code...
		break;
}

