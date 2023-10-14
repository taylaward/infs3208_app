<html>
    <head>
        <title>INFS3202 Project Tayla</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">INFS3202 Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>"> Home </a>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
            


        </div>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <?php if (session()->get('username')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>myprofile"> My Profile </a>
            <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Logout </a>
            <?php } else { ?>
                <a class="mx-3" href="<?php echo base_url(); ?>signup"> Sign Up </a>
                <a class="mx-3" href="<?php echo base_url(); ?>login"> Login </a>
            <?php } ?>
    </nav>
    <div class="container">
