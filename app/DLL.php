<?php

Function banco($server, $user, $password, $db, $consulta)
	{

	 $banco =  new mysqli($server, $user, $password, $db);
	 if ($banco->connect_error) {
            echo "Falha de conexão referência: (".$banco->connect_errno.") - ".$banco->connect_error;
            exit();
	 }
	 if (!$resultado = $banco->query($consulta)) {
		        echo "Falha na consulta referência: (".$banco->errno.") - ".$banco->error;
				  exit();
	 }
    $banco->close();
	 return $resultado;

	}

?>