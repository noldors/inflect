<?php
declare(strict_types=1);

namespace Noldors\Inflect\Inflectors;

/**
 * Rules based on ICanBoogie inflector @see https://github.com/ICanBoogie/Inflector/blob/master/LICENSE
 *
 * @package Noldors\Inflect\Inflectors
 */
class TurkishInflector extends BaseInflector
{
    protected $pluralRules = [
        '/([eöiü][^aoıueöiü]{0,6})$/ui' => '\1ler',
        '/([aoıu][^aoıueöiü]{0,6})$/ui' => '\1lar'
    ];

    protected $pluralIrregular = [
        'o'   => 'onlar',
        'sen' => 'siz',
        'ben' => 'biz'
    ];

    protected $singularRules = [
        '/l[ae]r$/ui' => ''
    ];

    protected $singularIrregular = [
        'onlar' => 'o',
        'siz'   => 'sen',
        'biz'   => 'ben'
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
        return \Transliterator::createFromRules(
            ':: Any-Lower;' .
            ':: Latin-ASCII;' .
            '{ (\ )+ } > \\' . $delimiter . ';' .
            '{ [^a-zA-Z0-9\_\\' . $delimiter . '\ ] } > ;' .
            ':: Any-NFKC;' .
            '{ (\-)+ } > \\' . $delimiter . ';'
        )->transliterate(trim($sentence));
    }
}
