<?php

header('Access-Control-Allow-Origin: *');

include 'Bdd.php';

class server
{
    function serve()
    {
        $method = $_SERVER['REQUEST_METHOD']; //si es un get, pull,


        //CREACION ONJETO BDD
        $bdd = new bdd();
        $data = json_decode(file_get_contents('php://input'));

        $token = null;
        if ($data != null) {
            $token = $data->token;
        }
        
        //SI NO COOKIE NO ENTRA

        if ($token != null) {
            $recurso = $data->direccion;
            
            //COMPROBAMOS SI TOQUE EXISTE
            if ($bdd->existeixToken_bbd_usuari($token) || $bdd->existeixToken_bbd_token($token))

                //SI RECURSO LOGIN
                if ($recurso == 'login') {

                    //COMPROBAMOS SI TOKEN EXISTE
                    if ($bdd->existeixToken_bbd_token($token)) {
                        
                        //ASIGNAMOS DATOS 
                        $email = $data->email;
                        $contrasenya = $data->contrasenya;

                        //COMPROBAMOS SI EXISTE
                        $token = $bdd->comprobarExisteix($email, $contrasenya);

                        //SI TRUE
                        if ($token) 
                        {
                            //RECUPERAMOS ROL
                            $rol = $bdd->recuperarRol($email, $contrasenya);
                            header('HTTP/1.1 200 OK');
                            $datosApasar = array('rol' => $rol, 'token' => $token);
                            //pasamos los datos
                            echo json_encode($datosApasar);
                        } else {
                            echo json_encode($token); //sera falso
                            header('HTTP/1.1 404 Not Found');
                        }
                    }
                } 

                //SI RECURSO ADMIN - MANAGER - TECNIC
                elseif ($recurso == 'admin' || $recurso == 'manager' || $recurso == 'technical') 
                {
                
                //RECUPERAMOS ROL
                } elseif ($recurso == 'admin' || $recurso == 'manager' || $recurso == 'technical') {
                    $rol = $bdd->recuperarRol_token($token);
                    $datosApasar = array('rol' => $rol);
                    echo json_encode($datosApasar);
                }

                //SI RECURSO WORKS
                elseif ($recurso == 'works')
                {
                    //RECUPERAMOS ROL
                    $rol = $bdd->recuperarRol_token($token);

                    //SI ROL ADMIN - GESTOR
                    if ($rol == 'admin' || $rol == 'gestor') {

                        //SI POST
                        if ($method == 'POST') 
                        {
                            //LAMAMOS METODO VEURE TASCA
                            $tasques = $bdd->veureTasques();
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        }

                        //SI DELETE
                        elseif ($method == "DELETE") 
                        {
                            //ASIGNAMOS DATOS
                            $idTasca1 = $data->idTasca;

                            //RECUPERAMOS TASCA
                            $idTasca = $bdd->veureUnaTasca($idTasca1);

                            //SI EXISTE
                            if ($idTasca) 
                            {
                                $idTasca = $data->idTasca;
                                //ELIMINAMOS TASCA
                                $bdd->borrarTasca($idTasca);

                           
                        }
                    } else {
                        $rol = false;
                        $datosApasar = array('rol' => $rol);
                        echo json_encode($datosApasar);
                    }


                } 
                
                //SI RECURSO ADD WORK
                elseif ($recurso == 'addWork') {

                    //RECUPERAMOS ROL BDD
                    $rol = $bdd->recuperarRol_token($token);

                    //SI ROL
                    if ($rol == 'admin' || $rol == 'gestor') {

                        //SI POST
                        if ($method == 'POST') 
                        {

                            //LLAMAMOS METODO CREAR TASCA
                            $bdd->crearTasca($data->nom, $data->descripicio, $data->prioritat, "pendent", "", "", $data->dataTasca, $data->empleat, "", "");
                        }
                        else 
                        {
                            header('HTTP/1.1 405 Mètode no disponible');
                        }
                    }
                } 
                
                //SI RECURSO EMPLOYEES
                elseif ($recurso == 'employees') {

                    //RECUPERAMOS ROL BDD
                    $rol = $bdd->recuperarRol_token($token);

                    //SI ROL 
                    if ($rol == 'admin') {

                        //LLAMAMOS METODO VER USERS
                        $usuaris = $bdd->veureUsers();
                        //pasamos todos los usuarios
                        $datosApasar = array('rol' => $rol, 'usuaris' => $usuaris);
                        echo json_encode($datosApasar);
                    }

                } 

                //SI RECURSO ADDEMPLOYEE
                elseif ($recurso == 'addEmployee'){

                    //RECUPERAMOS ROL BDD
                    $rol = $bdd->recuperarRol_token($token);


                    //SI ROL ADMIN
                    if($rol == 'admin')
                    {
                        //SI POST
                        if($method == "POST")
                        {
                            //LLAMAMOS METODO CREAR USER
                            $bdd->crearUsuari($data->nom, $data->cognom, $data->contrasenya, $data->email, $data->rol, "");
                        } 
                        else 
                        {
                            header('HTTP/1.1 405 Mètode no disponible');
                        }
                    }
                }
                
                //SI RECURSO MYWORKS
                elseif ($recurso == 'myWorks') {
                    
                    //RECUPERAMOS ROL
                    $rol = $bdd->recuperarRol_token($token);
                    $idUsuari = null;

                    //SI POST
                    if ($method == 'POST') {

                        //RECUPERAMOS ID USER
                        $idUsuari = $bdd->recuperarIdUsuari_token($token);

                        //SI ROL 
                        if ($rol == 'gestor' || $rol == 'tecnic' || $idUsuari != false) 
                        {
                            //LLAMAMOS METODO VEURE TASCAS
                            $tasques = $bdd->veureTasquesUsuari($idUsuari);
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        }
                    } else {
                        $estado = false;
                        $datosApasar = array('estado' => $estado);
                        echo json_encode($datosApasar);
                    }

                    $tasca = null;
                    $idTasca = null;
                    $comentari = null;
                    $estat = null;


                    //SI PUT
                    if ($method == 'PUT') {

                        //ASIGAMOS VALORES DE DATA
                        $idTasca = $data->idTasca;
                        $comentari = $data->comentari;
                        $estat = $data->estat;

                        //SI ROL
                        if ($rol == 'gestor' || $rol == 'tecnic' || $bdd->veureUnaTasca($idTasca)) 
                        {
                            //LLAMAMOS FUNCION UPDATE TASCA
                            $tasca = $bdd->updateTasca($idTasca, $comentari, $estat);
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        } else {
                            http_response_code(403);
                            echo json_encode(array('error' => 'No tiene permiso para actualizar esta tarea'));
                        }
                    }
                } 
                
                else {
                    header('HTTP/1.1 401 Unauthorized');
                    echo false;
                }
        } 

        else 
        {
            //SI NO TIENE COOKIE (TOKEN)
            $value = $this->tokenAleatorio();

            //COMPROBAMOS TOKEN NO EXISTE BDD
            while ($bdd->existeixToken_bbd_usuari($value)) {
                $value = $this->tokenAleatorio();
            }

            //INSERT TOKEN BDD
            $bdd->insertarToken_token($value);
            echo $value;
        }
    }

    }
    public function tokenAleatorio()
    {
        $caracteres_permitidos = '0kjkjlj123456789abcdefghijklmno897897pqrstuvwxyzABCDEFGHI6546JKLMNOPQRSTUVWXYZ';
        $longitud = 25;
        return substr(str_shuffle($caracteres_permitidos), 0, $longitud);
    }
}

$server = new server();
$server->serve();