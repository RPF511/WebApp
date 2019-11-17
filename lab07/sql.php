<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 07</title>
        <meta charset='utf-8' />
    </head>

    <body>
        <form action="sql.php" method="POST">
            Database:
            <input type="text" name="db"/>
            <br>
            Query:
            <input type="text" name="query"/>
            <br>
            <input type="submit">
        </form>
        <p>Result</p>
        <ul>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "mysql";
        if ($_POST['db'] != "" and $_POST['query'] != "") {
            $dbname = $_POST['db'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $result = $conn->query($_POST['query']);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <li><?= print_r($row) ?></li>
                <?php
                }
            } else {?>
                <li>no result</li>
            <?php
            }
            $conn->close();
        }
        ?>
        </ul>
    </body>
</html>