<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moduł CRM</title>
</head>
<body>
    <h1>Moduł CRM</h1>
    <form action="crm.php" method="post">
        <label for="option">Wybierz opcję:</label>
        <select name="option" id="option">
            <option value="1">Dodaj nowego klienta</option>
            <option value="2">Wyświetl wszystkich klientów</option>
            <option value="3">Aktualizuj dane klienta</option>
            <option value="4">Usuń klienta</option>
            <option value="5">Pobierz adresy e-mail klientów</option>
        </select>
        <button type="submit">Wykonaj</button>
    </form>
</body>
</html>
