<?php
header('Access-Control-Allow-Origin: *');
include 'bdd.php';

class server
{
    function serve()
    {
        $method = $_SERVER['REQUEST_METHOD']; //si es un get, pull,

        //creamos objeto base de datos
        $bdd = new bdd();
        $data = json_decode(file_get_contents('php://input'));

        $token = null;
        if ($data != null) {
            $token = $data->token;
        }
        //si no tiene cookie no entramos

        if ($token != null) {
            $recurso = $data->direccion;
            //comprobamos que el token existe en una de nuestras 2 bases de datos
            if ($bdd->existeixToken_bbd_usuari($token) || $bdd->existeixToken_bbd_token($token))
                if ($recurso == 'login') {

                   
                    if ($bdd->existeixToken_bbd_token($token)) {
                        //Acaba de iniciar, comprobamos que existe en la bdd token
                        $email = $data->email;
                        $contrasenya = $data->contrasenya;
                        //de los datos que nos han pasado los separamo
                        $token = $bdd->comprobarExisteix($email, $contrasenya);
                        //les pasamos a esta funcion que nos comprueba si existe la perosona y ya nos genera un token nuevo para ella.
                        if ($token) {
                            //la funcion no puede devolver false asi que puede no entrar aqui
                            $rol = $bdd->recuperarRol($email, $contrasenya);

                            header('HTTP/1.1 200 OK');
                            $datosApasar = array('rol' => $rol, 'token' => $token);
                            //pasamos los datos
                            echo json_encode($datosApasar);
                        } else {
                            //devuelve false
                            echo json_encode($token); //sera falso
                            header('HTTP/1.1 404 Not Found');
                        }
                    }

                //En el caso de que me venga con alguna de esta direcciones entramos por aqui
                } elseif ($recurso == 'admin' || $recurso == 'manager' || $recurso == 'technical') {
                    //como la direccion esta relacionada con su rol recuperamos el rol que deberian tener y lo enviamo
                    $rol = $bdd->recuperarRol_token($token);
                    $datosApasar = array('rol' => $rol);
                    echo json_encode($datosApasar);

                }
                //nos llega aqui cuando hacemos la coneccion a la api algun de estos url
                elseif ($recurso == 'works') {
                    $rol = $bdd->recuperarRol_token($token);

                    if ($rol == 'admin' || $rol == 'gestor') {

                        if ($method == 'POST') {
                            $tasques = $bdd->veureTasques();
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        }
                        //cuando la coneccion a axios es delete
                        elseif ($method == "DELETE") {
                            //me devuelve true or false, por si existe la tasca
                            $idTasca1 = $data->idTasca;
                            $idTasca = $bdd->veureUnaTasca($idTasca1);
                            if ($idTasca) {
                                $idTasca = $data->idTasca;
                                $bdd->borrarTasca($idTasca);

                            } else {
                                echo json_encode("entra2");
                            }
                        }
                    } else {

                        $rol = false;
                        $datosApasar = array('rol' => $rol);
                        echo json_encode($datosApasar);
                    }


                } 
                
                elseif ($recurso == 'addWork') {
                    //recuperamos el rol que deberia tener
                    $rol = $bdd->recuperarRol_token($token);
                    //si el rol tiene permiso
                    if ($rol == 'admin' || $rol == 'gestor') {

                        if ($method == 'POST') 
                        {
                            //hacemos la creaccion del usuario con los datos que nos han pasado
                            $bdd->crearTasca($data->nom, $data->descripicio, $data->prioritat, "pendent", "", "", $data->dataTasca, $data->empleat, "", "");
                        }
                        else 
                        {
                            header('HTTP/1.1 405 Mètode no disponible');
                        }
                    }
                } 
                
                elseif ($recurso == 'employees') {

                    $rol = $bdd->recuperarRol_token($token);
                    //solo lo puede hacer el administrador
                    if ($rol == 'admin') {
                        $usuaris = $bdd->veureUsers();
                        //pasamos todos los usuarios
                        $datosApasar = array('rol' => $rol, 'usuaris' => $usuaris);
                        echo json_encode($datosApasar);
                    }

                } 

                elseif ($recurso == 'addEmployee'){

                    $rol = $bdd->recuperarRol_token($token);
                    //miramos que tenga permiso
                    if($rol == 'admin')
                    {
                        //que nos pida las cosas por post
                        if($method == "POST")
                        {
                            //hacemos la cracion del usuario
                            $bdd->crearUsuari($data->nom, $data->cognom, $data->contrasenya, $data->email, $data->rol, "");
                        } 
                        else 
                        {
                            header('HTTP/1.1 405 Mètode no disponible');
                        }
                    }
                }
                
                elseif ($recurso == 'myWorks') {
                    
                    $rol = $bdd->recuperarRol_token($token);
                    $idUsuari = null;
                    //en el caso de que vayamos ha hecer un post
                    if ($method == 'POST') {

                        $idUsuari = $bdd->recuperarIdUsuari_token($token);
                        //primero comprobamos de que el usuario existe y si su rol le permite hacer la accion
                        if ($rol == 'gestor' || $rol == 'tecnic' || $idUsuari != false) {
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
                    //En el caso de que hagamos un put (update)
                    if ($method == 'PUT') {
                        //asociamoslos datos que nos han pasado
                        $idTasca = $data->idTasca;
                        $comentari = $data->comentari;
                        $estat = $data->estat;
                            // comprobamos de que el rol que tiene puede hacer la accion y que la tasca exista
                        if ($rol == 'gestor' || $rol == 'tecnic' && $bdd->veureUnaTasca($idTasca)) {
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
                    //si la cookie que nos pasa no existe
                    header('HTTP/1.1 401 Unauthorized');
                    echo false;
                }
        } 

        else {
            //en el caso que no tenga una cookie token
            $value = $this->tokenAleatorio();
            //comprobamos que el token no exista en la bdd
            while ($bdd->existeixToken_bbd_usuari($value)) {
                $value = $this->tokenAleatorio();
            }

            $bdd->insertarToken_token($value);
            echo $value;
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