<head>
    <title>Home</title>
</head>

<h1>Welcome to the NT Musician's Database</h1>

<?php if(!$musician->isEmpty()): ?>
    <div class="row">
        <h3>Latest Musicians</h3>
    </div>
        <!-- Carousel
        ================================================== -->
    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
            
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

                
            <div class="carousel-inner" role="listbox">
                <?php $counter = 0;?>
                <?php foreach ($musician as $musician): ?>
                    <?php if($counter >= 5): ?>
                        <?php break; ?>
                    <?php else: ?>
                        <?php if($counter == 0): ?>
                            <div class="item active">
                                <?php $musImage = 'uploads/users/' . $musician->username . '/' . $musician->portrait; ?>
                                <?php if($musician->portrait == ""): ?>
                                    <?php $image = $this->Html->image('default.png', array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Musician', 'action' => 'view', $musician->username], 
                                    array('target'=>'_blank', 'escape' => false));?>  
                                <?php else: ?>
                                    <?php $image = $this->Html->image($musImage, array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Musician', 'action' => 'view', $musician->username], 
                                    array('target'=>'_blank', 'escape' => false));?>  
                                <?php endif; ?>
                                <div class="carousel-caption">
                                    <h1><?= $musician->first_name?> <?= $musician->last_name?></h1>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="item">
                                <?php if($musician->portrait == ""): ?>
                                    <?php $image = $this->Html->image('default.png', array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Musician', 'action' => 'view', $musician->username], 
                                    array('target'=>'_blank', 'escape' => false));?>  
                                <?php else: ?>
                                    <?php $image = $this->Html->image($musImage, array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Musician', 'action' => 'view', $musician->username], 
                                    array('target'=>'_blank', 'escape' => false));?>  
                                <?php endif; ?>
                                <div class="carousel-caption">
                                    <h1><?= $musician->first_name?> <?= $musician->last_name?></h1>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php $counter += 1;?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>

            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->      
    </div>
<?php endif; ?>

<?php if(!$band->isEmpty()): ?>
    <div class="row">
        <h3>Latest Bands</h3>
    </div>
    <div class="row">
        <div id="myCarouselBand" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    <li data-target="#myCarouselBand" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarouselBand" data-slide-to="1"></li>
                    <li data-target="#myCarouselBand" data-slide-to="2"></li>
                    <li data-target="#myCarouselBand" data-slide-to="3"></li>
                    <li data-target="#myCarouselBand" data-slide-to="4"></li>
                </ol>


                
          <!-- Indicators -->
                
            <div class="carousel-inner" role="listbox">
                <?php $counter = 0;?>
                <?php foreach ($band as $band): ?>
                    <?php if($counter >= 5): ?>
                        <?php break; ?>
                    <?php else: ?>
                        <?php if($counter == 0): ?>
                            <div class="item active">
                                <?php $bandImage = 'uploads/bands/' . $band->id . '/' . $band->logo; ?>
                                <?php if($band->logo == ""): ?>
                                    <?php $image = $this->Html->image('default.png', array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Band', 'action' => 'view', $band->id], 
                                    array('target'=>'_blank', 'escape' => false));?>  
                                <?php else: ?>
                                    <?php $image = $this->Html->image($bandImage, array('class'=>'slideThumbnail'));?>
                                    <?php echo $this->Html->link($image, ['controller' => 'Band', 'action' => 'view', $band->id], 
                                    array('target'=>'_blank', 'escape' => false));?>
                                <?php endif; ?>
                                <div class="carousel-caption">
                                    <h1><?= $band->band_name?></h1>
                                </div>
                            </div>
                                <?php else: ?>
                                    <div class="item">
                                        <?php if($band->logo == ""): ?>
                                            <?php $image = $this->Html->image('default.png', array('class'=>'slideThumbnail'));?>
                                            <?php echo $this->Html->link($image, ['controller' => 'Band', 'action' => 'view', $band->id], 
                                            array('target'=>'_blank', 'escape' => false));?>  
                                        <?php else: ?>
                                            <?php $image = $this->Html->image($bandImage, array('class'=>'slideThumbnail'));?>
                                            <?php echo $this->Html->link($image, ['controller' => 'Band', 'action' => 'view', $band->id], 
                                            array('target'=>'_blank', 'escape' => false));?>  
                                        <?php endif; ?>
                                        <div class="carousel-caption">
                                            <h1><?= $band->band_name?></h1>
                                        </div>
                                    </div>
                                <?php endif; ?>
                        <?php $counter += 1;?>
                    <?php endif; ?>
            <?php endforeach; ?>
            </div>

            <a class="left carousel-control" href="#myCarouselBand" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarouselBand" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->
    </div>
<?php endif; ?>