
<script type="text/javascript">
$(document).ready(function() {
	$('.todo-list').sortable({
	    placeholder         : 'sort-highlight',
	    handle              : '.handle',
	    forcePlaceholderSize: true,
	    zIndex              : 999999,
	    update : function () {
		  	var order = $('.todo-list').sortable('serialize', { attribute: 'status-id' });
  		 	$.post("<?=base_url();?>/panel/settings/updatePosition?"+order);
	    }
	});
    $('.my-colorpicker1').colorpicker();
});

</script>



<div class="row">
  <div class="col-12">
    <div class="card">
<div class="card-header ui-sortable-handle" style="cursor: move;">
	  <h3 class="card-title"><?= lang('repair_statuses'); ?></h3>
	</div>
	<div class="card-body">
	  <ul class="todo-list ui-sortable">
	  	<?php foreach ($statuses as $status): ?>
	  		<li status-id="id_<?= $status->id; ?>">
				<span class="handle ui-sortable-handle">
					<i class="fa fa-ellipsis-v"></i>
					<i class="fa fa-ellipsis-v"></i>
				</span>
		     	<span class="text"><span class="label" style="font-size: 14px;background-color: <?= $status->bg_color; ?>; color: <?= $status->fg_color; ?>"><?= $status->label; ?></span></span>
		      	<div class="tools">
		        	<i data-dismiss="modal" id="modify" href="#status_modal" data-toggle="modal" data-num="<?= $status->id; ?>" class="fa fa-edit"></i>
		        	<i id="delete" data-num="<?= $status->id; ?>" class="fas fa-trash"></i>
		      	</div>
			</li>
	  	<?php endforeach; ?>
	  </ul>
	</div>
	<!-- /.box-body -->
	<div class="card-footer clearfix no-border">
	  <button type="button" class="btn btn-default pull-right" id="add_status"><i class="fa fa-plus"></i> <?= lang('add_status'); ?></button>
	</div>
	</div>
</div>
</div>


<!-- ============= MODAL MODIFICA CLIENTI ============= -->
<div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titrstat"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <p class="tips custip"></p>
                        <form id="status_form" class="col s12">
                    <div class="row">

                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                	<label><?= lang('label'); ?></label>
                                    <input id="label" name="label" type="text" class="validate form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 input-field">
                                <div class="form-group">
					                <label><?= lang('bg_color'); ?>:</label>
					                <input type="text" name="bg_color" id="bg_color" class="form-control my-colorpicker1 colorpicker-element" required>
					              </div>
                            </div>
                            <div class="col-md-12 col-lg-3 input-field">
                                <div class="form-group">
					                <label><?= lang('fg_color'); ?></label>
					                <input type="text" name="fg_color" id="fg_color" class="form-control my-colorpicker1 colorpicker-element" required>
					              </div>
                            </div>
	                        <div class="input-field col-lg-12">
	                            <div class="form-group">
				                  <div class="checkbox">
				                    <label>
				                      <input name="send_email" id="send_email" type="checkbox">
				                      <?= lang('send_mail'); ?>
				                    </label>
				                  </div>
				                  <div class="checkbox">
				                    <label>
				                      <input name="send_sms" id="send_sms" type="checkbox">
				                      <?= lang('send_sms'); ?>
				                    </label>
				                  </div>
				                  <div class="checkbox">
				                    <label>
				                      <input name="completed" type="hidden" value="0">
				                      <input name="completed" id="completed_status" type="checkbox" value="1">
				                      <?= lang('mark_as_completed'); ?>
				                    </label>
				                  </div>
				                </div>

	                        </div>

	                        <div style="display: none;" class="email_area input-field col-lg-6">
	                        	<h3><?=lang('email_templating');?></h3>
                                <div class="well">
                                    <dl class="dl-horizontal">
                                      <dt>%businessname% :</dt>
                                      <dd><?= lang('company_name'); ?></dd>

                                      <dt>%model% :</dt>
                                      <dd><?= lang('device_model'); ?></dd>

                                      <dt>%customer% :</dt>
                                      <dd><?= lang('client_name'); ?></dd>

                                      <dt>%site_url% :</dt>
                                      <dd><?= lang('hosted_url'); ?></dd>

                                      <dt>%statuscode% :</dt>
                                      <dd><?= lang('reparation_code'); ?></dd>

                                      <dt>%businesscontact% :</dt>
                                      <dd><?= lang('company_contact'); ?></dd>

                                      <dt>%id% :</dt>
                                      <dd><?= lang('rID'); ?></dd>
                                    </dl>
                                </div>
                                <div class="form-group">
	                            	<label><?= lang('email_subject');?></label>
	                            	<input type="text" name="email_subject" id="email_subject" class="form-control">
	                            </div>
	                            <div class="form-group">
	                            	<label><?= lang('email_text');?></label>
	                                <textarea class="form-control summernote" name="email_text" id="email_text" rows="6"></textarea>
	                            </div>
	                        </div>
	                        <div style="display: none;" class="sms_area input-field col-lg-6">
	                        	<div class="col-lg-12">
		                            <h3><?=lang('sms_templating');?></h3>
		                            <div class="well">
                                    <dl class="dl-horizontal">
	                                      <dt>%businessname% :</dt>
	                                      <dd><?= lang('company_name'); ?></dd>

	                                      <dt>%model% :</dt>
	                                      <dd><?= lang('device_model'); ?></dd>

	                                      <dt>%customer% :</dt>
	                                      <dd><?= lang('client_name'); ?></dd>

	                                      <dt>%site_url% :</dt>
	                                      <dd><?= lang('hosted_url'); ?></dd>

	                                      <dt>%statuscode% :</dt>
	                                      <dd><?= lang('reparation_code'); ?></dd>

	                                      <dt>%id% :</dt>
	                                      <dd><?= lang('rID'); ?></dd>
	                                    </dl>
	                                </div>
		                        </div>
	                            <div class="form-group">
	                            	<label><?= lang('sms_text');?></label>
	                                <textarea class="form-control" name="sms_text" id="sms_text" rows="6"></textarea>
	                            </div>
	                        </div>
                </div>
                        </form>
            </div>
            <div class="modal-footer" id="footerrStat">
                  <!--    -->
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#send_email').change(function() {
		if ($(this).prop('checked')) {
	    	$('.email_area').slideDown();
		    $('#email_text').prop('required', true);
		}else{
			$('.email_area').slideUp();
		    $('#email_text').prop('required', false);
		}
	});
	$('#send_sms').change(function() {
		if ($(this).prop('checked')) {
	    	$('.sms_area').slideDown();
		    $('#sms_text').prop('required', true);
		}else{
			$('.sms_area').slideUp();
		    $('#sms_text').prop('required', false);
		}
	});
});

jQuery("#add_status").on("click", function (e) {
	$('#status_form').trigger("reset");
    $('#status_form').parsley().reset();
    
    $('#status_modal').modal('show');
    $('#status_form').find("input").val("");
	jQuery('#send_sms').prop('checked', false);
	jQuery('#send_email').prop('checked', false);
	jQuery('.email_area').hide();
	jQuery('.sms_area').hide();
	jQuery('#email_text').prop('required', false);
	jQuery('#sms_text').prop('required', false);
    jQuery('#titrstat').html("<?= lang('add'); ?> <?= lang('repair_status'); ?>");
    jQuery('#footerrStat').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button role="button" form="status_form" id="submit" class="btn btn-success" data-mode="add"><i class="fa fa-user"></i> <?= lang("add"); ?> <?= lang('repair_status'); ?></button>');
});


jQuery(document).on("click", "#delete", function () {
	var div = $(this).parent().parent();
    var num = jQuery(this).data("num");
    jQuery.ajax({
        type: "POST",
        url: base_url + "panel/settings/statusDelete",
        data: "id=" + encodeURI(num),
        cache: false,
        dataType: "json",
        success: function (data) {
        	toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        	if (data.success) {
	            toastr['success']("<?= lang('status_deleted');?>");
	            div.remove();
	            var order = $('.todo-list').sortable('serialize', { attribute: 'status-id' });
	  		 	$.post("<?=base_url();?>/panel/settings/updatePosition?"+order);
        	}else{
	            toastr['error']("<?= lang('status_in_use');?>");
        	}
           
        }
    });
});

jQuery(document).on("click", "#modify", function () {
	$('#status_form').trigger("reset");
    $('#status_form').parsley().reset();
    
    jQuery('#titrstat').html('<?= lang('edit'); ?> <?= lang('repair_status');?>');
    var num = jQuery(this).data("num");
    jQuery.ajax({
	    type: "POST",
	    url: base_url + "panel/settings/getStatusByID",
	    data: "id=" + encodeURI(num),
	    cache: false,
	    dataType: "json",
	    success: function (result) {
        	jQuery('.email_area').hide();
        	jQuery('.sms_area').hide();
        	jQuery('#email_text').prop('required', false);
        	jQuery('#sms_text').prop('required', false);

	    	data = result.data;
	        jQuery('#label').val(data.label);
	        jQuery('#bg_color').val(data.bg_color);
	        jQuery('#fg_color').val(data.fg_color);
	        jQuery('#email_subject').val(data.email_subject);
	        send_email = data.send_email == "1" ? true : false;
	        send_sms = data.send_sms == "1" ? true : false;
	        completed = data.completed == "1" ? true : false;

	        jQuery('#send_email').prop('checked', send_email);
	        jQuery('#send_sms').prop('checked', send_sms);
	        jQuery('#completed_status').prop('checked', completed);
	        
	        if (send_email) {
	        	jQuery('.email_area').show();
	        	$('#email_text').summernote('destroy');
	        	jQuery('#email_text').val(data.email_text);
	        	$('#email_text').summernote();

	        	jQuery('#email_text').prop('required', true);
	        }
	        if (send_sms) {
	        	jQuery('.sms_area').show();
	        	jQuery('#sms_text').val(data.sms_text);
	        	jQuery('#sms_text').prop('required', true);

	        }
			jQuery('#footerrStat').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button id="submit" role="button" form="status_form" class="btn btn-success" data-mode="modify" data-num="' + encodeURI(num) + '"><i class="fa fa-save"></i> <?= lang("save"); ?> <?= lang('repair_status'); ?></button>')
        }
    });
});

$(function () {
	$('#status_form').parsley({
	    errorsContainer: function(pEle) {
	        var $err = pEle.$element.closest('.form-group');
	        return $err;
	    }
	}).on('form:submit', function(event) {
	    var mode = jQuery('#submit').data("mode");
	    var id = jQuery('#submit').data("num");
	    var url = "";
	    var dataString = $('#status_form').serialize();
	    if (mode == "add") {
	        url = base_url + "panel/settings/status_add";
	        jQuery.ajax({
	            type: "POST",
	            url: url,
	            data: dataString,
	            cache: false,
	            success: function (data) {
	                toastr['success']("<?= lang('repair_status_added');?>");
	                setTimeout(function () {
	                    $('#status_modal').modal('hide');
	                    window.location.reload();
	                }, 500);
	            }
	        });
	    } else {
	        url = base_url + "panel/settings/status_edit";
	        jQuery.ajax({
	            type: "POST",
	            url: url,
	            data: dataString + "&id=" + encodeURI(id),
	            cache: false,
	            success: function (data) {
	                toastr['success']("<?= lang('repair_status_edited');?>");
	                setTimeout(function () {
	                    $('#status_modal').modal('hide');
	                    window.location.reload();
	                }, 500);
	            }
	        });
	    }
	    return false;
	});
});
</script>