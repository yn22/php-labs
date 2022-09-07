<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
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
    </style>
</head>
<body>
    <form action="handle_request.php">
        <p>Оберіть область:</p>

        <select name="region_number">
            <?php
                define("FILE_PATH", "./data/oblinfo.txt");
                $fp = fopen(FILE_PATH, "r");
                $rows_number = (int)fgets($fp);
                $i = 2;

                while (!feof($fp)) {
                    $region =  trim(fgets($fp));
                    if (empty($region)) {
                        continue;
                    }

                    echo "<option value=\"$i\">$region</option>";

                    fgets($fp);
                    fgets($fp);
                    $i+= 3;
                }
                fclose($fp);
            ?>
        </select>

        
        <p><input type="submit" value="Показати"></input></p>
    </form>
</body>
</html>
