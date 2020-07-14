<div class="modal fade" id="modal-search">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <input id="u-name" type="hidden" value="">
                  
                <h4 id="modal-heading" class="modal-title"></h4>
                 <input type="hidden" name="_tokent" value="<?php echo csrf_token(); ?>" id="tok">
                <input id="save-id" type="hidden" value=""></input>
                <input id="hidden-id" type="hidden" value=""></input>
              </div>
              <div id="modal-body" class="modal-body">
              
              </div>
               
              <div class="modal-footer">
                <ul id="selected-per"></ul>
                <div id="foot">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button id="modal-save" type="button" onclick="save()" class="btn btn-primary">Save changes</button> -->
                </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->