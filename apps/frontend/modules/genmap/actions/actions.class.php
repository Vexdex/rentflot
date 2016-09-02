<?php

/**
 * Advertisements actions.
 *
 * @package    Rentflot
 * @subpackage Advertisements
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class genmapActions extends sfActions
{
  public function executeGenerate(sfWebRequest $request)
  {
	header('Content-Type: text/xml');
    $links="";
    //if($request["key"]=="1gggfGGs34332sdvvv55")
    //{
	  $links.=$this->link(url_for("call"),'2015-03-11','daily','0.6');
	  
	  $adverticements = Doctrine_Query::create()->from('Advertisement a')->execute();
	  foreach ($adverticements as $adv)
	  {
		$links.=$this->link(url_for('adv',array('slug'=>$adv->getSlug())),$adv->getDateTimeObject('updated_at')->format('Y-m-d'),'daily','1');
	  }
	  
	  $links.=$this->link(url_for("map"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("payments_pay_for_services"),'2015-03-01','daily','0.6');
	  
	  $links.=$this->link(url_for("article_frontend_list"),'2015-03-01','daily','0.6');
	  $articles = Doctrine_Query::create()->from('Article a')->execute();
	  foreach ($articles as $art)
	  {
		$links.=$this->link(url_for('@article_frontend_show?slug='.$art->getSlug()),$art->getDateTimeObject('updated_at')->format('Y-m-d'),'daily','0.6');
	  }	  
	  
	  $links.=$this->link(url_for("@iyt"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@croatia_yachts"),'2015-03-01','daily','0.8');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'croatia_sailing_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'croatia_motor_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("croatia_sailing_yachts");
	  $links.=$this->link_category("croatia_motor_yachts");
	  
	  $links.=$this->link(url_for("@odessa_yachts"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'odessa_sailing_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'odessa_motor_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'odessa_motor_ships')),'2015-03-01','daily','0.8');	 	
	  $links.=$this->link_category("odessa_sailing_yachts");
	  $links.=$this->link_category("odessa_motor_yachts");	  
	  $links.=$this->link_category("odessa_motor_ships");	  
	  
	  $links.=$this->link(url_for("@greece_yachts"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'greece_sailing_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'greece_motor_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("greece_sailing_yachts");	  
	  $links.=$this->link_category("greece_motor_yachts");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'attractions')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("attractions");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_ships_15')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_ships_15");
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_ships_50')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_ships_50");
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_ships_100')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_ships_100");
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_ships_150')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_ships_150");
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_ships_151')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_ships_151");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'sailing_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("sailing_yachts");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'motor_yachts')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("motor_yachts");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'speed_boats')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("speed_boats");
	  
	  $links.=$this->link(url_for('catalog_category', array('category_slug' => 'for_vip')),'2015-03-01','daily','0.8');
	  $links.=$this->link_category("for_vip");	  
	  
	  
	  $links.=$this->link(url_for("@yachts"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@motor_ships"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@links"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@banquet"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@entertainments"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@map_velikiy"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@map_olgin"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@photo_gallery"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@contract"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@rules"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@for_agents"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@clients"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@dictionary"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@rest_walk"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@contacts"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@about"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@sitemap"),'2015-03-01','daily','0.6');
	  $links.=$this->link(url_for("@feedback"),'2015-03-01','daily','0.6');
	  
	  $links = $this->tag_urlset($links);
	  $links="<?xml version=\"1.0\" encoding=\"UTF-8\"?>".$links;
	  echo $links;
	  die;
    //}
    //else
    //{
    //  die;
    //}
  }
  function link_category($category)
  {
	$cat_links="";
	$items = Doctrine_Query::create()->from('Item i')->leftJoin('i.Categories c')->Where('c.slug=?',$category)->andWhere('i.is_active=1')->execute();
	foreach ($items as $i)
	{
		$cat_links.=$this->link(url_for('catalog_item', array('category_slug' =>$category, 'item_slug' => $i->getSlug() )),$i->getDateTimeObject('updated_at')->format('Y-m-d'),'daily','1');
	}
	return $cat_links;
  }
  function link($link, $lastmod, $changefreq, $priority)
  {
    $block=array();
        $block[]="/for_vip/Zorianyi.html";
            $block[]="/motor_ships_100/Ekolog.html";
                $block[]="/motor_ships_50/Misisipi.html";
                    $block[]="/motor_ships_50/Olesta.html";
                        $block[]="/motor_ships_150/pamir.html";
                            $block[]="/motor_ships_151/Kashtan-2.html";
                                $block[]="/motor_ships_150/Kashtan-5.html";
                                    $block[]="/motor_ships_151/Elbrus.html";
                                        $block[]="/motor_ships_15/REGALCOMMODORE.html";
                                            $block[]="/sailing_yachts/korporativnaya_regata.html";
                                                $block[]="/en/sailing_yachts/korporativnaya_regata.html";
                                                    if(in_array ($link , $block))
                                                        {
                                                          return "";
                                                        }
  
	return $this->tag_url(
		$this->tag_loc($link).
		$this->tag_lastmod($lastmod).
		$this->tag_changefreq($changefreq).
		$this->tag_priority($priority)
		);
  }
  function tag_loc($data)
  {
    return $this->tag("loc","http://rentflot.ua".$data);
  }
  function tag_lastmod($data)
  {
    return $this->tag("lastmod",$data);
  }  
  function tag_changefreq($data)
  {
    return $this->tag("changefreq",$data);
  }   
  function tag_priority($data)
  {
    return $this->tag("priority",$data);
  } 
  function tag_url($data)
  {
    return $this->tag("url",$data);
  }  
  function tag_urlset($data)
  {
	$ret="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
	$ret.=$data;
	$ret.="</urlset>";
    return $ret;
  }  
  function tag($tag,$data)
  {
	$ret="<".$tag.">";
	$ret.=$data;
	$ret.="</".$tag.">\r\n";
	return $ret;
  }
}
