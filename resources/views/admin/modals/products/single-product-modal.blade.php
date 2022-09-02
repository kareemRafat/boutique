<!-- Modal -->
<div class="modal fade" id="single-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"><!-- modal-dialog-centered -->
      <div class="modal-content">
                <div class="overlay">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete product Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="container">
                <div class="row">
                    <div class="col-12">
                      <!-- Custom Tabs -->
                      <div class="card" style="box-shadow: none">
                        <div class="card-header d-flex p-0">
                          <ul class="nav nav-pills mr-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Attachments</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Description</a></li>
                          </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <form action="" class="update-img-form">
                                    <div class="input-group mt-2 mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </form>
                                <small class="text-danger font-weight-bold input-image"></small>
                              <table class="table table-hover table-striped table-sm image-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                              </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane desc-tab" id="tab_2">
                             
                            </div>
                            <!-- /.tab-pane -->
                          </div>
                          <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                      </div>
                      <!-- ./card -->
                    </div>
                    <!-- /.col -->
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
      </div>
  </div>
</div>
