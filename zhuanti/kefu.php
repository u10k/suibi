<?php
header("Content-Type:text/html;Charset=utf-8");
$yii = dirname(__FILE__) . "../../framework/yii.php";
$config = require dirname(__FILE__) . '../../protected/config/main.php';
require_once($yii);
$app = Yii::createWebApplication($config);
//$model = \application\modules\admin\models\Custom::model()->getCustoms();
$model = \application\modules\admin\models\Custom::model()->getCustomsToHome();
?>

