<?php


class FrontController{
	function __construct() {
		try{
			if (isset($_REQUEST['action'])){
				$action=$_REQUEST['action'];
			}else{
				$action=null;
			}

			new PublicController($action);

		}catch(Exception $e) {
            $error = new Error(array('exception' => $e->getMessage()));
        }
	}
}


?>