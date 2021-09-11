<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\StringHelper;
?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="fas fa-edit"></i> '.Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
          'label' => 'Signup',
          'url' => ['/site/signup'],
          'linkOptions' => [
            'class' => 'text-light'
          ]
        ];
        $menuItems[] = [
          'label' => 'Login',
          'url' => ['/site/login'],
          'linkOptions' => [
            'class' => 'text-light'
          ]
        ];
    } else {

        $menuItems[] = [
          'label' => '<i class="fas fa-door-open"></i> Logout (' . StringHelper::truncate(Yii::$app->user->identity->username,12) . ')',
          'url' => ['/site/logout'],
          'linkOptions' => [
            'class' => 'btn btn-danger',
            'data' => [
              'method' => 'POST'
            ]
          ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'ml-auto'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>
