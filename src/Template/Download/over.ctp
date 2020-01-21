<!-- page wrapper starts -->
<div class="pageWrapper">
    <!-- blog posts wrapper starts -->
    <div class="portfolioOneWrapper">
        <!-- small blog post starts  -->
        <div class="smallPostWrapper">
            <div class="postExcerptWrapper">
                <p>Your Daily content download has been finished. Next day you get another 5 free content for download. If you want to download more content please click ondemand button</p>
            </div>
            <a href="<?php echo $this->Url->build("/download/ondemand-action/$id/$file/$type/$price") ?>">
                    <div class="robi_cancle_button">Ondemand</div>
            </a>
            <div class="space_bar"></div>
            <a class="buttonWrapper buttonPink buttonArrowRight" href="<?php echo $this->Url->build('/') ?>">Cancel</a>
        </div>
        <!-- small blog post ends -->
    </div>
    <!-- blog posts wrapper ends -->
</div>
<!-- page wrapper ends -->