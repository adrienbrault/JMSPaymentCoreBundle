<?php

namespace Bundle\JMS\Payment\CorePaymentBundle\Tests\Plugin;

use Bundle\JMS\Payment\CorePaymentBundle\BrowserKit\Request;

class GatewayPluginTest extends \PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL is not loaded.');
        }
        
        $plugin = $this->getPlugin();
        
        // not sure if there is a better approach to testing this
        $request = new Request('https://github.com/schmittjoh/PaymentBundle/raw/master/Tests/Plugin/Fixtures/sampleResponse', 'GET');
        $response = $plugin->request($request);
        
        $this->assertEquals(file_get_contents(__DIR__.'/Fixtures/sampleResponse'), $response->getContent());
        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals('200 OK', $response->getHeader('Status'));
    }
    
    protected function getPlugin()
    {
        return $this->getMockForAbstractClass('Bundle\JMS\Payment\CorePaymentBundle\Plugin\GatewayPlugin', array(true));
    }
}