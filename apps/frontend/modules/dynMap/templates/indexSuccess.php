<h1 class="content paths hsjkdfh234">Карта маршрутов</h1>


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


<!--

<table width="430" border="0" cellpadding="0" cellspacing="0" align="center" class="MapTable">
  <tr>
    <td colspan="5"><img src="/images/map/route_map_01.jpg" width="430" height="12" alt="" /></td>
  </tr>
  <tr>
    <td rowspan="3"><img src="/images/map/route_map_02.jpg" width="130" height="675" alt="" /></td>
    <td colspan="2"><a class="nobor" href="<?php // echo url_for('map_velikiy') ?>"><img style="cursor: pointer" id="isl_0" onmouseover="activateIslandImage(0);" onmouseout="deActivateIslandImage(0);" src="/images/map/route_map_03.jpg" width="216" height="68" alt="Фотокарта и описание острова &quot;Великий&quot;" title="Фотокарта и описание острова &quot;Великий&quot;" /></a></td>
    <td colspan="2" rowspan="2"><img src="/images/map/route_map_04.jpg" width="84" height="624" alt="" /></td>
  </tr>
  <tr>
    <td colspan="2"><img src="/images/map/route_map_05.jpg" width="216" height="556" alt="" /></td>
  </tr>
  <tr>
    <td><img src="/images/map/route_map_06.jpg" width="37" height="51" alt="" /></td>
    <td colspan="2"><a class="nobor" href="<?php // echo url_for('map_olgin') ?>"><img style="cursor: pointer" id="isl_1" onmouseover="activateIslandImage(1);" onmouseout="deActivateIslandImage(1);" src="/images/map/route_map_07.jpg" width="195" height="51" alt="Фотокарта и описание острова &quot;Ольгин&quot;" title="Фотокарта и описание острова &quot;Ольгин&quot;" /></a></td>
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

-->


<link rel="stylesheet" type="text/css" media="screen" href="/magicLibsPlugin/jquery/plugins/lightbox-0.5/css/jquery.lightbox-0.5.css" />
<script type="text/javascript" src="/magicLibsPlugin/jquery/plugins/lightbox-0.5/js/jquery.lightbox-0.5.js"></script>
<a class="oiill lightbox-gal-1 nobor" href="/images/map/route_map_001.jpg" title="Фотокарта и описание острова &quot;Великий&quot;" rel="gallery1">
<img class="descr_img" style="margin-bottom: 0px;" title="Фотокарта и описание острова &quot;Великий&quot;" alt="Фотокарта и описание острова &quot;Великий&quot;" src="/images/map/route_map_001.jpg">
</a>
<script type="text/javascript">
    $(document).ready(function(){
      $(".lightbox-gal-1").lightBox({
        fixedNavigation:		true,
        fitToScreen: false,
        loopImages: true,
        imageClickClose: false,
        imageLoading:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/loading.gif',	
        imageBtnPrev:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/prev.gif',		
        imageBtnNext:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/next.gif',		
        imageBtnClose:		'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/close.gif',		
        imageBlank:				'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/blank.gif',
        txtImage:         'Фотография',
        txtOf:            'из'
      });
    });
</script>
















<br/>
<p class="link1 zxcizopxc123123" style="font-weight: bold;">Киевские причалы для посадки и высадки пассажиров (в формате Microsoft Word ~ 0.3-0.7Мб):</p>
<?php
  echo "<ul>";
   foreach($itemsListQuery as $row)
  {
      echo "<li><a href='http://www.rent-flot.kiev.ua/uploads/files/prichal/".$row["link"]."'>".$row["name"]."</a></li>";
  }
  echo "</ul>";
?>