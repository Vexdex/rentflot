<h1>Карта маршрутов</h1> 
<ul>
	<li><a href="<?php echo url_for('map_velikiy') ?>">Описание острова &laquo;Великий&raquo;</a> + <a href="/files/RENTFLOT-Ostrov_Velikiy_oborudovannyi.doc">оборудованная площадка на острове &laquo;Великий&raquo;</a> (Word, 0.4 Мб)</li>
	<li><a href="<?php echo url_for('map_olgin') ?>">Описание острова &laquo;Ольгин&raquo;</a></li>
	<li><a href="/files/Ostrov_Vezeniya_RENTFLOT.doc">Описание острова &laquo;Везения&raquo; с оборудованной площадкой</a> (Word, 1 Мб)</li>
	<li><a href="/files/RENTFLOT-Ostrov_Dikiy.doc">Описание острова &laquo;Дикий&raquo;</a> (Word, 0.2 Мб)</li>
	<li><a href="/files/RENTFLOT-Ostrov_Chainyi.doc">Описание острова &laquo;Чаиный&raquo;</a> (Word, 1.4 Мб)</li>
	<!-- <li><a href="/files/RENTFLOT-Truhanov_ostrov.doc">Описание острова &laquo;Труханов&raquo;</a> (Word, 0.6 Мб)</li> -->
</ul>
<br>

<script language="javascript" type="text/javascript">
	if (document.images)
  {
    preload_image_object = new Image();
    // set image url
    var i = 0;
    for(i=1; i<9; i++) 
    {
      image_url = "/images/map/route_map_0"+i+".jpg";
      preload_image_object.src = image_url;
		}
		
    image_url = "/images/map/route_map-a_03.jpg";
    preload_image_object.src = image_url;

		image_url = "/images/map/route_map-a_07.jpg";
    preload_image_object.src = image_url;
  }

	function activateIslandImage(island) 
  {
		if (island == 0) isl_0.src = "/images/map/route_map-a_03.jpg";
		else isl_1.src = "/images/map/route_map-a_07.jpg";
		return true
	}

	function deActivateIslandImage(island) 
  {
		if (island == 0) isl_0.src = "/images/map/route_map_03.jpg";
		else isl_1.src = "/images/map/route_map_07.jpg";
		return true;
	}
</script>




<table width="430" border="0" cellpadding="0" cellspacing="0" align="center" class="MapTable">
	<tr>
		<td colspan="5"><img src="/images/map/route_map_01.jpg" width="430" height="12" alt="" /></td>
	</tr>
	<tr>
		<td rowspan="3"><img src="/images/map/route_map_02.jpg" width="130" height="675" alt="" /></td>
		<td colspan="2"><a class="nobor" href="<?php echo url_for('map_velikiy') ?>"><img style="cursor: pointer" id="isl_0" onmouseover="activateIslandImage(0);" onmouseout="deActivateIslandImage(0);" src="/images/map/route_map_03.jpg" width="216" height="68" alt="Фотокарта и описание острова &quot;Великий&quot;" title="Фотокарта и описание острова &quot;Великий&quot;" /></a></td>
		<td colspan="2" rowspan="2"><img src="/images/map/route_map_04.jpg" width="84" height="624" alt="" /></td>
	</tr>
	<tr>
		<td colspan="2"><img src="/images/map/route_map_05.jpg" width="216" height="556" alt="" /></td>
	</tr>
	<tr>
		<td><img src="/images/map/route_map_06.jpg" width="37" height="51" alt="" /></td>
		<td colspan="2"><a class="nobor" href="<?php echo url_for('map_olgin') ?>"><img style="cursor: pointer" id="isl_1" onmouseover="activateIslandImage(1);" onmouseout="deActivateIslandImage(1);" src="/images/map/route_map_07.jpg" width="195" height="51" alt="Фотокарта и описание острова &quot;Ольгин&quot;" title="Фотокарта и описание острова &quot;Ольгин&quot;" /></a></td>
		<td><img src="/images/map/route_map_08.jpg" width="68" height="51" alt="" /></td>
	</tr>
	<tr>
		<td><img src="/images/spacer.gif" width="130" height="1" alt="" /></td>
		<td><img src="/images/spacer.gif" width="37" height="1" alt="" /></td>
		<td><img src="/images/spacer.gif" width="179" height="1" alt="" /></td>
		<td><img src="/images/spacer.gif" width="16" height="1" alt="" /></td>
		<td><img src="/images/spacer.gif" width="68" height="1" alt="" /></td>
	</tr>
</table>

<br/>
<p style="font-weight: bold">Киевские причалы для посадки и высадки пассажиров (в формате Microsoft Word ~ 0.3-0.7Мб):</p>
<ul>
	<li><a href="/files/RENTFLOT-Prichal_Gidropark.doc">Причал в Гидропарке</a></li>
	<!--<li><a href="/files/RENTFLOT-Prichal_Bereznyaki.doc">Причал на Березняках</a></li>-->
	<li><a href="/files/RENTFLOT-Prichal_pod_Mosk.mostom.doc">Причал под Московским мостом</a></li>
	<li><a href="/files/RENTFLOT-Prichal_vozle_Mosk_mosta.doc">Причал возле Московского моста</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Drujbi_narodiv.doc">Причал в парке Дружбы Народов</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Vantoviy_most.doc">Причал под Вантовым мостом</a></li>
	<!--<li><a href="/files/RENTFLOT-Prichal_vozle_st_M_Dnepr.doc">Причал возле ст. М. Днепр</a></li>-->
	<li><a href="/files/RENTFLOT-Prichal_Korchevatoe.doc">Причал на Корчеватом</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Ukrainka_Stugna.doc">Причал в Украинке в яхт-клубе &laquo;Стугна&raquo;</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Ukrainka_Yug.doc">Причал в Украинке в яхт-клубе &laquo;Южный&raquo;</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Osokorki.doc">Причал в яхтклубе на Осокорках</a></li>
	<li><a href="/files/RENTFLOT-Pristan_Osokorki.doc">Пристань на Осокорках</a></li>
	<li><a href="/files/RENTFLOT-Prichal_Skatert_Samobranka.doc">Причал у&nbsp;р-на &laquo;Скатерть Самобранка&raquo;</a></li>
  <li><a href="/files/RENTFLOT-Prichal_Kievskoe_more.doc">Причал на Киевском водохранилище</a></li>
  <li><a href="/files/Prichal_1_rechvokzal.doc">Причал №1 речного вокзала</a></li>
  <li><a href="/files/Prichal_Monitora.doc">Причал в парке Моряков возле памятника Монитора Железнякова</a></li>
  <li><a href="/files/Prichal_Verblyud.doc">Причал &laquo;Верблюжий залив&raquo;</a></li>
  <li><a href="/files/Pristan_Sadovaya_104a.doc">Пристань ул. Садовая, 104а</a></li>

  <li><a href="/files/RENTFLOT-Prichal_Sobache_Girlo.doc">Причал Залив &laquo;Собачье устье&raquo;</a></li>
  <li><a href="/files/RENTFLOT-Prichal_vidubichi.doc">Причал на Выдубичах</a></li>
</ul>
