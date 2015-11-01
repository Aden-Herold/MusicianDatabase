<head>
    <title>Edit Band: <?= h($band->band_name) ?></title>
</head>

<body>

    <div class="bodyContainer">
        <h1>Edit Band</h1>
        <?= $this->Form->create($band, array('type'=>'file')) ?>
        <fieldset>
            <legend><?= __('Edit Band') ?></legend>
            <?php
                echo $this->Form->input('band_name', array('class'=>'form-control', 'placeholder'=>'Band Name'));
                echo $this->Form->input('genre', array('class'=>'form-control', 'placeholder'=>'Genre'));
                 echo $this->Form->input('bio', array('class'=>'form-control', 'placeholder'=>'Bio'));
                echo $this->Form->input('fileToUpload', array('type'=>'file', 'label'=>'Upload Logo', 'class'=>'form-control'));
            ?>
        </fieldset>
        <?= $this->Form->submit('Submit', array('class'=>'btn btn-default')) ?>
        <?= $this->Form->end() ?>
    </div>
</body>

