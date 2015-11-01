<head>
    <title>Band: <?= h($band->band_name) ?></title>
</head>
<h1>Band</h1>
<div class="row">
    <div class="col-sm-12">
        <div id="profileHeader">
     <?php $image = 'uploads/bands/' . $band->id . '/' . $band->logo; ?>

        <?php if($band->logo == ""): ?>
            <p><?= $this->Html->image('default.png',array('class'=>'portrait')) ?></p>
        <?php else: ?>
            <p><?= $this->Html->image($image ,array('class'=>'portrait')) ?></p>
        <?php endif; ?>
    <h3 id='name'><?= h($band->band_name) ?></h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <h3>Band Details</h3>
    </div>
</div>

<div class="row">
    <div class="tableDetail">
        <table class="table table-striped">
            <tr>
                <th><?= __('Brand Name') ?></th>
                <td><?= h($band->band_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Genre') ?></th>
                <td><?= h($band->genre) ?></td>
            </tr>
            
            <tr>
                <th>Creator</th>
                <?php foreach ($musician as $creator): ?>
                    <?php if($creator->username == $band->user_id): ?>
                        <?php $musicianPath = "/musician/view/".$creator->username?>
                        <td><a href=<?= $musicianPath?>><?= $creator->first_name?> <?= $creator->last_name?></a></td>
                    <?php endif; ?>
                <?php endforeach; ?>
                
            </tr>

            <tr>
                <th><?= __('Established') ?></th>
                <td><?= h($band->created) ?></td>
            </tr>
            <?php $count = 0 ?>
            <?php foreach ($musician as $member): ?>
                <?php if($member->band_id == $band->id): ?>
                    <?php $firstName = $member->first_name;?>
                    <?php $lastName = $member->last_name;?>
                    <?php $fullName = $firstName . " " . $lastName; ?>
                    <?php $count += 1 ?>
                        <tr>
                          <th>Member <?= $count ?></th>
                            <?php if($member->speciality == ""): ?>
                                <?php $memSpecial = " - Speciality not identified"?>
                            <?php else: ?>
                                <?php $memSpecial = " - ".$member->speciality?>
                            <?php endif; ?>
                            <td><?php echo $this->Html->link($fullName, ['controller' => 'Musician', 'action' => 'view', $member->username], 
                                 array('target'=>'_blank', 'escape' => false));?> <?= $memSpecial ?></td>
                         </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            
        </table>
                <?php if($this->request->session()->read('Auth.User.username') == 'admin' || $this->request->session()->read('Auth.User.username') == $band->user_id): ?>
        <?php $userPath = "/band/edit/" . $band->id;?>
        <div class="row"><p><a href=<?= $userPath ?> class='btn btn-default btn-sm'>Edit &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></a></p></div>
        <div class="row">
            <?php $deletePath = "/band/delete/".$band->id?>
            <?php $deleteMessage = '"return confirm('."'Are you sure you want to delete band: " .$band->id.'?'."'".')"'?>
            <form action=<?= $deletePath?> method="post" onsubmit= <?= $deleteMessage?>>
                <button class='btn btn-default btn-sm' type="submit">Delete <span class="glyphicon glyphicon-remove-circle"></span></button>
            </form>
        </div>
    <?php endif; ?>
    </div>
</div>

<div class="row">
    <div id='bioDiv'>
        <h3 id='bio_header'><b>Bio</b></h3>
        <p id='bio_body'><?= h($band->bio) ?></p>
    </div>
</div>


<div class="row">
    <div id='members'>
        <h3><b>Members</b></h3>
        <?php foreach ($musician as $musician): ?>
            <div class="col-sm-4">
                <?php if($musician->band_id == $band->id): ?>
                    <?php $image = $this->Html->image($musician['portrait'], array('class'=>'thumbnail'));?>
                    <?php echo $this->Html->link($image, ['controller' => 'Musician', 'action' => 'view', $musician->username], array('target'=>'_blank', 'escape' => false));?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
        