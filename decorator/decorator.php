<?php
// 1. Subject Interface (Common interface for Real Subject and Proxy)
interface EbookInterface
{
    public function open(): void;
    public function getContent(): string;
}

// 2. Real Subject (Resource-intensive class)
class RealEbook implements EbookInterface
{
    private string $content;

    public function __construct(string $filename)
    {
        // Simulate a heavy operation like loading a large file
        // This is only called when the real object is instantiated.
        echo "Loading ebook from disk: $filename\n";
        $this->content = file_get_contents($filename); // Placeholder for actual file loading
    }

    public function open(): void
    {
        echo "Ebook opened.\n";
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

// 3. Proxy (Controls access and lazy loads the real subject)
class EbookProxy implements EbookInterface
{
    private ?RealEbook $realEbook = null;
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    private function initializeEbook(): void
    {
        if ($this->realEbook === null) {
            $this->realEbook = new RealEbook($this->filename);
        }
    }

    public function open(): void
    {
        // Access control can be added here
        $this->initializeEbook();
        $this->realEbook->open();
    }

    public function getContent(): string
    {
        // Lazy initialization happens only when content is needed
        $this->initializeEbook();
        return $this->realEbook->getContent();
    }
}

// Client code
echo "Client: Requesting to open the ebook (Proxy created, but not loaded yet).\n";
$ebookProxy = new EbookProxy("design_patterns.txt");

echo "Client: Opening the ebook.\n";
$ebookProxy->open(); // RealEbook instantiated here

echo "Client: Getting content.\n";
$content = $ebookProxy->getContent(); // Content retrieved
// ...
// 1. Component Interface (Same as EbookInterface above)
// interface EbookInterface { ... }

// 2. Concrete Component (RealEbook class - pure business logic)
// class RealEbook implements EbookInterface { ... }

// 3. Base Decorator class (Implements the interface and holds a reference to the wrapped object)
abstract class EbookDecorator implements EbookInterface
{
    protected EbookInterface $ebook;

    public function __construct(EbookInterface $ebook)
    {
        $this->ebook = $ebook;
    }

    public function open(): void
    {
        $this->ebook->open();
    }

    public function getContent(): string
    {
        return $this->ebook->getContent();
    }
}

// 4. Concrete Decorator (Adds specific new behavior)
class LoggerDecorator extends EbookDecorator
{
    public function open(): void
    {
        echo "[LOG] Opening ebook...\n";
        parent::open();
        echo "[LOG] Ebook successfully opened.\n";
    }

    public function getContent(): string
    {
        echo "[LOG] Accessing ebook content...\n";
        $content = parent::getContent();
        echo "[LOG] Content access finished.\n";
        return $content;
    }
}

// Client code
echo "Client: Creating a real ebook object.\n";
$realEbook = new RealEbook("design_patterns.txt"); // RealEbook loads immediately

echo "Client: Wrapping it with a LoggerDecorator.\n";
$loggedEbook = new LoggerDecorator($realEbook);

echo "Client: Opening the decorated ebook.\n";
$loggedEbook->open(); // Now includes logging messages

echo "Client: Getting content from the decorated ebook.\n";
$loggedEbook->getContent(); // Now includes logging messages
// ...
