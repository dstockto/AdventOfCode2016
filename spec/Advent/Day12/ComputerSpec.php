<?php
declare(strict_types = 1);

namespace spec\Advent\Day12;

use Advent\Day12\Computer;
use PhpSpec\ObjectBehavior;

class ComputerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Computer::class);
    }

    public function it_can_set_register_values_with_cpy_command()
    {
        $this->execute('cpy 41 a');
        $this->getRegisterValue('a')->shouldBe(41);

        $this->execute('cpy 42 b');
        $this->getRegisterValue('b')->shouldBe(42);

        $this->execute('cpy 43 c');
        $this->getRegisterValue('c')->shouldBe(43);

        $this->execute('cpy 44 d');
        $this->getRegisterValue('d')->shouldBe(44);
    }

    public function it_can_increment_registers_with_inc_command()
    {
        $this->execute('inc a');
        $this->execute('inc b');
        $this->execute('inc c');
        $this->execute('inc d');

        $this->getRegisterValue('a')->shouldBe(1);
        $this->getRegisterValue('b')->shouldBe(1);
        $this->getRegisterValue('c')->shouldBe(1);
        $this->getRegisterValue('d')->shouldBe(1);
    }

    public function it_can_decrement_registers_with_dec_command()
    {
        $this->execute('cpy 10 a');
        $this->execute('cpy 9 b');
        $this->execute('cpy 8 c');
        $this->execute('cpy 7 d');

        $this->execute('dec a');
        $this->execute('dec b');
        $this->execute('dec c');
        $this->execute('dec d');

        $this->getRegisterValue('a')->shouldBe(9);
        $this->getRegisterValue('b')->shouldBe(8);
        $this->getRegisterValue('c')->shouldBe(7);
        $this->getRegisterValue('d')->shouldBe(6);
    }

    public function it_has_an_instruction_counter_that_starts_at_zero()
    {
        $this->getInstructionPointer()->shouldBe(0);
    }

    public function it_will_increase_the_instruction_pointer_after_executing_instruction()
    {
        $this->execute('cpy 42 a');
        $this->getInstructionPointer()->shouldBe(1);
        $this->execute('cpy 41 a');
        $this->getInstructionPointer()->shouldBe(2);
    }

    public function it_will_move_the_instruction_pointer_if_register_is_non_zero_command()
    {
        $this->execute('jnz a 2');
        $this->getInstructionPointer()->shouldBe(1);
        $this->execute('inc a');
        $this->getInstructionPointer()->shouldBe(2);
        $this->execute('jnz a 2');
        $this->getInstructionPointer()->shouldBe(4);
    }

    public function it_can_reset()
    {
        $this->execute('cpy 123 a');
        $this->reset();
        $this->getInstructionPointer()->shouldBe(0);
    }

    public function it_can_load_instructions_into_computer_memory()
    {
        $this->getInstructions()->shouldBe([]);
        $this->loadInstructions(
            [
                'cpy 41 a',
                'inc a',
                'inc a',
                'dec a',
                'jnz a 2',
                'dec a',
            ]
        );

        $this->getInstructions()->shouldBe(
            [
                'cpy 41 a',
                'inc a',
                'inc a',
                'dec a',
                'jnz a 2',
                'dec a',
            ]
        );
        $this->reset();
        $this->getInstructions()->shouldBe([]);
    }

    public function it_can_execute_a_loaded_program()
    {
        $this->loadInstructions(
            [
                'cpy 41 a',
                'inc a',
                'inc a',
                'dec a',
                'jnz a 2',
                'dec a',
            ]
        );
        $this->runProgram();
        $this->getRegisterValue('a')->shouldBe(42);
    }

    public function it_can_handle_jnz_with_a_numeric_argument()
    {
        $this->execute('jnz 4 5');
        $this->getInstructionPointer()->shouldBe(5);

        $this->execute('jnz 0 200');
        $this->getInstructionPointer()->shouldBe(6);
    }

    public function it_can_copy_one_register_value_to_another()
    {
        $this->execute('cpy 41 a');
        $this->execute('cpy a b');
        $this->execute('inc a');

        $this->getRegisterValue('a')->shouldBe(42);
        $this->getRegisterValue('b')->shouldBe(41);
    }

    public function it_can_add_one_register_into_another()
    {
        $this->execute('cpy 41 a');
        $this->execute('cpy 12 b');
        $this->execute('add a b');
        $this->getRegisterValue('a')->shouldBe(53);
    }
}
