<head>
    <title>Add a band</title>
</head>
    <div class="bodyContainer">
        <h1>Add Band</h1>
        <?= $this->Form->create($band) ?>
        <?php $user_id = $this->request->session()->read('Auth.User.username') ?>
        <fieldset>
            <?php
                echo $this->Form->input('user_id', array('type' => 'hidden', 'value' =>  $user_id));
                echo $this->Form->input('band_name', array('class'=>'form-control', 'placeholder'=>'Band Name'));
                echo $this->Form->input('genre', array('class'=>'form-control', 'placeholder'=>'Genre'));
            ?>
        </fieldset>
        <?= $this->Form->submit('Submit', array('class' => 'btn btn-default')) ?>
        <?= $this->Form->end() ?>
    </div>