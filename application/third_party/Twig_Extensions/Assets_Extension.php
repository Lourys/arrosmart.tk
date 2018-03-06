<?php

class Assets_Extension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('css', [$this, 'cssPath']),
            new Twig_SimpleFunction('js', [$this, 'jsPath']),
            new Twig_SimpleFunction('img', [$this, 'imgPath']),
        ];
    }

    public function cssPath($file)
    {
        return base_url('assets/css/' . $file . '.css');
    }

    public function jsPath($file)
    {
        return base_url('assets/js/' . $file . '.js');
    }

    public function imgPath($file)
    {
        return base_url('assets/img/' . $file);
    }
}
