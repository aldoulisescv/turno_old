<?php
/*
 * CREATOR: VELEZOFT
 * DEVELOPER: ALDO ULISES CORNEJO VELEZ
 * DATE: 25/03/19
 * PROJECT: turno
 *
 * DESCRIPTION: Este archivo realiza todas las transacciones del módulo de turnos (altas,bajas,modificaciones,etc.)
 *
 */

$varUbicacion = 'securezone';
include_once("../class/class.brain.php");

$database = new db();
try {
if(!empty($_POST)){
   
    extract($_REQUEST);
        switch($cmd){
            case 'cambiarEstatusTurno':
                $editarDatosElement="UPDATE turnos set 
                estatusId='".$estatus."'
                    where turnoId=?";
        
                $editElementData=$database->updateRow($editarDatosElement,array($turnoId));
                //print_r($recursoIdEdit);
                if($editElementData==true){
                    $ConsultarGetElement="SELECT  *
                        FROM turnos                                            
                        where turnoId=?";
                    $GetElement=$database->getRow($ConsultarGetElement,array($turnoId));
                    if($GetElement==true){
                        $jsonElement=json_encode($GetElement);
                        echo $jsonElement;
                    }else{
                        echo "0";
                    }
                }else{
                    echo "0";
                }
                break;
            case 'getDataTurno':
                $sql="SELECT t.turnoId, t.usuarioId, t.recursoId, t.tipoSesionId, t.estatusId, t.fecha, t.horaInicio, t.horaFin,
                        u.nombre, u.apellidos, u.usuarioId,
                        r.nombre as rNombre, ts.nombre as tsNombre, e.nombre as eNombre
                        FROM turnos as t
                        INNER JOIN usuarios as u on u.usuarioId=t.usuarioId
                        INNER JOIN recursos as r on r.recursoId=t.recursoId
                        INNER JOIN tiposSesiones as ts on ts.tipoSesionId=t.tipoSesionId
                        INNER JOIN estatus as e on e.idestatus= t.estatusId
                        WHERE 1
                        and t.turnoId=?";
                $getElements = $database->getRow($sql, array( $turno));
                $jsonElements=json_encode($getElements);
                echo $jsonElements;
            break;
            case 'getTurnosHoy':
                $sql="SELECT t.turnoId, t.establecimientoId, u.username, t.estatusId, s.nombre as servicio, r.nombre as nombreRecurso,
                t.usuarioId,concat(u.nombre, ' | ',s.nombre ) as descripcion,  t.recursoId, t.tipoSesionId, t.fecha, t.horaInicio, t.horaFin, e.nombre as estatus
                FROM turnos as t 
                INNER JOIN usuarios as u on u.usuarioId=t.usuarioId
                INNER JOIN tiposSesiones as s on s.tipoSesionId=t.tipoSesionId
                INNER JOIN estatus as e on e.idestatus= t.estatusId 
                INNER JOIN recursos as r on r.recursoId=t.recursoId
                where t.estatusId <> '4' and t.establecimientoId = ".$establecimiento." 
                and t.fecha = ? ";
                $sql.=(isset($recurso))?"and t.recursoId = ".$recurso:"";
                $getElements = $database->getRows($sql, array( $date));
                $jsonElements=json_encode($getElements);
                echo $jsonElements;
            break;
            case 'registrarTurno':
                $database->beginTransactionDB();
                $newElement=array();
                $newElement[0]=$establecimientoId;
                $newElement[1]=$recursoId;
                $newElement[2]=$tipoSesionId;
                $newElement[3]=$usuarioId;
                $newElement[4]=$horaInicio;
                $newElement[5]=$horaFin;
                $newElement[6]=$fecha;
                $newElement[7]=$estatusId;
                $registrarElement=$database->insertRow("INSERT into turnos(
                                                establecimientoId, 
                                                recursoId,
                                                tipoSesionId,
                                                usuarioId,
                                                horaInicio,
                                                horaFin,
                                                fecha,
                                                estatusId
                                                ) 
                                                values(?,?,?,?,?,?,?,?)",$newElement);
                if($registrarElement==true){
                    $getElementLastId=$database->lastIdDB();
                    $ConsultarGetElement="SELECT  *
                                            FROM turnos                                              
                                            where turnoId=?";
                    $GetElement=$database->getRow($ConsultarGetElement,array($getElementLastId));
                    if($GetElement==true){
                        $database->commitDB();
                        $jsonElement=json_encode($GetElement);
                        echo $jsonElement;
                    }else{
                        $database->rollBackDB();
                        echo "0";
                    }
                }else{
                    $database->rollBackDB();
                    echo "0";
                }
                break;
            


         }



}
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>
