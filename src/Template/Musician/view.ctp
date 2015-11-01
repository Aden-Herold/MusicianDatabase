<head>
    <title>Musicians</title>
</head>

<?php if($this->request->session()->read('Auth.User.username') == $musician->username): ?>
            <h1>My Profile</h1>
<?php endif; ?>
<div id="profileHeader">

    <div class="row">
            <?php $image = 'uploads/users/' . $musician->username . '/' . $musician->portrait; ?>

        <?php if($musician->portrait == ""): ?>
            <?php echo $this->Html->image('default.png',array('class'=>'portrait'));?>
        <?php else: ?>
            <?php echo $this->Html->image($image,array('class'=>'portrait'));?>
        <?php endif; ?>
    </div>

    <h2 id='name'><?= h($musician->first_name) ?> <?= h($musician->last_name) ?></h2>

    <table class="table" align="center">
        <tr>
            <th><?= __('Speciality') ?></th>
            <td><?php if($musician->speciality == ""): ?>
                    Not Specified
                <?php else: ?>
                    <?= h($musician->speciality) ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
        <th><?= __('Band') ?></th>
        <td><?php if($musician->band_id == "" && $musician->username == $this->request->session()->read('Auth.User.username')): ?>
                    <a href="/band">Add Band <span class="glyphicon glyphicon-plus"></span></a>
            <?php else: ?>
                <?php if($musician->band_id == ""):?>
                Not specified
                <?php else: ?>
                    <?php foreach ($band as $band): ?>
                        <?php if($band->id == $musician->band_id): ?>
                            <?php $bandPath = "/band/view/".$band->id?>
                            <a href=<?= $bandPath?>><?= $band->band_name?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        </tr>
        <tr>
            <th><?= __('Contact Number') ?></th>
            <td><?php if($musician->contact_number == ""): ?>
                    Not Specified
                <?php else: ?>
                    <?= h($musician->contact_number) ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?php if($musician->email == ""): ?>
                    Not Specified
                <?php else: ?>
                    <?php $mailtoPath = "mailto:".$musician->email."?Subject=From:%20NT%20Musician's%20Database"?>
                    <a href=<?= $mailtoPath?>><?= h($musician->email) ?></a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Area Code') ?></th>
            <td><?php if($musician->post_code == ""): ?>
                Not Specified
                <?php else: ?>
                    <?= h($musician->post_code) ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <?php if($this->request->session()->read('Auth.User.username') == 'admin' || $this->request->session()->read('Auth.User.username') == $musician->username): ?>
        <?php $userPath = "/musician/edit/" . $musician->username;?>
        <div class="row"><p><a href=<?= $userPath ?> class='btn btn-default btn-sm'>Edit &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></a></p></div>
        <div class="row">
            <?php $deletePath = "/musician/delete/".$musician->username?>
            <?php $deleteMessage = '"return confirm('."'Are you sure you want to delete User: " .$musician->username.'?'."'".')"'?>
            <form action=<?= $deletePath?> method="post" onsubmit= <?= $deleteMessage?>>
                <button class='btn btn-default btn-sm' type="submit">Delete <span class="glyphicon glyphicon-remove-circle"></span></button>
            </form>
        </div>
    <?php endif; ?>
</div>

<div id='bioDiv'>
    <h3 id='bio_header'><b>Bio</b></h3>
    <p id='bio_body'>
        <?php if($musician->bio == ""): ?>
                No bio as of yet!
        <?php else: ?>
                <?= h($musician->bio) ?>
        <?php endif; ?>
    </p>
</div>


<div class="visiblexs">
    <div class="row">
        <div id='instruments'>
            <h3><b>Instruments Owned</b></h3>
        </div>

        <?php foreach ($instrument as $instrument): ?>
            
                <?php if($instrument->user_id == $musician->username): ?>
                <?php $instrImage = 'uploads/instruments/' . $instrument->id . '/' . $instrument->portrait; ?>

                <?php if($instrument->portrait == ""): ?>
                    <?php $image = $this->Html->image('default.png', array('class'=>'thumbnail'));?>
                    <?php echo $this->Html->link($image, ['controller' => 'Instrument', 'action' => 'view', $instrument->id], 
                        array('target'=>'_blank', 'escape' => false));?>
                <?php else: ?>
                    <?php $image = $this->Html->image($instrImage, array('class'=>'thumbnail'));?>
                    <?php echo $this->Html->link($image, ['controller' => 'Instrument', 'action' => 'view', $instrument->id], 
                        array('target'=>'_blank', 'escape' => false));?>
                <?php endif; ?>

                <?php endif; ?>
            
        <?php endforeach; ?>
    </div>
</div>

<?php if($this->request->session()->read('Auth.User.username') == $musician->username): ?>
    <div class="row">
        <div class="addInstrument">
            <p><a href='/Instrument/add'>Add an instrument <span class="glyphicon glyphicon-plus"></span></a></p>
        </div>
    </div>
<?php endif; ?>

