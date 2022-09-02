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
                              The European languages are members of the same family. Their separate existence is a myth.
                              For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                              in their grammar, their pronunciation and their most common words. Everyone realizes why a
                              new common language would be desirable: one could refuse to pay expensive translators. To
                              achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                              words. If several languages coalesce, the grammar of the resulting language is more simple
                              and regular than that of the individual languages.
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
                  <button type="submit" class="btn btn-danger delete-product-btn">confirm</button>
              </div>
      </div>
  </div>
</div>
