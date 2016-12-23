<?php
declare(strict_types = 1);

namespace Advent\Day22;

use Advent\Day12\Computer;

class SafeCracker extends Computer
{
    public function execute(string $instruction)
    {
        list ($command, $args) = explode(' ', $instruction, 2);

        echo $this->getRegistersAsString() . "\n";
        echo $this->getInstructionPointer() . ' => ' . $instruction . "\n";

        if ($command === 'tgl') {
            if (is_numeric($args)) {
                $delta = (int)$args;
            } else {
                $delta = $this->getRegisterValue($args);
            }

            $instructionPointer = $this->getInstructionPointer();
            $toggleInstructionPointer = $instructionPointer + $delta;
            echo "---->TOGGLE $toggleInstructionPointer\n";
            $toggleInstruction = $this->getInstructions()[$toggleInstructionPointer] ?? false;
            if ($toggleInstruction === false) {
                echo "    ---> No such instruction. Skipping\n";
                $this->incrementInstructionPointer();
                return;
            }

//            echo "Got tgl for ($toggleInstructionPointer) " . $toggleInstruction . "\n";
            $parts = explode(' ', $toggleInstruction);
            $toggleCommand = array_shift($parts);
            switch (count($parts)) {
                case 1:
                    if ($toggleCommand === 'inc') {
                        $toggleCommand = 'dec';
                    } else {
                        $toggleCommand = 'inc';
                    }
                    break;
                case 2:
                    if ($toggleCommand === 'jnz') {
                        $toggleCommand = 'cpy';
                    } else {
                        $toggleCommand = 'jnz';
                    }
                    break;
            }

            $toggledCommand = $toggleCommand . ' ' . implode(' ', $parts);

//            echo "   -- >  $toggledCommand\n";

            $this->replaceInstruction($toggleInstructionPointer, $toggledCommand);

            $this->incrementInstructionPointer();
            return;
        } else {
            parent::execute($instruction);
        }
    }

    private function replaceInstruction(int $toggleInstructionPointer, string $toggledCommand)
    {
        $this->instructions[$toggleInstructionPointer] = $toggledCommand;
    }
}
