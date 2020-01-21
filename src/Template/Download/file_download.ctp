<!-- page wrapper starts -->
<div class="pageWrapper singlePostPageWrapper">
    <!-- post content wrapper starts -->
    <div class="singlePostContentWrapper">
        <!-- portfolio item starts  -->
        <div class="portfolioFilterableItemWrapper" data-type="websites,logos">
            <?php
                if($data['cat_id']==28)
                    $dir='Wallpaper/Sprots';
                if($data['cat_id']==30)
                    $dir='Animation/Sports';
                if($data['cat_id']==31)
                    $dir='Video/Sports';
            ?>
            <a href="#">
                <?php echo $this->Html->image("$ContentCMS/upload/content/$dir/$data[details1_file_name]",['width'=>'180', 'height'=>'113', 'alt'=>'B2M WAP']) ?>
            </a>
            <a class="buttonWrapper buttonGreen buttonCheckmark" href="<?php echo $this->Url->build("/download/download-process/$data[con2_file_name]/$data[cat_id]/$data[id]/") ?>">Save to handset</a>

            <div class="portfolioFilterableItemInfoWrapper">
                <p>Thanks for downloading <?php echo $data['title']; ?></p>
                <p> <?php echo $data['price'] ?> Tk charged for this content</p>
            </div>
        </div>
        <!-- portfolio item ends -->
        <table>
            <thead>
            <tr>
                <th>Developer</th>
                <th>Type</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>B2M</td>
                <td><?php echo $data['type'] ?></td>
                <td><?php echo $data['price'] ?> Tk</td>
            </tr>
            </tbody>
        </table>

        <p>All Rights of the Contents published in This Portal Belongs to B2M Technologies Ltd. It is Strictly Prohibited to use These Contents for any other Usage Without Permission Of B2M Technologies Ltd. </p>
        <a href="#" class="buttonWrapper buttonPink buttonArrowRight">Back</a></p>
    </div>
    <!-- post content wrapper ends -->

</div>
<!-- page wrapper ends -->

