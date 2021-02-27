<?php 
    include("./app/models/Content.php");
    include("./app/models/Standings.php");
    include("./app/core/Sort.php");
?>

<?php 
    $type_sort = strip_tags($_GET["typeSort"]);
?>
<!DOCTYPE html>
<html>

<head>
  <title>
    My App
  </title>
  <meta charset="utf-8" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <?php         
        $data_attempts = (new Content('data_attempts.json'))->get_data();
        $data_cars = (new Content('data_cars.json'))->get_data();
        
        $total_data = (new Standings($data_cars, $data_attempts))->get_data();
        $sort_data = (new Sort($total_data, $type_sort))->sort_data();
    ?>
    <div class="wrapper">
        <form action="<?=$_SERVER['PHP_SELF']?>">
            <select name="typeSort" class="select-css">
              <option value="">Выберите тип сортировки</option>
              <option 
                <?php echo $type_sort === 'total_amount' ? 'selected' : '' ?> 
                value="total_amount"
              >По итоговой сумме набранных очков</option>
              <option
                <?php echo $type_sort === 'attempt_1' ? 'selected' : '' ?> 
                value="attempt_1">По пытке №1</option>
              <option
                <?php echo $type_sort === 'attempt_2' ? 'selected' : '' ?>
                value="attempt_2">По пытке №2</option>
              <option
                <?php echo $type_sort === 'attempt_3' ? 'selected' : '' ?>
                value="attempt_3">По пытке №3</option>
              <option
                <?php echo $type_sort === 'attempt_4' ? 'selected' : '' ?>
                value="attempt_4">По пытке №4</option>
            </select>
            <input class="btn_sort" type="submit" value="Сортировать!">
        </form>
        
        <table>
            <caption>
                Результат соревнований по автогонкам
            </caption>
            <tr>
                <th>Место</th>
                <th>ФИО</th>
                <th>Город</th>
                <th>Машина</th>
                <th>Попытка №1</th>
                <th>Попытка №2</th>
                <th>Попытка №3</th>
                <th>Попытка №4</th>
                <th>Итоговый результат</th>
            </tr>
            <?php
                $count = 1; 
                foreach ($sort_data as $key => $val) {  
                   echo "<tr>";
                    echo "<td>$count</td>";
                    echo "<td>{$val['name']}</td>";
                    echo "<td>{$val['city']}</td>";
                    echo "<td>{$val['car']}</td>";
                        foreach ($val['attempts'] as $attempt_key => $attempt_val) {                        
                            echo "<td>$attempt_val</td>";
                        }
                    echo "<td>{$val['total_result']}</td>";
                   echo "</tr>"; 
                   $count++;   
                }
            ?>
        </table>
    </div>
</body>
</html>

