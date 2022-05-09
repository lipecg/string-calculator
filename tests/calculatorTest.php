<?php 
use PHPUnit\Framework\TestCase;

class calculatorTest extends TestCase
{
 
    public function __construct(){
        parent::__construct();
        $this->calculator = new Calculator();
    }
    public function testTotal(): void
    {
        $total = $this->calculator->add('1,2,5');
        $this->assertEquals(
            8,
            $total
        );
    } 

    public function testEmptyStringReturnZero(): void
    {
        $total = $this->calculator->add('');
        $this->assertEquals(
            0,
            $total
        );
    } 

    public function testReturnResultIsInt(): void
    {
        $total = $this->calculator->add('1,2,5');
        $this->assertIsInt($total);
    } 

    public function testAddMethodHandlesNewLine(): void
    {
        $number = '1\n,2,3';
        $total = $this->calculator->add($number);
        $this->assertEquals(
            6,
            $total
        );
    } 

    public function testAddMethodHandlesNewCustomDelimiter(): void
    {
        $customDelimiterNum1 = '//;\n1;3;4';
        $customDelimiterTotal1 = $this->calculator->add($customDelimiterNum1);
        $this->assertEquals(
            8,
            $customDelimiterTotal1
        );

        $customDelimiterNum2 = '//$\n1$2$3';
        $customDelimiterTotal2 = $this->calculator->add($customDelimiterNum2);
        $this->assertEquals(
            6,
            $customDelimiterTotal2
        );

        $customDelimiterNum3 = '“//@\n2@3@8';
        $customDelimiterTotal3 = $this->calculator->add($customDelimiterNum3);
        $this->assertEquals(
            13,
            $customDelimiterTotal3
        );
    }

    public function testAddMethodExceptionWithNegativeNumbers(): void{
        $num = '//***1***-2***-4\n//\\$,@1$2@3';
        $this->expectException(Exception::class);
        $this->calculator->add($num);
    }

    public function testAddMethodIgnoresNumGreaterThenThousand(): void{
        $num = '2,1001';
        $total = $this->calculator->add($num);
        $this->assertEquals(
            2,
            $total
        );
    } 
}