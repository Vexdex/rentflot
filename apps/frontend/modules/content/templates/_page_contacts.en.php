<h1 class="contacts_title"  style="float: left;margin-left: 250px;">Contacts</h1>
<img class="contacts_logo" style="padding-top: 15px;padding-left: 50px;" width="150px" src="/images/logos/logo_en.png"/>
<table class="contacts_table"  cellpadding="5" cellspacing="0" border="0" style="text-indent: 0px;">
 <tr>
	<td colspan="2"><h3 style="margin-top: 0px;">For renting or booking a motor ship, yacht or motor boat, also for ordering a banquet or fourchette and entertainment on the river please contact us:</h3></td>
 </tr>

 <tr>
	<td style="line-height: 18px;" align="center">
	 <table class="contacts_table2" cellpadding="3" cellspacing="5" border="0" align="center">
	 	<tr>
	 	 <td class="cat_cont"><div class="ohide">Address:</div></td>
	 	 <td class="cat_cont2"><div class="ohide">Office time schedule:</div></td>
		</tr>
		
		<tr>
		 <td class="data_cont">
		  <div class="ohide">
		 	Kiev, <br/>
       floating landing stage at Verhniy Val str., 72
	   </div>
	    <div class="oshow">Odessa</div>
 		 </td>
 		 <td class="data_cont">
		<div class="ohide"> 
      Office working days:<br/>
	  </div>
	  
      Mon - Sat<br/>
	  <div class="ohide">
	  <br/>
      Office working hours:<br/>
	  </div>
			10.00 - 19.00
 		 </td>
		</tr>
		
		<tr><td colspan=2>&nbsp;</td></tr>
		<tr>
		 <td class="cat_cont"><div class="ohide">Telephone numbers:</div></td>
 	 	 <td class="cat_cont2"><div class="ohide">Contact us:</div></td>
		</tr>
		<tr>
		 <td class="data_cont">
			<span id="istat_7">
			<span class="ohide">
			(044) 451-40-58 (multichannel)<br/>
			(044) 237-10-96
			</span>
			</span> 
			(063) 237-10-96 (Life) <br/>
			(050) 312-32-64 (MTS, Viber)<br/>
      (096) 194-61-62 (Kyivstar)<br/>
			(you can call on weekends)
 		 </td>
 		 <td class="data_cont">
 		 	e-mail: <script>"rentflot".printAddr('ddd@flo.cm.ua', 'order', '.ua');</script><br/>
			Skype: <a href="skype:rentflot.ua">rentflot.ua</a><br/>
			<a href="<?php echo url_for('homepage') ?>">www.rentflot.ua</a>
 		 </td>
		</tr>
		 <tr>
		   <td class="cat_cont"><div class="ohide">Callback:</div></td>
		   <td class="cat_cont2"><div class="ohide">Feedback:</div></td>
		 </tr>
<tr>
       <td class="data_cont">
         <form action="<?php echo url_for('call/submit') ?>" method="POST" style="width: 100%;">
           <center>
             <input type="text" placeholder="Phone" class="ContactPhone" name="phone" id="phone"  style="width: 150px;
height: 30px;
border-radius: 3px;
border: 1px solid #C5C8CA;
padding: 2px 7px;
outline: 0px none;
background-color: #FFF;
margin-top: 0px;
margin-left: 0px;"/>
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
             <p>Send a message to us and we will contact you as soon as possible</p>
           </center>
           <script>
             var phoneMask = '+38 (099) 999-99-99';
             $(".ContactPhone").mask(phoneMask);
             $("#sub").click(
               function(){
                 if($("#phone").val().indexOf("_")!=-1 || $("#phone").val().length<19)
                 {
                   $("#err").text("Wrong phone format, please follow template!");
                   return false;
                 }
               }
             );
           </script>
         </form>
       </td>
       <td class="data_cont">
         <a href="<?php echo url_for('feedback') ?>">Send your request online</a>
       </td>
     </tr>
	 </table>
	</td>
 <tr>
 
 <tr>
	<td align="center"><br/>
	<span class="cat_cont">Map:</span>
	<br/><br/>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2539.349738659779!2d30.523382898148967!3d50.471832490170634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDI4JzE5LjQiTiAzMMKwMzEnMjQuNCJF!5e0!3m2!1sru!2sua!4v1423572693669" width="600" height="450" frameborder="0" style="border:0"></iframe>
	</td>
 </tr>
  <tr>
    <td align="center">
       <span class="cat_cont">Floating landing stage:</span>
       <br/><br/>
       <img src="/images/contacts/office.jpg"/>
    </td>
 </tr>
  <tr>
      <td align="center">
             <br/>
                    <img src="/images/contacts/office_rentflot.jpg"/>
                        </td>
						</tr>
</table>