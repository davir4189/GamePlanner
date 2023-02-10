<?php
class BdD{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "gameplanner";
    
    private static $settings = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_EMULATE_PREPARES => false,
	);

    //funció constructor
    public function __construct()
    {
       BdD::connect($this->servername, $this->username, $this->password, $this->database);
    }
    public static function connect($servername, $username, $password, $database) {
		if (!isset(self::$connection)) {
			self::$connection = @new PDO(
				"mysql:host=$servername;dbname=$database",
				$username,
				$password,
				self::$settings
			);
		}
    }
    //Aquesta funcio en mira si el usuari que en han pasat las dades existeix
    public static function comprobarExisteix($nom,$contrasenya,$token){
        $SQL = "SELECT * FROM usuari WHERE name = :nom and :contrasenya";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':nom',$nom);
        $consulta->bindParam(':contrasenya',$contrasenya);
        $qFiles = $consulta->execute(); 
        if ($consulta->rowCount() > 0)
                //si devuelve true le hacemos la isercion a ese usuario de su token
            return true;
        else
            return false;
    }
    public static function crearUsuari($nom,$cognom,$contrasenya,$email,$rol,$apiKey,$token){
        $sql="INSERT (nom,cognom,contrasenya,email,rol,apiKey,token) VALUES (:nom,cognom,:contrasenya,:email,:rol,:apiKey,:token)"
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':nom',$nom);
        $consulta->bindParam(':contrasenya',$contrasenya);
        $consulta->bindParam(':cognom',$cognom);
        $consulta->bindParam(':email',$email);
        $consulta->bindParam(':rol',$rol);
        $consulta->bindParam(':apiKey',$apiKey);
        $consulta->bindParam(':apiKey',$apiKey);
        $qFiles = $consulta->execute();
    }
}

?>