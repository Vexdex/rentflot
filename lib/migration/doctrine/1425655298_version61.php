<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version61 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('news_translation', 'news_translation_id_news_id', array(
             'name' => 'news_translation_id_news_id',
             'local' => 'id',
             'foreign' => 'id',
             'foreignTable' => 'news',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('news_translation', 'news_translation_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('news_translation', 'news_translation_id_news_id');
        $this->removeIndex('news_translation', 'news_translation_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }
}