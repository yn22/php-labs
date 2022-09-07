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
        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th class="region">Область</th>
                    <th>Населення, тис.</th>
                    <th>Кількість ВНЗ</th>
                    <th>Кількість ВНЗ на 100 тис. населення</th>
                </tr>
            </thead>
            <tbody>
                <?php
                define("FILE_PATH", "./data/oblinfo.txt");
                $fp = fopen(FILE_PATH, "r");
                $rows_number = (int)fgets($fp);
                $i = 1;
                while (!feof($fp)) {
                    $city =  iconv("windows-1251", "utf-8", fgets($fp));
                    $population = (int)fgets($fp);
                    $universities = (int)fgets($fp);
                    $universities_per_100k = round($universities / $population * 100, 2);

                    echo "
                        <tr>
                            <td>$i</td>
                            <td>$city</td>
                            <td>$population</td>
                            <td>$universities</td>
                            <td>$universities_per_100k</td>
                        </tr>
                    ";
                    $i++;
                }
                fclose($fp);
                ?>
            </tbody>
        </table>
    </body>
</html>


