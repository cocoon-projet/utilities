<?php

use Cocoon\Utilities\Strings;
use PHPUnit\Framework\TestCase;

class StringsUtilitiesTest extends TestCase
{
    private $word = 'str cocoon inflector';

    public function testSlugify()
    {
        $test = Strings::slugify($this->word);
        $this->assertEquals('str-cocoon-inflector', $test);
    }

    public function testRandom()
    {
        $this->assertIsString(Strings::Random());
    }

    public function testToken()
    {
        $this->assertIsString(Strings::Token());
    }

    public function testContains() 
    {
        $test = Strings::contains($this->word, "i");
        $this->assertTrue($test);
        $string = Strings::contains('maman', "i");
        $this->assertFalse($string);
    }

    public function testLimitWords()
    {
        $test =Strings::limitWords($this->word,1);
        $this->assertEquals('str...', $test);
    }

    public function testPlural()
    {
        $test = Strings::plural('genou');
        $this->assertEquals('genoux', $test);
    }

    public function testSingular()
    {
        $test = Strings::Singular('bouteilles');
        $this->assertEquals('bouteille', $test);
    }

    public function testCamelize()
    {
        $test = Strings::camelize('str_cocoon_inflector');
        $this->assertEquals('StrCocoonInflector', $test);
    }

    public function testHumanize()
    {
        $test = Strings::humanize('employee_salariee');
        $this->assertEquals('Employee salariee', $test);
    }

    public function testTitleize()
    {
        $test = Strings::titleize('le titre de l\'article du journal');
        $this->assertEquals('Le Titre De L\'article Du Journal', $test);
    }

    public function testTableize()
    {
        $test = Strings::tableize('PersonneStatut');
        $this->assertEquals('personne_statuts', $test);
    }

    public function testUnTableize()
    {
        $test = Strings::unTableize('personne_statuts');
        $this->assertEquals('PersonneStatut', $test);
    }

    public function testUnDerscore()
    {
        $test = Strings::underscore('str cocoon inflector');
        $this->assertEquals('str_cocoon_inflector', $test);
    }
	
}