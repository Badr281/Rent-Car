<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Definition\Call\Then;
use Behat\Behat\Definition\Call\When;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * This context class contains the definitions of the steps used by the demo 
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 * 
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    /**
     * @When sends a request to  path :path
     */
    public function aDemoScenarioSendsARequestTo(string $path)
    {
        $this->response = $this->kernel->handle(Request::create($path,'GET'));
    }

    /**
     * @Then the status code should be :code
     */
    public function theResponseShouldBeReceived($code)
    {
        if ($this->response->getStatusCode() != $code) {
            throw new \RuntimeException('different status code');
        }
    }

    /**
     * @Then I should be redirected to :page
     * 
     */
    public function shouldRedirectedTo($page)
    {
        if ($this->response->headers->get('location') != $page) {
            throw new \RuntimeException(printf('an anonymous cannot acesss to the %s page',$page));
        }
    }

    /**
     * @Then my page should contains :page
     */
    public function pageContent($page)
    {
        if( $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
        if ($this->response->headers->get('location') != $page   ) {
            throw new \RuntimeException(printf('an anonymous cannot acesss to the %s page',$page));
        }
    }
}

}
