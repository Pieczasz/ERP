<?php
// Tutaj dodajemy kod do obsługi formularza i operacji związanych z modułem CRM

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzamy, czy opcja została wybrana
    if (isset($_POST["option"])) {
        $option = $_POST["option"];
        
        // Tutaj będziemy dodawać obsługę różnych opcji
        switch ($option) {
            case "1":
                // Obsługa dodawania nowego klienta
                break;
            case "2":
                // Obsługa wyświetlania wszystkich klientów
                break;
            case "3":
                // Obsługa aktualizacji danych klienta
                break;
            case "4":
                // Obsługa usuwania klienta
                break;
            case "5":
                // Obsługa pobierania adresów e-mail klientów
                break;
            default:
                echo "Nieprawidłowa opcja.";
        }
    } else {
        echo "Nie wybrano opcji.";
    }
}
?>
