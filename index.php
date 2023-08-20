<?php

include_once('BmiIndexer.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $weight = floatval($_POST["weight"]);
    $height = floatval($_POST["height"]);

    $human = new HumanBeing();
    $human->setWeight($weight);
    $human->setHeight($height);
    $human->calculateBmi();

    $bmiIndexer = new BmiIndexer();
    $bmiIndexer->setHuman($human);

    $bmi = $bmiIndexer->getBmi();
    $interpretation = $bmiIndexer->interpretBMI();
    $imagePath = $bmiIndexer->interpretimagePathBMI();
    $details = $bmiIndexer->interpretdetailsBMI();

    // แสดงผล
    echo "<div class='container py-5'>";
    echo "<div class='row justify-content-center'>";
    echo "<div class='col-lg-6'>";
    echo "<div class='card shadow bg-dark'>";
    echo "<div class='card-body'>";
    echo "<h2 class='text-center mb-4'>ผลลัพธ์</h2>";
    echo "<p class='text-center'><strong>ค่า BMI ของคุณคือ:</strong> " . $bmi . "</p>";
    echo "<p class='text-center'><strong>" . $interpretation . "</strong></p>";
    echo "<div class='text-center'>";
    echo "<img src='" . $imagePath . "' alt='BMI Image' class='img-fluid rounded mx-auto d-block' />";
    echo "</div>";
    echo "<div class='details'>";
    echo "<h3>ข้อแนะนำ:</h3>";
    echo "<ul>";
    echo $details;
    echo "</ul>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>BMI Calculator</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("images/bmi background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }

        .card {
            border-radius: 20px;
            border: none;
        }

        .btn {
            border-radius: 20px;
        }

        .btn {
            transition: transform .2s;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        @keyframes animateBackground {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 100% 0;
            }
        }

        body {
            background-image: url("images/bmi background.jpg");
            animation: animateBackground 10s linear infinite;
            background-size: 200% 200%;
            color: white;
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow bg-dark">
                    <div class="card-body">
                        <h1 class="text-center mb-4">BMI Calculator</h1>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="weight">Weight (kg):</label>
                                <input type="text" class="form-control" name="weight" id="weight" required>
                            </div>
                            <div class="form-group">
                                <label for="height">Height (cm):</label>
                                <input type="text" class="form-control" name="height" id="height" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Calculate BMI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>