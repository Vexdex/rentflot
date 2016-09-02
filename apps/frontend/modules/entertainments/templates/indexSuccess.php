<h1>Управление страницей "Программа отдыха"</h1>
<form method="post">
  По-русски:
  <textarea id="advertisement_ru_text" name="template_text" style="width:100%;height: 500px;">
    <?php echo $txt;?>
  </textarea>
  <br/><br/>
  In English:
  <textarea id="advertisement_en_text" name="template_text_en" style="width:100%;height: 500px;">
    <?php echo $txt_en;?>
  </textarea>
  <input type="submit" name="save" value="Сохранить изминения"/>
</form>

<script type="text/javascript">
  tinyMCE.init({
    file_browser_callback :           "tinyBrowser",
    mode:                              "exact",
    elements:                          "advertisement_ru_text,advertisement_en_text",
    theme:                             "advanced",
    language:                          "ru",
    theme_advanced_toolbar_location:   "top",
    theme_advanced_toolbar_align:      "left",
    theme_advanced_statusbar_location: "bottom",
    theme_advanced_resizing:           true
  });
</script>

