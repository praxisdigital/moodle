<?php
$bundledata =  @$_GET['bundleddata'];
header('Location: ../auth/ef_webbog_sso/ssoindex.php?bundleddata='.$bundledata);
exit;
