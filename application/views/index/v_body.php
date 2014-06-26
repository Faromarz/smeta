<?php if (isset($v_libs)): ?><?= $v_libs ?><?php endif; ?>
<div id="background<?php if(Request::initial()->controller() == 'Budget'):?>_budget<?php endif;?>">
    <div id="conteyner">
        <?php if (isset($v_head)): ?><?= $v_head ?><?php endif; ?>
        <?php if (isset($v_page)): ?><?= $v_page ?><?php endif; ?>
        <?php if (isset($v_footer)): ?><?= $v_footer ?><?php endif; ?>
    </div>
</div>
<?php if (isset($v_auth)): ?><?= $v_auth ?><?php endif; ?>
<?php if (isset($v_all_block)): ?><?= $v_all_block ?><?php endif; ?>
