<?php 

require_once 'includes/talleresFunciones.php';

session_start();

$taller = new talleresFunciones();

if(isset($_GET)){


	$id = $_GET['id'];

	if(isset($id) && !empty($id))
	{
		$taller->delete($id);
		header("Location:talleres.php");
	}else{
		header("Location:talleres.php");
	}
	



}