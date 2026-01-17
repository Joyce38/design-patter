<?php

// 1. Subject Interface: Defines the common interface for both the RealSubject and the Proxy
interface Image
{
    public function display();
}

// 2. Real Subject: The actual object that performs the resource-intensive work
class RealImage implements Image
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        // Simulate a heavy operation, e.g., loading from disk or a remote server
        $this->loadFromDisk();
    }

    private function loadFromDisk()
    {
        echo "Loading image: " . $this->filename . "\n";
    }

    public function display()
    {
        echo "Displaying image: " . $this->filename . "\n";
    }
}

// 3. Proxy: The proxy object that acts as a placeholder
class ProxyImage implements Image
{
    private $realImage;
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    // Controls access and performs lazy initialization
    public function display()
    {
        if ($this->realImage == null) {
            // Only create the real object when it's actually needed
            $this->realImage = new RealImage($this->filename);
        }
        // Delegate the request to the real object
        $this->realImage->display();
    }
}

// Client code
echo "Client: Executing the client code with a proxy...\n";

// Create proxy objects, but the real images are not loaded yet
$image1 = new ProxyImage("image1.jpg");
$image2 = new ProxyImage("image2.jpg");

echo "\nClient: Calling display() on image1 for the first time...\n";
// The real image1 is loaded and displayed here
$image1->display();

echo "\nClient: Calling display() on image1 again...\n";
// The real image1 is already loaded and just displayed
$image1->display();

echo "\nClient: Calling display() on image2 for the first time...\n";
// The real image2 is loaded and displayed here
$image2->display();

?>
