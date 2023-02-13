<?php
 include 'prueba.php';

// class server{
//     //separamos el url en partes 
//        {
            $uri ='http://gameplanner.daw.institutmontilivi.cat/login';///$_SERVER['REQUEST_URI'];//guardamos el url que nos envia
            $method=$_SERVER['REQUEST_METHOD'];//si es un get, pull,
            $paths=explode('/',$uri);
            array_shift($paths);
            array_shift($paths);
            array_shift($paths);
            $recurso= array_shift($paths);
            var_dump($recurso);
            //creamos objeto base de datos
            $bdd= new bdd();
            //si no tiene cookie no entramos
            if(isset($_COOKIE['token'])){
                    $token=$_COOKIE["token"];
                    //comprobamos que el token existe
                    if($bdd->existeixToken_bbd_usuari($token) || $bdd->existeixToken_bbd_token($token))
                            if($recurso='login'){
                            
                                if($bdd->existeixToken_bbd_token($token)){
                                    //Acaba de iniciar, comprobamos que existe en la bdd token
                                    $data = json_decode(file_get_contents('php://input'));
                                    $email=$data->email;
                                    $contrasenya=$data->contrasenya;
                                    $token=$bdd->comprobarExisteix($email,$contrasenya);
                                    if($token){
                                        setcookie("token", $token,+time()+3600,'/')//creamos una cookie
                                        header('HTTP/1.1 200 OK');
                                    }
                                    else{
                                        header('HTTP/1.1 404 Not Found');  
                                    }
                                }


                            }
                    else{
                        //si la cookie que nos pasa no existe
                        header('HTTP/1.1 401 Unauthorized');
                    }
        }
        else{
            //en el caso que no tenga una cookie token
            $value=tokenAleatorio();
            //comprobamos que el token no exista en la bdd
            while($bdd->existeixToken_bbd_usuari($value)){
                $value=tokenAleatorio();
            }
            setcookie("token", $value,+time()+3600,'/')
        }
            
            

 public function tokenAleatorio(){
        $caracteres_permitidos = '0kjkjlj123456789abcdefghijklmno897897pqrstuvwxyzABCDEFGHI6546JKLMNOPQRSTUVWXYZ';
        $longitud = 25;
        return substr(str_shuffle($caracteres_permitidos), 0, $longitud);
    }
//}
    


?>