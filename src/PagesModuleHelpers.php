<?php

if (!function_exists('raw_open_graph_values')) {

    /**
     * Get raw open graph values.
     *
     * @param $page
     * @return array
     */
    function raw_open_graph_values($page): array
    {
        $array = [];
        if (!$page->entry->open_graph_raw) {
            return $array;
        }
        $values = explode("\n", $page->open_graph_raw);
        foreach ($values as $value) {
            $value = explode(':', $value);
            if (count($value) === 2) {
                $array[$value[0]] = $value[1];
            }
        }

        return $array;
    }
}
