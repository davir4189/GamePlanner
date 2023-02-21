<?php
class BdD
{
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
    public static $connection;
    public static function connect($servername, $username, $password, $database)
    {
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
    public function comprobarExisteix($email, $contrasenya)
    { //buscamos por usuario contraseña si lo encuentra update
        $SQL = "SELECT * FROM usuari WHERE email = :email and contrasenya = :contrasenya";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasenya', $contrasenya);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $token = $this->tokenAleatorio_datosUsuario($email);
            $this->insertarToken_usuari_por_usuario($token, $email, $contrasenya);
            return $token;
        } else
            return false;
    }
    public function recuperarRol($email, $contrasenya)
    {
        $resposta = null;
        $SQL = "SELECT rol FROM usuari WHERE email = :email and contrasenya = :contrasenya";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasenya', $contrasenya);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            //asociamos el resultado en un array para tener acceso a el
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta[0]['rol'];
        } else
            return false;

    }
    //busco por el token y retorno su rol
    public function recuperarRol_token($token)
    {
        $resposta = null;
        $SQL = "SELECT rol FROM usuari WHERE token = :token";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            //asosiamos el resultado en un array para tener acceso a el
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta[0]['rol'];
        } else
            return false;

    }

    public function recuperarIdUsuari_token($token)
    {
        $resposta = null;
        $SQL = "SELECT * FROM usuari WHERE token = :token";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            //asosiamos el resultado en un array para tener acceso a el
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta[0]['idUsuari'];
        } else
            return false;

    }

    public function comprobarExisteixPerToken($tokenAntic)
    { //despues del login buscamos por el token
        $resposta = null;
        $SQL = "SELECT * FROM usuari WHERE token = :tokenAntic";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':tokenAntic', $tokenAntic);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            //asosiamos el resultado en un array para tener acceso a el
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            //creamos el nuevo token
            $token = $this->tokenAleatorio_datosUsuario($resposta[0]["email"]);
            //agregamos el nuevo token hace update
            $this->insertarToken_usuari_por_token($tokenAntic, $token);
            return true;
        } else
            return false;
    }
    //creacion de usuario con todos sus datos
    public function crearUsuari($nom, $cognom, $contrasenya, $email, $rol, $apiKey)
    {
        $SQL = "INSERT INTO usuari (nom,cognom,contrasenya,email,rol,apiKey) VALUES (:nom,:cognom,:contrasenya,:email,:rol,:apiKey)";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':contrasenya', $contrasenya);
        $consulta->bindParam(':cognom', $cognom);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':rol', $rol);
        $consulta->bindParam(':apiKey', $apiKey);
        $qFiles = $consulta->execute();
    }
    //creacion de tasca con todos sus datos
    public function crearTasca($nom, $descripicio, $prioritat, $estat, $comentari, $direccio, $dataTasca, $empleat, $equipLocal, $equipVisitant)
    {
        $SQL = "INSERT INTO tasca (nom,descripicio,prioritat,estat,comentari,direccio,dataTasca,empleat,equipLocal,equipVisitant ) VALUES (:nom,:descripicio,:prioritat,:estat,:comentari,:direccio,:dataTasca,:empleat,:equipLocal,:equipVisitant)";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':descripicio', $descripicio);
        $consulta->bindParam(':prioritat', $prioritat);
        $consulta->bindParam(':estat', $estat);
        $consulta->bindParam(':comentari', $comentari);
        $consulta->bindParam(':direccio', $direccio);
        $consulta->bindParam(':dataTasca', $dataTasca);
        $consulta->bindParam(':empleat', $empleat);
        $consulta->bindParam(':equipLocal', $equipLocal);
        $consulta->bindParam(':equipVisitant', $equipVisitant);
        $qFiles = $consulta->execute();
    }

    public function borrarTasca($idTasca)
    {
        $SQL = "DELETE FROM `tasca` WHERE `tasca`.`idTasca` = :idTasca ;";
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':idTasca', $idTasca);
        $qFiles = $consulta->execute();
    }
    //buscamos las tascas del usuario
    public function veureTasquesUsuari($idUsuario)
    {
        $resposta = null;
        $SQL = 'SELECT * FROM tasca WHERE empleat = :empleat';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':empleat', $idUsuario);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta; //retornamos los datos
        } else {
            return false;
        }

    }
    public function veureUnaTasca($idTasca)
    {
        $resposta = null;
        $SQL = 'SELECT * FROM tasca WHERE `tasca`.`idTasca` = :idTasca ;';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':idTasca', $idTasca);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function veureTasques()
    {
        $resposta = null;
        $SQL = 'SELECT * FROM tasca';
        $consulta = (BdD::$connection)->prepare($SQL);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta;
        } else {
            return false;
        }

    }
    public function updateTasca($idTasca, $comentari, $estat)
    {
        $SQL = 'UPDATE tasca SET comentari = :comentari, estat = :estat WHERE idTasca = :idTasca';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':comentari', $comentari);
        $consulta->bindParam(':estat', $estat);
        $consulta->bindParam(':idTasca', $idTasca);
        $qFiles = $consulta->execute();

        if ($qFiles) {
            return $this->veureTasques();
        } else {
            return false;
        }
    }


    public function updateTascaAdmin($idTasca, $nom, $descripicio, $prioritat, $estat, $comentari, $direccio, $empleat, $equipLocal, $equipVisitant, $dataCreacio)
    {
        $SQL = 'UPDATE tasca SET nom = :nom, descripicio = :descripicio, prioritat = :prioritat, estat = :estat, comentari = :comentari, direccio = :direccio,empleat= :empleat, equipLocal = :equipLocal, equipVisitant = :equipVisitant,dataCreacio=:dataCreacio WHERE idTasca = :idTasca';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':idTasca', $idTasca);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':comentari', $comentari);
        $consulta->bindParam(':prioritat', $prioritat);
        $consulta->bindParam(':estat', $estat);
        $consulta->bindParam(':descripicio', $descripicio);
        $consulta->bindParam(':direccio', $direccio);
        $consulta->bindParam(':empleat', $empleat);
        $consulta->bindParam(':equipLocal', $equipLocal);
        $consulta->bindParam(':equipVisitant', $equipVisitant);
        $consulta->bindParam(':dataCreacio', $dataCreacio);
        $qFiles = $consulta->execute();
    }


    public function veureUsers()
    {
        $resposta = null;
        $SQL = 'SELECT * FROM usuari';
        $consulta = (BdD::$connection)->prepare($SQL);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            return $resposta; //retornamos los datos
        } else {
            return false;
        }
    }
    public function updateUsuari($nom, $cognom, $contrasenya, $email, $rol, $apiKey, $idUsuari)
    {
        $SQL = 'UPDATE usuari SET rol=:rol,nom=:nom,cognom=:cognom,email=:email,contrasenya=:contrasenya,apiKey=:apiKey WHERE :idUsuari';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':contrasenya', $contrasenya);
        $consulta->bindParam(':cognom', $cognom);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':rol', $rol);
        $consulta->bindParam(':apiKey', $apiKey);
        $consulta->bindParam(':idUsuari', $idUsuari);
        $qFiles = $consulta->execute();
    }
    public function existeixToken_bbd_token($token)
    {
        $SQL = 'SELECT * FROM tokenbd WHERE token=:token';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function existeixToken_bbd_usuari($token)
    {
        $SQL = 'SELECT * FROM usuari WHERE token=:token';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0)
            return true;
        else
            return false;
    }
    //inserta token despues de cada accion que se hace
    public function insertarToken_usuari_por_token($tokenAntic, $token)
    {
        $SQL = 'UPDATE usuari SET token=:token WHERE token=:tokenAntic';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $consulta->bindParam(':tokenAntic', $tokenAntic);
        $qFiles = $consulta->execute();
        return true;
    }
    //inserta el primer token al usuario, el token esta en null se lo encuentra por email y contraseña
    public function insertarToken_usuari_por_usuario($token, $email, $contrasenya)
    {
        $SQL = 'UPDATE usuari SET token=:token WHERE email=:email and contrasenya=:contrasenya';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasenya', $contrasenya);
        $qFiles = $consulta->execute();
    }
    public function insertarToken_token($token)
    {
        $SQL = 'INSERT INTO tokenbd (token) VALUES (:token)';
        $consulta = (BdD::$connection)->prepare($SQL);
        $consulta->bindParam(':token', $token);
        $qFiles = $consulta->execute();
    }
    public function recuperarEquips()
    {
        $resposta = null;
        $SQL = 'SELECT * FROM equip';
        $consulta = (BdD::$connection)->prepare($SQL);
        $qFiles = $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $result = $consulta->fetchAll();
            foreach ($result as $fila) {
                $resposta[] = $fila;
            }
            echo json_encode($resposta); //retornamos los datos
        } else {
            return false;
        }
    }
    //falta select equipo local


    public function borrarToken_token_bdd($token)
    {
        //primero miramos si el token existe
        if ($this->existeixToken_bbd_token($token)) {
            $SQL = 'DELETE FROM `tokenbd` WHERE token=:token';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $qFiles = $consulta->execute();
            return true;
        } else {
            return false;
        }
    }

    public function tokenAleatorio_datosUsuario($email)
    {
        $caracteres_permitidos = '0kjkjlj123456789abcdefghijklmno897897pqrstuvwxyzABCDEFGHI6546JKLMNOPQRSTUVWXYZ';
        $longitud = 6;
        $resultado = md5(substr(str_shuffle($caracteres_permitidos), 0, $longitud) . $email);
        return $resultado;

    }

}

?>