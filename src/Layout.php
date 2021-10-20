<?php

namespace App;

class Layout
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $page;

    /**
     * @var string
     */
    private $title;

    /**
     * @param $page
     * @param string $name
     * @param string $title
     */
    public function __construct(string $page, string $name = 'default', string $title = 'APSL Website!')
    {
        $this->page = $page;
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Process and render layout
     */
    public function render(): void
    {
        extract([
            'title' => $this->title,
            'content' => $this->renderTemplate()
        ]);
        include __DIR__ . "/../layouts/{$this->name}.php";
    }

    /**
     * Proces template/page
     */
    private function renderTemplate(): string
    {
        ob_start();
        include "../Templates/{$this->page}.php";

        return ob_get_clean();
    }
}