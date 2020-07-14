</div>
</div>
<footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2019 <a href="<?php echo url('client'); ?>">E-Thekka</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
  <div class="control-sidebar-bg"></div>
<div id="loader-animation" style="position: fixed;width: 100%;height: 100%;left: 0;top: 0;z-index: 99999;  opacity: 1;display: none;background-color:#0000001a">
    <div  style="display: table; margin: 0 auto;width: 120px;position: fixed;top: 45%;left: 45%;padding:0px 40px;background-color: #4440;border-radius: 0.5em;">
        <ion-spinner icon="ios" class="spinner spinner-ios" style="width: 35px; float:left; stroke: #fff;fill: #fff;">
            <svg class="lds-gear" width="70px" height="70px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="shape-rendering: auto; animation-play-state: running; animation-delay: 0s; background: rgba(255, 255, 255, 0) none repeat scroll 0% 0%;">
                <g transform="translate(50 50)" class="" style="animation-play-state: running; animation-delay: 0s;">
                    <g class="" style="animation-play-state: running; animation-delay: 0s;">
                        <animateTransform attributeName="transform" type="rotate" values="0;360" keyTimes="0;1" dur="1s" repeatCount="indefinite" class="" style="animation-play-state: running; animation-delay: 0s;"></animateTransform>
                        <path d="M33.04542328371661 -8 L43.04542328371661 -8 L43.04542328371661 8 L33.04542328371661 8 A34 34 0 0 1 30.456563754497918 15.112833098668288 L30.456563754497918 15.112833098668288 L38.117008185687695 21.54070919553368 L27.83240643070307 33.79742028543733 L20.17196199951329 27.36954418857194 A34 34 0 0 1 13.616739557547405 31.154203630038815 L13.616739557547405 31.154203630038815 L15.353221334216709 41.00228116016089 L-0.4037027139786171 43.780652002831786 L-2.140184490647921 33.9325744727097 A34 34 0 0 1 -9.594508411582792 32.618176042508374 L-9.594508411582792 32.618176042508374 L-14.59450841158279 41.27843008035276 L-28.45091487213381 33.27843008035276 L-23.45091487213381 24.61817604250837 A34 34 0 0 1 -28.316379263849985 18.819741374041424 L-28.316379263849985 18.819741374041424 L-37.71330547170907 22.239942807298114 L-43.18562776491977 7.204860874723568 L-33.78870155706069 3.784659441466879 A34 34 0 0 1 -33.78870155706069 -3.7846594414668706 L-33.78870155706069 -3.7846594414668706 L-43.18562776491977 -7.204860874723558 L-37.71330547170908 -22.239942807298103 L-28.31637926384999 -18.819741374041417 A34 34 0 0 1 -23.450914872133833 -24.618176042508356 L-23.450914872133833 -24.618176042508356 L-28.45091487213384 -33.27843008035274 L-14.594508411582828 -41.27843008035275 L-9.59450841158282 -32.61817604250837 A34 34 0 0 1 -2.140184490647929 -33.9325744727097 L-2.140184490647929 -33.9325744727097 L-0.40370271397862934 -43.780652002831786 L15.353221334216682 -41.002281160160905 L13.616739557547383 -31.154203630038825 A34 34 0 0 1 20.171961999513286 -27.36954418857194 L20.171961999513286 -27.36954418857194 L27.832406430703063 -33.79742028543733 L38.11700818568769 -21.5407091955337 L30.45656375449791 -15.112833098668306 A34 34 0 0 1 33.04542328371661 -7.999999999999999 M0 -30A30 30 0 1 0 0 30 A30 30 0 1 0 0 -30" fill="#28292f" class="" style="animation-play-state: running; animation-delay: 0s;">
                            
                        </path>
                    </g>
                </g>
            </svg>
            
        </ion-spinner>
    </div>
</div>
</div>
<?php echo TawkTo::widgetCode() ;?>
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
<script type="text/javascript" src="<?php echo url('assets/plugins/toaster/js/jquery.notify.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo asset('js/select2.min.js'); ?>"></script>
<script src="<?php echo asset('js/demo.js'); ?>"></script>
<script src="<?php echo asset('js/nepali-date-picker.js'); ?>"></script>
<!-- PACE -->
<script src="<?php echo url('assets/plugins/pace/pace.min.js') ;?>"></script>
<script src="<?php echo url('js/function.js') ;?>"></script>
<script src="<?php echo url('js/scripts.js') ;?>"></script>
<!-- Data Tables -->
<script src="<?php echo url('assets/plugins/datatables/jquery.dataTables.min.js') ;?>"></script>
<script src="<?php echo url('assets/plugins/datatables/dataTables.bootstrap.min.js') ;?>"></script>
<script type="text/javascript">
	var baseUrl = "<?php echo url('/client/');?>";
  // $(document).ajaxStart(function () {
  //   console.log('started');
  //   Pace.restart();
  // })
  function toast(a) {
        var statusToIcon = [
            'error', 'success', 'warning', 'info'
        ];
        var statusToHeading = [
            'Error', 'Success', 'Warning', 'Info'
        ];
        var tostObj = {
            type: statusToIcon[a.status], //alert | success | error | warning | info
            title: a.title,
            message: prepareMessage(a.message),
            position: {
                x: "right", //right | left | center
                y: "top" //top | bottom | center
            },
            icon: '<img src="<?php echo url("assets/plugins/toaster/images/paper_plane.png") ;?>" />', //<i>
            size: "normal", //normal | full | small
            overlay: false, //true | false
            closeBtn: true, //true | false
            overflowHide: false, //true | false
            spacing: 20, //number px
            theme: "default", //default | dark-theme
            autoHide: true, //true | false
            delay: 4000, //number ms
            onShow: null, //function
            onClick: null, //function
            onHide: null, //function
            template: '<div class="notify"><div class="notify-text"></div></div>'
        };
        notify(tostObj);
        //return true;
    }
    
    function parseMessage(msg) {
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

    function prepareMessage(msg) {
        var newMessage = parseMessage(msg).trim();
        return newMessage.slice(0, -5);
    }
</script>
</body>
</html>
