<?php

namespace Tests\Unit;

use App\Gateways\DatafinitiGateway;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Tests\WaxAppTestCase;

class ProductDataGatewayTest extends WaxAppTestCase
{
    protected $httpClient;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function testBarCodeSearch()
    {
        $this->mock(HttpClient::class, function ($mock) {
            $mock->shouldReceive('post')
                ->andReturn(new Response(200, [], file_get_contents(__DIR__.'/stubs/Datafiniti/gtins.0085126340551.json')));
        });

        $gateway = app()->make(DatafinitiGateway::class);

        $results = $gateway->barCodeSearch('0085126340551');

        $thing = $results[0];

        $this->assertEquals('SIGMA', $thing['brand']);
        $this->assertEquals('Sigma 35mm f/1.4 DG HSM A1 Lens for Nikon Cameras', $thing['name']);

        $expectedDescriptions = [
           'Box Contents: Sigma 35mm f 1.4 LensFront Rear Lens CapsPerfect Hood (Bayonet) Pouch CaseFeatures: Sigma announced the development of 3 main categories for their new lens lineup. Contemporary, Art Sport. This lens is the first in the Art line. The Sigma 35mm 1.4 DG HSM is a state of the art lens designed for full frame cameras but can also be used with APS-C sensors as well. The 35mm 1.4 DG HSM includes new features based around a unique lens concept and design. The 35mm is a staple focal length in the world of photography, and paired with Sigma technology, this lens can take artistic expression to the next level. The lens is equipped with technology including a Hyper Sonic Motor (HSM), floating internal focusing system, SLD and FLD Glass elements. The HSM ensures quiet, high seed, accurate autofocusing while the floating focusing system allows for superior optical performance with subjects at a closer shooting distance. The SLD glass elements along with the FLD glass elements, which are equal to fluorite, help correct both axial and chromatic aberration. The large 1.4 aperture make it ideal in low light and the lens is compatible with the Sigma USB dock and Optimization Pro software to adjust and fine tune focusing parameters. The Sigma 35mm 1.4 DG HSM is a must have for any camera bag. Specifications: F stop range 1.4 -16Closest Focusing Distance30cm / 11.8M aximum Magnification 1:1. 2Number of Diaphragm Blades9 (Rounded diaphragm) Filter Size67mmDimensions (Length x Diameter) 94mm ( 3.7 ) X 76.2 mm ( 3.0 )Weight 23.5 oz. / 665g',
           'Box Contents:Sigma 35mm f1.4 LensFront Rear Lens CapsPerfect Hood (Bayonet)Pouch CaseFeatures:Sigma announced the development of 3 main categories for their new lens lineup. Contemporary, Art Sport. This lens is the first in the Art line.The Sigma 35mm 1.4 DG HSM is a state of the art lens designed for full frame cameras but can also be used with APS-C sensors as well. The 35mm 1.4 DG HSM includes new features based around a unique lens concept and design.The 35mm is a staple focal length in the world of photography, and paired with Sigma technology, this lens can take artistic expression to the next level.The lens is equipped with technology including a Hyper Sonic Motor (HSM), floating internal focusing system, SLD and FLD Glass elements. The HSM ensures quiet, high seed, accurate autofocusing while the floating focusing system allows for superior optical performance with subjects at a closer shooting distance. The SLD glass elements along with the FLD glass elements, which are equal to fluorite, help correct both axial and chromatic aberration.The large 1.4 aperture make it ideal in low light and the lens is compatible with the Sigma USB dock and Optimization Pro software to adjust and fine tune focusing parameters. The Sigma 35mm 1.4 DG HSM is a must have for any camera bag. Specifications:F stop range1.4-16Closest Focusing Distance30cm / 11.8Maximum Magnification1:1.2Number of Diaphragm Blades9 (Rounded diaphragm)Filter Size67mmDimensions (Length x Diameter)94mm (3.7) X 76.2mm (3.0)Weight23.5 oz./ 665g',
           'Digital Camera Lenses',
           'Auto Focus',
           'SIGMA',
        ];

        $this->assertEquals($expectedDescriptions, $thing['descriptions']);
    }

}
