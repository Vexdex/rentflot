<?php 
/** 
* Translating language with Google API 
* @author gabe@fijiwebdesign.com mod BY GANJAR icq:993770 http://mytu.ru 
* @version $Id$ 
* @license - Share-Alike 3.0 (http://creativecommons.org/licenses/by-sa/3.0/) 
* 
* Google requires attribution for their Language API, please see: http://code.google.com/apis/ajaxlanguage/documentation/#Branding
* 
*/ 
class GoogleTranslate 
{ 
  /** 
  * Translate a piece of text with the Google Translate API 
  * @return String 
  * @param $text String 
  * @param $from String[optional] Original language of $text. An empty String will let google decide the language of origin
  * @param $to String[optional] Language to translate $text to 
  */ 
  

  static function preTranslate($text, $from = '', $to = 'en') 
  { 
    $url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.rawurlencode($text).'&langpair='.rawurlencode($from.'|'.$to); 
    $response = file_get_contents( 
        $url, 
        null, 
        stream_context_create( 
            array( 
                'http'=>array( 
                    'method'=>"GET", 
                    'header'=>"Referer: http://".$_SERVER['HTTP_HOST']."/\r\n" 
                ) 
            ) 
        ) 
    ); 
    if (preg_match("/{\"translatedText\":\"([^\"]+)\"/i", $response, $matches)) 
    { 
      return self::_unescapeUTF8EscapeSeq($matches[1]); 
    } 
    return false; 
  } 
  
    /*
    static function preTranslate($s_text, $s_lang, $d_lang)
    {
      $url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&amp;q=".urlencode($s_text)."&amp;langpair=".urlencode($s_lang.'|'.$d_lang);
      $c = curl_init();
      curl_setopt($c, CURLOPT_URL, $url);
      curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($c, CURLOPT_REFERER, "http://gritsinger.com");
      $b = curl_exec($c);
      curl_close($c);
      $json = json_decode($b, true);
      if ($json['responseStatus'] != 200)return false;
      return $json['responseData']['translatedText'];
    } 
    */    
  
  /** 
  * Convert UTF-8 Escape sequences in a string to UTF-8 Bytes. Old version. 
  * @return UTF-8 String 
  * @param $str String 
  */ 
  static function __unescapeUTF8EscapeSeq($str) 
  { 
    return preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_NOQUOTES, \'UTF-8\');'), $str); 
  } 
  
  /** 
  * Convert UTF-8 Escape sequences in a string to UTF-8 Bytes 
  * @return UTF-8 String 
  * @param $str String 
  */ 
  static function _unescapeUTF8EscapeSeq($str) 
  { 
    return preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return GoogleTranslate::_bin2utf8(hexdec($matches[1]));'), $str);
  } 
  
  /** 
  * Convert binary character code to UTF-8 byte sequence 
  * @return String 
  * @param $bin Mixed Interger or Hex code of character 
  */ 
  static function _bin2utf8($bin) 
  { 
    if ($bin <= 0x7F) 
    { 
      return chr($bin); 
    } 
    else if ($bin >= 0x80 && $bin <= 0x7FF) 
    { 
      return pack("C*", 0xC0 | $bin >> 6, 0x80 | $bin & 0x3F); 
    } 
    else if ($bin >= 0x800 && $bin <= 0xFFF) 
    { 
      return pack("C*", 0xE0 | $bin >> 11, 0x80 | $bin >> 6 & 0x3F, 0x80 | $bin & 0x3F); 
    } 
    else if ($bin >= 0x10000 && $bin <= 0x10FFFF) 
    { 
      return pack("C*", 0xE0 | $bin >> 17, 0x80 | $bin >> 12 & 0x3F, 0x80 | $bin >> 6& 0x3F, 0x80 | $bin & 0x3F);
    } 
  } 
    
  static function translate($original_text, $inp_lan = '', $out_lan)
  { 
    $output_text = ''; //Значение на вывод 
    if(mb_strlen($original_text ,'UTF-8') > 300)
    { 
      preg_match_all('!(.{200,300})(\s|,|\.|-|\?|\!|\(|\)|\")!Us', $original_text, $text); 
      $text_2 = $text; 
      $text_2 = array_pop($text_2[1]); 
      preg_match_all('!'.preg_quote ( $text_2 ).'(.*)$!Us', $original_text, $text_end); 
      $text[0][] = array_pop($text_end[1]); 
      $text = $text[0]; 
      foreach($text as $key => $value)
      { 
        $trans_text = GoogleTranslate::preTranslate($value, $inp_lan, $out_lan); 
        if ($trans_text !== false) 
        { 
          $output_text .= $trans_text.' '; 
        } 
      } 
    } 
    else 
    { 
      $trans_text = GoogleTranslate::preTranslate($original_text, $inp_lan, $out_lan); 
      if ($trans_text !== false) 
      { 
        $output_text = $trans_text; 
      } 
    } 
    return str_replace('  ', ' ',str_replace('<br>', "\n",str_replace('\n', ' ',str_replace('\r', ' ',$output_text))));
  }  
  
} 

 
?>