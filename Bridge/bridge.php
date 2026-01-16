// RedCircle.php
<?php
class RedCircle implements DrawAPI
{
    public function drawCircle(int $radius, int $x, int $y): void
    {
        echo "Drawing Circle[ color: red, radius: {$radius}, x: {$x}, y: {$y} ]\n";
    }
}

// GreenCircle.php
class GreenCircle implements DrawAPI
{
    public function drawCircle(int $radius, int $x, int $y): void
    {
        echo "Drawing Circle[ color: green, radius: {$radius}, x: {$x}, y: {$y} ]\n";
    }
}
