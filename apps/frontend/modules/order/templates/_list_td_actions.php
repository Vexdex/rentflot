<td class="Actions">
    <?php if ($sf_user->hasCredential(array(0 => 'order'))): ?>
        <nobr><a href="<?php echo url_for('order/show?id='.$order->getId()) ?>"><img src="/magicLibsPlugin/grid/infosoft3/images/view.png" /></a>&nbsp;<a href="<?php echo url_for('order/edit?id='.$order->getId()) ?>"><img src="/magicLibsPlugin/grid/infosoft3/images/edit.png" /></a></nobr>
    <?php endif; ?>
</td>

