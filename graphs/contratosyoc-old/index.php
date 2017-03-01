<!DOCTYPE html>
<head>
    <link type="text/css" rel="stylesheet" href="styles/style.css">
    <script type="text/javascript" src="scripts/d3.min.js"></script>
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body style="height:900px; width:1280px; overflow:auto" onload="main()">


<div class="bp-navBar" style="left:20px;">
    <ul class="bp-navigation clearfix" style="list-style-type:none">
        <li id="federalButton" class="button selected">Órdenes de compra</li>
        <li id="stateButton" class="button">Contratos</li>
        <li id="localButton" class="button">Ambos</li>
    </ul>
</div>


<div id="body" style="position: absolute; top:80px">
    <div id="toolTip" class="tooltip" style="opacity:0;">
        <div id="head" class="header"></div>
        <div id="header1" class="header1"></div>
        <div id="header2" class="header2"></div>
        <div style="position:absolute; left:10px">
            <div id="federalTip" class="tip" style="width:135px; left:0px; top:10px; position: absolute;">
                <div class="header3"><br>Órdenes de compra</div>
                <div class="header-rule"></div>
                <div id="fedSpend" class="header4"></div>
            </div>
            <div id="stateTip" class="tip" style="width:125px; left:140px; top:10px; position: absolute;">
                <div class="header3"><br>Contratos</div>
                <div class="header-rule"></div>
                <div id="stateSpend" class="header4"></div>
            </div>
            <div id="localTip" class="tip" style="width:125px; left:272px; top:10px; position: absolute;">
                <div class="header3"><br>Ambos</div>
                <div class="header-rule"></div>
                <div id="localSpend" class="header4"></div>
            </div>
        </div>
        <div class="tooltipTail"></div>
    </div>
</div>
</body>
</html>
