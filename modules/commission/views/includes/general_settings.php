<?php defined('BASEPATH') or exit('No direct script access allowed');
$calculate_recurring_invoice = get_option('calculate_recurring_invoice');
$commission_program_is_applied = get_option('commission_program_is_applied');
?>
<?php echo form_open(admin_url('commission/reset_data')); ?>
<div class="row mbot10">
    <div class="col-md-12">
    	<button type="submit" class="btn btn-info _delete"><?php echo _l('reset_data'); ?></button> <label class="text-danger"><?php echo _l('reset_button_tooltip'); ?></label>
	</div>
</div>
<?php echo form_close(); ?>
<?php echo form_open(admin_url('commission/update_setting')); ?>

<div class="row">
    <div class="form-group col-md-12">
	<hr>
	  <label for="calculate_recurring_invoice"><?php echo _l('calculate_recurring_invoice'); ?></label><br />
	  <div class="radio radio-inline radio-primary">
	    <input type="radio" name="calculate_recurring_invoice" id="calculate_recurring_invoice_yes" value="1" <?php if($calculate_recurring_invoice == 1){echo 'checked';} ?>>
	    <label for="calculate_recurring_invoice_yes"><?php echo _l("settings_yes"); ?></label>
	  </div>
	  <div class="radio radio-inline radio-primary">
	    <input type="radio" name="calculate_recurring_invoice" id="calculate_recurring_invoice_no" value="0" <?php if($calculate_recurring_invoice == 0){echo 'checked';} ?>>
	    <label for="calculate_recurring_invoice_no"><?php echo _l("settings_no"); ?></label>
	  </div>
	</div>

    <div class="form-group col-md-12">
		<label for="commission_program_is_applied"><?php echo _l('commission_program_is_applied'); ?></label><br />
		  <div class="radio radio-inline radio-primary">
		    <input type="radio" name="commission_program_is_applied" id="commission_program_is_applied_latest_program" value="latest_program" <?php if($commission_program_is_applied == 'latest_program'){echo 'checked';} ?>>
		    <label for="commission_program_is_applied_latest_program"><?php echo _l("latest_program"); ?></label>
		  </div>
		  <div class="radio radio-inline radio-primary">
		    <input type="radio" name="commission_program_is_applied" id="commission_program_is_applied_all_programs" value="all_programs" <?php if($commission_program_is_applied == 'all_programs'){echo 'checked';} ?>>
		    <label for="commission_program_is_applied_all_programs"><?php echo _l("all_programs"); ?></label>
		  </div>
	</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
</div>
<?php echo form_close(); ?>
