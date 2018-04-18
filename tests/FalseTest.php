<?php 
/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class FalseTest extends PHPUnit_Framework_TestCase{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError(){
	$var = new rettigd\CustomHTMLPurifierFilter\FalseFilter;
	$this->assertTrue(is_object($var));
	unset($var);
  }
  
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testConvertsFalse() 
  {
    $default_html = false;

    $class = new \rettigd\CustomHTMLPurifierFilter\FalseFilter();
    $html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, "0");
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, $default_html);

  }

  public function testDoesntConvertTrue() 
  {
    $default_html = true;

    $class = new \rettigd\CustomHTMLPurifierFilter\FalseFilter();
    $html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, true);

  }

  public function testDoesntConvertString() 
  {
    $default_html = "some string";

    $class = new \rettigd\CustomHTMLPurifierFilter\FalseFilter();
    $html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, $default_html);

  }
    
}