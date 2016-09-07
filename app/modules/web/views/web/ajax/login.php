<div class="modal-dialog modal-sm">
  <form action='<?php echo $url->route('@web.login');?>' method='post'>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='fa fa-key'></span> Security Checkpoint</h4>
      </div>
      <div class="modal-body">
        <p>It's locked for security sake.</p>
        <div class='form-group'>
          <label>Password</label>
          <?php echo $form->password('password')->attr('class="form-control"');?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </div><!-- /.modal-content -->
  </form>
</div>