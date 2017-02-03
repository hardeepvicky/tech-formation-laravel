<html>
    <head>
        <meta charset="utf-8" />
        <title>{{ isset($pageTitle) ? $pageTitle : "" }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
		<link href="/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />		
        <link href="/metronic/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" type="text/css" rel="stylesheet">
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/metronic/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/metronic/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        
        <link href="/metronic/assets/global/plugins/tf-loader/tf-loader.css"  rel="stylesheet" type="text/css" />
        
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/metronic/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/metronic/assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
        
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
        
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
		<script src="/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo">
        <div class="page-wrapper">
            <div class="page-header navbar navbar-fixed-top">                
                @include('partial.header')
            </div>
            
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <div class="page-sidebar-wrapper">                    
                    @include('partial.sidebar')
                </div>

                <div class="page-content-wrapper">
                    <div class="tf-loader-container" data-loader-radius="10"></div>
                    <div class="page-content">
                        @yield('content')
                    </div>
                </div>
                
                <div class="page-footer">                    
                    @include('partial.footer')
                </div>
            </div>
            <!-- End CONTAINER -->
        </div>
    
        <!-- BEGIN CORE PLUGINS -->
        <script src="/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <script src="/metronic/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

        <script src="/metronic/assets/global/plugins/tf-loader/tf-loader.js" type="text/javascript"></script>
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/metronic/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script> 
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <script src="/js/ajax.js" type="text/javascript"></script>
        <script src="/js/default.js" type="text/javascript"></script>
    </body>
</html>