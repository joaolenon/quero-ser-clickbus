<?php 

namespace Machine;

use Cash\Machine;

class MachineTest extends \PHPUnit_Framework_TestCase
{
    protected $machine;

    public function setup()
    {
        $this->machine = new Machine;
    }

    public function validValues()
    {
        return array(
            array(30, array(20, 10)),
            array(80, array(50, 20, 10)),
            array(130, array(100, 20, 10)),
            array(320, array(100, 100, 100, 20)),
        );
    }

    /**
     * @dataProvider validValues
     */
    public function testValidValues($value, $expected)
    {
        $banknotes = $this->machine->withdraw($value);
        $this->assertEquals($expected, $banknotes);
    }

    public function noteUnavailableValues()
    {
        return array(
            array(5),
            array(15),
            array(65),
            array(125),
        );
    }

    /**
     * @dataProvider noteUnavailableValues
     * @expectedException \Cash\NoteUnavailableException
     */
    public function testUnavailableValues($value)
    {
        $this->machine->withdraw($value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNegativeValue()
    {
        $this->machine->withdraw(-130.00);
    }

    public function testNullValue()
    {
        $banknotes = $this->machine->withdraw(NULL);
        $this->assertEquals(array('Empty Set'), $banknotes);
    }
}
