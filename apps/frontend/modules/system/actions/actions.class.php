<?php

/**
 * system actions.
 *
 * @package    Rentflot
 * @subpackage system
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class systemActions extends sfActions
{
  public function executeUpdateWeather(sfWebRequest $request)
  {
    $this->forward404Unless(sfConfig::get('app_system_update_weather_token') == $request->getParameter('token'));

    $weather = parse_weather();

    if ($weather)
    {
      magicCache::set('static_content_weather', parse_weather());

      return $this->renderText('Прогноз погоды успешно обновлен');
    }

    return $this->renderText('Ошибка обновления прогноза погоды');
  }

  public function executeParseEmails(sfWebRequest $request)
  {
    $this->forward404();

    $emails = array();
    $dir = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'emails';

    $txtFiles = sfFinder::type('file')->name('*.txt')->in($dir);
    foreach ($txtFiles as $file)
    {
      $content = file_get_contents($file);

      $taintedEmails = (explode("\n", $content));

      foreach ($taintedEmails as $taintedEmail)
      {
        if (strpos($taintedEmail, '@') !== false)
        {
          $emails[] = trim(strtolower(str_replace(array('"', ","), '', $taintedEmail)));
        }
      }
    }

    $csvFiles = sfFinder::type('file')->name('*.csv')->in($dir);
    foreach ($csvFiles as $file)
    {
      $content = file_get_contents($file);

      $taintedEmails = (explode(";", $content));

      foreach ($taintedEmails as $taintedEmail)
      {
        if (strpos($taintedEmail, '@') !== false)
        {
          $emails[] = trim(strtolower(str_replace(array('"', ","), '', $taintedEmail)));
        }
      }
    }

    $emails = array_unique($emails);

    sort($emails);

    $response = $this->getContext()->getResponse();
    $response->clearHttpHeaders();
    //$response->setHttpHeader('Content-Type', 'application/vnd.ms-excel');
    $response->setHttpHeader('Content-Type', 'text/csv');
    $response->setHttpHeader('Content-Disposition', 'attachment;filename="emails.txt"');

    return $this->renderText(implode("\n", $emails));
  }
}
