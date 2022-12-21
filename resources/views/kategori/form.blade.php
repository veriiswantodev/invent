<div class="modal fade" id="modalForm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="" method="POST">
                  @method('post')
                  @csrf
                      <div class="form-group">
                          <label for="nama">Nama</label>
                          <input type="text" class="form-control" name="nama" id="nama">
                      </div>
                  <button type="submit" class="btn btn-success" id="simpan">Simpan</button>
          </form>
      </div>

  </div>

</div>
