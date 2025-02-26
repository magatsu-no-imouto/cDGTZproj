<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="hepc.jpg" type="image/x-icon">
    <title>Centralized Digitization</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        /* Hero Section */
        .carousel-item img {
            width: 100%;
            height: 80vh;
            object-fit: cover;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
        }

        .carousel-caption h1,
        .carousel-caption p {
            color: white;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }

        /* Gallery Section */
        .gallery {
            padding: 60px 0;
        }

        .gallery h2 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .gallery .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .gallery .card:hover {
            transform: translateY(-10px);
        }

        .gallery .card-img-top {
            height: 100px;
            width: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery .card-body {
            padding: 15px;
            text-align: center;
        }

        .gallery .card-title {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .gallery .card-text {
            font-size: 1rem;
            color: #555;
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-mode .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
        }

        body.dark-mode .gallery .card {
            background-color: #1f1f1f;
            border: 1px solid #444;
        }

        body.dark-mode .footer {
            background-color: #222;
        }

        /* Dark mode toggle button */
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f1f1f1;
            border: none;
            padding: 10px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark-mode-toggle:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body class="dark-mode">

    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fas fa-sun"></i>
    </button>

  

    <!-- Gallery Section -->
    <section class="gallery">
        <h2>Hayakawa Electronics (Phils.) Corps.</h2>
        <div class="container mt-4">
            <a href = "wi.php" style = "text-decoration: none; color:white;">
            <div class="row row-cols-3 row-cols-md-3 g-3">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">WORK INSTRUCTION</h5>
                            
                        </div>
                    </div>
                </div>
            </a>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 3">
                        <div class="card-body">
                            <h5 class="card-title">CONTROL PLAN</h5>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 4">
                        <div class="card-body">
                            <h5 class="card-title">FIC</h5>
                          
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 5">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCT SPECIFICATIONS</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">MATERIAL DETAILS</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DIAOR</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DAILY MAINTENANCE CHECKSHEET</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCTION ASSEMBLY RECORD</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DCIOR</h5>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2025 Hayakawa Electronics (Phils.) Corps. . All rights reserved.</p>
      
    </footer>

    <!-- Bootstrap and JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Toggle dark mode
        document.getElementById('darkModeToggle').addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.dark-mode-toggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
    </script>
</body>

</html>
