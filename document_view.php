<?php
    // view_document.php - Vulnerable Version
    include('dbconn.php');
    $doc_id = $_GET['doc_id'] ?? '';

    // Connect to database
    // Check connection
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    // Verify document exists in database
    $stmt = $conn->prepare('SELECT file_name FROM uploaded_files WHERE id = ?');
    $stmt->bind_param('s', $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Vulnerable path construction - no sanitization
        $file_path = '../protected_documents/' . $doc_id . '_' . $row['file_name'];
        
        if (file_exists($file_path)) {
            // Output file contents
            header('Content-Type: application/octet-stream');
            readfile($file_path);
        } else {
            echo 'File not found in storage';
        }
    } else {
        echo 'Invalid document ID';
    }

    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Secure Document Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 2rem; }
        .card { margin-top: 3rem; }
        .spinner { display: none; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Acme Corp Document System</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Secure Document Retrieval</h4>
            </div>
            <div class="card-body">
                <form id="docForm" class="needs-validation" novalidate>
                    <div class="input-group">
                        <input type="text" class="form-control" name="doc_id" 
                               placeholder="Enter your 5-digit document ID" 
                               pattern="\d{5}" required>
                        <button class="btn btn-primary" type="submit">Retrieve Document</button>
                    </div>
                    <div class="invalid-feedback">
                        Please enter a valid 5-digit ID
                    </div>
                    <div class="spinner-border text-primary mt-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </form>
                <div id="result" class="mt-4"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('docForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Form validation
            if (!this.checkValidity()) {
                this.classList.add('was-validated');
                return;
            }

            const docId = this.doc_id.value;
            const spinner = document.querySelector('.spinner');
            const resultDiv = document.getElementById('result');
            
            spinner.style.display = 'block';
            resultDiv.innerHTML = '';

            fetch(`view_document.php?doc_id=${encodeURIComponent(docId)}`)
                .then(response => {
                    if (!response.ok) throw new Error('Document not found');
                    return response.text();
                })
                .then(html => {
                    resultDiv.innerHTML = html;
                })
                .catch(error => {
                    resultDiv.innerHTML = `<div class="alert alert-danger">
                        Error retrieving document: ${error.message}
                    </div>`;
                })
                .finally(() => {
                    spinner.style.display = 'none';
                });
        });
    </script>
</body>
</html>