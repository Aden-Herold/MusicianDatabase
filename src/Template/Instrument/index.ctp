<head>
    <title>Instrument Lists</title>
</head>

<h1>Instrument Lists</h1>
<?php if(!$instrument->isEmpty()): ?>
<?php if($this->request->session()->read('Auth.User.username') != ""): ?>
    <div class="row">
        <div class="col-sm-5">
            <a class="btn btn-link" href="/instrument/add">Add an instrument <span class="glyphicon glyphicon-plus"></span></a>
        </div>
    </div>
<?php endif; ?>

<div class="hidden-xs">
    <div class="row">
        <div class="col-xs-3">
            <div class="instrumentList"><h4>Portrait</h4></div>
        </div>
        <div class="col-xs-1">
            <div class="instrumentList"><h4>Type</h4></div>
        </div>
        <div class="col-xs-2">
            <div class="instrumentList"><h4>Make</h4></div>
        </div>
        <div class="col-xs-2">
            <div class="instrumentList"><h4>Model</h4></div>
        </div>
        <div class="col-xs-1">
            <div class="instrumentList"><h4>Year</h4></div>
        </div>
    </div>
</div>



    <?php foreach ($instrument as $instrument): ?>
        <div class="smallScreenBorder">
            <div class="row">
                <div class="col-sm-3">
                    <div class="instrumentList">
                        <?php $image = 'uploads/instruments/' . $instrument->id . '/' . $instrument->portrait; ?>
                        <?php if($instrument->portrait == ""): ?>
                            <?php echo $this->Html->image('default.png',array('class'=>'bandThumbnail'));?>
                        <?php else: ?>
                            <?php echo $this->Html->image($image,array('class'=>'bandThumbnail'));?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="instrumentList">
                        <p><?= h($instrument->type) ?></p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="instrumentList">
                        <p><?= h($instrument->make) ?></p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="instrumentList">
                        <p><?= h($instrument->model) ?></p>
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="instrumentList">
                        <p><?= $this->Number->format($instrument->year) ?></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="instrumentList">
                        <div class="row">
                            <?php $instrumentViewPath = "/instrument/view/".$instrument->id; ?>
                            <a href=<?=$instrumentViewPath ?> class="btn btn-default btn-xs">View &nbsp;<span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
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
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>


<?php else: ?>
    <h2 class="center-text">There is no instrument in the database</h2>
<?php endif;?>
        
    
