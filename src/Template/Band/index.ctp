 <head>
    <title>Band Lists</title>
 </head>
   <h1>Band Lists</h1>

<?php if($this->request->session()->read('Auth.User.username') != ""): ?>
    <div class="row">
        <div class="col-sm-5">
            <a class="btn btn-link" href="/band/add">Add a band <span class="glyphicon glyphicon-plus"></span></a>
        </div>
    </div>
<?php endif; ?>


    <div class="hidden-xs">
        <div class="bandListsHeader">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Logo</h4>
                </div>
                <div class="col-sm-1">
                    <h4>ID</h4>
                </div>
                <div class="col-sm-3">
                    <h4>Band Name</h4>
                </div>
                <div class="col-sm-2">
                    <h4>Genre</h4>
                </div>
            </div>
        </div>
    </div>


    <?php foreach ($band as $band): ?>
        <div class="bandLists">
            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <?php $image = 'uploads/bands/' . $band->id . '/' . $band->logo; ?>
                        <?php if($band->logo == ""): ?>
                            <?php echo $this->Html->image('default.png',array('class'=>'bandThumbnail'));?>
                        <?php else: ?>
                            <?php echo $this->Html->image($image,array('class'=>'bandThumbnail'));?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="row">
                        <?= $this->Number->format($band->id) ?>
                    </div>
                    
                </div>

                <div class="col-sm-3">
                    <?= h($band->band_name) ?>
                </div>

                <div class="col-sm-2">
                    <?= h($band->genre) ?>
                </div>

                <div class="col-sm-2">

                    <div class="row">
                        <?php $bandViewPath = "/band/view/".$band->id; ?>
                        <a href=<?=$bandViewPath ?> class="btn btn-default btn-xs">View &nbsp;<span class="glyphicon glyphicon-eye-open"></span></a>
                    </div>
                    
                    <?php if($this->request->session()->read('Auth.User.username') != "" ): ?>
                        <?php $bandJoin = "/band/join/".$band->id?>
                        <div class="row">
                            <a href=<?= $bandJoin?> class="btn btn-default btn-xs">Join &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-circle-arrow-left"></span></a>
                        </div>
                    <?php endif; ?>

                    <?php if($this->request->session()->read('Auth.User.username') == $band->user_id || $this->request->session()->read('Auth.User.username') == "admin"): ?>

                        <div class="row">
                            <?php $bandViewPath = "/band/edit/".$band->id; ?>
                            <a href=<?=$bandViewPath ?> class="btn btn-default btn-xs">Edit &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
                        </div>
                        <div class="row">
                            <?php $deletePath = "/band/delete/".$band->id?>
                            <?php $deleteMessage = '"return confirm('."'Are you sure you want to delete the band " .$band->band_name.'?'."'".')"'?>
                            <form action=<?= $deletePath?> method="post" onsubmit= <?= $deleteMessage?>>
                                <button class='btn btn-default btn-xs' type="submit">Delete <span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>   

<?php if($this->request->session()->read('Auth.User.username') == ""): ?>
    <p class="text-right">Please sign-in to add a new band.</p>
<?php endif; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
