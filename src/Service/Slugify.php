<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input): string
    {
        $slug = strtolower($input);
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
        $slug = preg_replace('/[^[:alnum:]]/', ' ', $slug);
        $slug = preg_replace('/[[:space:]]+/', '-', $slug);
        $slug = trim($slug, '-');

        return $slug;
    }
}