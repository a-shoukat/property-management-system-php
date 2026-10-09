<?php
// Starting the session to handle login/logout status
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA Markets — Property Management System</title>

    <!-- Google Translate Script -->
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,ur,fr,es',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
          autoDisplay: false
        }, 'google_translate_element');
      }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>

<!-- ================= Modern Header ================= -->
<header id="header" class="w-100">
    <!-- Top bar -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <ul class="top-contact list-text-white d-table mb-0">
                        <li><a href="#"><i class="fas fa-phone-alt mr-1" style="color:#d4af37"></i>+92 327 9596082</a></li>
                        <li><a href="#"><i class="fas fa-envelope mr-1" style="color:#d4af37"></i>emanniazi456@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="top-contact float-right">
                        <ul class="list-text-white d-table mb-0">
                            <?php if (isset($_SESSION['uemail'])) { ?>
                                <li><i class="fas fa-user mr-1" style="color:#d4af37"></i><a href="logout.php">Logout</a></li>
                            <?php } else { ?>
                                <li><i class="fas fa-user mr-1" style="color:#d4af37"></i><a href="login.php">Login</a></li>
                                <li><i class="fas fa-user-plus mr-1" style="color:#d4af37"></i><a href="register.php">Register</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main navbar -->
    <div class="main-nav py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a class="navbar-brand" href="index.php">EA<span class="brand-accent">Markets</span><span class="brand-gold">.</span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="property.php">Properties</a></li>
                                <li class="nav-item"><a class="nav-link" href="agent.php">Agents</a></li>
                                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                                <?php if (isset($_SESSION['uemail'])) { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                                            <li class="nav-item"><a class="nav-link" href="feature.php">Your Property</a></li>
                                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item"><a class="nav-link" href="login.php">Login / Register</a></li>
                                <?php } ?>
                            </ul>

                            <!-- Language Selector with Google Translate -->
                            <div class="nav-item dropdown mr-2">
                                <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#" role="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-globe"></i> Language
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                                    <div id="google_translate_element" class="px-2 py-1"></div>
                                </div>
                            </div>

                            <a class="btn btn-success d-none d-xl-block" href="submitproperty.php">+ Submit Property</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- =============== /Modern Header =============== -->

</body>
</html>
