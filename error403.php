<div onload="redireccionar()" style="background:white; text-align: center; color:black; margin: auto; height: 100% ; width: 100%; font-size: 50px;">
	
	<h1>Error 403 Sin privilegios </h1>
	<img src="assent/img/25.gif"><br>
	<a href="" onclick="redireccionar()">Regresar</a>
</div>

<script language="JavaScript">
  function redireccionar() {
  	alert("Error dentro de la pagina");
    setTimeout("location.href=index.php", 1000);
  }
  </script>