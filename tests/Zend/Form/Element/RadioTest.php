<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Form_Element_RadioTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Element_RadioTest::main");
}

require_once 'Zend/Form/Element/Radio.php';

/**
 * Test class for Zend_Form_Element_Radio
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Element_RadioTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Form_Element_RadioTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->element = new Zend_Form_Element_Radio('foo');
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
    }

    public function getView()
    {
        require_once 'Zend/View.php';
        $view = new Zend_View();
        $view->addHelperPath(__DIR__ . '/../../../../library/Zend/View/Helper');
        return $view;
    }

    public function testRadioElementSubclassesMultiElement()
    {
        $this->assertTrue($this->element instanceof Zend_Form_Element_Multi);
    }

    public function testRadioElementSubclassesXhtmlElement()
    {
        $this->assertTrue($this->element instanceof Zend_Form_Element_Xhtml);
    }

    public function testRadioElementInstanceOfBaseElement()
    {
        $this->assertTrue($this->element instanceof Zend_Form_Element);
    }

    public function testRadioElementIsNotAnArrayByDefault()
    {
        $this->assertFalse($this->element->isArray());
    }

    public function testHelperAttributeSetToFormRadioByDefault()
    {
        $this->assertEquals('formRadio', $this->element->getAttrib('helper'));
    }

    public function testRadioElementUsesRadioHelperInViewHelperDecoratorByDefault()
    {
        $decorator = $this->element->getDecorator('viewHelper');
        $this->assertTrue($decorator instanceof Zend_Form_Decorator_ViewHelper);
        $decorator->setElement($this->element);
        $helper = $decorator->getHelper();
        $this->assertEquals('formRadio', $helper);
    }

    public function testCanDisableIndividualRadioOptions()
    {
        $this->element->setMultiOptions(array(
                'foo'  => 'Foo',
                'bar'  => 'Bar',
                'baz'  => 'Baz',
                'bat'  => 'Bat',
                'test' => 'Test',
            ))
            ->setAttrib('disable', array('baz', 'test'));
        $html = $this->element->render($this->getView());
        foreach (array('baz', 'test') as $test) {
            if (!preg_match('/(<input[^>]*?(value="' . $test . '")[^>]*>)/', $html, $m)) {
                $this->fail('Unable to find matching disabled option for ' . $test);
            }
            $this->assertRegexp('/<input[^>]*?(disabled="disabled")/', $m[1]);
        }
        foreach (array('foo', 'bar', 'bat') as $test) {
            if (!preg_match('/(<input[^>]*?(value="' . $test . '")[^>]*>)/', $html, $m)) {
                $this->fail('Unable to find matching option for ' . $test);
            }
            $this->assertNotRegexp('/<input[^>]*?(disabled="disabled")/', $m[1], var_export($m, 1));
        }
    }

    public function testSpecifiedSeparatorIsUsedWhenRendering()
    {
        $this->element->setMultiOptions(array(
                'foo'  => 'Foo',
                'bar'  => 'Bar',
                'baz'  => 'Baz',
                'bat'  => 'Bat',
                'test' => 'Test',
            ))
            ->setSeparator('--FooBarFunSep--');
        $html = $this->element->render($this->getView());
        $this->assertContains($this->element->getSeparator(), $html);
        $count = substr_count($html, $this->element->getSeparator());
        $this->assertEquals(4, $count);
    }

    public function testRadioElementRendersDtDdWrapper()
    {
        $this->element->setMultiOptions(array(
                'foo'  => 'Foo',
                'bar'  => 'Bar',
                'baz'  => 'Baz',
                'bat'  => 'Bat',
                'test' => 'Test',
            ));
        $html = $this->element->render($this->getView());
        $this->assertRegexp('#<dt[^>]*>&\#160;</dt>.*?<dd#s', $html, $html);
    }

    /**
     * @group ZF-9682
     */
    public function testCustomLabelDecorator()
    {
        $form = new Zend_Form();
        $form->addElementPrefixPath('My_Decorator', __DIR__ . '/../_files/decorators/', 'decorator');

        $form->addElement($this->element);

        $element = $form->getElement('foo');

        $this->assertTrue(
            $element->getDecorator('Label') instanceof My_Decorator_Label
        );
    }

    /**
     * @group ZF-6426
     */
    public function testRenderingShouldCreateLabelWithoutForAttribute()
    {
        $this->element->setMultiOptions(array(
                'foo'  => 'Foo',
                'bar'  => 'Bar',
             ))
             ->setLabel('Foo');
        $html = $this->element->render($this->getView());
        $this->assertNotContains('for="foo"', $html);
    }

    /**
     * @group ZF-11517
     */
    public function testCreationWithIndividualDecoratorsAsConstructorOptionsWithoutLabel()
    {
        $element = new Zend_Form_Element_Radio(array(
            'name'         => 'foo',
            'multiOptions' => array(
                'bar'  => 'Bar',
                'baz'  => 'Baz',
            ),
            'decorators' => array(
                'ViewHelper',
            ),
        ));

        $this->assertFalse($element->getDecorator('label'));
    }

    /**
     * @group ZF-11517
     */
    public function testRenderingWithIndividualDecoratorsAsConstructorOptionsWithoutLabel()
    {
        $element = new Zend_Form_Element_Radio(array(
            'name'         => 'foo',
            'multiOptions' => array(
                'bar'  => 'Bar',
                'baz'  => 'Baz',
            ),
            'decorators' => array(
                'ViewHelper',
            ),
        ));

        $html = $element->render($this->getView());
        $this->assertNotContains('<dt id="foo-label">&#160;</dt>', $html);
    }

    /**
     * Prove the fluent interface on Zend_Form_Element_Radio::loadDefaultDecorators
     *
     * @link http://framework.zend.com/issues/browse/ZF-9913
     * @return void
     */
    public function testFluentInterfaceOnLoadDefaultDecorators()
    {
        $this->assertSame($this->element, $this->element->loadDefaultDecorators());
    }
}

// Call Zend_Form_Element_RadioTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Form_Element_RadioTest::main") {
    Zend_Form_Element_RadioTest::main();
}
