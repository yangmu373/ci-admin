<div id="rightMain" class="col-md-12" role="main">
    <div class="alert alert-warning <?php if($error == ''):?>hide<?php else:?>fade in<?php endif;?>">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo $error;?>
    </div>
    <form id="searchForm" role="form" action="" method="POST">
        <div class="row">
            <div class="col-md-2">
                <input type="text" name="startDate" class="form-control datetimepicker" value="<?php echo $startDate;?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="endDate" class="form-control datetimepicker" value="<?php echo $endDate;?>">
            </div>
            <div class="col-md-2">
                <select name="ver" class="form-control combobox">
                    <option value="group" <?php if($ver == 'group'):?>selected="selected"<?php endif;?>>不区分版本</option>
                    <option value="all" <?php if($ver == 'all'):?>selected="selected"<?php endif;?>>全部版本</option>
                    <?php foreach($verMap as $verOne):?>
                        <option value="<?php echo $verOne;?>" <?php if($verOne == $ver):?>selected="selected"<?php endif;?>><?php echo $verOne;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2">
                <script>
                    var cidArr = new Array();
                    <?php foreach($cidMap as $cidOne):?>
                    cidArr.push("<?php echo $cidOne;?>");
                    <?php endforeach;?>
                    var cidArrDef = new Array();
                    cidArrDef.push("不区分渠道");
                    cidArrDef.push("全部渠道");
                    cidArrDef.push("Organ");
                    cidArrDef.push("D2");
                    cidArrDef.push("U2");
                    <?php foreach($cidMapDef as $cidOne):?>
                    cidArrDef.push("<?php echo $cidOne;?>");
                    <?php endforeach;?>
                </script>
                <div class="input-group cid-box">
                    <input type="text" class="form-control" autocomplete="off" name="cid" value="<?php echo $vcid;?>">
                    <ul class="dropdown-menu dropdown-menu-right cid-box-list" role="menu" style="height: 300px; overflow-y:scroll;">
                    </ul>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">&nbsp;<span class="caret"></span></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <select name="sel" class="form-control selectpicker">
                    <option value="newInstall" <?php if($sel == 'newInstall'):?>selected="selected"<?php endif;?>>新装</option>
                    <option value="updateCheck" <?php if($sel == 'updateCheck'):?>selected="selected"<?php endif;?>>报活</option>
                </select>
            </div>
            </div>
            <div class="row">
                <div class="btn-group col-md-2">
                    <button id="searchbtn" type="button" class="btn btn-primary">查询</button>
                    <button id="newPageSearchBtn" type="button" class="btn btn-primary">在新页面查询</button>
                </div>
                <div class="col-md-2">
                    <button id="exportBtn" type="button" class="btn btn-success form-control">导出</button>
                </div>
                <input type="hidden" id="actHidden" name="act" value="search">
            </div>
    </form>

    <div style="height: 30px;"></div>

    <table class="table table-hover tbcloth">
        <thead>
        <tr>
            <th>日期</th>
            <?php if($ver != 'group'):?>
            <th>版本号</th>
            <?php endif;?>
            <?php if($cid != 'group'):?>
            <th>渠道</th>
            <?php endif;?>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户XP系统数量（mid不除重）">
                xp数量
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户XP系统的占比 ">
                占比
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户WIN7系统数量（mid不除重）">
                win7数量
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户WIN7系统的占比 ">
                占比
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户WIN8系统数量（mid不除重）">
                win8数量
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户WIN7系统的占比 ">
                占比
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户其他OS系统数量（mid不除重）">
                其他OS数量
                </a>
            </th>
            <th>
                <a href="#" class="tip" data-toggle="tooltip" title="用户其他OS系统的占比 ">
                占比
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($userOsList as $userOs):?>
            <?php $totalOs = $userOs['xp'] + $userOs['win7'] + $userOs['win8'] + $userOs['otherOs'];?>
                <tr>
                    <td><?php echo $userOs['date'];?></td>
                    <?php if($ver != 'group'):?>
                    <td><?php echo $userOs['ver'];?></td>
                    <?php endif;?>
                    <?php if($cid != 'group'):?>
                    <td><?php echo $userOs['cid'];?></td>
                    <?php endif;?>
                    <td><?php echo $userOs['xp'];?></td>
                    <td><?php echo round($userOs['xp'] / $totalOs, 4) * 100;?>%</td>
                    <td><?php echo $userOs['win7']?></td>
                    <td><?php echo round($userOs['win7'] / $totalOs, 4) * 100;?>%</td>
                    <td><?php echo $userOs['win8'];?></td>
                    <td><?php echo round($userOs['win8'] / $totalOs, 4) * 100;?>%</td>
                    <td><?php echo $userOs['otherOs'];?></td>
                    <td><?php echo round($userOs['otherOs'] / $totalOs, 4) * 100;?>%</td>
                </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<script>
    $("#searchbtn").click(function(){
        $("#actHidden").val("search");
        $("#searchForm").attr("target", "_self")
        $("#searchForm").submit();
    });
    $("#newPageSearchBtn").click(function(){
        $("#actHidden").val("search");
        $("#searchForm").attr("target", "_blank")
        $("#searchForm").submit();
    });
    $("#exportBtn").click(function(){
        $("#actHidden").val("export");
        $("#searchForm").attr("target", "_blank")
        $("#searchForm").submit();
    });

    $(".cid-box button").click(function(event){
        defCidbox();
        event.stopPropagation();
    });

    $(".cid-box input").click(function(event){
        event.stopPropagation();
    });

    $(".cid-box ul").delegate("li","click",function(){
        $(".cid-box input").val($(this).children("a").html());
    });

    $("body").on("propertychange input", ".cid-box input", function(){
        var input = $(this).val();
        searchCidbox(input);
    });

    $(".cid-box input").bind("propertychange", function(){
        var input = $(this).val();
        searchCidbox(input);
    });

    $("body").click(function(){
        $(".cid-box ul").hide();
    });

    function searchCidbox(input)
    {
        input = $.trim(input);
        var ulHtml = "";
        for(var i = 0; i < cidArr.length; i++){
            if(cidArr[i].indexOf(input) > -1){
                ulHtml += "<li><a href=\"#\">" + cidArr[i] + "</a></li>";
            }
        }
        $(".cid-box ul").html(ulHtml);
        if(input == "" || ulHtml == ""){
            $(".cid-box ul").hide();
        }else{
            $(".cid-box ul").show();
        }
    }

    function defCidbox()
    {
        if($(".cid-box ul").css('display') != "none"){
            $(".cid-box ul").hide();
        }else{
            var ulHtml = "";
            for(var i = 0; i < cidArrDef.length; i++){
                ulHtml += "<li><a href=\"#\">" + cidArrDef[i] + "</a></li>"
            }
            $(".cid-box ul").html(ulHtml);
            $(".cid-box ul").show();
        }
    }
</script>