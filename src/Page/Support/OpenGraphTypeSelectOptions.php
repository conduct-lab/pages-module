<?php
namespace Anomaly\PagesModule\Page\Support;


use Anomaly\SelectFieldType\SelectFieldType;

class OpenGraphTypeSelectOptions
{
    public function handle(SelectFieldType $fieldType)
    {
        $options = [
            'article' => 'Article',
            'website' => 'Website',
        ];
        $fieldType->setOptions($options);
    }
}
