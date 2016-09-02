<?php echo $client->getFullName() ?>
<br />
<?php echo str_replace("\n", '<br />', $client->getPhones()) ?>