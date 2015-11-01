<head>
    <title>Edit Profile</title>
</head>
<body>
    <div class="bodyContainer">
        <h1>Edit Profile</h1>
        <?= $this->Form->create($musician, array('type'=>'file')); ?>
        <fieldset>
            <?php
                echo $this->Form->input('username', array('type'=>'hidden'));
                echo $this->Form->input('first_name', array('class'=>'form-control', 'placeholder'=>'First Name'));
                echo $this->Form->input('last_name', array('class'=>'form-control', 'placeholder'=>'Last Name'));
                echo $this->Form->input('speciality', array('class'=>'form-control', 'placeholder' => 'Speciality', 'label'=>'Which instrument do you play?'));
                echo $this->Form->input('fileToUpload', array('type'=>'file', 'label'=>'Upload Photo', 'class' => 'form-control'));
                echo $this->Form->input('band', ['options' => $band, 'empty' => true , 'class'=>'form-control']);
                echo $this->Form->input('contact_number', array('class'=>'form-control', 'placeholder'=>'contact_number'));
                echo $this->Form->input('post_code', array('class'=>'form-control', 'placeholder'=>'post_code'));
                echo $this->Form->input('email', array('class'=>'form-control', 'placeholder'=>'Email'));
                echo $this->Form->input('bio', array('class'=>'form-control'));
            ?>
        </fieldset>
        <div class="btn-group">
                <?= $this->Form->submit('Submit', array('class'=>'btn btn-default')) ?>
        </div>
            
        <?= $this->Form->end() ?>
    </div>
</body