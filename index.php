<?php
include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT EN RED</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat.php', true);
			req.send();
		}
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">
<br>
	<div id="contenedor">
		<div id="caja-chat">
			<div id="chat"></div>
		</div>

		<form method="POST" action="index.php">
			<textarea name="mensaje" placeholder="Mensaje..."></textarea>
			<input type="submit" name="enviar" value="Enviar">
		</form>

		<?php
			if (isset($_POST['enviar'])) {
				$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
				$nombre = $nombre_host;
				$mensaje = $_POST['mensaje'];
				$consulta = "INSERT INTO chat (nombre, mensaje) VALUES ('$nombre', '$mensaje')";
				$ejecutar = $conexion->query($consulta);
				if ($ejecutar) {
					echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
				}
			}
		?>
	</div>
</body>
</html>