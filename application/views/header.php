<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>basic reddit clone in php - index</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/static/css/grid.css">
        <link rel="stylesheet" href="/static/css/fonts.css">
        <link rel="stylesheet" href="/static/css/main.css">
        <link rel="stylesheet" href="/static/css/reusable.css">

        <?php
            if(isset($_customHead) && $_customHead)
                echo $_customHeadContent;
        ?>
        
    </head>
<body>

<div id="topMenu">
    <div class="container">
        <div class="row">
            <div class="column grid-1 split-1">
                <a href="index.html"><img src="/static/img/logo.png"></a>
            </div>
            <div class="column grid-6 split-2">
                <ul class="left-aligned mobile-text-center ">
                    <li class="active"><a href="/">frontpage</a></li>
                    <li><a href="sub_list.html">sub list</a></li>
                    <li><a href="about.html">about</a></li>
                </ul>
            </div>
            <div class="column grid-5 split-2">
                <ul class="right-aligned mobile-text-center ">
                    <li><a href="search.html">search</a></li>
                    <li><a href="/main/register">register</a></li>
                    <li><a href="/main/login">login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>