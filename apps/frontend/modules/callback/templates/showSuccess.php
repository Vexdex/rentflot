<h1>
  Информация по заказанному звонку
</h1>

<form action="<?php echo url_for('callback/done?id='.$call->getId()) ?>" method="POST" style="width: 100%;">
  <center>
	<table>
		<tr>
			<td>
				<div style="display: inline;"><?php echo __('phone', null, 'call') ?></div>
			</td>
			<td>
				<span placeholder="Телефон" class="ContactPhone" name="phone" id="phone"  style="width: 250px;
				height: 30px;
				border-radius: 3px;
				border: 1px solid #C5C8CA;
				padding: 2px 7px;
				outline: 0px none;
				background-color: #FFF;
				margin-top: 0px;
				margin-left: 20px;"><?php echo $call->getPhone(); ?></span>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>
				<div style="display: inline;">Время поступления звонка</div>
			</td>
			<td>
				<span placeholder="Телефон" class="ContactPhone" name="phone" id="phone"  style="width: 250px;
				height: 30px;
				border-radius: 3px;
				border: 1px solid #C5C8CA;
				padding: 2px 7px;
				outline: 0px none;
				background-color: #FFF;
				margin-top: 0px;
				margin-left: 20px;"><?php echo $call->getCreatedAt(); ?></span>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>		
	</table>
    <p style="color:red;">После того, как будет потверждено проведение звонка, он будет удален!</p>
    <input type="submit" value="Звонок проведен" style="font-family: Arial,Helvetica,sans-serif;
height: 26px;
line-height: 26px;
text-decoration: none;
padding: 0px 5px;
border-radius: 4px;
background-color: #FFF;
font-weight: bold;
font-size: 13px;
cursor: pointer;
bottom: 40px;
right: 102px;
border: 1px solid #8E4702;
color: #8E4702;" id="sub"/>
  </center>
</form>