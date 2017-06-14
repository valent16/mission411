<?php

class DataBaseManager{
	static private $dbh = null;
	
	static private $instance = null;
	
	static private $db_host="mysql:host=localhost;";
	static private $db_name="dbname=mission411";
	static private $db_user="root";
	static private $db_password="ptrx160";
	
	private function __construct(){
		try{
			self::$dbh = new PDO(self::$db_host.self::$db_name, self::$db_user, self::$db_password);
		}catch(PDOException $e){
			echo "<p>Erreur de connection à la base de donnée.</br>";
			die();
		}
	}

	public static function getInstance(){
		if(null ===self::$instance){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function prepareAndExecuteQuery($requete, $args){
		$numargs = count($args);
		if (empty($requete) || !is_string($requete) || preg_match('/(\"|\')+/', $requete) !== 0){
			return false;
		}
		
		$statement = self::$dbh->prepare($requete);
		if ($statement === false){
			return false;
		}
		
		for ($i=1;$i<=$numargs;$i++){
			$statement->bindParam($i, $args[$i-1]);
		}
		
		$statement->execute();
		return $statement;
	}
	
	
	public static function destroyQueryResults(&$statement){
		$statement->closeCursor();
		$statement = null;
	}
	
	private function __clone(){}
}
?>