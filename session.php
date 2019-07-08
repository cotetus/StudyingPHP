<?php
include 'app.widgets/TSession.class.php';

new TSession;

if (!TSession::getValue('counted')) {
	echo "Registrando visita.";

	TSession::setValue('counted', true);
}else {
	echo "Visita ya registrada.";
}

  ?>