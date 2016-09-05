<table>
    <tr>
    <?php foreach ($contacts_flash as $key => $contact_user): ?>
                    <!-- 2016/09/03 vexdex before 
                    	<td>
                    -->
                    <!-- 2016/09/03 vexdex after [ --> 
			<td style="padding-right: 10px">
					<strong>
						<?php echo $contact_user["user_name"] ?>
					</strong><br/>
                     <!-- 2016/09/03 vexdex after ] -->                     
					<?php foreach ($contact_user["contacts"] as $key => $contact): ?>                                        
						<span style="background-color:#FFCECE;">
                                                    <a href="<?php echo url_for('order/show?id='.$contact["order_id"]); ?>">
							<?php echo substr($contact["contact_time"],0,5) ?>
                                                    </a>                                                    	
						</span>
                                                &nbsp;
					<?php endforeach ?>
				
			</td>
                        
                        <td>
					<strong>
						<?php echo $contact_user["user_name"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</strong><br/>
					<?php foreach ($contact_user["contacts"] as $key => $contact): ?>
						<span style="background-color:#FFCECE;">
						<a href="<?php echo url_for('order/show?id='.$contact["order_id"]); ?>">
							<?php echo substr($contact["contact_time"],0,5) ?>
						</a>
						</span>&nbsp;
					<?php endforeach ?>
				
			</td>
                        
                        
		<?php endforeach ?>
	</tr>
	<tr>
		<?php foreach ($calls_list as $key => $call): ?>
			<td>
				<span style="background-color:gold;">
				<a href="<?php echo url_for('callback/show?id='.$call["id"]); ?>">
					<?php echo $call["phone"]; ?> (<?php //echo $call["created_at"]; 
						echo date('d-m-Y H:i', strtotime($call["created_at"]));
					?>)
				</a>
				</span>&nbsp;			
			</td>
		<?php endforeach ?>
	</tr>
</table>
<div class="AdminMenu">
  <?php if (count($menu1->getRawValue())): ?><?php echo implode(' &bull; ', $menu1->getRawValue()) ?><br/><?php endif ?>
  <?php if (count($menu2->getRawValue())): ?><?php echo implode(' &bull; ', $menu2->getRawValue()) ?><br/><?php endif ?>
  <br/><?php if ($sf_user->hasCredential('order')): ?><?php echo admin_menu_item('Новый заказ', 'order_new', 'id="new_order"') ?> &bull; <?php endif ?><?php echo admin_menu_item('Просмотр сайта', '@homepage', 'target="_blank" class="extern"') ?>&nbsp;&nbsp;&nbsp;<span class="Version">Версия системы: <?php echo sfConfig::get('app_version') ?></span>
</div>