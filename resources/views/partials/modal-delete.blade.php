<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form class="m-2 p-4" id="deleteForm" action="" method="POST">
              <div class="modal-body">
                  @csrf
                  @method('DELETE')
                  <div class="alert alert-danger" role="alert">
                      Esta seguro que desea eliminar - <span id="Name"></span>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="buttonsend" type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
      </div>
    </div>
</div>
