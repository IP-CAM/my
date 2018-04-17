<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-feedback').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <style type="text/css">
        #reply_form{
            width: 500px;
            height:300px;
            position: absolute;
            top:300px;
            left:700px;
            background-color: #ffffff;
            display: none;
        }

      </style>
      <div id="reply_form"align="center">
          <input type="hidden" id="save_feedback_email">
          <input type="hidden" id="save_feedback_id">
          <textarea cols="75" rows="10" id="reply_content"></textarea>
          <button id="submit_reply" onclick="reply()">回复</button>

      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-feedback">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">
                    <?php echo $column_email; ?>
                    </td>
                  <td class="text-left">
                   <?php echo $column_content; ?>
                    </td>
                  <td class="text-right">
                    <?php echo $column_status; ?>
                  </td>
                  <td class="text-left">
                    <?php echo $column_created; ?>
                   </td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($feedbacks) { ?>
                <?php foreach ($feedbacks as $f) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($f['feedback_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $f['feedback_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $f['feedback_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $f['email']; ?></td>
                  <td class="text-left"><?php echo $f['content']; ?></td>
                  <td class="text-right"><?php echo $f['status']; ?></td>
                  <td class="text-left"><?php echo $f['created']; ?></td>
                  <td class="text-right"><i class="fa fa-pencil" onclick="show_reply(<?php echo $f['feedback_id']; ?>)"></i></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
		    $session_data = $_SESSION;
		    foreach ($session_data as $v){
            $keys_arr = array_keys($v);
                if(in_array('token',$keys_arr)){
                    $url_token = $v['token'];
                    break;
                };
            }
		?>
<script type="text/javascript">
    function show_reply(id) {
        $("#save_feedback_id").val(id);
        //$("#save_feedback_email").val(email);
       $("#reply_form")[0].style.display= 'block';
    };

    function reply() {
    var feedback_id =  $("#save_feedback_id").val();
    // var feedback_email =  $("#save_feedback_email").val();
     var content =  $("#reply_content").val();
      $.ajax({
        type: "POST",
        url: "index.php?route=marketing/feedback/reply&token=<?php echo $url_token;?>",
        data: {"feedback_id":feedback_id,"content":content},

        success: function (msg) {
         alert(msg);
          $("#reply_form")[0].style.display= 'none';
        },
        error:function(msg){
          $("#reply_form")[0].style.display= 'none';
        }
      });

    }
</script>
<?php echo $footer; ?>