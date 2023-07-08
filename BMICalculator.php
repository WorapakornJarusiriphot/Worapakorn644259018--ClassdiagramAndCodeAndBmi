<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #c31432, #240b36);
            color: white;
        }
        .card {
            border-radius: 20px;
            border: none;
        }
        .btn {
            border-radius: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

    <?php

    class BMICalculator
    {
        private $weight; // Weight in kilograms
        private $height; // Height in centimeters

        public function __construct($weight = 0, $height = 0)
        {
            $this->setWeight($weight);
            $this->setHeight($height);
        }

        public function getWeight()
        {
            return $this->weight;
        }

        public function setWeight($weight)
        {
            $this->weight = $weight;
        }

        public function getHeight()
        {
            return $this->height;
        }

        public function setHeight($height)
        {
            $this->height = $height;
        }

        public function calculateBMI()
        {
            $heightInMeters = $this->getHeight() / 100;
            $bmi = $this->getWeight() / ($heightInMeters * $heightInMeters);
            return round($bmi, 2);
        }

        public function interpretBMI()
        {
            $bmi = $this->calculateBMI();
            $interpretation = '';

            if ($bmi < 16) {
                $interpretation = 'น้ำหนักต่ำกว่ามาตรฐานมาก / ผอมมาก';
            } elseif ($bmi >= 16 && $bmi < 18.5) {
                $interpretation = 'น้ำหนักน้อย  / ผอม';
            } elseif ($bmi >= 18.5 && $bmi < 25) {
                $interpretation = 'ปกติ (สุขภาพดี)';
            } elseif ($bmi >= 25 && $bmi < 30) {
                $interpretation = 'น้ำหนักเกิน / โรคอ้วนระดับ 1';
            } elseif ($bmi >= 30 && $bmi < 35) {
                $interpretation = 'อ้วน / โรคอ้วนระดับ 2';
            } elseif ($bmi >= 35 && $bmi < 40) {
                $interpretation = 'อ้วนมาก / โรคอ้วนระดับ 3';
            } elseif ($bmi >= 40) {
                $interpretation = 'เป็นโรคอ้วน / โรคอ้วนระดับสุดท้าย';
            }

            return $interpretation;
        }
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $weight = floatval($_POST["weight"]);
        $height = floatval($_POST["height"]);

        $bmiCalculator = new BMICalculator($weight, $height);

        // คำนวณค่า BMI
        $bmi = $bmiCalculator->calculateBMI();

        // แปลงค่า BMI เป็นคำอธิบาย
        $interpretation = $bmiCalculator->interpretBMI();

        // Define image for each BMI category
        $imagePath = "";
        if ($bmi < 16) {
            $imagePath = "images/ผอมมาก.jpg";
        } elseif ($bmi >= 16 && $bmi < 18.5) {
            $imagePath = "images/ผอม.jpg";
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $imagePath = "images/สุขภาพดี.jpg";
        } elseif ($bmi >= 25 && $bmi < 30) {
            $imagePath = "images/น้ำหนักเกิน.jpg";
        } elseif ($bmi >= 30 && $bmi < 35) {
            $imagePath = "images/อ้วน.jpg";
        } elseif ($bmi >= 35 && $bmi < 40) {
            $imagePath = "images/อ้วนมาก.jpg";
        } elseif ($bmi >= 40) {
            $imagePath = "images/เป็นโรคอ้วน.png";
        }

        // แสดงผลลัพธ์
        echo "<div class='container py-5'>";
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-lg-6'>";
        echo "<div class='card shadow bg-dark'>";
        echo "<div class='card-body'>";
        echo "<h2 class='text-center mb-4'>ผลลัพธ์</h2>";
        echo "<p class='text-center'><strong>ค่า BMI ของคุณคือ:</strong> " . $bmi . "</p>";
        echo "<p class='text-center'><strong> " . $interpretation . "</p>";
        echo "<div class='text-center'>";
        echo "<img src='" . $imagePath . "' alt='BMI Image' class='img-fluid rounded mx-auto d-block' />";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    ?>
</body>
</html>
