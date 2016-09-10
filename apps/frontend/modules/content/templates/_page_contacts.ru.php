<h1 class="contacts_title" style="float: left;margin-left: 250px;">Контакты</h1>
<img class="contacts_logo" style="padding-top: 15px;padding-left: 50px;" width="150px" src="/images/logos/logo.png"/>
<table class="contacts_table" cellpadding="5" cellspacing="0" border="0" style="text-indent: 0px;">
 <tr>
	<td colspan="2"><h3 style="margin-top: 0px;">Арендовать теплоход, катер или яхту, заказать банкет или фуршет под ключ, провести развлекательные мероприятия на берегу реки, Вы сможете, обратившись к нам:</h3></td>
 </tr>

 <tr>
	<td style="line-height: 18px;" align="center">
	 <table  class="contacts_table2" cellpadding="3" cellspacing="5" border="0" align="center">
	 	<tr>
	 	 <td class="cat_cont"><div class="ohide">Адрес:</div></td>
	 	 <td class="cat_cont2"><div class="ohide">Режим работы офиса:</div></td>
		</tr>
		
		<tr>
		 <td class="data_cont">
		 <div class="ohide">
       г. Киев<br/>
              ул.Верхний Вал, 72<br/>
                     офис на причале<br/>
                       <!-- 2016/09/04 vexdex -->
                     (10 минут пешком от станции<br/> 
                      метро Контрактовая площадь)

		</div>	
                    <div class="oshow">Одесса</div>		
 		 </td>
                    <!-- 2016/09/04 vexdex -->
 		 <td class="data_cont" style="white-space:nowrap;overflow:hidden;">
                    <div class="ohide">
 		 	График работы офиса:<br/>  
                        Пн.- Сб., Вс - в телефонном режиме<br/> 
                    </div>
                        <br/>
			<div class="ohide">
			Режим работы офиса:<br/> 
			</div>
			10.00 - 19.00 ч.
 		</td>
            </tr>
		
		<tr><td colspan=2>&nbsp;</td></tr>
		<tr>
		 <td class="cat_cont">Телефоны:</td>
 	 	 <td class="cat_cont2"><div class="ohide">Средства электронной связи:</div></td>
		</tr>
		<tr>
		 <td class="data_cont">
			<span id="istat_4">
			<span class="ohide">
			(044) 451-40-58 (многокан.)<br/>
			(044) 237-10-96
			</span> 
			</span> 
			
			(063) 237-10-96 (Life) <br/>
			(050) 312-32-64 (MTS, Viber)<br/>
      (096) 194-61-62 (Kyivstar)<br/>
			(звоните также и в выходные)
 		 </td>
                   <!-- 2016/09/04 vexdex  -->
 		 <td class="data_cont">
 		 	e-mail: <script>"rentflot".printAddr('ddd@flo.cm.ua', 'order', '.ua');</script><br/>
			Skype: <a href="skype:rentflot.ua">rentflot.ua</a><br/>			
                        Viber: 050-312-32-64 <br>
                        ICQ: 392-068-639<br>
                        <a href="<?php echo url_for('homepage') ?>">www.rentflot.ua</a>
 		 </td>
		</tr>
                 <tr>
                    <td><p>&nbsp;</p></td>
                    <td><p>&nbsp;</p></td>
                </tr>  
     <tr>
       <td class="cat_cont">Заказать звонок:</td>
       <td class="cat_cont2"><div class="ohide">Обратная связь:</div></td>
     </tr>
		  <tr>
       <td class="data_cont">
         <form action="<?php echo url_for('call/submit') ?>" method="POST" style="width: 100%;">
           <center>
               <!-- 2016/09/04 vexdex style [ -->
             <input type="text" placeholder="Телефон" class="ContactPhone" name="phone" id="phone"   style="width: 120px;
height: 30px;
border-radius: 3px;
border: 1px solid #C5C8CA;
padding: 2px 7px;
outline: 0px none;
background-color: #FFF;
margin-top: 0px;
margin-left: 0px;
text-align: left;"/>
             <!-- 2016/09/04 vexdex ] -->
             <input type="submit" value="<?php echo __('submit', null, 'call') ?>" style="font-family: Arial,Helvetica,sans-serif;
height: 29px;
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
       </td>
       <td class="data_cont">
         <a href="<?php echo url_for('feedback') ?>">Отправить запрос online</a>
       </td>
     </tr>
	 </table>
	</td>
 <tr> 

 
 <tr class="ohide">
	<td align="center">
	  <br/>
	  <span class="cat_cont">Карта проезда:</span>
	  <br/><br/>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10158.14128638762!2d30.515888806068634!3d50.4683771692015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDI4JzE5LjQiTiAzMMKwMzEnMjQuNCJF!5e0!3m2!1sru!2sua!4v1427452749616" width="585" height="450" frameborder="0" style="border:0"></iframe>
	</td>
 </tr>
 <tr class="ohide">
    <td align="center">
       <span class="cat_cont">Офис на причале:</span>
       <br/><br/>
       <img src="/images/contacts/office.jpg"width="585"/>
    </td>
 </tr>
  <tr class="ohide">
      <td align="center">
             <br/>
                    <img src="/images/contacts/office_rentflot.jpg" width="585"/>
                        </td>
                         </tr>
						 
						 
</table>