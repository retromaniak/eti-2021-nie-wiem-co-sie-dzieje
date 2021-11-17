<?php

namespace App;

class Layout
{
    /**
     * @var string
     */
        private  $name;
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
     * @param $page
     * @param string $name
     * @param string $title
     */
        public function __construct(
            Request $request,
            string $page,
            string $name ='default',
            string $title = 'APSL Website'
        ){
            $this->page = $page;
            $this->name = $name;
            $this->title = $title;
            $this->request=$request;

        }

    /**
     * process layout
     */
        public  function  render(): string
        {
            extract([
                'title'=>$this->title,
                'content'=> $this->renderTemplate()
            ]);
            ob_start();
            include __DIR__."/../layouts/{$this->name}.php";
            return ob_get_clean();

        }

    /**
     * process template/page
     */
        private function  renderTemplate(): string
        {
            ob_start();
            extract([
                'request'=>$this->request,
                'router' => ServiceContainer::getInstance()->getService('router')
            ]);
            include "../templates/{$this->page}.php";
            return ob_get_clean();
        }
}