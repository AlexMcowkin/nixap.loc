<?php
use yii\helpers\Html;

$this->title = Html::encode(Yii::t('app', '404'));
$this->registerMetaTag(['name' => 'keywords', 'content' => '404']);
$this->registerMetaTag(['name' => 'description', 'content' => '404']);

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col0-md-12">
		<?=$errorMessage;?>
	</div>
</div>
