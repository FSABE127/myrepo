<?php
// process.php - Vulnerable code with hidden flag and database export
$secret_flag = "VulnWeb{xxe_exploit_success_1337}"; // Flag added here

include('dbconn.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

libxml_use_internal_errors(true); // Suppress warnings
$xmlContent = file_get_contents($_FILES['xmlFile']['tmp_name']);

// Insert uploaded XML into database
$filename = $_FILES['xmlFile']['name'];
$content = $conn->real_escape_string($xmlContent);
$sql = "INSERT INTO uploaded_files (filename, content) VALUES ('$filename', '$content')";

if (!$conn->query($sql)) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$xml = simplexml_load_string(
    $xmlContent,
    'SimpleXMLElement',
    LIBXML_NOENT // Enable entity substitution (vulnerable)
);

if ($xml === false) {
    libxml_clear_errors();
}

// "Secret" flag check (intentionally vulnerable)
if (isset($xml->flag)) {
    echo "<div class='flag-container'>";
    echo "<h3>Validation Successful</h3>";
    echo "<p>Secret Code: " . htmlspecialchars($secret_flag) . "</p>";
    echo "</div>";
}

$conn->close();
?>