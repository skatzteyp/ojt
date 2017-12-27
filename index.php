<?php
    $conn = new mysqli('127.0.0.1', 'root', 'password', 'ojt');

    if ($conn->connect_error) {
        echo $conn->connect_errno . ' - ' . $conn->connect_error;
        die();
    }

    if ($_POST['submit']) {
        $values = [ $_POST['title'], $_POST['artist'], $_POST['year'], $_POST['image'] ];
        $sql = 'INSERT INTO songs(title, artist, year, image) VALUES ("' . implode('","', $values) . '")';

        if (!$conn->query($sql)) {
            echo $conn->error;
        }
    }

    $sql = 'SELECT * FROM songs';

    $songs = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title></title>
    </head>
    <body>
        <form action="/" method="POST">
            Title: <input type="text" name="title" /><br>
            Artist: <input type="text" name="artist" /><br>
            Year: <input type="text" name="year" /><br>
            Image: <input type="text" name="image" /><br>
            <input type="submit" value="Add New" name="submit" />
        </form>
        <table>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th></th>
            </tr>
            <?php while($song = $songs->fetch_assoc()): ?>
            <?php if ($song['id'] == $_GET['id']) { $selected = $song; } ?>
            <tr>
                <td><?php echo $song['title']; ?></td>
                <td><?php echo $song['artist']; ?></td>
                <td><?php echo $song['year']; ?></td>
                <td><a href="?id=<?php echo $song['id']; ?>">View</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php if ($selected): ?>
        <img src="<?php echo $selected['image']; ?>" />
        <?php endif; ?>
    </body>
</html>

