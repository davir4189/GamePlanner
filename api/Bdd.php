<?php

class BdD
{
    private $servername = "localhost";
    private $username = "adminer";
    private $password = "gameplannerED!";
    private $database = "gameplanner";

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    //CONSTRUCTOR
    public function __construct()
    {
        BdD::connect($this->servername, $this->username, $this->password, $this->database);
    }

    public static $connection;

    //CONEXION A BASE DE DATOS
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

    //FUNCION QUE CMPRUEBA SI USUARIO EXISTE A TRAVES DE EMAIL I PASSWORD
    public function comprobarExisteix($email, $contrasenya)
    { 
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION QUE RECUPERA EL ROL DEL USUARIO SI EXISTE
    public function recuperarRol($email, $contrasenya)
    {
        try{
            $resposta = null;
            $SQL = "SELECT rol FROM usuari WHERE email = :email and contrasenya = :contrasenya";
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':contrasenya', $contrasenya);
            $qFiles = $consulta->execute();
            if ($consulta->rowCount() > 0) {
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $result = $consulta->fetchAll();
                foreach ($result as $fila) {
                    $resposta[] = $fila;
                }
                return $resposta[0]['rol'];
            } else
                return false;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION QUE RECUPERA EL ROL DEL USUARIO SI EL TOKEN ES QUE LE CORRESPONDE
    public function recuperarRol_token($token)
    {
        try{
            $resposta = null;
            $SQL = "SELECT rol FROM usuari WHERE token = :token";
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $qFiles = $consulta->execute();
            if ($consulta->rowCount() > 0) {
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $result = $consulta->fetchAll();
                foreach ($result as $fila) {
                    $resposta[] = $fila;
                }
                return $resposta[0]['rol'];
            } else
                return false;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION QUE RECUPERA EL ID DEL USUARIO SI EL TOKEN ES QUE LE CORRESPONDE
    public function recuperarIdUsuari_token($token)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION QUE MIRA SI EXISTE USUARIO POR TOKEN
    public function comprobarExisteixPerToken($tokenAntic)
    { 
        //DESPUES DE LOGIN BUSCAMOS POR TOKEN
        try{
            $resposta = null;
            $SQL = "SELECT * FROM usuari WHERE token = :tokenAntic";
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':tokenAntic', $tokenAntic);
            $qFiles = $consulta->execute();
            if ($consulta->rowCount() > 0) {
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $result = $consulta->fetchAll();
                foreach ($result as $fila) {
                    $resposta[] = $fila;
                }
                //CREACION NUEVO TOKEN
                $token = $this->tokenAleatorio_datosUsuario($resposta[0]["email"]);
                //ACTUALIZAMOS TOKEN BDD
                $this->insertarToken_usuari_por_token($tokenAntic, $token);
                return true;
            } else
                return false;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION ADD USUARI
    public function crearUsuari($nom, $cognom, $contrasenya, $email, $rol, $apiKey)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }
    
    //FUNCION ADD TASCA
    public function crearTasca($nom, $descripicio, $prioritat, $estat, $comentari, $direccio, $dataTasca, $empleat, $equipLocal, $equipVisitant)
    {
        try{
            $SQL = "INSERT INTO tasca (nom,descripicio,prioritat,estat,comentari,direccio,dataTasca,empleat) VALUES (:nom,:descripicio,:prioritat,:estat,:comentari,:direccio,:dataTasca,:empleat)";
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':nom', $nom);
            $consulta->bindParam(':descripicio', $descripicio);
            $consulta->bindParam(':prioritat', $prioritat);
            $consulta->bindParam(':estat', $estat);
            $consulta->bindParam(':comentari', $comentari);
            $consulta->bindParam(':direccio', $direccio);
            $consulta->bindParam(':dataTasca', $dataTasca);
            $consulta->bindParam(':empleat', $empleat);
            $qFiles = $consulta->execute();
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION DELETE TASCA
    public function borrarTasca($idTasca)
    {
        try{
            $SQL = "DELETE FROM `tasca` WHERE `tasca`.`idTasca` = :idTasca ;";
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':idTasca', $idTasca);
            $qFiles = $consulta->execute();
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }
    
    //FUNCION MOSTRAR TASCA USUARIO
    public function veureTasquesUsuari($idUsuario)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION RECUPERAR DATOS UNA TASCA
    public function veureUnaTasca($idTasca)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION PARA MOSTRAR TODAS LAS TASCAS
    public function veureTasques()
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION EDITAR TAREA
    public function updateTasca($idTasca, $comentari, $estat)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION ADMIN/MANAGER EDITAR TASCA
    public function updateTascaAdmin($idTasca, $nom, $descripicio, $prioritat, $estat, $comentari, $direccio, $empleat, $equipLocal, $equipVisitant, $dataCreacio)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION PARA VER TODOS LOS USUARIOS
    public function veureUsers()
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION EDITAR USUARIO
    public function updateUsuari($nom, $cognom, $contrasenya, $email, $rol, $apiKey, $idUsuari)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION QUE COMPRUEBA SI TOKEN PASADO EXISTE EN BASE DE DATOS TOKEN
    public function existeixToken_bbd_token($token)
    {
        try{
            $SQL = 'SELECT * FROM tokenbd WHERE token=:token';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $qFiles = $consulta->execute();
            if ($consulta->rowCount() > 0)
                return true;
            else
                return false;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION QUE MIRA SI TOKEN DE USUARIO EXISTE
    public function existeixToken_bbd_usuari($token)
    {
        try{
            $SQL = 'SELECT * FROM usuari WHERE token=:token';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $qFiles = $consulta->execute();
            if ($consulta->rowCount() > 0)
                return true;
            else
                return false;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }


    //FUNCION QUE CAMBIA TOKEN ANTIGUO POR NUEVO EN TOKEN
    public function insertarToken_usuari_por_token($tokenAntic, $token)
    {
        try{
            $SQL = 'UPDATE usuari SET token=:token WHERE token=:tokenAntic';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $consulta->bindParam(':tokenAntic', $tokenAntic);
            $qFiles = $consulta->execute();
            return true;
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION QUE CAMBIA TOKEN ANTIGUO POR NUEVO EN NUEVO
    public function insertarToken_usuari_por_usuario($token, $email, $contrasenya)
    {
        try{
            $SQL = 'UPDATE usuari SET token=:token WHERE email=:email and contrasenya=:contrasenya';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':contrasenya', $contrasenya);
            $qFiles = $consulta->execute();
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }
    }

    //FUNCION AÑADIR TOKEN NUEVO A BASE DATOS TOKEN
    public function insertarToken_token($token)
    {
        try{
            $SQL = 'INSERT INTO tokenbd (token) VALUES (:token)';
            $consulta = (BdD::$connection)->prepare($SQL);
            $consulta->bindParam(':token', $token);
            $qFiles = $consulta->execute();
        }
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION PARA RECUPERAR TODOS LOS EQUIPOS
    public function recuperarEquips()
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION BORRAR TOKEN BASE DE DATOS TOKEN
    public function borrarToken_token_bdd($token)
    {
        try{
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
        catch(PDOException $e){
            echo "error" . $e->getMessage();
        }

    }

    //FUNCION PARA CREAR TOKEN
    public function tokenAleatorio_datosUsuario($email)
    {
        $caracteres_permitidos = '0kjkjlj123456789abcdefghijklmno897897pqrstuvwxyzABCDEFGHI6546JKLMNOPQRSTUVWXYZ';
        $longitud = 6;
        $resultado = md5(substr(str_shuffle($caracteres_permitidos), 0, $longitud) . $email);
        return $resultado;

    }

}

?>