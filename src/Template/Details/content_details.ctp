<div class="content_continer">
	<div class="alertBox alertBoxGo">
	    <p class="alertBoxContent"><?php echo $title; ?></p>
	    <a class="alertBoxButton" href="#"></a>
	</div>
	    <!-- portfolio wrapper starts -->    
    <?php 
    	foreach($details as $data){
    		if($data['cat_id']==28)
    			$dir='Wallpaper/Sprots';
    		if($data['cat_id']==30)
    			$dir='Animation/Sports';
    		if($data['cat_id']==31)
    			$dir='Video/Sports';
    ?>
    <div class="content_box_left">
	    <a href="<?php echo $this->Url->build("/download/free-file-download/$data[id]/$data[con2_file_name]/$data[type]/$data[price]") ?>">
	        <?php echo $this->Html->image("$ContentCMS/upload/content/$dir/$data[prv1_file_name]",['width'=>'50', 'height'=>'50', 'align'=>'middle', 'alt'=>'B2M WAP']) ?>
	        <h4>Price : <?php echo $data['price'] ?> Tk</h4>
	    </a>
	    <!----Rating Continer Start---->
	    <div class="count_container">
	        <a href="<?php echo $this->Url->build("/download/free-file-download/$data[id]/$data[con2_file_name]/$data[type]/$data[price]") ?>" class="down_buttion">Download</a>
	    </div>
	    <!----Rating Continer End---->

	</div>
    <?php } ?>
    <div class="clear">

    </div>
    <div class="pageNumbersWrapper">
    	<ul class="pagination">
    		<?php echo $this->Paginator->prev('<<',['class'=>'pageNumber']) ?>
    		<?php echo $this->Paginator->next('>>') ?>
    	</ul>
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