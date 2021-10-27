<?php

namespace App;

/**
 * Klasa przetwarzająca layouty aplikacji. Odpowiada zarenderowanie stron/szablonów.
 */
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
     * @var Request
     */
    private $request;

    /**
     * @param string $page
     * @param string $name
     * @param string $title
     * @param Request $request
     */
    public function __construct(
        Request $request,
        string $page,
        string $name = 'default',
        string $title = 'APSL Website!'
    ) {
        $this->page = $page;
        $this->name = $name;
        $this->title = $title;
        $this->request = $request;
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
        extract([
            'request' => $this->request
        ]);
        include "../Templates/{$this->page}.php";

        return ob_get_clean();
    }
}