<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if ($form->hasGlobalErrors()): ?>
  <div class="Error">
    <?php echo $form->renderGlobalErrors() ?>
  </div>
<?php endif; ?>

<?php echo form_tag_for($form, '@client_contact', array('enctype'=> "multipart/form-data", 'id' => 'client_contact_form')) ?>
  <table cellspacing="0" class="GridForm">
	<tr>
		<td>Дата создания контакта</td>
		<td><?php echo $client_contact->getCreatedAt() ?></td>
	</tr>
    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('contact/form_fieldset', array('client_contact' => $client_contact, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'cultures_enabled' => true)) ?>
    <?php endforeach; ?>
	<?php if (!$form->isNew()): ?>
	<tr>
		<td>Контакты с клиентом</td>
			<td>
				<table>
					<tr>
						<td>
							Дата создания контакта
						</td>
						<td>
							Дата повторного контакта
						</td>		
						<td>
							Статус
						</td>						
						<td>
							Комментарий
						</td>												
					</tr>
					<?php foreach($other_contacts as $oc): ?>
						<tr>
							<td><?php echo $oc->getCreatedAt()?></td>
							<td><?php echo $oc->getContactDate()?></td>
							<td><?php echo $oc->getContactStatus()?></td>
							<td><?php echo $oc->getComment()?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</td>		
	</tr>
	<?php if ($sf_user->hasCredential('order') && 1==0): ?>
	<tr>
		<td colspan="2">
			<?php echo link_to('Заказы клиента', 'order_by_client',array('id_client'=>$client_contact->getClientId())) ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
    <tr>
      <td colspan="2" align="center" style="text-align: center">
        <?php include_partial('contact/form_actions', array('client_contact' => $client_contact, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>  
      </td>
    </tr>
  </table>
  <?php echo $form->renderHiddenFields(false) ?>
</form>


