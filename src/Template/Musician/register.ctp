<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Registration
    </title>
</head>


    <div class="bodyContainer">
        <h1>Register</h1>

        <?= $this->Form->create($musician) ?>
        <fieldset>
            <?php echo $this->Form->input('username', array('class'=>'form-control', 'placeholder'=>'Username', 'type' => 'text')); ?>
            <?php echo $this->Form->input('password', array('class'=>'form-control', 'placeholder'=>'Password')); ?>
            <?php echo $this->Form->input('email', array('class'=>'form-control', 'placeholder'=>'Email')); ?>
            <?php echo $this->Form->input('first_name', array('class'=>'form-control', 'placeholder'=>'First Name')); ?>
            <?php echo $this->Form->input('last_name', array('class'=>'form-control', 'placeholder'=>'Last Name')); ?>
        </fieldset>
        <?= $this->Form->submit('Submit', array('class'=>'btn btn-default')) ?>
        <?= $this->Form->end() ?>

    </div>