<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System ERP</title>
</head>
<body>
    <h1>System ERP</h1>
    <form action="controller.php" method="post">
        <label for="option">Wybierz moduł:</label>
        <select name="option" id="option">
            <optgroup label="Moduł CRM">
                <option value="1">Dodaj nowego klienta</option>
                <option value="2">Wyświetl wszystkich klientów</option>
                <option value="3">Aktualizuj dane klienta</option>
                <option value="4">Usuń klienta</option>
                <option value="5">Pobierz adresy e-mail klientów</option>
            </optgroup>
            <optgroup label="Moduł sprzedaży">
                <option value="6">Podstawowe operacje CRUD</option>
                <option value="7">Pobierz transakcję z największym przychodem</option>
                <option value="8">Pobierz produkt z największym przychodem</option>
                <option value="9">Liczba transakcji między dwoma datami</option>
                <option value="10">Suma cen transakcji między dwoma datami</option>
            </optgroup>
            <optgroup label="Moduł HR">
                <option value="11">Podstawowe operacje CRUD</option>
                <option value="12">Najstarszy i najmłodszy pracownik</option>
                <option value="13">Średni wiek pracowników</option>
                <option value="14">Pracownicy z urodzinami w ciągu dwóch tygodni</option>
                <option value="15">Liczba pracowników z określonym poziomem uprawnień</option>
                <option value="16">Liczba pracowników na oddział</option>
            </optgroup>
        </select>
        <button type="submit">Wykonaj</button>
    </form>
</body>
</html>
