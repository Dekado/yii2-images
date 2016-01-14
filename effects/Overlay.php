<?php
namespace rico\yii2images\effects;

class Overlay {

    public $opacity = '0.2';
    public $toColor = '41, 41, 41';

    public static function getId()
    {
        return 'OverlayForImages';
    }

    public function newPseudoImage($x, $y, $canvasType) {
        $imagick = new \Imagick();
        $imagick->newPseudoImage($x, $y, $canvasType);
        //$imagick->setFillColor('white');
        $imagick->setImageFormat("png");
        //header("Content-Type: image/png");
        return $imagick;
    }

    public function applyTo($im)
    {
        $overlay = $this->newPseudoImage($im->getImageWidth(), $im->getImageHeight(), 'canvas:rgba('.$this->toColor.', '.$this->opacity.')');
        $im->compositeImage($overlay, \Imagick::COMPOSITE_OVER, 0, 0);

        return $im;
    }

}