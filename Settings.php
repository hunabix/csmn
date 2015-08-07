<?php
/**********************************************************************************
* Settings.php                                                                    *
***********************************************************************************
* SMF: Simple Machines Forum                                                      *
* Open-Source Project Inspired by Zef Hemel (zef@zefhemel.com)                    *
* =============================================================================== *
* Software Version:           SMF 1.1                                             *
* Software by:                Simple Machines (http://www.simplemachines.org)     *
* Copyright 2006 by:          Simple Machines LLC (http://www.simplemachines.org) *
*           2001-2006 by:     Lewis Media (http://www.lewismedia.com)             *
* Support, News, Updates at:  http://www.simplemachines.org                       *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license as published by Simple Machines LLC.          *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the Simple Machines license.          *
* The latest version can always be found at http://www.simplemachines.org.        *
**********************************************************************************/

########## Maintenance ##########
# Note: If $maintenance is set to 2, the forum will be unusable!  Change it to 0 to fix it.
$maintenance = 0;		# Set to 1 to enable Maintenance Mode, 2 to make the forum untouchable. (you'll have to make it 0 again manually!)
$mtitle = 'Foros interactivos';		# Title for the Maintenance Mode message.
#$mmessage = 'En este momento estamos dando mantenimeinto a www.musinetwork.com para mejorar su funcionalidad... El foro regresará a la actividad lo antes posible.';		# Description of why the forum is in maintenance mode.
$mmessage = 'Hola a todos!<br><br>Les informamos que estamos por terminar el proceso de migraci&oacute;n a un nuevo servidor, por esta raz&oacute;n, los FOROS DE LA COMUNIDAD (solamente) est&aacute;n parcialmente deshabilitados por algunas horas.<br><br> El resto de la página y el CAMPUS MUSINETWORK funcionan normalmente. <br><br>De antemano, muchas gracias por su comprensión y por ser parte de Musinetwork!';

########## Forum Info ##########
$mbname = 'Comunidad Musinetwork';		# The name of your forum.
$language = 'spanish';		# The default language file set for the forum.
$boardurl = 'http://www.musinetwork.com/foros';		# URL to your forum's folder. (without the trailing /!)
$webmaster_email = 'musinetw@musinetwork.com';		# Email address to send emails from. (like noreply@yourdomain.com.)
$cookiename = 'SMFCookie426';		# Name of the cookie to set for authentication.

########## Database Info ##########
$db_server = 'localhost';
$db_name = 'musine_smf1';
$db_user = 'musine_smf1';
$db_passwd = 'TUuTLRbqjhxP';
$db_prefix = 'smf_';
$db_persist = 0;
$db_error_send = 0;

########## Directories/Files ##########
# Note: These directories do not have to be changed unless you move things.
$boarddir = '/home/musine/public_html/foros';		# The absolute path to the forum's folder. (not just '.'!)
$sourcedir = '/home/musine/public_html/foros/Sources';		# Path to the Sources directory.

########## Error-Catching ##########
# Note: You shouldn't touch these settings.
$db_last_error = 1299157696;

# Make sure the paths are correct... at least try to fix them.
if (!file_exists($boarddir) && file_exists(dirname(__FILE__) . '/agreement.txt'))
	$boarddir = dirname(__FILE__);
if (!file_exists($sourcedir) && file_exists($boarddir . '/Sources'))
	$sourcedir = $boarddir . '/Sources';

$db_character_set = 'utf8';
?>