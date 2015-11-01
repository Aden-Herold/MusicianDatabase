<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= $this->Html->meta('icon') ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <?= $this->Html->css('styles.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <div class="visible-xs">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">Musicians Database</a>
            </div>

            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <?php if($this->request->session()->read('Auth.User.username')): ?>
                    <?php $profilePath = "/musician/view/".$this->request->session()->read('Auth.User.username'); ?>
                    <li><a href=<?= $profilePath ?>>My Profile</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Discover<span class="caret"></span></a>
                        <ul class="nav dropdown-menu">
                            <li><a href="/musician">Musicians</a></li>
                            <li><a href="/band">Bands</a></li>
                            <li><a href="/instrument">Instruments</a></li>
                        </ul>
                    </li>
                    <li><a href="/Band/add">Create Band</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Discover<span class="caret"></span></a>
                        <ul class="nav dropdown-menu">
                            <li><a href="/musician">Musicians</a></li>
                            <li><a href="/band">Bands</a></li>
                            <li><a href="/instrument">Instruments</a></li>
                        </ul>
                    </li>
                    <li><a href="/Musician/register">Register</a></li>
                <?php endif; ?>
                <?php if($this->request->session()->read('Auth.User.username')): ?>
                    <form method="post" action="/Musician/logout">
                    <li><?= $this->Form->button('logout', array('class'=>'btn btn-default')); ?></li>
                    <?= $this->Form->end(); ?>
                <?php else: ?>
                    <form method="post" action="/Musician/login">
                        <input class="form-control" type="text" placeholder="Username" name="username">
                        <input class="form-control" type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn btn-default" size="4">Submit</button>
                    </form>
                <?php endif; ?>
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="hidden-xs">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Musicians Database</a>
            </div>
              <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <?php if($this->request->session()->read('Auth.User.username')): ?>
                    <?php $profilePath = "/musician/view/".$this->request->session()->read('Auth.User.username'); ?>
                    <li><a href=<?= $profilePath ?>>My Profile</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Discover<span class="caret"></span></a>
                        <ul class="nav dropdown-menu">
                            <li><a href="/musician">Musicians</a></li>
                            <li><a href="/band">Bands</a></li>
                            <li><a href="/instrument">Instruments</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Discover<span class="caret"></span></a>
                        <ul class="nav dropdown-menu">
                            <li><a href="/musician">Musicians</a></li>
                            <li><a href="/band">Bands</a></li>
                            <li><a href="/instrument">Instruments</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
              </ul>

              <ul class="nav navbar-nav navbar-right">

                <?php if($this->request->session()->read('Auth.User.username')): ?>
                    <form class="navbar-form navbar-nav navbar-right" method="post" action="/Musician/logout">
                    <li><?= $this->Form->button('logout', array('class'=>'btn btn-default')); ?></li>
                    <?= $this->Form->end(); ?>
                <?php else: ?>
                    <li><a href="/Musician/register">Register</a></li>
                    <form class="navbar-form navbar-nav navbar-right" method="post" action="/Musician/login">
                        <input class="form-control" type="text" placeholder="Username" name="username" size="7">
                        <input class="form-control" type="password" placeholder="Password" name="password" size="7">
                        <button type="submit" class="btn btn-default" size="4">Submit</button>
                    </form>
                <?php endif; ?>
              </ul>
          </div>
        </nav>
    </div>

    <?= $this->Flash->render() ?>
    <div class="bodyContainer">
        <?= $this->fetch('content') ?>
    </div>
    
    <footer class="footer">
      <div class="container">
        <p class="navbar-fixed-bottom">Copyright  &copy;</p>
      </div>
    </footer>

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
</body>
</html>
