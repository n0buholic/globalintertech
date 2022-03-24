<?php
	
	if($_SERVER['SERVER_NAME'] == "localhost")
	{
		// jika dijalankan dilocalhost
		echo "../../admgol/rest-api/view/View_service_rma";
	}
	else
	{
		// jika dijalankan online
		echo "https://global.cmbstore.id/rest-api/view/View_service_rma";;
	}

?>