<?php 
class Image_Color_Analyse
{

    public function getPixelMatrix($histogramElements)
    {
        $colorStatistics = [];

        foreach ($histogramElements as $histogramElement) {

            // only for debug
            //$colorString = $histogramElement->getColorAsString();

            $color = $histogramElement->getColor();
            $count = $histogramElement->getColorCount();

            $hex = sprintf('#%s%s%s',
                dechex($color['r']),
                dechex($color['g']),
                dechex($color['b'])
            );


            if (array_key_exists($hex, $colorStatistics)) {
                $colorStatistics[$hex] += $count;
            }
            else {
                $colorStatistics[$hex] = $count;
            }

        }

        return $colorStatistics;
    }

    public function indexAction()
    {
        $file = Mage::getBaseDir('media').DS.'catalog'.DS.'product'.DS.'180g_1.jpg';
        if(file_exists($file)){
            $imagick = new Imagick($file);
            $histogramElements = $imagick->getImageHistogram();
            
            $this->getPixelMatrix($histogramElements);
        }

}
