<?php
// Sprawdzamy, czy żądanie zostało wykonane metodą POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzamy, czy opcja została wybrana
    if (isset($_POST["option"])) {
        $option = $_POST["option"];
        
        // W zależności od wybranej opcji kierujemy do odpowiedniego modułu
        switch ($option) {
            case "1":
            case "2":
            case "3":
            case "4":
            case "5":
                // Kierujemy do modułu CRM
                include 'crm.php';
                break;
            case "6":
            case "7":
            case "8":
            case "9":
            case "10":
                // Kierujemy do modułu sales
                include 'sales.php';
                break;
            case "11":
            case "12":
            case "13":
            case "14":
            case "15":
            case "16":
                // Kierujemy do modułu HR
                include 'hr.php';
                break;
            default:
                echo "Nieprawidłowa opcja.";
                break;
        }
    } else {
        // Jeśli opcja nie została wybrana, zwracamy błąd
        echo "Nie wybrano opcji.";
    }
} else {
    // Jeśli żądanie nie jest typu POST, zwracamy błąd
    echo "Nieprawidłowe żądanie.";
}
?>
