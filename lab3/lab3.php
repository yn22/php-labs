<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../data/styles/common.css">
    <title>Lab 3</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            height: 50px;
            font-weight: normal;
            font-style: normal;
        }

        th.region {
            width: 40%;
        }

        td {
            padding: 3px;
        }

        table {
            border: 2px solid black;
            width: 70%;
            margin-left: 15%;
        }

        .container {
            width: 70%;
            margin-left: 15%;
        }
    </style>
</head>

<body class="deep-grey">
    <div class="container">
        <form action="handle_request.php" method="GET">
            <?php
            define("FILE_PATH", "./data/napr.txt");
            $fp = fopen(FILE_PATH, "r");
            $specializations = array();

            while (!feof($fp)) {
                $specialization =  trim(iconv("windows-1251", "utf-8", fgets($fp)));
                array_push($specializations, $specialization);
            }
            fclose($fp);
            sort($specializations);

            foreach ($specializations as $specialization) {
                echo "<input type='radio' name='napr' value='$specialization' required>$specialization<br>";
            }
            ?>
            <input type="submit" value="Відправити запит" action="handle.php" style="margin-top: 10px;">
        </form>
    </div>
</body>

</html>