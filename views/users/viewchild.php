<?php

use yii\helpers\Html;

$this->title = 'View Descendants for: ' . $user->parent_name;
$this->params['breadcrumbs'][] = 'View Descendants';
?>
<div class="users-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

	<div class="table-responsive">
		<table class="table table-hover table-condensed">
	    <thead>
	      <tr>
	        <th>Rank</th>
	        <th>Name</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php foreach ($descendants as $key => $value):?>
		<tr>
			<td><?=$value["type"];?></td>
			<td><?=$value["name"];?></td>
		</tr>    	
	    <?php endforeach;?>
	    </tbody>
	    </table>
	</div>

</div>
