<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>search</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
table, th, td {
    border: 1px solid black;
            border-collapse: collapse;
            width: 500px;
        }
    </style>

</head>
<body>
<div>
    <table>
        <tr>
            <th>名字</th>
            <th>類型</th>
            <th>收件時間</th>
            <th>地點</th>
        </tr>

        <?php
        foreach ($RECORD as $user) {?>
        <tr>
            <td><?php echo $user->NAME; ?></td>
            <td><?php echo $user->TYPE; ?></td>
            <td><?php echo $user->RECEIEVE_DATE; ?></td>
            <td><?php echo $user->PLACE; ?></td>
        </tr>
    <?php } ?>
</table>
</div>
</body>
</html>
