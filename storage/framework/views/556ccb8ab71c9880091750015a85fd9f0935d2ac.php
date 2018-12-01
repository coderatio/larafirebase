<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    
    
    <link rel="stylesheet" href="<?php echo e(asset('public/css/iconmoon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/icons.css')); ?>">

    <!-- Styles -->
    <link href="<?php echo e(asset("public/css/app.css")); ?>" rel="stylesheet">
</head>
<body id="">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <router-link to="/" class="navbar-brand">
                    <i class="sl sl-icon-disc"></i> <?php echo e(config('app.name', 'Laravel')); ?>

                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link"><i class="sl sl-icon-home"></i> Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/posts" class="nav-link"><i class="sl sl-icon-notebook"></i> Posts</router-link>
                        </li>
                        <!-- Authentication Links -->
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <div class="contents">
                <router-view></router-view>
            </div>
        </div>
    </div>
    <script>
        const loadingSpinner = '<?php echo e(asset('public/images/spinner-blue.gif')); ?>';
        const baseUrl = '<?php echo e(url('/')); ?>';
        const updateSpinner = '<?php echo e(asset('public/images/spinner-blue.gif')); ?>';
    </script>
    <script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
</body>
</html>
