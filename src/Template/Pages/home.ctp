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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('styles.css') ?>
</head>
<body>
    <h1>Welcome to the NT Musician's Database!</h1>
	<div class='latest'>
		<h3>Latest Musicians</h3>
		<?php foreach ($musician as $musician): ?>
    	<div class="smallScreenBorder">
        <?php $name = $musician->first_name . " " . $musician->last_name; ?>
        <div class="row">
            <div class="col-sm-4">
                <div class="musicianList">
                    <?php if($musician->portrait == ""): ?>
                        <?php echo $this->Html->image('default.png',array('class'=>'thumbnail')); ?>
                    <?php else: ?>
                        <?php echo $this->Html->image($musician['portrait'],array('class'=>'thumbnail')); ?>
                    <?php endif; ?>
                </div>
            </div>
	</div>

	<div class='latest'>
		<h3>Latest Bands</h3>
		
	</div>
</body>
</html>
