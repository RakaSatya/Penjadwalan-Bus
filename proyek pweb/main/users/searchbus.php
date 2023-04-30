<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="search-result.php" method="POST">
        <div>
            <label>Dari</label>
            <input type="text" name="sFrom_city" id="">
        </div>
        <div>
            <label>Ke</label>
            <input type="text" name="sTo_city" id="">
        </div>
        <div>
            <label>Tanggal</label>
            <input type="date" name="search_date" id="">
        </div>
        <button type="submit" name = "search_bus">Search</button>
    </form>
</body>
</html>