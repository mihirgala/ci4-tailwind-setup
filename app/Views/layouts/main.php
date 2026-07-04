<?php $appname = "MyApp" ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Instrasoft - Premium Web Solutions and Design">
    <title>
        <?= (isset($title) && !empty($title)) ? "$title | $appname" : "$appname" ?>
    </title>
    <link rel="stylesheet" href="/css/output.css">
</head>

<body class="h-screen flex flex-col overflow-hidden">
    <?= $this->include('partials/navbar') ?>

    <main class="flex-1 flex flex-col min-h-screen">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/footer') ?>
</body>

</html>