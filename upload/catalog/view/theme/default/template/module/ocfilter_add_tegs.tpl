<style>
    .tegs_mini{
        max-height: 45px;
        text-overflow: ellipsis;
        padding-bottom: 50px;
        overflow: hidden;
    }
    #all-tegs{
        /*min-width: 80;*/
        cursor: pointer;
        text-align: right;
        text-shadow: 1px 0px black;
    }    
    #tegs li{
        border: 1px solid #DDDDDD;
        min-width: 83px;
        text-align: center;
    }
</style>
<script>
    function all_tegs() {
        var el = $('#all-tegs');
        if (el.attr('v') == '0') {
            $('#tegs').removeClass('tegs_mini');
            el.attr('v', '1');
            el.html('Скрыть');
        } else {
            $('#tegs').addClass('tegs_mini');
            el.attr('v', '0');
            el.html('Показать все');
        }
    }
</script>
<div class="row">
    <div class="col-12">
        <ul id="tegs" class="list-inline tegs_mini">
            <? foreach ($ocfilter_add_tegs_groups as $key => $ocfilter_add_tegs){?>
                <? foreach ($ocfilter_add_tegs as $ocfilter_add_teg){?>                        
            <li class="list-inline-item"><a href="<? echo $ocfilter_add_teg['href']; ?>"><? echo $ocfilter_add_teg['name']; ?></a></li>
                <?}?>
            <?}?>
        </ul>
    </div>
    <div id="all-tegs" onclick="all_tegs()" v="0">Показать все</div>
</div>
