<h1>
  <?php echo __('h1', null, 'call') ?>
</h1>

<form action="<?php echo url_for('call/submit') ?>" method="POST" style="width: 100%;">
  <center>
    <div style="display: inline;margin-left:-45px;"><?php echo __('phone', null, 'call') ?></div>
    <input type="text" placeholder="Телефон" class="ContactPhone" name="phone" id="phone"  style="width: 250px;
height: 30px;
border-radius: 3px;
border: 1px solid #C5C8CA;
padding: 2px 7px;
outline: 0px none;
background-color: #FFF;
margin-top: 0px;
margin-left: 0px;"/>
    <br/><br/>
    <input type="submit" value="<?php echo __('submit', null, 'call') ?>" style="font-family: Arial,Helvetica,sans-serif;
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
	<p id="err" style="color:red;"></p>
    <p>Закажите звонок и наш специалист максимально быстро с вами свяжется</p>
  </center>
  <script>
    var phoneMask = '+38 (099) 999-99-99';
    $(".ContactPhone").mask(phoneMask);
	$("#sub").click(
		function(){
			if($("#phone").val().indexOf("_")!=-1 || $("#phone").val().length<19)
			{
				$("#err").text("Неправильно введен телефон, мы не сможем с вами связаться!");
				return false;
			}
		}
	);
  </script>
</form>