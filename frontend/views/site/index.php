<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\StringHelper;
$this->title = Yii::$app->name;
?>
<div class="site-index row">
	<div class="col-md-9">
		<?php foreach ($models as $key => $value): ?>
	    <div class="media">
	      <div class="media-left media-middle">
	        <a href="#">
			    <img class="media-object" src="https://static.oschina.net/uploads/img/201711/15190729_qSNe.jpg" width="150" height="93" alt="...">

	        </a>
	      </div>
	      <div class="media-body">
	        <h4 class="media-heading"><?= $value->post_title ?></h4>
	        <p>
	        	<?= mb_substr($value->post_excerpt, 0, 100) ?>...&nbsp;&nbsp;&nbsp;
	        	<a href="<?= Url::to(['site/article', 'id'=>$value->id]) ?>" title="" class="pull-right">阅读全文&nbsp;&nbsp;&nbsp;>></a>
	    	</p>
	        <p class="row">
	        	<span class="fa fa-user col-md-2">&nbsp;<?= $value->user_id ?></span>
	        	<span class="fa fa-list col-md-2">&nbsp;</span>
	        	<span class="fa fa-eye col-md-2">&nbsp;<?= $value->post_hits ?></span>
	        	<span class="fa fa-star-o col-md-2">&nbsp;</span>
	        	<span class="fa fa-clock-o col-md-4">&nbsp;<?= date('Y-m-d H:i:s', $value->published_time) ?></span>
	        </p>
	      </div>
	    </div>
		<?php endforeach ?>
		<div class="text-center">
		<?php echo yii\widgets\LinkPager::widget([
			    'pagination' => $pages,
		]);?>
		</div>
	</div>
	<?php
		$top = backend\models\Article::find()
			->select(['id', 'post_title', 'post_hits', 'published_time'])
			->where(['post_status'=>1, 'post_type'=>1])
			->orderBy('post_hits DESC')
			->limit(5)
            ->all();

        $recommended = backend\models\Article::find()
			->select(['id', 'post_title', 'post_hits', 'published_time'])
			->where(['post_status'=>1, 'post_type'=>1, 'recommended'=>1])
			->orderBy('post_hits DESC')
			->limit(5)
            ->all();

        $friendLink = backend\models\FriendLink::find()
			->where(['status'=>1])
			->orderBy('sort ASC')
            ->all();
	?>
	<div class="col-md-3">
	    <div class="list-group">
	      <a href="#" class="list-group-item active">排行榜</a>
	      <?php foreach ($top as $key => $value): ?>
	      <a href="<?= Url::to(['article/view', 'id'=>$value->id]) ?>" class="list-group-item"><?= mb_substr($value->post_title, 0, 15)?>...<span class="badge"><?= $value->post_hits ?></span></a>
	      <?php endforeach ?>
	    </div>
	    <div class="list-group">
	      <a href="#" class="list-group-item active">推荐</a>
	      <?php foreach ($recommended as $key => $value): ?>
	      <a href="<?= Url::to(['article/view', 'id'=>$value->id]) ?>" class="list-group-item"><?= mb_substr($value->post_title, 0, 15)?>...<span class="badge"><?= $value->post_hits ?></span></a>
	      <?php endforeach ?>
	    </div>
	    <div class="list-group">
	      <a href="#" class="list-group-item active">友情链接</a>
	      <?php foreach ($friendLink as $key => $value): ?>
	      <a href="<?= $value->url ?>" class="list-group-item" target="<?= $value->target ?>"><?= $value->name ?></a>
	      <?php endforeach ?>
	    </div>
	</div>
</div>
