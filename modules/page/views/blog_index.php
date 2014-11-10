<?
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/
?>
<?foreach($post as $entry):?>
    <div class="grid_4 main-content-thumb">
    <h4>&#151; <?=date("M d, Y",$entry->date_created)?></h4>
    <div class="image-link">
    <a  href="/index.php/module/blog/<?=$entry->id?>">
    </a>
    </div>
    <h3><a  href="/index.php/module/blog/<?=$entry->id?>"><?=$entry->title?></a></h3>
    <!-- <h3><a  href="/index.php/blog/jhgjhg-jhg/">jhgjhg jhg</a></h3> -->
    <p>
    <?=substr($entry->content,0,150)?>
            </p>
    
    </div>
    
<?endforeach;?>