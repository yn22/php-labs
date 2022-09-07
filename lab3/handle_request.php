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
            $specialization_key = $_GET["napr"];
            $specializations_map = array();

            define("FILE_PATH", "./data/data.txt");
            $fp = fopen(FILE_PATH, "r");
            $to_continuie = true;

            while (!feof($fp) && $to_continuie) {
                $line = trim(iconv("windows-1251", "utf-8", fgets($fp)));
                if ($line == $specialization_key) {
                    $total_universities = (int)fgets($fp);

                    $specializations_map[$specialization_key] = array(
                        "stats" => array(
                            "total_universities" => $total_universities
                        ),
                        "universities" => array()
                    );
                    // while the line not equal to line break
                    while (!feof($fp)) {
                        $university_score = fgets($fp);
                        if ($university_score == PHP_EOL) {
                            $to_continuie = false;
                            break;
                        }
                        $university_budget_places = (int)fgets($fp);
                        $university_contract_places = (int)fgets($fp);
                        $university_name = iconv("windows-1251", "utf-8", fgets($fp));

                        $specializations_map[$specialization_key]["universities"][$university_name] = array(
                            "avg_score" => $university_score,
                            "budget_places" => $university_budget_places,
                            "contract_places" => $university_contract_places
                        );
                    }
                }
            }
            fclose($fp);

            echo "
                <p>
                <b>Спеціальність:</b> $specialization_key
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Середній бал студентів, які поступили на бюджет</th>
                            <th>Кількість студентів, які поступили на бюджет</th>
                            <th>Недобір</th>
                            <th>Кількість контрактиків</th>
                            <th>ВНЗ</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($specializations_map[$specialization_key]["universities"] as $university_name => $university_data) {
                            $university_score = $university_data["avg_score"];
                            $university_budget_places = $university_data["budget_places"];
                            $university_contract_places = $university_data["contract_places"] <= 0 ? "-" : $university_data["contract_places"];
                            $university_shortage = $university_data["contract_places"] < 0 ? abs($university_data["contract_places"]) : "-";
                            echo "
                                <tr>
                                    <td>$university_score</td>
                                    <td>$university_budget_places</td>
                                    <td>$university_shortage</td>
                                    <td>$university_contract_places</td>
                                    <td>$university_name</td>
                                </tr>
                            ";
                        }                
                        echo "
                    </tbody>
                </table>        
            "
        ?>
    </body>
</html>