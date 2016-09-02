<td class="BatchCheckbox">
  <input type="checkbox" [?php echo (!empty($batch_ids) && in_array($<?php echo $this->getSingularName() ?>->getPrimaryKey(), $sf_data->getRaw('batch_ids'))) ? 'checked="checked"': '' ?] name="ids[]" value="[?php echo $<?php echo $this->getSingularName() ?>->getPrimaryKey() ?]" class="sf_admin_batch_checkbox" />
</td>
