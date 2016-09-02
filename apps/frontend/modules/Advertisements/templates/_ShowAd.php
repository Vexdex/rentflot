<?php if($message!=""):?>
<div style="border: solid 2px #f08b53;padding: 10px;border-radius: 10px;background: #f9e08c; margin: auto; width:60%;">
  <a style="font-size: 110%;color: #d8261a; text-decoration: none; border-bottom: none;" href="<?php echo url_for('adv/index?slug='.$slug) ?>">
    <?php
      echo str_replace("\n","<br/>",$message);
    ?>
  </a>
</div>
<?php endif;?>