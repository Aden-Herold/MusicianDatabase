<head>
    <title>Edit Instrument</title>
</head>

<div class="bodyContainer">
    <h1>Edit Instrument</h1>

    <?= $this->Form->create($instrument, array('type'=>'file')) ?>
    <fieldset>
        <?php
            echo $this->Form->input('type', array('class'=>'form-control', 'placeholder'=>'Type'));
            echo $this->Form->input('make', array('class'=>'form-control', 'placeholder'=>'Make'));
            echo $this->Form->input('model', array('class'=>'form-control', 'placeholder'=>'Model'));
            echo $this->Form->input('year', array('class'=>'form-control', 'placeholder'=>'Year'));
            echo $this->Form->input('fileToUpload', array('type'=>'file', 'label'=>'Upload Photo', 'class'=>'form-control'));
        ?>
    </fieldset>
    <?= $this->Form->submit('Submit', array('class' => 'btn btn-default')) ?>
    <?= $this->Form->end() ?>
</div>