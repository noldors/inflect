<?php
declare(strict_types=1);

namespace Noldors\Inflect\Inflectors;

class NorwegianInflector extends BaseInflector
{
    protected $pluralRules = [
        '/$/'   => 'er',
        '/r$/i' => 're',
        '/e$/i' => 'er'
    ];

    protected $pluralIrregular = [
        'konto' => 'konti'
    ];

    protected $singularRules = [
        '/re$/ui' => 'r',
        '/er$/ui' => ''
    ];

    protected $singularIrregular = [
        'konti' => 'konto'
    ];

    /**
     * Transliterate sentence for url
     *
     * @param string $sentence
     * @param string $delimiter
     *
     * @return string
     */
    public function slug(string $sentence, string $delimiter = '-'): string
    {
        return preg_replace(
            ['/[^[a-zA-Z0-9-_ ]/u', '/\s/u', "/$delimiter{2,}/u"],
            ['', $delimiter, $delimiter],
            \Transliterator::createFromRules(':: Any-Lower; :: Latin-ASCII; :: Any-Publishing; :: Any-NFKC; :: NFC;')
                ->transliterate(trim($sentence)));
    }
}