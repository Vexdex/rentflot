<?php if ($form->hasGlobalErrors()): ?>
  <div class="Error">
    <?php echo $form->renderGlobalErrors() ?>
  </div>
<?php endif; ?>

<style type="text/css">
  .ui-datepicker {
    font-size: 1.2em;
  }
  
  .wallpapered {
    position: relative;
}
.wallpapered textarea {
    width: inherit;
    height: inherit;
}
.wallpapered .background {
    position: absolute;
    top: 146;
    left: 8;
    color: gray;
}
</style>

<center>
  <table class="FrontendForm">
    <tr>
      <th class="Title"><?php /*echo __('list_order_items', array(), 'order')*/ ?></th>
      <td style="vertical-align: top; padding-top: 9px"><strong><?php echo $item->getName() ?></strong>  <?php /*echo "&mdash;";echo $category->getName()*/ ?></td>
    </tr>
    <?php foreach ($form as $name => $field): ?>
    <?php if (!$form[$name]->isHidden()): ?>
      <tr>
        <th class="Title" style="white-space: nowrap"><?php echo $form[$name]->renderLabel(__('form_'.$name, array(), 'order')) ?><?php if ($form->getValidator($name)->getOption('required')): ?><span class="Required">*</span><?php endif ?></th>
        <td>
		  <div class="wallpapered">
          <?php echo $form[$name]->render(array('class' => $name == 'additional_information' ? 'Textarea' : 'Input')) ?>
		  <?php if($name=='additional_information'): ?>
			 <div class="background">
                                <?php echo __('bg_text_online_order', array(), 'order'); ?>
			</div>
		  <?php endif ?>
          <?php if ($name == 'time_from' || $name == 'time_to'): ?><span class="Help">точное или примерное время</span><?php endif ?>
          <?php if ($name == 'people_count'): ?><span class="Help">от-до</span><?php endif ?>
          <?php if ($form[$name]->hasError()): ?>
          <div class="Error"><?php echo __($form[$name]->getError()->getMessageFormat(), $form[$name]->getError()->getArguments(), 'grid') ?></div>
          <?php endif ?>
		  </div>
        </td>
      </tr>
      <?php endif ?>
    <?php endforeach ?>
  </table>
</center>