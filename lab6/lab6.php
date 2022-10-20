<html>

<head>
    <style>
        div {
            margin: 10px;
        }

        .container {
            display: flex;
            flex-flow: row wrap;
        }
    </style>
</head>

<body>

    Погода в містах України:
    <div class="container">
        <div><img src="pogoda.php?city=kharkiv-5053"></div>
        <div><img src="pogoda.php?city=kyiv-4944"></div>
        <div><img src="pogoda.php?city=donetsk-5080"></div>
        <div><img src="pogoda.php?city=dnipro-5077"></div>
    </div>
    <div>Погода у світі:</div>
    <div class="container">
        <div><img src="pogoda.php?city=moscow-4368"></div>
        <div><img src="pogoda.php?city=tampere-471"></div>
        <div><img src="pogoda.php?city=london-744"></div>
        <div><img src="pogoda.php?city=barcelona-1948"></div>
    </div>
</body>