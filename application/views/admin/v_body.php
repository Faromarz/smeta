<?php if (isset($v_libs)): ?><?= $v_libs ?><?php endif; ?>
<?php if (isset($v_head)): ?><?= $v_head ?><?php endif; ?>
<div class="page-container">
    <?php if (isset($v_left_menu)): ?><?= $v_left_menu ?><?php endif; ?>
    <div class="page-content-wrapper">
        <div class="page-content" style="min-height:953px">
            <?php if (isset($v_page)): ?><?= $v_page ?><?php endif; ?>
        </div>
    </div>
</div>
<?php if (isset($v_footer)): ?><?= $v_footer ?><?php endif; ?>

<script>
    jQuery(document).ready(function() {
         Metronic.init(); // init metronic core components
        Layout.init();
    });
</script>