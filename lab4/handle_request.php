<!-- add basic html -->
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
        <?php
            $region_number = $_GET["region_number"];

            define("FILE_PATH", "./data/oblinfo.txt");
            $fp = fopen(FILE_PATH, "r");
            // read line number 10 from the file
            $i = 1;

            while (!feof($fp)) {
                if ($i == $region_number) {
                    $region =  trim(fgets($fp));
                    $population = (int)fgets($fp);
                    $universities = (int)fgets($fp);
                    $universities_per_100k = round($universities / $population * 100, 2);
                    break;
                }
                $i++;
                fgets($fp);
            }

            echo "
                <table>
                    <thead>
                        <tr>
                            <th>Область</th>
                            <th>Населення, тис.</th>
                            <th>Кількість вишів</th>
                            <th>Кількість вишів на 100 тис. населення</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$region</td>
                            <td>$population</td>
                            <td>$universities</td>
                            <td>$universities_per_100k</td>
                        </tr>
            ";

        ?>
    </body>
</html>