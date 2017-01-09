<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>basic reddit clone in php <?php if(isset($_customTitle)) echo " - " . $_customTitle; ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/static/css/grid.css">
        <link rel="stylesheet" href="/static/css/fonts.css">
        <link rel="stylesheet" href="/static/css/main.css">
        <link rel="stylesheet" href="/static/css/reusable.css">

        <?php
            if(isset($_customHeadContent))
                echo $_customHeadContent;
        ?>

    </head>
<body>

<?php $this->isActive("hah"); ?>

<div id="topMenu">
    <div class="container">
        <div class="row">
            <div class="column grid-1 split-1">
                <a href="/"><img src="/static/img/logo.png"></a>
            </div>
            <div class="column grid-6 split-2">
                <ul class="left-aligned mobile-text-center ">
                    <li <?php $this->isActive('/'); ?> ><a href="/">frontpage</a></li>
                    <li <?php $this->isActive('/main/subreddits'); ?> ><a href="/main/subreddits">sub list</a></li>
                    <li <?php $this->isActive('/main/about'); ?> ><a href="/main/about">about</a></li>
                </ul>
            </div>
            <div class="column grid-5 split-2">
                <ul class="right-aligned mobile-text-center ">
                    <li <?php $this->isActive('/main/search'); ?>><a href="/main/search">search</a></li>
                    <?php 
                    if(!$_loggedIn)
                    {
                    ?>
                    <li <?php $this->isActive('/main/register'); ?> ><a href="/main/register">register</a></li>
                    <li <?php $this->isActive('/main/login'); ?> ><a href="/main/login">login</a></li>
                    <?php 
                    } else {
                        if($_SESSION['user'] == 'admin')
                        {
                    ?>
                    <li <?php $this->isActive('/main/admin'); ?> ><a href="/main/admin">admin</a></li>
                    <?php
                        }
                    ?>                    
                    <li><a href="/main/logout">logout</a></li>
                    <?php 
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
        if(isset($this->pageVariables['_message']))
            echo "<div class=\"row message {$this->pageVariables['_messageType']}\"><div class=\"container\"><div class=\"column grid-12\"><p>$_message</p></div></div></div>";
    ?>

</div>

