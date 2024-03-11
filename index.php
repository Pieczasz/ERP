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

    <!-- Dodatkowy formularz dla opcji 1 (Dodaj nowego klienta) w module CRM -->
<div id="addCustomerForm" style="display: none;">
    <h2>Dodaj nowego klienta</h2>
    <form action="controller.php" method="post">
        <input type="hidden" name="option" value="1">
        <input type="hidden" name="module" value="crm">
        <label for="name">Imię:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="email">Adres e-mail:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="subscription">Status subskrypcji:</label>
        <input type="text" name="subscription" id="subscription" required><br>
        <button type="submit">Dodaj klienta</button>
    </form>
</div>

    <!-- Dodatkowy formularz dla opcji 3 (Aktualizuj dane klienta) w module CRM -->
    <div id="updateCustomerForm" style="display: none;">
        <h2>Aktualizuj dane klienta</h2>
        <form action="controller.php" method="post">
            <input type="hidden" name="option" value="3">
            <input type="hidden" name="module" value="crm">
            <label for="customerId">Identyfikator klienta:</label>
            <input type="text" name="customerId" id="customerId" required><br>
            <label for="name">Nowe imię:</label>
            <input type="text" name="name" id="name" required><br>
            <label for="email">Nowy adres e-mail:</label>
            <input type="email" name="email" id="email" required><br>
            <label for="subscription">Nowy status subskrypcji:</label>
            <input type="text" name="subscription" id="subscription" required><br>
            <button type="submit">Aktualizuj dane klienta</button>
        </form>
    </div>

    <!-- Dodatkowy formularz dla opcji 4 (Usuń klienta) w module CRM -->
    <div id="deleteCustomerForm" style="display: none;">
        <h2>Usuń klienta</h2>
        <form action="controller.php" method="post">
            <input type="hidden" name="option" value="4">
            <input type="hidden" name="module" value="crm">
            <label for="customerId">Identyfikator klienta:</label>
            <input type="text" name="customerId" id="customerId" required><br>
            <button type="submit">Usuń klienta</button>
        </form>
    </div>

    <script>
        document.getElementById('option').addEventListener('change', function() {
            if (this.value === '1') {
                document.getElementById('addCustomerForm').style.display = 'block';
            } else if (this.value === '3') {
                document.getElementById('updateCustomerForm').style.display = 'block';
            } else if (this.value === '4') {
                document.getElementById('deleteCustomerForm').style.display = 'block';
            } else {
                document.getElementById('addCustomerForm').style.display = 'none';
                document.getElementById('updateCustomerForm').style.display = 'none';
                document.getElementById('deleteCustomerForm').style.display = 'none';
            }
        });
    </script>
</body>
</html>
