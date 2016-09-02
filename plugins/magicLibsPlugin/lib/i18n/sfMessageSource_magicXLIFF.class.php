<?php


class sfMessageSource_magicXLIFF extends sfMessageSource_XLIFF
{
  
  /**
   * Loads the messages from a XLIFF file.
   *
   * @param string $filename  XLIFF file.
   * @return array|false An array of messages or false if there was a problem loading the file.
   */
  public function &loadData($filename)
  {
    libxml_use_internal_errors(true);
    if (!$xml = simplexml_load_file($filename))
    {
      $error = false;

      return $error;
    }
    libxml_use_internal_errors(false);

    $translationUnit = $xml->xpath('//trans-unit');

    $translations = array();

    foreach ($translationUnit as $unit)
    {
      // by Dmitriy
      //$source = (string) $unit->source;
      //$translations[$source][] = (string) $unit->target;
      $source = (string) str_replace(array('<source>', '</source>'), '', $unit->source->asXML());;
      $translations[$source][] = (string) str_replace(array('<target>', '</target>'), '', $unit->target->asXML());
      $translations[$source][] = (string) $unit['id'];
      $translations[$source][] = (string) $unit->note;
    }

    return $translations;
  }
}
