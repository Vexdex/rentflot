<?php /* @var Item $item */ ?>

<?php if ($form->hasGlobalErrors()): ?>
  <div class="Error">
    <?php echo $form->renderGlobalErrors() ?>
  </div>
<?php endif; ?>

<style type="text/css">
  .ui-datepicker {
    font-size: 1.2em;
  }
  
  .ui-datepicker a {
    border: none;
  }
</style>

<center>
<form method="post">
  <table class="FrontendForm">
    <tr>
      <th class="Title">Заказ</th>
      <td><strong><?php echo $item->getName() ?></strong> &laquo; <?php echo $category->getName() ?></td>
    </tr>
    <?php foreach ($form as $name => $field): ?>
      <?php if (!$form[$name]->isHidden()): ?>
        <tr>
          <th class="Title"><?php echo $form[$name]->renderLabel(__('form_'.$name, array(), 'order')) ?><?php if ($form->getValidator($name)->getOption('required')): ?><span class="Required">*</span><?php endif ?></th>
          <td>
            <?php echo $form[$name]->render(array('class' => $name == 'additional_information' ? 'Textarea' : 'Input')) ?>
            <?php if ($name == 'time_from'): ?><span class="Help">Можете указать примерное время</span><?php endif ?>
            <?php if ($form[$name]->hasError()): ?>
            <div class="Error"><?php echo __($form[$name]->getError()->getMessageFormat(), $form[$name]->getError()->getArguments(), 'grid') ?></div>
            <?php endif ?>
          </td>
        </tr>
      <?php endif ?>
    <?php endforeach ?>
    <tr>
      <td></td>
      <td style="padding: 10px">
        <input type="submit" class="Submit" value="Заказать" />
      </td>
    </tr>
  </table>
</form>
</center>