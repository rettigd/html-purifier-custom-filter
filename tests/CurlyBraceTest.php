<?php 
/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class CurlyBraceTest extends PHPUnit_Framework_TestCase{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError(){
	$var = new rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter;
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
  public function testDefault() 
  {
    $default_html = "test some html";

	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter();
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, $default_html);

  }

  public function testConvert() 
  {
    $default_html = "{{ test some html }}";

	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter();
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, "&#123;&#xfeff;&#123;&#xfeff; test some html &#125;&#xfeff;&#125;&#xfeff;");

  }

  public function testRemove() 
  {
    $default_html = "{{ test some html }}";

	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter('remove');
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, " test some html ");

  }

  public function testDelete() 
  {
    $default_html = "{{ test some html }}";

	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter('delete');
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, "");

  }

  public function testReplace() 
  {
    $default_html = "{{ test some html }}";

	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter(['[',']']);
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, "[[ test some html ]]");

  }

  public function testCallbackException() 
  {
    $this->expectException(\Exception::class);

    $default_html = "{{ test some html }}";


	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter(['[',']'], function($newHTML, $originalHTML, $config, $context) {
        if ($newHTML !== $originalHTML) {
            throw new \Exception();
        }
    });
	$html = $class->prefilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
    
    $html = $class->postfilter($default_html, '', '');
 
  }

  public function testCallbackUpdateHTML() 
  {
    $default_html = "{{ test some html }}";


	$class = new \rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter(['[',']'], function($originalHTML, $html, $config, $context) {
        return $originalHTML;
    });
    
    $html = $class->postfilter($default_html, '', '');
    $this->assertEquals($html, $default_html);
 
  }
    
}