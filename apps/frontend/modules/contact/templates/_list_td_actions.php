<td class="Actions">
    <?php if ($sf_user->hasCredential(array(0 => 'contact'))): ?>
        <nobr>
			
			          <?php if ($sf_user->hasCredential(array(  0 => 'order',))): ?><a href="<?php echo url_for('order/edit?id='.$client_contact->getOrder()->getId()) ?>"><img src="/magicLibsPlugin/grid/infosoft3/images/edit.png" /></a></nobr>
<?php endif; ?>

<?php if ($sf_user->hasCredential(array(  0 => 'contact',))): ?>
<?php echo $helper->linkToDeleteContact($client_contact, array(  'credentials' =>   array(    0 => 'contact',  ),  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'zxc',  'is_default_action' => true,  'label' => '<img src="/magicLibsPlugin/grid/infosoft3/images/delete.png" />','icon'=>'')) ?>
<?php endif; ?>
		</nobr>			
    <?php endif; ?>
</td>

