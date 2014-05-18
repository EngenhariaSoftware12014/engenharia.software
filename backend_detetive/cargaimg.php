<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Imagem</title>
</head>
<body>
<h2>Envie a imagem a ser carregada no perfil</h2>

<form action='php/uploadfiles.php' method="post" enctype="multipart/form-data">
<table>
<input type="text" name="pathrun" size="35" hidden value='<?php echo $_REQUEST['diretorio'];?>'>
<tr><td><input type="file" name="imagem" size="35" ></td><td colspan="2"><input type="submit" name="enviar" value="Enviar"></td></tr>

</table>
</form>
</body>
</html>