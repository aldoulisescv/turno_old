<?php
/*
* CREATOR: VELEZOFT
 * DEVELOPER: ALDO ULISES CORNEJO VELEZ
 * DATE: 07/04/19
 * PROJECT: turno
 *
 * DESCRIPTION:Muestra el contenido más importante del módulo de recusos tales como: Los modales de los formularios de registro y edición de srecursoes, así como los el datatable (solo encabezados y pies)
 *
 */
class MostrarRecursop{


    public static function modalRecurso($action, $name){
        echo '<div class="modal fade slide-up disable-scroll modalrecurso" id="form'.$name.'Recurso" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
          <div class="modal-content-wrapper">
            <div class="modal-content">
              <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5>'.$name.' Recurso</h5>
                <p class="p-b-10">Formulario de recursos</p>
              </div>
              <div class="modal-body">
                <!-- START PANEL -->
                <div class="panel panel-transparent">
                  <div class="panel-body">
                    <form role="form" class="formRecurso" id="formRecurso'.$action.'" autocomplete="off" novalidate="novalidate">
                      <input type="hidden" name="establecimientoId'.$action.'" id="establecimientoId'.$action.'" value="'.$_SESSION['EstablecimientoID'].'">
                      <input type="hidden" name="cmd" value="recurso'.$name.'">
                      <input type="hidden" name="recursoId'.$action.'" id="recursoId'.$action.'">
                      <p>Datos principales</p>
                      <div class="form-group-attached">
                        <div class="row clearfix">
                          <div class="col-sm-12">
                              <div class="form-group form-group-default required" aria-required="true" data-toggle="tooltip" data-placement="top" title="Este es el nombre">
                                  <label >Nombre</label>
                                  <input type="text" class="form-control" name="recursoNombre'.$action.'" id="recursoNombre'.$action.'" required="" aria-required="true" style="
                                  height: 38px;
                              ">
                              </div>
                          </div>
                        </div>
                        <div class="row clearfix">
                          <div class="col-sm-6">
                              <div class="form-group p-b-10 p-t-10 form-group-default required" aria-required="true" data-toggle="tooltip" data-placement="top" title="Este es el nombre">
                                <div id="divstatus1'.$action.'" style="display: block;"><label class="inline" style="margin-top: 15px; margin-left: 12px" id="estatusSeleccionable1" name="estatusSeleccionable1">Seleccionable</label></div>
                                <div id="divstatus2'.$action.'" style="display: none;"><label class="inline" style="margin-top: 15px; margin-left: 12px" id="estatusSeleccionale2" name="estatusSeleccionale2">No Seleccionable</label></div>
                                <span class="input-group-addon bg-transparent">
                                  <div class="lcs_wrap">
                                    <input name="seleccionables'.$action.'" id="seleccionables'.$action.'" class="lcs_check'.$action.'" type="checkbox">
                                    <div class="lcs_switch  lcs_checkbox_switch lcs_on">
                                      <div class="lcs_cursor"></div>
                                    </div>
                                  </div>
                                </span>
                                <input type="hidden" name="seleccionable'.$action.'" id="seleccionable'.$action.'"/>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group form-group-default required" aria-required="true" data-toggle="tooltip" data-placement="top" title="Este es el nombre">
                                  <label >Orden Alfabético</label>
                                  <select title="" tabindex="-1" class="full-width select2-offscreen" data-placeholder="Selecciona una opción" data-init-plugin="select2" name="orden_alfa'.$action.'" id="orden_alfa'.$action.'" required>
                                    <option></option>  
                                    <option value="asc">Ascendente (A-Z)</option>
                                    <option value="desc">Descendente (Z-A)</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-6  m-t-10 sm-m-t-10">
                          <div class="pull-left">
                            <button class="btn btn-primary btn-lg" type="submit">
                            <span class="glyphicon glyphicon-floppy-save"></span> Guardar
                            </button>
                          </div>
                        </div>
                        <div class="col-sm-6 m-t-10 sm-m-t-10">
                          <div class="pull-right">
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove-sign"></span> Cerrar
                            </button>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div id="mensajeGuardadoUsuario"></div>
                    </form>
                  </div>
                </div>
                <!-- END PANEL -->
              </div>
            </div>
          </div>
          <!-- /.end modal-content -->
        </div>
      </div>       ';
    }
}