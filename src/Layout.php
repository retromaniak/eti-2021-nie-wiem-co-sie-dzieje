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
     * @var array
     */
    private $params;

    /**
     * @param string $page
     * @param string $name
     * @param string $title
     * @param array $params
     */

    public function __construct(
        string $page,
        string $name,
        string $title = 'APSL Website!',
        array $params
    ) {
        $this->page = $page;
        $this->name = $name;
        $this->title = $title;
        $this->params = $params;
    }

    /**
     * Process and render layout
     * @return string
     */
    public function render(): string
    {
        extract(array_merge($this->params, [
            'title' => $this->title,
            'content' => $this->renderTemplate(),
            'session' => ServiceContainer::getInstance()->get('session')
        ]));

        ob_start();
        include __DIR__ . "/../layouts/{$this->name}.php";
        return ob_get_clean();
    }

    /**
     * Proces template/page
     */
    private function renderTemplate(): string
    {
        ob_start();
        extract($this->params);
        include "../templates/{$this->page}.php";

        return ob_get_clean();
    }
}