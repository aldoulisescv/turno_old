<?php
/*
 * CREATOR: VELEZOFT
 * DEVELOPER: ALDO ULISES CORNEJO VELEZ
 * DATE: 1/04/19
 * PROJECT: turno
 *
 * DESCRIPTION: Este archivo realiza todas las transacciones del módulo de establecimientos (altas,bajas,modificaciones,etc.)
 *
 */

$varUbicacion = 'securezone';
include_once("../class/class.brain.php");

$database = new db();
try {
    if(!empty($_POST)){            
        extract($_REQUEST);
        switch($cmd){
            case "registrarEstablecimiento":
                try {
                    $database->beginTransactionDB();
                    $establecimiento=array();
                    unset($_REQUEST['cmd']);
                    unset($_REQUEST['establecimiento']);
                    foreach ($_REQUEST as $key => $value) {
                        $establecimiento[]=$value;
                    }
                    $registrarEstablecimiento=$database->insertRow("INSERT into establecimientos(
                        pais,
                        latitud,
                        longitud,
                        usuarioEstablecimiento,
                        nombre, 
                        emailEstablecimiento,
                        telefonoEstablecimiento,
                        categoriaId,
                        subcategoriaId,
                        calle,
                        numeroExt,
                        numeroInt,
                        codigoPostal,
                        colonia,
                        estado,
                        ciudad)
                        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ", $establecimiento);
                    if($registrarEstablecimiento==true){
                        $getEstabLastId=$database->lastIdDB();
                            $ConsultarGetEstable="SELECT u.usuarioId, u.estatus,u.tipoUsuarioId,u.username,u.nombre,u.apellidos,u.password,u.email,u.telefono,u.fecha_registro,
                            e.establecimientoId FROM 	usuarios as u INNER JOIN establecimientos as e on u.usuarioId = e.usuarioEstablecimiento WHERE e.establecimientoId = ? ";
                            $getEstab=$database->getRow($ConsultarGetEstable,array($getEstabLastId));
                            if($getEstab==true){
                                $database->commitDB();
                                session_start();
                                $_SESSION["EstablecimientoId"]=$getEstabLastId;
                                $_SESSION["UsuarioID"] = $getEstab['usuarioId'];
                                $_SESSION["UsuarioNombre"] = $getEstab['nombre']." ".$getEstab['apellidoPaterno'];
                                $_SESSION["UsuarioEmail"] = $getEstab['email'];
                                $_SESSION["EstablecimientoID"]=$getEstab['establecimientoId'];
                                Sessions::loadvarsesion($getEstab['tipoUsuarioId']);
                                //print_r($_SESSION);
                                echo "1";
                            }else{
                                $database->rollBackDB();
                                echo "0";
                            }
                    }else{
                        $database->rollBackDB();
                        echo "0";
                    }
                } catch (Exception $e) {
                    echo "0";
                }
                break;
            


        }
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>