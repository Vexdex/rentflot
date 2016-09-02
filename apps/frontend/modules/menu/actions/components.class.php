<?php
 
 
class menuComponents extends sfComponents
{

  public function executeMainAdminMenu($request)
  {
  }

  public function executeMainMenu($request)
  {    
  }

  public function executeTopMenu($request)
  {    
  }

  public function executeNews($request)
  {
    $this->news = Doctrine_Query::create()
            ->from('News n')
            ->limit(3)
            ->orderBy("id DESC")
            ->execute();
    //$order_item_categories = $item->getCategories();
    //$adv=$order_item_categories[0]->getAdvertisements();
  }

  public function executeClients($request)
  {
	$clients=array();
	
	$client=array(
		"name"=>"Adidas",
		"text"=>"Благодарим Рент- флот за организованное мероприятние...",
		"href"=>"adidas"
		);
	$clients[]=$client;
	
		$client=array(
		"name"=>"1+1",
		"text"=>"Киевская судоходная компания Рентфлот зарекомендовала себя...",
    "href"=>"plus1"
		);
	$clients[]=$client;
	
		$client=array(
		"name"=>"Oriflame",
		"text"=>"Компания ДП Орифлейм настоящим письмом выражает свою благодарность...",
    "href"=>"oriflame"
		);
	$clients[]=$client;	
	
		$client=array(
		"name"=>"Shell",
		"text"=>"06 Сентября 2008 года, на теплоходе Каштан, с высадкой на острове...",
    "href"=>"shell"
		);
	$clients[]=$client;		

		$client=array(
		"name"=>"ACC",
		"text"=>"09.07.2009г. компания Рентфлот организовала для нас корпоративный...",
      "href"=>"acc_ukraine"
		);
	$clients[]=$client;		
	
		$client=array(
		"name"=>"Банк реконструкции и развития",
		"text"=>"С помощью компании Рентфлот был проведен корпортивный тренинг...",
      "href"=>"ubrr"
		);
	$clients[]=$client;		
	
		$client=array(
		"name"=>"Укркосмос",
		"text"=>"28 августа 2009 года у нашего предприятия был замечательный день...",
      "href"=>"ukrkosmos"
		);
	$clients[]=$client;		
	
		$client=array(
		"name"=>"Nokia",
		"text"=>"В июне 2005 агенство Рентфлот организовало для компании Nokia...",
      "href"=>"nokia"
		);
	$clients[]=$client;		
	
		$client=array(
		"name"=>"Gillette",
		"text"=>"Компания Жилет Укрейн Тов характеризует КСК Рентфлот как...",
      "href"=>"gillette"
		);
	$clients[]=$client;	

			$client=array(
		"name"=>"City.com",
		"text"=>"Компания City.com выражает благодарность агенству Рентфлот...",
        "href"=>"citycom"
		);
	$clients[]=$client;	
	
			$client=array(
		"name"=>"Украинский автобус",
		"text"=>"В декабре 2006 агенство Рентфлот организовало для торгового дома...",
        "href"=>"bogdan"
		);
	$clients[]=$client;		
	
			$client=array(
		"name"=>"Теленеделя",
		"text"=>"Рекламная группа Теленеделя сотрудничает с КСК Рентфлот с 2003-го года...",
        "href"=>"tele"
		);
	$clients[]=$client;		
	
			$client=array(
		"name"=>"Артем",
		"text"=>"Державна акціонерна холдингова компанія Артем висловлює свою подяку...",
        "href"=>"artem"
		);
	$clients[]=$client;			
	
			$client=array(
		"name"=>"Киевский городской центр народного творчества и культурологических исследований",
		"text"=>"вже декілька років веде активну творчу співпрацю...",
        "href"=>"centr"
		);
	$clients[]=$client;		
	
			$client=array(
		"name"=>"Эй Би Си Груп",
		"text"=>"Компания Эй Би Си Груп благодарит киевскую судоходную компанию...",
        "href"=>"abc"
		);
	$clients[]=$client;		
	
			$client=array(
		"name"=>"Аэросвит",
		"text"=>"Громадська рада підприемства ЗАТ Авіакомпанія Аєросвіт 29 серпня 2008...",
        "href"=>"aerosvit"
		);
	$clients[]=$client;

    $client=array(
    "name"=>"Panasonic",
    "text"=>"В сентябре 2008 года КСК РЕнтфлот организовало для компании...",
      "href"=>"panasonic"
  );
    $clients[]=$client;

    $client=array(
    "name"=>"ПроФИКС",
    "text"=>"ООО Компания Профикс благодарит судоходную компанию Рентфлот...",
      "href"=>"profix"
  );
    $clients[]=$client;

    $client=array(
      "name"=>"Дружба",
      "text"=>"Дякуемо компанії Рентфлот за обслуговування нашого колективу...",
      "href"=>"drujba"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Юнивест Принт",
      "text"=>"Компания Юнивест Марктинг висловлює свою подяку...",
      "href"=>"univestprint"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Ренессанс",
      "text"=>"Я, Сотник Вячеслав Анатольевич, менеджер по мотивации персонала компании...",
      "href"=>"renessans"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Коннов и Созановский",
      "text"=>"Этим письмом хотим выразить благодарность компании Рентфлот...",
      "href"=>"konnov"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"ООО «Арктур»",
      "text"=>"Фирма «Арктур» выражает свою признательность КСК Рентфлот за отличную организацию...",
      "href"=>"arktur"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Астеллас Фарма Юроп Б.В.",
      "text"=>"22.06.2010 для сотрудников представительства компании...",
      "href"=>"astellas"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Простобанк консалтинг",
      "text"=>"Компания Простобанк консалтинг выражает благодарность компании Рентфлот...",
      "href"=>"prostobank"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"МБФ «Еврейский Хэсэд Бней Азриэль»",
      "text"=>"Прежде всего, позвольте поблагодарить Вас за комфортное обслуживание сотрудников Фонда...",
      "href"=>"bney_azriel"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Нафтогаз Украины",
      "text"=>"Первинна профспілка організаціі філіі Метрологічний центр НАК Нафтогаз Украины висловлюе...",
      "href"=>"naftogaz_of_ukraine"
    );
    $clients[]=$client;

    $client=array(
      "name"=>"Скай Тревел Холдинг ЛТД",
      "text"=>"ТОВ Скай Тревел Холдинг ЛТД рекомендует компанию Рентфлот для организации речного отдыха...",
      "href"=>"sky_travel"
    );
    $clients[]=$client;

    $clients_nums = array_rand ( $clients ,3 );
    $real_clients=array();
    foreach($clients_nums as $index)
    {
      $real_clients[]=$clients[$index];
    }
	
	  $this->clients=$real_clients;
  }
  public function executeAdminMenu($request)
  {    
    $this->getContext()->getConfiguration()->loadHelpers('Rentflot');
    $this->menu1 = array();
    $this->menu2 = array();

    if ($this->getUser()->hasCredential('catalog'))
    {
      $this->menu1[] = admin_menu_item('Плавсредства, аттракционы и услуги', 'item');
    }
    if ($this->getUser()->hasCredential('owners'))
    {
      $this->menu1[] = admin_menu_item('Судовладельцы', 'owner');
    }
    if ($this->getUser()->hasCredential('clients'))
    {
      $this->menu1[] = admin_menu_item('Клиенты', 'client');
    }
    if ($this->getUser()->hasCredential('articles'))
    {
      $this->menu1[] = admin_menu_item('Статьи', 'article');
    }
    
    if ($this->getUser()->hasCredential('calendar'))
    {
      $this->menu2[] = admin_menu_item('Календарь', 'calendar_schedule');
    }
    if ($this->getUser()->hasCredential('order'))
    {
      $this->menu2[] = admin_menu_item('Заказы', 'order');
    }
    if ($this->getUser()->hasCredential('contact'))
    {
      $this->menu2[] = admin_menu_item('Напоминания', 'client_contact');
    }
    if ($this->getUser()->hasCredential('bills'))
    {
      $this->menu2[] = admin_menu_item('Бухгалтерия', 'bill');
    }
    if ($this->getUser()->hasCredential('reports'))
    {
      $this->menu2[] = admin_menu_item('Отчеты', 'reports');
    }
    if ($this->getUser()->hasCredential('auth_user'))
    {
      $this->menu2[] = admin_menu_item('Пользователи', 'sf_guard_user');
    }
    if ($this->getUser()->hasCredential('books'))
    {
      $this->menu2[] = admin_menu_item('Настройки', 'settings');
    }
	
	$users_q="SELECT DISTINCT cc.created_by as user_id, CONCAT(gup.first_name,' ',gup.last_name) as user_name FROM client_contact cc,sf_guard_user_profile gup WHERE date(cc.contact_date)=CURDATE() AND cc.created_by=gup.user_id
ORDER BY concat(gup.first_name,gup.last_name)";
	$creators_list = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($users_q);	
	
	//foreach($creators_list as $user)
	for($i=0;$i<count($creators_list);$i++)
	{
		$user=$creators_list[$i];
		$contact_q="SELECT order_id,contact_time FROM client_contact WHERE date(contact_date)=CURDATE() AND created_by=".$user["user_id"];
		$contacts=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($contact_q);	
		$creators_list[$i]["contacts"]=$contacts;
	}
		//echo "<pre>";
		//print_r($creators_list);
		//die;

	$this->contacts_flash=$creators_list;
	
	$calls_q="SELECT * FROM callback";
	$calls_list = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($calls_q);	
	$this->calls_list=$calls_list;
    /*
    <?php echo  ?> &bull; <?php echo  ?> &bull; <?php echo  ?> &bull; <?php echo admin_menu_item('Статьи', 'article') ?>
  <?php  admin_menu_item('Заказы', 'order') ?> &bull; <?php echo admin_menu_item('Бухгалтерия', 'bill') ?>  &bull; <?php echo  ?>  &bull; <?php echo  ?> &bull; <?php echo admin_menu_item('Настройки', 'settings') ?><br/>
  */
  }
  
}