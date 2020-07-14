<?php ?>
</section>
<section id="test1" class="content col-lg-3 right-contaner disnone">
    <div class="col-md-12 " style="padding-left: 0;">


        <ul class="nav nav-tabs" style="margin-bottom: 10px;">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">NEW</a></li>
            <li><a data-toggle="tab" href="#menu2">ALL</a></li>

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="col-sm-3 list-icon-background"><i class="fa fa-envelope list-icon" aria-hidden="true"></i><div class="list-icon-text">Mail</div></div>
                <div class="col-sm-3 list-icon-background" style="background: rgb(81, 51, 171);"><i class="fa fa-calendar list-icon" aria-hidden="true" style=""></i><div class="list-icon-text">Calender</div></div>
                <div class="col-sm-3 list-icon-background" style="background: rgb(210, 71, 38);"><i class="fa fa-users list-icon" aria-hidden="true" style=""></i><div class="list-icon-text">People</div></div>
                <div class="col-sm-3 list-icon-background" style="background: rgb(9, 74, 178);"><i class="fa fa-cloud list-icon" aria-hidden="true"></i><div class="list-icon-text">OneDrive</div></div>
                <div class="col-sm-3 list-icon-background" style="background: rgb(43, 87, 154);"><i class="fa fa-check-square-o list-icon" aria-hidden="true"></i><div class="list-icon-text">Tasks</div></div>
                <div class="col-sm-3 list-icon-background" style="background: rgb(33, 115, 70);"><i class="fa fa-file-word-o list-icon" aria-hidden="true"></i><div class="list-icon-text">Word</div></div>
                    <?php
                if(!empty(session('darbandiid_exec'))):
                $auth = new \App\Auth();
                $darbandiid = session('darbandiid_exec');
                $selected = session('darbandiid');
                $drbInfo = new \App\Darbandi();
                $emp_id = $drbInfo->getGeneralInfo($darbandiid)->empid;
                $accounts = $auth->checkMultipleAuthority($emp_id,$darbandiid);
                ?>
                <?php if(count($accounts)>1):?>
                <select id="multiple-account" class="form-control" onchange="switchAccount(this.value)">
                    <?php foreach($accounts as $k=>$a):?>
                    <option <?php echo $k==$selected?'selected="selected"':'';?> value="<?php echo $k;?>"><?php echo $a;?></option>
                    <?php endforeach;?>
                    
                </select>
                <?php endif;endif;?>

            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
        </div>
    </div>
    <div class="aside-bottom-menu-right ">
        Get more apps
    </div>
</section>
<!-- /.content -->
<section id="bell1" class="content col-lg-3 right-contaner-bell disnone">
    <div class="col-md-12 " style="padding-left: 0;">

        <ul class="dropdown-menu1" style="display:inline;">
            <li class="header" >You have 10 notifications</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <div class="slimScrollDiv" >
                    <ul class="menu" style="overflow: hidden; width: 100%; height: auto;">
                        <li>
                            <a href="#">
                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                page and may cause design problems
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-users text-red"></i> 5 new members joined
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user text-red"></i> You changed your username
                            </a>
                        </li>
                    </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </li>
            <li class="footer"><a href="#">View all</a></li>
        </ul>



</section>
<section id="help1" class="content col-lg-3 right-contaner-help disnone">
    <div class="col-md-12 " style="padding-left: 0;">

        <ul class="dropdown-menu" style="display: inline;">
            <li class="header">You have 9 tasks</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li><!-- Task item -->
                        <a href="#">
                            <h4>
                                Design some buttons
                                <small class="pull-right">20%</small>
                            </h4>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                    <li><!-- Task item -->
                        <a href="#">
                            <h4>
                                Create a nice theme
                                <small class="pull-right">40%</small>
                            </h4>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">40% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                    <li><!-- Task item -->
                        <a href="#">
                            <h4>
                                Some task I need to do
                                <small class="pull-right">60%</small>
                            </h4>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                    <li><!-- Task item -->
                        <a href="#">
                            <h4>
                                Make beautiful transitions
                                <small class="pull-right">80%</small>
                            </h4>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                </ul>
            </li>
            <li class="footer">
                <a href="#">View all tasks</a>
            </li>
        </ul>



</section>
</div>
</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark layout-option">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs ">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<div id="loader-animation" style="position: fixed;width: 100%;height: 100%;left: 0;top: 0;z-index: 99999;  opacity: 1;display: none">
    <div  style="display: table; margin: 0 auto;width: 120px;position: fixed;top: 45%;left: 45%;padding:0px 40px;background-color: #444;border-radius: 0.5em;">
    <ion-spinner icon="ios" class="spinner spinner-ios" style="width: 35px; float:left; stroke: #fff;fill: #fff;">
        <svg viewBox="0 0 64 64" style="width: 100% !important;height: 50px !important;" ><g stroke-width="4" stroke-linecap="round"><line y1="17" y2="29" transform="translate(32,32) rotate(180)"><animate attributeName="stroke-opacity" dur="750ms" values="1;.85;.7;.65;.55;.45;.35;.25;.15;.1;0;1" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(210)"><animate attributeName="stroke-opacity" dur="750ms" values="0;1;.85;.7;.65;.55;.45;.35;.25;.15;.1;0" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(240)"><animate attributeName="stroke-opacity" dur="750ms" values=".1;0;1;.85;.7;.65;.55;.45;.35;.25;.15;.1" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(270)"><animate attributeName="stroke-opacity" dur="750ms" values=".15;.1;0;1;.85;.7;.65;.55;.45;.35;.25;.15" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(300)"><animate attributeName="stroke-opacity" dur="750ms" values=".25;.15;.1;0;1;.85;.7;.65;.55;.45;.35;.25" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(330)"><animate attributeName="stroke-opacity" dur="750ms" values=".35;.25;.15;.1;0;1;.85;.7;.65;.55;.45;.35" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(0)"><animate attributeName="stroke-opacity" dur="750ms" values=".45;.35;.25;.15;.1;0;1;.85;.7;.65;.55;.45" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(30)"><animate attributeName="stroke-opacity" dur="750ms" values=".55;.45;.35;.25;.15;.1;0;1;.85;.7;.65;.55" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(60)"><animate attributeName="stroke-opacity" dur="750ms" values=".65;.55;.45;.35;.25;.15;.1;0;1;.85;.7;.65" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(90)"><animate attributeName="stroke-opacity" dur="750ms" values=".7;.65;.55;.45;.35;.25;.15;.1;0;1;.85;.7" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(120)"><animate attributeName="stroke-opacity" dur="750ms" values=".85;.7;.65;.55;.45;.35;.25;.15;.1;0;1;.85" repeatCount="indefinite"></animate></line><line y1="17" y2="29" transform="translate(32,32) rotate(150)"><animate attributeName="stroke-opacity" dur="750ms" values="1;.85;.7;.65;.55;.45;.35;.25;.15;.1;0;1" repeatCount="indefinite"></animate></line></g></svg></ion-spinner>
    <span style="display: table-cell;vertical-align: middle;font-size: 16px;position: relative;top: -2px;left: 7px;color: white;">Loading...</span>
</div>
</div>

<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo asset('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo asset('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo asset('js/app.min.js'); ?>"></script>
<script src="<?php echo asset('js/jquery.toast.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo asset('js/demo.js'); ?>"></script>
<script src="<?php echo asset('js/function.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('dm-uploader/js/jquery.dm-uploader.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    
    if (typeof common === "function") {
        common();
    }
    if (typeof table === "function") {
        table();
    }
    var gToastLoader = "";
    var gToastObj = {
        heading: '<h2><i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;Please Wait..</h2>',
        text: '',
        showHideTransition: 'slide',
        allowToastClose: false,
        hideAfter: false,
        textAlign: 'center',
        position: 'mid-center',
    };
    function toast(a) {
        var statusToIcon = [
            'error','success','warning','info'
        ];
        var statusToHeading = [
            'Error','Success','Warning','Info'
        ];
        var tostObj = {
            heading: a.title || statusToHeading[a.status],
            text: prepareMessage(a.message),
            showHideTransition: 'slide',
            position: 'top-right',
            loader: false,
            icon: parseInt(a.status)== 'NaN'?a.status:statusToIcon[a.status]
        };
        $.toast(tostObj);
        return true;
    }
    function parseMessage(msg){
        var m = "";
        if (typeof msg == 'object') {
            for (let i in msg) {
                m += parseMessage(msg[i]);
            }
        } else if (typeof msg == 'string') {
            m += msg + '<br/>';
        }
        return m;
    }
    
    function prepareMessage(msg){
        var newMessage = parseMessage(msg).trim();
        return newMessage.slice(0, -5);
    }
    
    function page(e, last) {
        e.preventDefault();
        var entry = $("#selectentry").val();
        var page = e.target.text;
        var index = $("body #pagg ul li.active").text();
        if (page === "Prev") {
            if(index >= 1){
                index--;
                page = index;
            }else{
                return;
            }
        }
        if (page === "Next") {
            if (index != last) {
                index++;
                page = index;
            } else {
                return;
            }
        }
        var path = window.location.href.split('/');

        var path = path[path.length - 1];
         if(path=="search"){
            var data =  $("#form").serialize();
        var url = baseurl + "/search/getlist";
         var entry = $("#selectentry").val() || '';
             var search = $("#searchfill").val() || '';
             // var index = $("body #pagg ul li.active").text() || 1;
             url += "?entry="+entry+"&page="+page;
        var xhr = submitFormAjax(url,data);
        xhr.done(function(resp){
            createTable(resp);
            // table();
            // toast(resp);
        });
        xhr.fail(function(reason){
            var rsp = reason.responseJSON;
            toast(rsp);
        });
         } else{
        var url = baseUrl + "/" + path + "/list-data?entry=" + entry + "&page=" + page + "&search=" + $("#searchfill").val();
        if($('#page-param').length && $('#page-param').val()!=''){
            url += $('#page-param').val();
        }
        var xhr = ajaxGetObj(url);
        xhr.done(function(resp){
            createTable(resp);
        }).fail(function(error){
            console.log(error);
        });
    }
    }
    
   function logout(e){
       e.preventDefault();
       var xhr = ajaxGetObj('<?php echo url('/').'/auth/logout';?>');
       xhr.done(function(resp){
           toast({status:"1",title:"success",text:resp.text});
           window.location.href = '<?php echo url('/');?>';
       }).fail(function(reason){
           toast({status:"0",title:"error",text:'Cannot Logout Right Now..'});
       });
   }

// sets title to all the pages if available
   function setTitle(){
       var title = $('#main-body > .row').data('title');
       if(title){
           $('.body-header').html('<div>'+title+'</div>');
           $('title').text(title);
       }else{
           $('.body-header').html('');
           $('title').text('OAS');
       }
   }
   setTitle();
   
   function switchAccount(darbandi){
    var url = baseUrl+"/auth/switch-account/"+darbandi;
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        toast(resp);
        window.location.href = baseUrl;
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
   }
   function setDefaultSection(id='officeid'){
       if(section!=''){
        if($('#'+id).length){
            $('#'+id).val(section).trigger('change');
        }
    }
    }
    function setDefaultOrg(id='orgidint'){
        if(org!=''){
        if($('#'+id).length){
            $('#'+id).val(org).trigger('change');
        }
        }
    }
    
    function setDefaultDarbandi(id='darbandiid'){
        if(darbandi!=''){
        if($('#'+id).length){
            $('#'+id).val(darbandi).trigger('change');
        }
        }
    }
   
</script>
</body>
</html>
