<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table cron_job_table(id int not null auto_increment, lastrun datetime, primary key(id));
    insert into cron_job_table values(1,'2016-07-06 08:00:00');
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 