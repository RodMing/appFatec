<html>
	<head>
		<link rel="stylesheet" href="../css/foundation.css" />
    	<link rel="stylesheet" href="../css/app.css" />
	</head>
    <body>
        <div class="row">
	      <div class="large-12 columns">
	        <h1>AppFatec</h1>
	      </div>
	    </div>
	    <form action="notificacao" method="post">
	        <table>
	            <tr>
	                <td>
	                    <label>Título</label>
	                </td>
	                <td>
	                    <input type="text" placeholder="Titulo" name="titulo"/>
	                </td>
	            </tr>
	            <tr>
	                <td>
	                    <label>Mensagem</label>
	                </td>
	                <td>
	                    <input type="text" placeholder="Mensagem" name="mensagem"/>
	                </td>
	            </tr>
	            <tr>
	                <td></td>
	                <td>
	                    <input style="float:right;margin:0" type="submit" class="alert button" value="Enviar">
	                </td>
	            </tr>
	        </table>
		</form>
    </body>
</html>