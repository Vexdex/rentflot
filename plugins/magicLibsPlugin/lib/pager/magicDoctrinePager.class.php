<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfDoctrine pager class.
 *
 * @package    sfDoctrinePlugin
 * @subpackage pager
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfDoctrinePager.class.php 28897 2010-03-30 20:30:24Z Jonathan.Wage $
 */
class magicDoctrinePager extends sfDoctrinePager
{

  /**
   * @see sfPager
   */
  public function init()
  {
    $this->resetIterator();

    $countQuery = $this->getCountQuery();
    $count = $countQuery->count();

    $this->setNbResults($count);

    $query = $this->getQuery();
    $query->offset(0)
          ->limit(0);

    if (0 == $this->getPage() || 0 == $this->getMaxPerPage() || 0 == $this->getNbResults())
    {
      $this->setLastPage(0);
    }
    else
    {
      $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));
      $offset = ($this->getPage() - 1) * $this->getMaxPerPage();

      $query->offset($offset)
            ->limit($this->getMaxPerPage());
    }
  }
}
