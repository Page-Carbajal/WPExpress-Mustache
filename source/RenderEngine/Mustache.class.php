<?php


namespace WPExpress\UI\RenderEngine;


use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;
use WPExpress\UI\BaseRenderEngine;


class Mustache extends BaseRenderEngine
{

    public function __construct( $context = false )
    {
        parent::__construct($context);

        $this->templatePath  = 'templates/mustache';
        $this->typeExtension = 'mustache';
    }

    public function render( $filename, $context = false )
    {
        $this->setContext($context);

        $templateDirectory = $this->getTemplateDirectory();

        // Include file or notify error
        if( file_exists($templateDirectory) ) {
            $options            = array();
            $options['loader']  = new Mustache_Loader_FilesystemLoader($templateDirectory);
            $options['charset'] = 'UTF-8';

            $mustache = new Mustache_Engine($options);

            return $mustache->render($this->getFileName($filename), $context);

        } else {
            // If not template was found then display the message
            return $this->getTemplateNotFoundMessage();
        }
    }
}