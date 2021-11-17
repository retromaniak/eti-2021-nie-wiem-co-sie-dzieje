<html>
<head>
	<title><?php echo $title ?></title>
</head>
<body>
	<h1>Hello APSL!</h1>
    <a href="/">Main PAGE</a><br />
    <a href="/body">BODY PAGE</a><br />
    <a href=/article/{id}>Article PAGE</a>
<!--    napisac generate uri, ma zadanie przyjac 2 parametry.-->
<!--    1 nazwa, 2 parametry routingu w wyniku-->
<!--    /strona/parametry w oparciu o router match-->
<!--    z danych generowac sciezka do a href-->
    <?php echo $content ?>
</body>
</html>