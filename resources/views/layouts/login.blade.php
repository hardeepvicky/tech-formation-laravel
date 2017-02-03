<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
		<link href="/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />		
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/metronic/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/metronic/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/metronic/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />        
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
        
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
		<script src="/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    </head>
    <body class="login">
        <div class="logo">
            <div class="page-logo">
                <img src="/img/trinetra.png" alt="logo" class="logo-default" /> 
            </div>
        </div>
        
        @yield('content')
        
        <div class="copyright"> 
            <b>Trinetra Central Portal</b>
            | <a href="http://www.bennyimpex.in/" target="_blank">Powered By : <img src="/img/jupitor_logo.jpg" /> </a>
        </div>
    
        <!-- BEGIN CORE PLUGINS -->
        <script src="/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        
        <script src="/metronic/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/metronic/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <script src="/js/default.js" type="text/javascript"></script>
    </body>
</html>