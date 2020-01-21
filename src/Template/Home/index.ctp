<div class="content_continer">
    <div class="striming_banner">
        <a href="rtsp://119.15.156.89:1935/ingestion/_definst_/ipl?wowzatokenendtime=1460463060&wowzatokenstarttime=1460461260&wowzatokenhash=rcQ-6lbkD1ZQby7kehx7n5wzzK1C6wfu5Au_2poVdxI=">
            <img src="<?php echo $this->Url->image('CFC.jpg');?>" width="100%" height="152">
        </a>
    </div>
    <div class="clear">
        
    </div>
    <div class="content_title"><?php echo $msisdn ?></div>
    <div class="content_title">News</div>
    <div class="news_continer">
        <a href="#"><?php echo substr($news['content'],0,50) ?></a>
    </div>
    <div class="content_footer_wrapper">    
        <?php echo $this->Html->link('Details','/details/news-details',['class'=>'buttonWrapper buttonGreen buttonCheckmark']);?>
    </div>
    <div class="clear"></div>
    <div class="content_title">Wallpaper</div>
    <?php 
        foreach($wallpaper as $data){
    ?>
    <div class="content_box_left">
        <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>">
            <?php echo $this->Html->image("$ContentCMS/upload/content/Wallpaper/Sprots/$data[prv1_file_name]",['width'=>'50', 'height'=>'50', 'align'=>'middle', 'alt'=>'B2M WAP']) ?>
            <h4>Price : <?php echo $data['price'] ?></h4>
        </a>

        <!----Rating Continer Start---->
        <div class="count_container">
            <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>" class="down_buttion">Details</a>
        </div>
        <!----Rating Continer End---->

    </div>
    <?php } ?>
    <div class="clear">
    </div>
    <div class="content_footer_wrapper">    
        <?php echo $this->Html->link('More...','/details/content-details/Wallpaper',['class'=>'buttonWrapper buttonGreen buttonCheckmark']);?>
    </div>
    <div class="clear">      
    </div>
    <div class="content_title">Animation</div>
    <?php 
        foreach($animation as $data){
    ?>
    <div class="content_box_left">
        <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>">
            <?php echo $this->Html->image("$ContentCMS/upload/content/Animation/Sports/$data[prv1_file_name]",['width'=>'50', 'height'=>'50', 'align'=>'middle', 'alt'=>'B2M WAP']) ?>
            <h4>Price : <?php echo $data['price'] ?></h4>
        </a>

        <!----Rating Continer Start---->
        <div class="count_container">
            <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>" class="down_buttion">Details</a>
        </div>
        <!----Rating Continer End---->
    </div>
    <?php } ?>
    <div class="clear">       
    </div>
    <div class="content_footer_wrapper">
        <?php echo $this->Html->link('More...','/details/content-details/Animation',['class'=>'buttonWrapper buttonGreen buttonCheckmark']);?>
    </div>
    <div class="clear">
    </div>
    <div class="content_title">Video</div>
    <?php 
        foreach($video as $data){
    ?>
    <div class="content_box_left">
        <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>">
            <?php echo $this->Html->image("$ContentCMS/upload/content/Video/Sports/$data[prv1_file_name]",['width'=>'50', 'height'=>'50', 'align'=>'middle', 'alt'=>'B2M WAP']) ?>
            <h4>Price : <?php echo $data['price'] ?></h4>
        </a>

        <!----Rating Continer Start---->
        <div class="count_container">
            <a href="<?php echo $this->Url->build("/Home/details/$data[id]") ?>" class="down_buttion">Details</a>
        </div>
        <!----Rating Continer End---->
    </div>
    <?php } ?> 
    <div class="clear">
        
    </div>
    <div class="content_footer_wrapper">
        <?php echo $this->Html->link('More...','/details/content-details/Video',['class'=>'buttonWrapper buttonGreen buttonCheckmark']);?>
    </div> 
    <div class="clear">
        
    </div> 
    <?php
        if(!empty($status)){
    ?>
    <a href="<?php echo $this->Url->build('/subscribe/unsubscribe') ?>">
    <div class="robi_cancle_button">Unsubscribe</div> </a>
    <?php 
        } 
        else{
    ?>
    <a href="<?php echo $this->Url->build('/subscribe/subscribe') ?>">
    <div class="robi_sub_button">Subscribe</div> </a>
    <?php        
        }
    ?>
</div>
