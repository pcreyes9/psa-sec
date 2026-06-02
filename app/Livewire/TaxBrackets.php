<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaxBracket;

class TaxBrackets extends Component
{
    public $brackets = [];
    public $isEditing = false;


    public function mount()
    {
        $this->loadBrackets();
    }


    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;

        if (!$this->isEditing) {
            $this->loadBrackets();
        }
    }

    public function loadBrackets()
    {
        $this->brackets = TaxBracket::orderBy('min_amount')
            ->get()
            ->toArray();
    }

    public function addBracket()
    {
        $this->brackets[] = [

            'min_amount' => 0,

            'max_amount' => null,

            'base_tax' => 0,

            'percentage' => 0,
        ];
    }

    public function removeBracket($index)
    {
        if (isset($this->brackets[$index]['id'])) {

            TaxBracket::find(
                $this->brackets[$index]['id']
            )?->delete();
        }

        unset($this->brackets[$index]);

        $this->brackets = array_values(
            $this->brackets
        );
    }

    public function save()
    {
        foreach ($this->brackets as $bracket) {

            TaxBracket::updateOrCreate(

                [
                    'id' => $bracket['id'] ?? null
                ],

                [
                    'min_amount' =>
                        $bracket['min_amount'] ?? 0,

                    'max_amount' =>
                        $bracket['max_amount'],

                    'base_tax' =>
                        $bracket['base_tax'] ?? 0,

                    'percentage' =>
                        $bracket['percentage'] ?? 0,
                ]
            );
        }

        $this->loadBrackets();

        session()->flash(
            'success',
            'Tax brackets updated successfully.'
        );
    }

    public function render()
    {
        return view(
            'livewire.tax-brackets'
        );
    }
}
