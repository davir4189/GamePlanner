<?php
header('Access-Control-Allow-Origin: *');
include 'bdd.php';

class server
{
    function serve()
    {
        $uri = $_SERVER['REQUEST_URI']; //guardamos el url que nos envia
        $method = $_SERVER['REQUEST_METHOD']; //si es un get, pull,
        
        //array_shift($paths);

        // var_dump($recurso);
        //creamos objeto base de datos
        $bdd = new bdd();
        $data = json_decode(file_get_contents('php://input'));
        
        $token=null;
        if($data!=null){
        $token= $data->token;
        }
        //si no tiene cookie no entramos

        if ($token!=null) 
		{
            $recurso=$data->direccion;
            //comprobamos que el token existe
            if ($bdd->existeixToken_bbd_usuari($token) || $bdd->existeixToken_bbd_token($token))
                if ($recurso == 'login') {
                    

                    if ($bdd->existeixToken_bbd_token($token)) {
                        //Acaba de iniciar, comprobamos que existe en la bdd token
                        $email = $data->email;
                        $contrasenya = $data->contrasenya;
                        $token = $bdd->comprobarExisteix($email, $contrasenya);
                        if ($token) { 
                            $rol=$bdd->recuperarRol($email,$contrasenya);

                            header('HTTP/1.1 200 OK');
                            $datosApasar=array('rol'=>$rol,'token'=>$token);
                            echo json_encode($datosApasar);
                        } else {
                            
                            echo json_encode($token);//sera falso
                            header('HTTP/1.1 404 Not Found');
                        }
                    }


                }
                elseif ($recurso=='admin'||$recurso=='manager'||$recurso=='technical'){
                    $rol=  $bdd->recuperarRol_token($token);
                    
                    $datosApasar= array('rol'=>$rol);                
                    echo json_encode($datosApasar);

                }
                //nos llega aqui cuando hacemos la coneccion a la api algun de estos url
                elseif($recurso=='works' ||$recurso=="/works/editWork" ){
                    $rol=  $bdd->recuperarRol_token($token);
                    
                    if($rol=='admin'||$rol=='gestor'){
                       
                        if($method=='GET'){
                            $tasques=$bdd->veureTasques();                  
                            $datosApasar= array('rol'=>$rol,'tasques'=>$tasques);  
                            echo json_encode($datosApasar);
                        }
                        //cuando la coneccion a axios es delete
                        elseif($method=="DELETE"){
                            //me devuelve true or false, por si existe la tasca
                            $idTasca=$bdd->veureUnaTasca($data->idTasca);
                            if($idTasca){
                                $idTasca=$data->idTasca;
                                $bdd->borrarTasca($idTasca);
                                echo (true);
                            }
                            else{
                                echo false;
                            }
                        }
                    }
                    else{
                        
                        $rol=false;
                        $datosApasar= array('rol'=>$rol); 
                        echo json_encode($datosApasar);
                    }
                   

                }


                elseif($recurso == 'addWork'){
                    $nom = "";
                    $fecha = "";
                    $equipLocal = "";
                    $equipVisitant = "";
                    $prioritat = "";
                    $empleat = "";
                    $descripcio = "";
                    $tasca = "";


                    $rol=  $bdd->recuperarRol_token($token);
                    if($rol == 'admin' || $rol == 'gestor'){
                        
                        $nom = $data->$nom;
                        $fecha = $data->$fecha;
                        $equipLocal = $data->$equipLocal;
                        $equipVisitant = $data->$equipVisitant;
                        $prioritat = $data->$prioritat;
                        $empleat = $data->$empleat;
                        $descripcio = $data->$descripcio;
                        echo "hoooola";
                        if($method == 'POST'){
                            echo "adei";
                            $tasca = $bdd->crearTasca($nom, $descripcio, $prioritat, "pedent", null, null, $empleat, $equipLocal, $equipVisitant, null);
                        }
                    }
                }

                elseif ($recurso == 'employees'){
                    
                    $rol = $bdd->recuperarRol_token($token);

                    if($rol == 'admin'){
                        $usuaris = $bdd->veureUsers();
                        $datosApasar = array('rol' => $rol, 'usuaris' => $usuaris);
                        echo json_encode($datosApasar);
                    }

                }

                elseif ($recurso == 'myWorks'){

                    $rol = $bdd->recuperarRol_token($token);
                    $idUsuari = null;

                    if($method == 'POST'){
                        
                        $idUsuari = $bdd->recuperarIdUsuari_token($token);

                        if($rol == 'gestor' || $rol == 'tecnic' || $idUsuari != false){
                            $tasques = $bdd->veureTasquesUsuari($idUsuari);
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        }
                    }
                    else{
                        $estado = false;
                        $datosApasar= array('estado'=>$estado); 
                        echo json_encode($datosApasar);
                    }

                    $tasca = null;
                    $idTasca = null;
                    $comentario = null;
                    $estado = null;

                    if($method == 'PUT' ){
                        
                        $idTasca = $bdd->veureUnaTasca($data->$idTasca);
                        $comentario = $data->$comentario;
                        $estado = $data->$estado;

                        if($rol == 'gestor' || $rol == 'tecnic' || $idTasca != false){
                            $tasca = $bdd->updateTasca($idTasca, $comentario, $estado);
                            $datosApasar = array('rol' => $rol, 'tasques' => $tasques);
                            echo json_encode($datosApasar);
                        }
                    }
                }


                              
                else {
                    //si la cookie que nos pasa no existe
                    header('HTTP/1.1 401 Unauthorized');
                    echo false;
                }
        } else 
		{
            //en el caso que no tenga una cookie token
            $value = $this->tokenAleatorio();
            //comprobamos que el token no exista en la bdd
            while ($bdd->existeixToken_bbd_usuari($value)) {
                $value = $this->tokenAleatorio();
            }
            
            $bdd->insertarToken_token($value); 
			echo $value;//envia 
        }


    }
        public function tokenAleatorio()
        {
            $caracteres_permitidos = '0kjkjlj123456789abcdefghijklmno897897pqrstuvwxyzABCDEFGHI6546JKLMNOPQRSTUVWXYZ';
            $longitud = 25;
            return substr(str_shuffle($caracteres_permitidos), 0, $longitud);
        }
}

$server=new server();
$server->serve();
