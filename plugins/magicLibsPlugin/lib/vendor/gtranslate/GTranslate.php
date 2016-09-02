<?php

/**
* GTranslate - A class to comunicate with Google Translate(TM) Service
*               Google Translate(TM) API Wrapper
*               More info about Google(TM) service can be found on http://code.google.com/apis/ajaxlanguage/documentation/reference.html
* 		This code has o affiliation with Google (TM) , its a PHP Library that allows to comunicate with public a API
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @author Jose da Silva <jose@josedasilva.net>
* @since 2009/11/18
* @version 0.7.7
* @licence LGPL v3
*
* <code>
* <?
* require_once("GTranslate.php");
* try{
*	$gt = new Gtranslate;
*	echo $gt->english_to_german("hello world");
* } catch (GTranslateException $ge)
* {
*	echo $ge->getMessage();
* }
* ?>
* </code>
*/


/**
* Exception class for GTranslated Exceptions
*/

class GTranslateException extends Exception
{
	public function __construct($string) {
		parent::__construct($string, 0);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}

class GTranslate
{
	/**
	* Google Translate(TM) Api endpoint
	* @access private
	* @var String 
	*/
	private $url = "http://ajax.googleapis.com/ajax/services/language/translate";
	
        /**
        * Google Translate (TM) Api Version
        * @access private
        * @var String 
        */	
	private $api_version = "1.0";

        /**
        * Comunication Transport Method
 	* Available: http / curl
        * @access private
        * @var String 
        */
	private $request_type = "http";

        /**
        * Valid languages file
        * @access private
        * @var String 
        */
	private $valid_languages_file = array("languages.ini", "languages.v2.ini");

        /**
        * Path to available languages file
        * @access private
        * @var String 
        */
	private $available_languages_file 	= "languages.v2.ini";
	
        /**
        * Holder to the parse of the ini file
        * @access private
        * @var Array
        */
	private $available_languages = array();

	/**
	* Google Translate api key
 	* @access private 
	* @var string
	*/
	private $api_key = null;

	/**
	* Google request User IP
	* @access private
	* @var string	
	*/
	private $user_ip = null;

	/**
	* HTTP Url of the translated page
	* @access private
	* @var string
	*/
	private $http_referer	=	'';

        /**
        * Constructor sets up {@link $available_languages}
        */
	public function __construct()
	{
		$this->http_referer = (!empty($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '');
	}

	/**
	* Set language file to use
	* @access public
	* @param string $file
	*/	
	public function setLanguageFile($language_file)
	{		
		if(in_array($language_file, $this->valid_languages_file))
		{
			$this->available_languages_file = $language_file;
			return true;			
		}
		return false;
	}

	/**
	* Parse available language from language file
	* @access private
	*/	
	private function parseLanguageFile()
	{
		$this->available_languages = parse_ini_file($this->available_languages_file);
	}	
	
        /**
        * URL Formater to use on request
        * @access private
        * @param array $lang_pair
	* @param array $string
	* "returns String $url
        */

	private function urlFormat($lang_pair,$string)
	{
		$parameters = array(
			"v" => $this->api_version,
			"q" => $string,
			"langpair"=> implode("|",$lang_pair)
		);

		if(!empty($this->api_key))
		{
			$parameters["key"] = $this->api_key;
		}

		if( empty($this->user_ip) ) 
		{
			if( !empty($_SERVER["REMOTE_ADDR"]) ) 
			{
				$parameters["userip"]	=	$_SERVER["REMOTE_ADDR"];
			}
		} else 
		{
			$parameters["userip"]   =	$this->user_ip;
		}

		$url  = "";

		foreach($parameters as $k=>$p)
		{
			$url 	.=	$k."=".urlencode($p)."&";
		}
		return $url;
	}

	/**
	* Define the request type
	* @access public
	* @param string $request_type
	* return boolean
	*/
	public function setRequestType($request_type = 'http') {
  		if (!empty($request_type)) {
	    		$this->request_type = $request_type;
			return true;
  		}
		return false;
	}

	/**
	* Define the Google Translate Api Key
 	* @access public
	* @param string $api_key
	* return boolean
	*/
	public function setApiKey($api_key) {
  		if (!empty($api_key)) {
	    		$this->api_key = $api_key;
			return true;
  		}
		return false;
	}
	
	/**
	* Define the User Ip for the query
 	* @access public
	* @param string $ip
	* return boolean
	*/
	public function setUserIp($ip) {
  		if (!empty($ip)) {
	    		$this->user_ip = $ip;
			return true;
  		}
		return false;
	}
	
	/**
	* Define the http referer for the translation
 	* @access public
	* @param string $utl
	* return boolean
	*/
	public function setHttpReferer($url) {
  		if (!empty($url)) {
	    		$this->http_referer = $url;
			return true;
  		}
		return false;
	}
	
        /**
        * Query the Google(TM) endpoint 
        * @access private
        * @param array $lang_pair
        * @param array $string
        * returns String $response
        */

	public function query($lang_pair,$string)
	{

		$query_url = $this->urlFormat($lang_pair,$string);
		$response = $this->{"request".ucwords($this->request_type)}($query_url);
		return $response;
	}

        /**
        * Query Wrapper for Http Transport 
        * @access private
        * @param String $url
        * returns String $response
        */

	private function requestHttp($url)
	{

		return GTranslate::evalResponse(json_decode(file_get_contents($this->url."?".$url)));
	}

        /**     
        * Query Wrapper for Curl Transport 
        * @access private
        * @param String $url
        * returns String $response
        */

	private function requestCurl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $this->http_referer);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
		$body = curl_exec($ch);
		curl_close($ch);
		return GTranslate::evalResponse(json_decode($body));
	}

        /**     
        * Response Evaluator, validates the response
	* Throws an exception on error 
        * @access private
        * @param String $json_response
        * returns String $response
        */

	private function evalResponse($json_response)
	{

		switch($json_response->responseStatus)
		{
			case 200:
				return $json_response->responseData->translatedText;
				break;
			default:
				throw new GTranslateException("Unable to perform Translation:".$json_response->responseDetails);
			break;
		}
	}


        /**     
        * Validates if the language pair is valid
        * Throws an exception on error 
        * @access private
        * @param Array $languages
        * returns Array $response Array with formated languages pair
        */

	private function isValidLanguage($languages)
	{
		$language_list 	= $this->available_languages;

		$languages 		= 	array_map( "strtolower", $languages );
		$language_list_v  	= 	array_map( "strtolower", array_values($language_list) );
		$language_list_k 	= 	array_map( "strtolower", array_keys($language_list) );
		$valid_languages 	= 	false;

		if( TRUE == in_array($languages[0],$language_list_v) AND TRUE == in_array($languages[1],$language_list_v) )
		{
			$valid_languages 	= 	true;	
		}


		if( FALSE === $valid_languages AND TRUE == in_array($languages[0],$language_list_k) AND TRUE == in_array($languages[1],$language_list_k) )
		{
			$languages 	= 	array($language_list[strtoupper($languages[0])],$language_list[strtoupper($languages[1])]);
			$valid_languages        =       true;
		}

		if( FALSE === $valid_languages )
		{
			throw new GTranslateException("Unsupported languages (".$languages[0].",".$languages[1].")");
		}

		return $languages;
	}

        /**     
        * Magic method to understande translation comman
	* Evaluates methods like language_to_language
        * @access public
	* @param String $name
        * @param Array $args
        * returns String $response Translated Text
        */



  /*
  public function __call($name,$args)
	{
		if(empty($this->available_languages))
		{
			$this->parseLanguageFile();
		}
		
		$languages_list 	= 	explode("_to_",strtolower($name));
		$languages = $this->isValidLanguage($languages_list);

		$string 	= 	$args[0];
		return $this->query($languages,$string);
	}
  */


  private function crop_data($text, $crop_length = 5000)
  {
    //echo $text;    
    $text_length = mb_strlen($text, 'utf-8');
    //echo $text_length;
    if ($text_length > $crop_length) 
    {
      $start = 0;
      while ($start <= $text_length) 
      {
        if ($start + $crop_length >= $text_length) 
        {
          $text_data[] = mb_substr($text, $start, $crop_length, 'utf-8');
          break;
        }
        $length = mb_strrpos(mb_substr($text, $start, $crop_length, 'utf-8'), '<', 0, 'utf-8');
        
        if ($length === false) 
        {
          $length = mb_strrpos(mb_substr($text, $start, $crop_length, 'utf-8'), ' ', 0, 'utf-8');
          if ($length === false) 
          {
            $text_data[] = mb_substr($text, $start, $crop_length, 'utf-8');
            $length = $crop_length;
          }
          else 
          {
            $text_data[] = mb_substr($text, $start, $length, 'utf-8');
          }
        }
        else 
        {
          if ($length === 0)
          {
            $length = mb_strrpos(mb_substr($text, $start, $crop_length, 'utf-8'), '>', 0, 'utf-8');
          }
          $text_data[] = mb_substr($text, $start, $length, 'utf-8');
        }
        $start = $start + $length;
      }
    }
    else 
    {
      $text_data[] = $text;
    }
    
    return $text_data;  
  }
  

  public function __call($name, $args)
	{
		if(empty($this->available_languages))
		{
			$this->parseLanguageFile();
		}
		
		$languages_list = explode("_to_",strtolower($name));
		$languages = $this->isValidLanguage($languages_list);

		$string =	$args[0];
    
    /*
    $output_text = '';
    if(mb_strlen($string ,'UTF-8') > 300)
    { 
      preg_match_all('!(.{200,300})(\s|,|\.|-|\?|\!|\(|\)|\")!Us', $string, $text); 
      $text_2 = $text; 
      $text_2 = array_pop($text_2[1]); 
      preg_match_all('!'.preg_quote ( $text_2 ).'(.*)$!Us', $string, $text_end); 
      $text[0][] = array_pop($text_end[1]); 
      $text = $text[0]; 
      foreach($text as $key => $value)
      { 
        $trans_text = $this->query($languages,$value);
        if ($trans_text !== false) 
        { 
          $output_text .= $trans_text.' '; 
        } 
      } 
    } 
    else 
    { 
      $output_text = $this->query($languages,$string);
    }
    */

    $output_text = '';
    if(mb_strlen($string ,'utf-8') > 5000)
    {
      $crop_data = $this->crop_data($string);
      foreach ($crop_data as $piece) 
      {
        $output_text .= $this->query($languages, $piece);
      }
    }
    else
    {
      $output_text = $this->query($languages, $string);
    }
		
    return $output_text;
	}  
  
  /*
  private function crop($text, $crop_length = 5000)
  {
    echo $text;
    $text_length = mb_strlen($text, 'utf-8');    
    echo $text_length;
    if ($text_length > $crop_length) 
    {
      $start = 0;
      $j = 0;
      while ($start < $text_length) 
      {
        $text_piece = $this->substrws(mb_substr($text, $start, $text_length, 'utf-8'), $crop_length);
        $text_data[] = $text_piece;        
        $length = mb_strlen($text_piece, 'utf-8');
        //vardump($length);
        $start = $start + $length;
        if ($j > 10000) 
        {
          $text_data[] = 'TRANSLATION ERROR';
          break;
        }
        ++$j;
      }
    }
    else 
    {
      $text_data[] = $text;
    }
    
    vardump($text_data);
    die();
    return $text_data;  
  }
  
  public function substrws( $text, $len=300 ) { 

    if( (mb_strlen($text, 'utf-8') > $len) ) { 

        $whitespaceposition = mb_strpos($text," ",$len, 'utf-8')-1; 

        if( $whitespaceposition > 0 ) 
            $text = mb_substr($text, 0, ($whitespaceposition+1), 'utf-8'); 

        // close unclosed html tags 
        if( preg_match_all("|<([a-zA-Z]+)>|",$text,$aBuffer) ) { 

            if( !empty($aBuffer[1]) ) { 

                preg_match_all("|</([a-zA-Z]+)>|",$text,$aBuffer2); 

                if( count($aBuffer[1]) != count($aBuffer2[1]) ) { 

                    foreach( $aBuffer[1] as $index => $tag ) { 

                        if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag) 
                            $text .= '</'.$tag.'>'; 
                    } 
                } 
            } 
        } 
    } 

    return $text; 
}   
*/
 


/**
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param string  $ending Ending to be appended to the trimmed string.
* @param boolean $exact If false, $text will not be cut mid-word
* @param boolean $considerHtml If true, HTML tags would be handled correctly
* @return string Trimmed string.
*/
    /*
    function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
           
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
   
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
           
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                    // if tag is a closing tag (f.e. </b>)
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                    // if tag is an opening tag (f.e. <b>)
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
               
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length+$content_length> $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
               
                // if the maximum length is reached, get off the loop
                if($total_length>= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
       
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
       
        // add the defined ending to the text
        $truncate .= $ending;
       
        if($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
       
        return $truncate;
       
    }
*/ 
  
}

?>
