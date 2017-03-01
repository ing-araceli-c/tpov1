<!DOCTYPE html>
<head>
    <meta HTTP-EQUIV="X-UA-COMPATIBLE" CONTENT="IE=EmulateIE9">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta property="og:image" content="http://www.brightpointinc.com/interactive/images/Budget_202px.png">

    <title>Federal Budget Data Visualization D3.js</title>
    <link type="text/css" rel="stylesheet" href="styles/style.css">

    <script type="text/javascript" src="scripts/d3.min.js"></script>
    <script type="text/javascript" src="scripts/main.js"></script>

</head>

<body style="height:900px; width:1280px; overflow:auto" onload="main()">


<div class="bp-navBar" style="left:20px;">
    <ul class="bp-navigation clearfix" style="list-style-type:none">
        <li id="federalButton" class="button selected">Federal</li>
        <li id="stateButton" class="button">State</li>
        <li id="localButton" class="button">Local</li>
    </ul>
</div>



<div id="body" style="position: absolute; top:80px">

    <div id="toolTip" class="tooltip" style="opacity:0;">
        <div id="head" class="header"></div>
        <div id="header1" class="header1"></div>
        <div id="header2" class="header2"></div>
        <div style="position:absolute; left:10px">
            <div id="federalTip" class="tip" style="width:135px; left:0px; top:10px; position: absolute;">
                <div class="header3"><br>Federal Funds</div>
                <div class="header-rule"></div>
                <div id="fedSpend" class="header4"></div>
            </div>
            <div id="stateTip" class="tip" style="width:125px; left:140px; top:10px; position: absolute;">
                <div class="header3"><br>State Funds</div>
                <div class="header-rule"></div>
                <div id="stateSpend" class="header4"></div>
            </div>
            <div id="localTip" class="tip" style="width:125px; left:272px; top:10px; position: absolute;">
                <div class="header3"><br>Local Funds</div>
                <div class="header-rule"></div>
                <div id="localSpend" class="header4"></div>
            </div>
        </div>
        <div class="tooltipTail"></div>
    </div>
</div>


</body>

</html>
