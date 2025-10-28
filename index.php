<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + React + Inertia.js Development Guide</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <a href="#" class="logo">
            <i class="bi bi-code-slash"></i>
            Laravel + React Guide
        </a>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <?php include('inc/sidebar.php'); ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <!-- Introduction -->
                <?php include('inc/sections/introduction.php') ?>
                
                <!-- Programming Concepts -->
                <?php include('inc/sections/programming-concepts.php') ?>
                
                <!-- Project Structure -->
                <?php include('inc/sections/project-structure.php') ?>                
                
                <!-- Migration -->
                <?php include('inc/sections/migration.php') ?>                
                
                <!-- Factory -->
                 <?php include('inc/sections/factory.php') ?>
                
                <!-- Seeding -->
                <?php include('inc/sections/seeding.php') ?>
                
                <!-- Model -->
                <?php include('inc/sections/model.php') ?>    
                
                <!-- Service -->
                <?php include('inc/sections/service.php') ?> 
                
                <!-- Controllers -->
                <?php include('inc/sections/controllers.php') ?>  
                
                <!-- Routes -->
                <?php include('inc/sections/routes.php') ?>  
                
                <!-- CRUD Operations -->
                <?php include('inc/sections/crud-operation.php') ?>
                
                <!-- Validation -->
                <?php include('inc/sections/validation.php') ?>
                
                <!-- Search -->
                <?php include('inc/sections/search.php') ?>
                
                <!-- Filter -->
                <?php include('inc/sections/filter.php') ?>
                
                <!-- Sort -->
                <?php include('inc/sections/sort.php') ?>
                
                <!-- Pagination -->
                <?php include('inc/sections/pagination.php') ?>
                
                <!-- Delete Operations -->
                <?php include('inc/sections/delete.php') ?>
                
                <!-- File Upload -->
                <?php include('inc/sections/fileupload.php') ?>
                
                <!-- Modal View -->
                <?php include('inc/sections/modalview.php') ?>
                
                <!-- Add/Remove Row -->
                <?php include('inc/sections/add-remove-row.php') ?>
                
                <!-- Price Calculation -->
                <?php include('inc/sections/price-calculation.php') ?>
                
                <!-- Toggle Component -->
                <?php include('inc/sections/toggle-component.php') ?>
                
                <!-- Table Export -->
                <?php include('inc/sections/table-export.php') ?>
                
                <!-- Custom Layouts -->
                <?php include('inc/sections/custom-layouts.php') ?>
                
                <!-- Quick Reference -->
                <?php include('inc/sections/quick-reference.php') ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>