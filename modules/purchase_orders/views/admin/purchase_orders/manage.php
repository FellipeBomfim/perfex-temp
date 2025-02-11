<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="panel-table-full">
                <div id="vueApp">
                    <?php $this->load->view('admin/purchase_orders/list_template'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
<script>
    var hidden_columns = [2, 5, 6, 8, 9];
</script>
<?php init_tail(); ?>
<script>
    $(function() {
        init_purchase_order();
    });
</script>
</body>

</html>