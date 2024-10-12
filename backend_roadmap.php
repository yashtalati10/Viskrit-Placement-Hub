<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Developer Roadmap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .roadmap-section {
            padding: 40px 0;
        }
        .roadmap-step {
            margin-bottom: 30px;
        }
        .roadmap-step h4 {
            background-color: #6c757d;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .roadmap-step p {
            background-color: #e9ecef;
            padding: 15px;
            border-left: 4px solid #6c757d;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#learn-language">Programming Languages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#databases">Databases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#api-design">API Design</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#security">Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#version-control">Version Control</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Roadmap Section -->
    <div class="container roadmap-section">
        <h2 class="text-center mb-5">Backend Developer Roadmap</h2>

        <!-- Step 1: Learn a Programming Language -->
        <div class="roadmap-step" id="learn-language">
            <h4>1. Learn a Backend Programming Language</h4>
            <p>Choose a programming language suitable for backend development. Some common choices include:</p>
            <ul class="list-group">
                <li class="list-group-item">Node.js (JavaScript)</li>
                <li class="list-group-item">Python (Django, Flask)</li>
                <li class="list-group-item">PHP (Laravel, Symfony)</li>
                <li class="list-group-item">Java (Spring)</li>
                <li class="list-group-item">Ruby (Ruby on Rails)</li>
            </ul>
        </div>

        <!-- Step 2: Databases -->
        <div class="roadmap-step" id="databases">
            <h4>2. Learn Databases</h4>
            <p>Databases store and retrieve data for your applications. Choose between SQL and NoSQL databases depending on your project needs.</p>
            <ul class="list-group">
                <li class="list-group-item">SQL Databases: MySQL, PostgreSQL, MariaDB</li>
                <li class="list-group-item">NoSQL Databases: MongoDB, Cassandra, Redis</li>
                <li class="list-group-item">Learn to write SQL queries and optimize database performance</li>
                <li class="list-group-item">Learn Database normalization and indexing</li>
            </ul>
        </div>

        <!-- Step 3: API Design -->
        <div class="roadmap-step" id="api-design">
            <h4>3. Learn API Design</h4>
            <p>APIs (Application Programming Interfaces) allow your application to communicate with others. You should learn how to design and develop RESTful or GraphQL APIs.</p>
            <ul class="list-group">
                <li class="list-group-item">RESTful APIs: Learn HTTP methods (GET, POST, PUT, DELETE)</li>
                <li class="list-group-item">Authentication: JWT, OAuth, and session management</li>
                <li class="list-group-item">Rate limiting and error handling</li>
                <li class="list-group-item">GraphQL: Learn querying, mutations, and resolvers</li>
            </ul>
        </div>

        <!-- Step 4: Security -->
        <div class="roadmap-step" id="security">
            <h4>4. Learn Web Application Security</h4>
            <p>Security is crucial for backend development. Protect your applications against common threats by learning:</p>
            <ul class="list-group">
                <li class="list-group-item">Implementing HTTPS (SSL/TLS)</li>
                <li class="list-group-item">Preventing SQL Injection and Cross-site Scripting (XSS)</li>
                <li class="list-group-item">Authentication & Authorization: Role-based access control</li>
                <li class="list-group-item">Secure password storage: Hashing algorithms like bcrypt</li>
            </ul>
        </div>

        <!-- Step 5: Version Control -->
        <div class="roadmap-step" id="version-control">
            <h4>5. Version Control with Git</h4>
            <p>Version control is essential for managing code. Learn to use Git to collaborate with others and track changes in your projects.</p>
            <ul class="list-group">
                <li class="list-group-item">Learn Git basics: Commit, push, pull, branching</li>
                <li class="list-group-item">Use GitHub or GitLab for repository management</li>
                <li class="list-group-item">Collaborate with others using pull requests</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Backend Developer Roadmap. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
