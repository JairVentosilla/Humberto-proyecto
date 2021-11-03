<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="https:maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	 <script src="https://ajax.gloogleapis.com/ajax/libd/jquery/3.5.1/jquery.min.js"></script>
     <link type="text/css" href="css/jquery.dataTables_themeroller.css" rel="stylesheet"/>
	 <script type="text/javascript" src="js/jquery.js"></script>
     <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>
<body>
<?php  
$servidor="localhost";
$usuario="root";
$clave="";
$bdd="tecnologico";
$conexion=mysqli_connect($servidor,$usuario,$clave,$bdd);
$tabla="SELECT * FROM cursos WHERE codcur like 'MA%' ";
$conectar=mysqli_query($conexion,$tabla);
$cursos=array();
while($filas=mysqli_fetch_assoc($conectar))
{
	$cursos[]=$filas;
}
	
?>
<div class="container">
	 <table id="filename" class="table table-striped table-bordered">
		 <tr>
			<th>CODIGO</th>
			<th>NOMBRE</th>
			<th>CREDITOS</th>
			<th>HORAS</th>
		 </tr>
             <tbody>
			<?php  
				foreach($cursos as $curso)
				{
			?>
				<tr>
					<td><?php echo $curso["codcur"]; ?></td>
					<td><?php echo $curso["nombre"];?></td>
					<td><?php echo $curso["cred"];?></td>
					<td><?php echo $curso["horas"];?></td>
				</tr>
			<?php		
				}
			?>
			</tbody>
	</table>
</div>
<?php  
	if(isset($_POST["exportar"])) 
	{
		 if(!empty($cursos)) 
		 {
		 	$filename ="cursos.xls";
		 	header("Content-Type: application/vnd.ms-excel; name='excel'");
		 	header("Content-Disposition: attachment; filename=".$filename);
		 }
		 else
		 {
		 	echo 'No hay datos a exportar';
		 }
		 exit;
    }
?>
<div class="container">
<div clas="btn-group pull-right">
	     <form action=" <?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		 <button type="submit" id="exportar" name='exportar'value="Export to excel" class="btn btn-success btn-lg">Exportar a Excel</button>
	     </form>	 
</div>
</div>
</body>
</html>
<?php
ob_end_flush();
?>