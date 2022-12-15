<?php

namespace App\Http\Traits;

trait ClientTrait
{
    private function clientItem($id)
    {
        return $this->clientModel::find($id);
    }

    private function clients()
    {
        return $this->clientModel::get();
    }
}
