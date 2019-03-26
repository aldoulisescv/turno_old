<?php
//session_start();
/*
 * CREATOR: VELEZOFT
 * DEVELOPER: ALDO ULISES CORNEJO VELEZ
 * DATE: 18/03/19
 * PROJECT: turno
 *
 * SESSIONES
 * BASE DE DATOS - busonline - proximamente.info
 * DESCRIPTION: MANEJO DE SESIONES DE USUARIO
 *
 */
//print_r($_SESSION);
class Sessions{
	//Validar Sesión
	static function validarUsuario(){
		if(Sessions::verificarSesion()){
			$id_usuario = $_SESSION['UsuarioID'];
		}else{
			Sessions::redireclogin();
		}
    }
    
    //Verifica la sesión del usuario
	static function verificarSesion(){
		//session_start();
		if(isset($_SESSION['keysession'])){
			$createKey = Sessions::keySesionCreate($_SESSION['UsuarioID']);
		          if($_SESSION['keysession'] == $createKey){
		                	return true;
		          }else{
                			return false;
			}
		}else{
			return false;
		}
	}
	//En caso de tener la sesión activa lo envia al panel principal del sistema
	static function validarlogin(){
		if(Sessions::verificarSesion()){
				echo '<script languaje="javascript">location.href = "usuarios.php";</script>';
			}
		}
    //En caso de no tener la sesión activa lo envia a la página de login
	static function redireclogin(){
        echo '<script languaje="javascript">location.href = "index.php";</script>';
    }   
    //Funcion llave para validar la sesión valida
    static function keySesionCreate($UsuarioID){
        $today = date('Ymd');
        $llavePrivada = "051093";
        if(isset($UsuarioID)){
            $_SESSION['keysession'] = sha1($UsuarioID.$today.$llavePrivada);
        }else{
            $_SESSION['keysession'] = 0;
        }
        return $_SESSION['keysession'];
    }
    //Funcion para habilitar funciones, niveles de usuario y permisos de usuario
	static function loadvarsesion($tipoUsuario){
		//1.Super Administrador - root
		//2.Administrador - admin
		//3.Cliente - cliente
		switch ($tipoUsuario){
			case "1":
				$_SESSION['desctypeuser'] = "Super Administrador";
				$_SESSION['typeuser'] = "root";
				$_SESSION['permissions'] = array("usuarios" => "all");
			break;

			case "2":
				$_SESSION['desctypeuser'] = "Administrador";
				$_SESSION['typeuser'] = "admin";
				$_SESSION['permissions'] = array("usuarios" => "all", "colonos"=>"all", "alertas"=>"all", "wizard"=>"all","zonas" => "all","calles" => "all","reportes" => "all","direcciones"=>"all");
			break;


			default:
		}
    }
    
    static function validateType($usrType, $location){
		//1.Super Administrador - root
		//2.Administrador - admin
		//3.Guardia - guardia
		switch ($usrType){
			case "root":
				if(($location=="usuarios") or ($location=="usuarios") ){
				} else{
					echo '<script languaje="javascript">location.href = "usuarios.php";</script>';
				}
			break;

			case "admin":
				if(($location=="usuarios")or($location=="colonos")or($location=="direcciones") or ($location=="alertas") or ($location=="wizard") or ($location=="zonas") or ($location=="calles") or ($location=="reportes")){
				} else{
					echo '<script languaje="javascript">location.href = "usuarios.php";</script>';
				}
			break;

			
			break;

			default:
				echo '<script languaje="javascript">location.href = "index.php";</script>';
			break;

		}
	}
}
?>