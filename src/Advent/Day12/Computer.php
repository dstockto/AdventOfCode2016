<?php
declare(strict_types = 1);

namespace Advent\Day12;

class Computer
{
    /** @var array */
    protected $instructions;
    /** @var int */
    private $instructionPointer;
    /** @var Register[] */
    private $registers = [];

    public function __construct()
    {
        $this->instructions       = [];
        $this->instructionPointer = 0;
        $this->registers          =
            [
                'a' => new Register(),
                'b' => new Register(),
                'c' => new Register(),
                'd' => new Register(),
            ];
    }

    public function execute(string $instruction)
    {
        list ($command, $args) = explode(' ', $instruction, 2);

        echo $this->getRegistersAsString() . "\n";
        echo $this->instructionPointer . ' => ' . $instruction . "\n";

        switch ($command) {
            case 'cpy':
                list($value, $register) = explode(' ', $args);
                if (is_numeric($value)) {
                    if (is_numeric($register)) {
                        throw new \Exception('Nothing good.');
                    }
                    $this->registers[$register]->setValue((int)$value);
                } else {
                    $this->registers[$register]->setValue($this->getRegisterValue($value));
                }
                break;
            case 'inc':
                $this->registers[$args]->incr();
                break;
            case 'dec':
                $this->registers[$args]->dec();
                break;
            case 'jnz':
                list ($register, $jump) = explode(' ', $args);
                if (is_numeric($register)) {
                    if ((int)$register !== 0) {
                        if (!is_numeric($jump)) {
                            $jump = $this->getRegisterValue($jump);
                        }
                        $this->incrementInstructionPointer((int)$jump);
                        return;
                    } else {
                        $this->incrementInstructionPointer();
                        return;
                    }
                }
                if ($this->registers[$register]->getValue() !== 0) {
                    $this->incrementInstructionPointer((int)$jump);
                    return;
                }
                break;
            case 'add':
                list($target, $add) = explode(' ', $args);
                $total = $this->registers[$target]->getValue() + $this->registers[$add]->getValue();
                $this->registers[$target]->setValue($total);
                break;

            case 'mul':
                list($target, $x, $y) = explode(' ', $args);
                $total = $this->registers[$target]->getValue() +
                    $this->registers[$x]->getValue() * $this->registers[$y]->getValue();
                $this->registers[$target]->setValue($total);
                break;
        }

        $this->incrementInstructionPointer();
    }

    public function getRegisterValue(string $register): int
    {
        return $this->registers[$register]->getValue();
    }

    public function getInstructionPointer(): int
    {
        return $this->instructionPointer;
    }

    public function reset()
    {
        $this->instructionPointer = 0;
        $this->instructions       = [];
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function loadInstructions(array $instructions)
    {
        $this->instructions       = $instructions;
        $this->instructionPointer = 0;
    }

    public function runProgram()
    {
        while (($instruction = $this->getInstruction()) !== 'halt') {
//            echo $this . "\n\n";
            $this->execute(trim($instruction));
        }
    }

    private function getInstruction(): string
    {
        return trim($this->instructions[$this->instructionPointer] ?? 'halt');
    }

    public function __toString()
    {
        $return = $this->getRegistersAsString();
        $return .= sprintf("IP: %d\n", $this->getInstructionPointer());
        $return .= str_repeat('=', 20) . "\n";

        foreach ($this->instructions as $line => $instruction) {
            if ($line == $this->instructionPointer) {
                $return .= '===>  ';
            } else {
                $return .= sprintf('%4d  ', $line);
            }
            $return .= $instruction;
        }

        return $return;
    }

    /**
     * @return string
     */
    protected function getRegistersAsString(): string
    {
        return sprintf(
            "A: %d B: %d C: %d D: %d\n",
            $this->getRegisterValue('a'),
            $this->getRegisterValue('b'),
            $this->getRegisterValue('c'),
            $this->getRegisterValue('d')
        );
    }

    /**
     * @param int $amount
     * @return int
     */
    protected function incrementInstructionPointer(int $amount = 1): int
    {
        $this->instructionPointer += $amount;
        return $this->instructionPointer;
    }
}
