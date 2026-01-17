<?php
interface Mediator
{
    public function sendMessage(string $message, User $user): void;
}
class ChatMediator implements Mediator
{
    private array $users = [];

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function sendMessage(string $message, User $sender): void
    {
        foreach ($this->users as $user) {
            // Do not send the message back to the sender
            if ($user !== $sender) {
                $user->receive($message);
            }
        }
    }
}
class User
{
    private string $name;
    private Mediator $mediator;

    public function __construct(string $name, Mediator $mediator)
    {
        $this->name = $name;
        $this->mediator = $mediator;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function send(string $message): void
    {
        echo "[" . $this->name . "] sends: " . $message . "\n";
        $this->mediator->sendMessage($message, $this);
    }

    public function receive(string $message): void
    {
        echo "[" . $this->name . "] receives: " . $message . "\n";
    }
}
// Instantiate the Mediator
$mediator = new ChatMediator();

// Instantiate Colleague (User) objects and link them to the mediator
$john = new User("John", $mediator);
$jane = new User("Jane", $mediator);
$doe = new User("Doe", $mediator);

// Add users to the mediator's list
$mediator->addUser($john);
$mediator->addUser($jane);
$mediator->addUser($doe);

echo "--- Communication through Mediator ---\n";
// John sends a message, which the mediator then routes to Jane and Doe
$john->send("Hi everyone!");

echo "\n";

// Jane sends a message to everyone else via the mediator
$jane->send("Hello John and Doe!");
