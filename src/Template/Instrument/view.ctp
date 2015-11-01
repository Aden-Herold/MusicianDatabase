<head>
    <title>Instrument</title>
</head>
<h1>Instrument</h1>
<div class="row">
    <div class="col-sm-12">
        <div id="profileHeader">
        <?php $image = 'uploads/instruments/' . $instrument->id . '/' . $instrument->portrait; ?>

        <?php if($instrument->portrait == ""): ?>
            <p><?= $this->Html->image('default.png',array('class'=>'portrait')) ?></p>
        <?php else: ?>
            <p><?= $this->Html->image($image ,array('class'=>'portrait')) ?></p>
        <?php endif; ?>
    <h3 id='name'><?= $instrument->has('musician') ? $this->Html->link($instrument->musician->first_name, ['controller' => 'Musician', 'action' => 'view', $instrument->musician->username]) : '' ?>'s
     <?=$instrument->year ?> <?=$instrument->make ?> <?=$instrument->model ?></h3>
        </div>
    </div>
</div>

<div class="adminModification">
    <?php if($this->request->session()->read('Auth.User.username') == $instrument->user_id || $this->request->session()->read('Auth.User.username') == 'admin'): ?>
        
        <div class="row">
            <?php $instrumentViewPath = "/instrument/edit/".$instrument->id; ?>
            <a href=<?=$instrumentViewPath ?> class="btn btn-default btn-xs">Edit &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
        </div>
        <div class="row">
            <?php $deletePath = "/instrument/delete/".$instrument->id?>
            <?php $deleteMessage = '"return confirm('."'Are you sure you want to delete the instrument " .$instrument->id.'?'."'".')"'?>
            <form action=<?= $deletePath?> method="post" onsubmit= <?= $deleteMessage?>>
                <button class='btn btn-default btn-xs' type="submit">Delete <span class="glyphicon glyphicon-remove-circle"></span></button>
            </form>
        </div>
    <?php endif; ?>   
</div>

<div class="row">
    <div class="col-sm-5">
        <h3>Instrument Details</h3>
    </div>
</div>

<?php $firstName = $instrument->has('musician') ? $instrument->musician->first_name : '';?>
<?php $lastName = $instrument->has('musician') ? $instrument->musician->last_name : '';?>
<?php $fullName = $firstName . " " . $lastName; ?>

<div class="row">
    <div class="tableDetail">
        <table class="table table-striped table-bordered">
            <?php $firstName = $instrument->has('musician') ? $instrument->musician->first_name : '';?>
            <?php $lastName = $instrument->has('musician') ? $instrument->musician->last_name : '';?>
            <?php $fullName = $firstName . " " . $lastName; ?>
            <tr>
                <th><?= __('Owner') ?></th>
                <td><?= $instrument->has('musician') ? $this->Html->link($fullName, ['controller' => 'Musician', 'action' => 'view', $instrument->musician->username]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Type') ?></th>
                <td><?= h($instrument->type) ?></td>
            </tr>
            <tr>
                <th><?= __('Make') ?></th>
                <td><?= h($instrument->make) ?></td>
            </tr>
            <tr>
                <th><?= __('Model') ?></th>
                <td><?= h($instrument->model) ?></td>
            </tr>
            <tr>
                <th><?= __('Year') ?></th>
                <td><?= $this->Number->format($instrument->year) ?></td>
            </tr>
        </table>
    </div>
</div>