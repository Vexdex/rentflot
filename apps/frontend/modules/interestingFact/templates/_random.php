<td valign="top" style="background-image: url(/images/interesting_facts/<?php echo $interesting_fact_key ?>.jpg); background-repeat: no-repeat; background-position: 25px bottom">
  <table cellpadding="0" cellspacing="0" border="0" height="100%">
		<tr><td valign="top" align="center" style="height: 30px; padding: 3px 0 0 2px; background: url(/images/bg/top.gif) no-repeat center top"><h1><?php echo sfContext::getInstance()->has('h1') ? sfContext::getInstance()->get('h1') : __('default_h1', null, 'meta') ?></h1></td></tr>
		<tr><td align="right" valign="middle" style="padding: 0px 25px 5px 235px; font-size: 10px;"><?php echo __($interesting_fact_key, null, 'interestingFacts') ?></td></tr>
	</table>
</td>