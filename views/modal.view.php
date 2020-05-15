<!-- MODAL LOGIN -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
            <form id="frmLogin" autocomplete="false">


                    <div class="form-group">
                        <label for="">Usuario:</label>
                        <input type="text" class="form-control" id="txtLoginUsuario" required>
                    </div>

                    <div class="form-group">
                        <label for="">Clave:</label>
                        <input type="password" class="form-control" id="txtLoginClave" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="btnLogin">Login</button>
                    </div>

            </form>
            
      </div>
      <!-- <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-block" id="btnLogin">Login</button>
      </div> -->
    </div>
  </div>
</div>

<!-- MODAL REGISTRO -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalRegistro" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center" id="myModalLabel">Registro</h4>
      </div>
      <div class="modal-body">
            <form id="frmRegistro">


                    <div class="form-group col-lg-12">
                        <label for="">Apellidos:</label>
                        <input type="text" class="form-control" id="txtRegistroApellidos" required>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="">Nombres:</label>
                        <input type="text" class="form-control" id="txtRegistroNombres" required>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="">Telefono:</label>
                        <input type="tel" class="form-control" id="txtRegistroTelefono" >
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="">Correo:</label>
                        <input type="email" class="form-control" id="txtCorreoRegistro" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Clave:</label>
                        <input type="password" class="form-control" id="txtClave1Registro" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="">Confirmacion de Clave:</label>
                        <input type="password" class="form-control" id="txtClave2Registro" required>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" id="btnRegistrarUsuario">Registrarme</button>
                    </div>


            </form>
            
      </div>
      
    </div>
  </div>
</div>