<?php
namespace JVS;

/**
 * SimpleNavigation tests
 *
 * @author Javier Villanueva <info@jvsoftware.com>
 */
class SimpleNavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * SimpleNavigation instance
     *
     * @var SimpleNavigation
     */
    protected $simpleNavigation;

    public function setUp()
    {
        $this->simpleNavigation = new SimpleNavigation;
    }

    /**
     * Make sure class can be instantiated
     *
     * @return void
     */
    public function testCanInitClass()
    {
        $this->assertInstanceOf('JVS\SimpleNavigation', $this->simpleNavigation);
    }

    /**
     * Make sure it can render navigation without specified links
     *
     * @return void
     */
    public function testCanRenderUnlinkedNavigation()
    {
        $simpleItems = array('Home', 'Blog', 'About');

        $htmlMenu = '<ul>';
        $htmlMenu .= '<li><a href="#">Home</a></li>';
        $htmlMenu .= '<li><a href="#">Blog</a></li>';
        $htmlMenu .= '<li><a href="#">About</a></li>';
        $htmlMenu .= '</ul>';

        $expectedDom = new \DomDocument;
        $expectedDom->loadHtml($htmlMenu);
        $expectedDom->preservewhitespace = false;

        $actualDom = new \DomDocument();
        $actualDom->loadHtml($this->simpleNavigation->make($simpleItems));
        $actualDom->preservewhitespace = false;

        $this->assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());
    }

    /**
     * Make sure it can render navigation with specified links
     *
     * @return void
     */
    public function testCanRenderLinkedMenu()
    {
        $linkedItems = array(
            'Home'  => 'http://home.com',
            'Blog'  => 'http://blog.com',
            'About' => 'http://about.com',
        );

        $htmlMenu = '<ul>';
        $htmlMenu .= '<li><a href="http://home.com">Home</a></li>';
        $htmlMenu .= '<li><a href="http://blog.com">Blog</a></li>';
        $htmlMenu .= '<li><a href="http://about.com">About</a></li>';
        $htmlMenu .= '</ul>';

        $expectedDom = new \DomDocument;
        $expectedDom->loadHtml($htmlMenu);
        $expectedDom->preservewhitespace = false;

        $actualDom = new \DomDocument();
        $actualDom->loadHtml($this->simpleNavigation->make($linkedItems));
        $actualDom->preservewhitespace = false;

        $this->assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());
    }

    /**
     * Make sure it can render multi-level navigations
     *
     * @return void
     */
    public function testCanRenderMultiLevelMenu()
    {
        $multiLevelItems = array(
            'Home'  => 'http://home.com',
            'Blog'  => 'http://blog.com',
            'About' => array(
                'About 1' => 'http://about1.com',
                'About 2' => 'http://about2.com',
            ),
        );

        $htmlMenu = '<ul>';
        $htmlMenu .= '<li><a href="http://home.com">Home</a></li>';
        $htmlMenu .= '<li><a href="http://blog.com">Blog</a></li>';
        $htmlMenu .= '<li><a href="#">About</a>';
        $htmlMenu .= '<ul>';
        $htmlMenu .= '<li><a href="http://about1.com">About 1</a></li>';
        $htmlMenu .= '<li><a href="http://about2.com">About 2</a></li>';
        $htmlMenu .= '</ul>';
        $htmlMenu .= '</li>';
        $htmlMenu .= '</ul>';

        $expectedDom = new \DomDocument;
        $expectedDom->loadHtml($htmlMenu);
        $expectedDom->preservewhitespace = false;

        $actualDom = new \DomDocument();
        $actualDom->loadHtml($this->simpleNavigation->make($multiLevelItems));
        $actualDom->preservewhitespace = false;

        $this->assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());
    }
}
