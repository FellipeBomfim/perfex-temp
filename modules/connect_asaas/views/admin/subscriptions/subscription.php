<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-5">
                <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-text-neutral-700">
                    <span>
                        <?php
                        echo isset($subscription) ? $subscription->name : _l('new_subscription'); ?>
                    </span>
                </h4>
                <div class="panel_s">
                    <div class="panel-body accounting-template">
                        <?php if (isset($subscription)) {
                            if (!empty($subscription->stripe_subscription_id)
                                && $subscription->status != 'canceled' && $subscription->status != 'incomplete_expired' && $subscription->status != 'incomplete') {
                                ?>
                                    <div class="alert alert-success">
                                        <b><?php echo _l('customer_is_subscribed_to_subscription_info'); ?></b><br />
                                        Subscription ID: <?php echo $subscription->stripe_subscription_id; ?>
                                    </div>
                                                <?php
                            } ?>
                        <input type="hidden" name="isedit">
                        <?php if (isset($subscription)) { ?>
                        <a href="#" class="btn btn-default" data-target="#subscription_send_to_client_modal"
                            data-toggle="modal">
                            <span class="btn-with-tooltip" data-toggle="tooltip"
                                data-title="<?php echo _l('send_to_email'); ?>" data-placement="bottom">
                                <i class="fa-regular fa-envelope"></i></span>
                        </a>
                        <a href="<?php echo  $subscription->asaas_subscription_link; ?>" class="btn btn-default"
                            target="_blank">
                            <?php echo _l('view_subscription'); ?>
                        </a>
                        <?php } ?>
                        <hr />
                        <?php
} ?>
                        <?php $this->load->view('connect_asaas/admin/subscriptions/form'); ?>
                    </div>
                </div>
            </div>
            <?php
            if (isset($subscription)) { ?>
            <div class="col-md-7">
                <div class="panel_s tw-mt-10">
                    <div class="panel-body">
                        <div class="horizontal-scrollable-tabs preview-tabs-top panel-full-width-tabs">
                            <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                            <div class="horizontal-tabs">
                                <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#upcoming_invoice" aria-controls="upcoming_invoice" role="tab"
                                            data-toggle="tab">
                                            <?php echo _l('upcoming_invoice'); ?>
                                        </a>
                                    </li>
                                    <li role="presentation" class="tab-separator">
                                        <a href="#child_invoices" aria-controls="child_invoices" role="tab"
                                            data-toggle="tab">
                                            <?php echo _l('child_invoices'); ?>
                                        </a>
                                    </li>
                                    <li role="presentation" data-toggle="tooltip"
                                        title="<?php echo _l('emails_tracking'); ?>" class="tab-separator">
                                        <a href="#tab_emails_tracking" aria-controls="tab_emails_tracking" role="tab"
                                            data-toggle="tab">
                                            <?php if (!is_mobile()) { ?>
                                            <i class="fa-regular fa-envelope-open" aria-hidden="true"></i>
                                            <?php } else { ?>
                                            <?php echo _l('emails_tracking'); ?>
                                            <?php } ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active tw-py-2" id="upcoming_invoice">

                                <?php if ($subscription->status != 'canceled') { ?>
                                <?php } elseif (!empty($subscription->stripe_subscription_id) && $subscription->status == 'canceled') { ?>
                                <div class="alert alert-info mtop15">
                                    <a href="https://stripe.com/docs/subscriptions/canceling-pausing#reactivating-canceled-subscriptions"
                                        target="_blank"><i class="fa fa-link"></i></a>
                                    <?php echo _l('subscription_is_canceled_no_resume'); ?>
                                </div>
                                <?php } elseif (!empty($subscription->stripe_subscription_id) && $subscription->status == 'incomplete_expired') { ?>
                                <div class="alert alert-warning mtop15">
                                    <a href="https://stripe.com/docs/billing/lifecycle#incomplete" target="_blank"><i
                                            class="fa fa-link"></i></a>
                                    <?php echo _l('subscription_is_subscription_is_expired'); ?>
                                </div>
                                <?php } elseif (empty($subscription->stripe_subscription_id)) { ?>
                                <div class="alert alert-info mtop15 no-mbot">
                                    <?php echo _l('subscription_not_yet_subscribed'); ?>
                                </div>
                                <?php } ?>
                                <?php
                                if(isset($upcoming_invoice)){
                                 $this->load->view('admin/invoices/invoice_preview_html', ['invoice' => $upcoming_invoice]);
                                }
                                ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="child_invoices">
                                <?php if (count($child_invoices)) { ?>
                                <h4 class="tw-font-medium tw-text-base tw-my-2"><?php echo _l('invoices'); ?></h4>

                                <ul class="list-group">
                                    <?php foreach ($child_invoices as $invoice) { ?>
                                    <li class="list-group-item">
                                        <a href="<?php echo admin_url('invoices/list_invoices/' . $invoice->id); ?>"
                                            target="_blank"><?php echo format_invoice_number($invoice->id); ?>
                                            <span class="pull-right bold">
                                                <?php echo app_format_money($invoice->total, $invoice->currency_name); ?>
                                            </span>
                                        </a>
                                        <br />
                                        <span class="inline-block mtop10">
                                            <?php echo '<span class="bold">' . _d($invoice->date) . '</span>'; ?><br />
                                            <?php echo format_invoice_status($invoice->status, '', false); ?>
                                        </span>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } else { ?>
                                <div class="alert alert-info no-mbot mtop15">
                                    <?php echo _l('no_child_found', _l('invoices')); ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div role="tabpanel" class="tab-pane ptop10" id="tab_emails_tracking">
                                <?php
                    $this->load->view(
                    'admin/includes/emails_tracking',
                    [
                      'tracked_emails' => get_tracked_emails($subscription->id, 'subscription'), ]
                );
                  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php if (isset($subscription)) { ?>
<?php $this->load->view('admin/subscriptions/send_to_client'); ?>
<?php } ?>
<?php init_tail(); ?>
<script>
$(function() {
    // Project ajax search
    init_ajax_project_search_by_customer_id();
    appValidateForm('#subscriptionForm', {
        name: 'required',
        clientid: 'required',
        stripe_plan_id: 'required',
        currency: 'required',
        quantity: {
            required: true,
            min: 1,
        }
    });

    <?php if (!isset($subscription) || (isset($subscription) && empty($subscription->stripe_subscription_id))) { ?>

    checkFirstBillingDate($('#stripe_plan_id').selectpicker('val'));

    $('#stripe_plan_id').on('change', function() {
        var selectedPlan = $(this).val();
        checkFirstBillingDate(selectedPlan);
        var selectedOption = $('#stripe_plan_id').find('option[value="' + selectedPlan + '"]');
        var interval = selectedOption.data('interval');
        var $firstBillingDate = $('#date');
        var firstBillingDate = $firstBillingDate.val();
        if (interval == 'month') {
            var currentDate = moment().add(1, 'day').format('YYYY-MM-DD');
            var futureMonth = moment(currentDate).add(selectedOption.data('interval-count'), 'M');
            $firstBillingDate.attr('data-date-end-date', futureMonth.format('YYYY-MM-DD'));
            $firstBillingDate.datetimepicker('destroy');
            init_datepicker($firstBillingDate);
        }
    });
    <?php } ?>

    $('#subscriptionForm').on('dirty.areYouSure', function() {
        $('#prorateWrapper').removeClass('hide');
    });

    $('#subscriptionForm').on('clean.areYouSure', function() {
        $('#prorateWrapper').addClass('hide');
    });

});

function checkFirstBillingDate(selectedPlan) {
    if (selectedPlan == '') {
        return;
    }
    var interval = $('#stripe_plan_id').find('option[value="' + selectedPlan + '"]').data('interval');
    if (interval == 'week' || interval == 'day') {
        $('#first_billing_date_wrapper').addClass('hide');
        $('#date').val('');
    } else {
        $('#first_billing_date_wrapper').removeClass('hide');
    }
}
</script>
