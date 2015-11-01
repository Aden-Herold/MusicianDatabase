<head>
    <title>Add</title>
</head>
<body>
    <div class="bodyContainer">
        <?= $this->Form->create($musician) ?>
        <fieldset>
            <legend><?= __('Add Musician') ?></legend>
            <?php
                echo $this->Form->input('band_id', ['options' => $band]);
                echo $this->Form->input('password');
                echo $this->Form->input('first_name');
                echo $this->Form->input('last_name');
                echo $this->Form->input('dob');
                echo $this->Form->input('portrait');
                echo $this->Form->input('email');
                echo $this->Form->input('contact_number');
                echo $this->Form->input('post_code');
                echo $this->Form->input('joined');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</body>
