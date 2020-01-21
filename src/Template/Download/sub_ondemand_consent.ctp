<div class="content_continer">
    <div class="pageWrapper">
        <!-- blog posts wrapper starts -->
        <div class="portfolioOneWrapper">
            <div class="notify_continer">
                <img src="<?php echo $this->Url->image('notify_1.jpg') ?>" class="responsive-image" alt="img">
                <a href="<?php echo $this->Url->build('/subscribe/subscribe-action/yes') ?>">
                    <div class="robi_sub_button">রেজিস্ট্রেশন</div>
                </a>
                <div class="postExcerptWrapper">
                    <p>If you want to download without subscription you will be charged some amount of money</p>
                </div>
                <a href="<?php echo $this->Url->build("/download/ondemand-action/$id/$file/$type/$price") ?>">
                    <div class="robi_cancle_button">Ondemand</div>
                </a> 
                <div class="space_bar"></div>
                <a href="#" class="buttonWrapper buttonPink buttonArrowRight">Back</a>
            </div>
        </div>
        <!-- blog posts wrapper ends -->
    </div>
</div>