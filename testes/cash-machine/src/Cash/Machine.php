<?php

namespace Cash;

class Machine
{
    private $allowNotes = [100, 50, 20, 10];

    public function withdraw($value)
    {
        $businessLogic = $this->businessLogic($value);
        if(is_array($businessLogic)) {
            return $businessLogic;
        }

        $banknotes = [];

        foreach ($this->allowNotes as $note) {
            if ($value < $note && $note < $value) {
                continue;
            }

            $qty    = floor($value/$note);
            $value  -= $note * $qty;

            $banknotes = array_merge($banknotes, $this->separeNotes($qty, $note));
        }

        return $banknotes;
    }

    protected function separeNotes($qty, $value)
    {
        $banknotes = [];

        for ($i=0; $i < $qty; $i++) {
            $banknotes[] = $value;
        }

        return $banknotes;
    }

    protected function businessLogic($value) {
        if (is_null($value)) {
            return ['Empty Set'];
        }

        if ($value <= 0) {
            throw new \InvalidArgumentException('The value must be positive');
        }

        if (is_float($value/end($this->allowNotes))) {
            throw new NoteUnavailableException('The value is not valid');
        }
    }
}
