<!DOCTYPE html>
<html lang="en" ng-app="adminApp">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>R2R | Routine to Research</title>
        <script type="application/javascript" src="{{ asset(elixir('js/all.js')) }}"></script>
        <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}"/>
        <link rel="stylesheet" href="{{ asset(elixir('css/all.css')) }}"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
        <script>
          document.createElement('ui-select');
          document.createElement('ui-select-match');
          document.createElement('ui-select-choices');
        </script>
        <![endif]-->
    </head>
    <body ng-controller="MainController" ng-init="getAuthenticatedUser()" ng-class="(authenticatedUser)?'hold-transition skin-blue fixed sidebar-mini':'hold-transition login-page'">
        <div ng-class="(authenticatedUser)?'wrapper':''">
            <div ng-include="getInclude('header')"></div>
            <div ng-include="getInclude('sidebar')"></div>
            <div ng-class="(authenticatedUser)?'content-wrapper':''">
                @yield('content')
            </div>
        </div>
    </body>
</html>