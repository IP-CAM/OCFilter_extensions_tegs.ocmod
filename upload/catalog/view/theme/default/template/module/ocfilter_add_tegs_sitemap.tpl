<?php

echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
    </ul>
    <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
        <div id="content" class="col-sm-12">
            <div class="row list">
                <div class="col-sm-12">
                    <h1><?php echo $heading_title; ?></h1>
                </div>
            </div>            
            <div class="row">
                <div class="col-sm-12 list">
                    <ul  style="column-count:4;">
                    <? foreach ($ocfilter_add_tegs_groups as $key => $ocfilter_add_tegs){?>
                        <li><? echo $key;?></li>
                        <ul>
                        <? foreach ($ocfilter_add_tegs as $ocfilter_add_teg){?>                        
                        <li><a href="<? echo $ocfilter_add_teg['href']; ?>"><? echo $ocfilter_add_teg['name']; ?></a></li>
                        <?}?>
                        </ul>
                    <?}?> 
                    </ul>
                </div>
            </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>