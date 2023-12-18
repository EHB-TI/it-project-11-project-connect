<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApplicationBox extends Component
{
    public string $title;
    public string $message;
    public ?string $route;
    public ?int $projectId;
    public ?string $buttonText;
    public ?string $status;

    public function __construct(string $title, string $message, ?string $route = null, ?int $projectId = null, ?string $buttonText = null, ?string $status = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->route = $route;
        $this->projectId = $projectId;
        $this->buttonText = $buttonText;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.application-box');
    }
}
