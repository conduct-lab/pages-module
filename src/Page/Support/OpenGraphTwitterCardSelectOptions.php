<?php
namespace Anomaly\PagesModule\Page\Support;


use Anomaly\SelectFieldType\SelectFieldType;

class OpenGraphTwitterCardSelectOptions
{
    public function handle(SelectFieldType $fieldType)
    {
        $options = [
            'summary' => 'Summary',
            'summary_large_image' => 'Large image',
        ];
        $fieldType->setOptions($options);
    }
}
