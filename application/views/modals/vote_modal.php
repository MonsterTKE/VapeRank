
<!-- Login modal -->

    <div class="modal hide" id="loginModal">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Login</h3>
    </div>
    <div class="modal-body" id="logModalBody">

    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
    </div>
    </div>

<script type="text/javascript">
$("#loginModalbutton").loginModal("#loginModalbutton", "#logModalBody");
</script>
<!-- Vote modal -->

<div class="modal hide fade" id="voteModal">
  <div class="modal-header">

    <div id="progress_bar" class="progress progress-striped active">
  <div class="bar"
       style="width: 100%;"></div>
</div>
    <button id="clearModalForm" type="button" class="close" data-dismiss="modal">×</button>
  </div>

<div class="modal-body">
     <div id="mod_alert" class="alert">
        <p id="modalH3">You just voted for </p>
     </div>
     <div id="voteModalBody">
     </div>
    <span id="chars-left"></span>
    <div class="modal-form">
    <form id="modal_form" class="well" name="modal_form" accept-charset="utf-8"/>
    <label for="f_textarea"><p id="chars-left"></p></label>
              <textarea  class="input-xlarge" placeholder="Leave a comment, good or bad." id="f_textarea" rows="3"></textarea>
      <button type="submit" class="btn" id="f_submit">comment</button>
    </form>
  </div>
  </div>
  <div class="modal-footer">
    <a href="#" id="clearModalForm" class="btn" data-dismiss="modal">Close window</a>
  </div>
</div>

<script type="text/javascript">
$("textarea#f_textarea").textAreaLimit(500, "#chars-left");
</script>

