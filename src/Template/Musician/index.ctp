<head>
    <title>Musician Lists</title>
</head>

<h1>All Musicians</h1>

<div class="hidden-xs">
        <div class="row">
            <div class="col-sm-4">
                <div class="musicianList"><h3>Portrait</h3></div>
            </div>
            <div class="col-sm-5">
                <div class="musicianList"><h3>Details</h3></div>
            </div>
            <div class="col-sm-3">
                <div class="musicianList"><h3>Status</h3></div>
            </div>
        </div>
    </div>
    
    <?php foreach ($musician as $musician): ?>
    <div class="smallScreenBorder">
        <?php $name = $musician->first_name . " " . $musician->last_name; ?>
        <div class="row">
            <div class="col-sm-4">
                <div class="musicianList">
                    <?php $image = 'uploads/users/' . $musician->username . '/' . $musician->portrait; ?>
                    <?php if($musician->portrait == ""): ?>
                        <?php echo $this->Html->image('default.png',array('class'=>'thumbnail')); ?>
                    <?php else: ?>
                        <?php echo $this->Html->image($image,array('class'=>'thumbnail')); ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="musicianList">
                    <div class="row">
                        <h3><?= $this->Html->link($name, ['controller' => 'Musician', 'action' => 'view', $musician->username])?></h3>
                    </div>
                    <?php if($musician->band_id ==""):?>
                        <div class="row">
                            Not in any band
                        </div>
                    <?php else: ?>
                        <div class="row">
                            A member of <?= $musician->has('band') ? $this->Html->link($musician->band->band_name, ['controller' => 'Band', 'action' => 'view', $musician->band->id]) : '' ?>
                        </div>
                        <br> 
                    <?php endif; ?>
                    <div class="row">
                        <?php if($this->request->session()->read('Auth.User.username') == 'admin'): ?>
                            <?php $modifyPath = "/musician/edit/" . $musician->username ?>
                            <a href=<?= $modifyPath?> class="btn btn-default btn-sm">Edit &nbsp;Musician&nbsp;&nbsp; <span class="glyphicon glyphicon-pencil"></span></a>
                            <?php $deletePath = "/musician/delete/".$musician->username?>
                            <?php $deleteMessage = '"return confirm('."'Are you sure you want to delete User: " .$musician->username.'?'."'".')"'?>
                            <form action=<?= $deletePath?> method="post" onsubmit= <?= $deleteMessage?>>
                                <button class='btn btn-default btn-sm' type="submit">Delete Musician <span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="musicianList"><b>Offline</b></div>
            </div>
        </div></div>
    <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
