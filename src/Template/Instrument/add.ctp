<head>
    <title>Add Instrument</title>
</head>
    <div class="bodyContainer">
        <h1>Add Instrument</h1>
        <?= $this->Form->create($instrument) ?>
        <fieldset>
            
            <?php
                echo $this->Form->input('user_id', ['options' => $musician, 'type' => 'hidden', 'value' =>  $musician]);
                echo $this->Form->input('type', array('class'=>'form-control', 'placeholder'=>'Type'));
                echo $this->Form->input('make', array('class'=>'form-control', 'placeholder'=>'Make'));
                echo $this->Form->input('model', array('class'=>'form-control', 'placeholder'=>'Model'));
                echo $this->Form->input('year', array('class'=>'form-control', 'placeholder'=>'Year'));
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>



