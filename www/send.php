
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM  ORDER BY id DESC LIMIT 1';
                       foreach ($pdo->query($sql) as $row) {
                           echo '<tr>';
                           echo '<td>'. $row['name'] . '</td>';
                           echo '<td>'. $row['email'] . '</td>';
                           echo '<td><a class="btn" href="read.php?id='.$row['id'].'">Read</a></td>';
                           echo '</tr>';
                       }
                       Database::disconnect();

