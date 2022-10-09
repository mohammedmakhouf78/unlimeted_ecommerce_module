<?php


namespace App\Http\Traits;


trait DatatableTrait
{
    private function makeHideButtons($array)
    {
        $data = [];
        foreach($array as $index => $element)
        {
            $data []= [
                'text' =>$element,
                'className' => 'btn btn-outline-primary btn-sm toggle-vis mb-1',
                'action' => "function(e, dt, node, config) {
                    var column = dt.column($index);
                    column.visible(!column.visible());
                }"
            ];
        }
        return $data;
    }
}
