<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Gitignore;

class GitignoreTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCases(string $patterns, array $matchingCases, array $nonMatchingCases)
    {
        $regex = Gitignore::toRegex($patterns);

        foreach ($matchingCases as $matchingCase) {
            $this->assertRegExp($regex, $matchingCase, sprintf('Failed asserting path [%s] matches gitignore patterns [%s] using regex [%s]', $matchingCase, $patterns, $regex));
        }

        foreach ($nonMatchingCases as $nonMatchingCase) {
            $this->assertNotRegExp($regex, $nonMatchingCase, sprintf('Failed asserting path [%s] not matching gitignore patterns [%s] using regex [%s]', $nonMatchingCase, $patterns, $regex));
        }
    }

    /**
     * @return array return is array of
     *               [
     *               [
     *               '', // Git-ignore Pattern
     *               [], // array of file paths matching
     *               [], // array of file paths not matching
     *               ],
     *               ]
     */
    public function provider()
    {
        return [
            [
                '
                    *
                    !/bin/bash
                ',
                ['bin/cat', 'abc/bin/cat'],
                ['bin/bash'],
            ],
            [
                'fi#le.txt',
                [],
                ['#file.txt'],
            ],
            [
                '
                /bin/
                /usr/local/
                !/bin/bash
                !/usr/local/bin/bash
                ',
                ['bin/cat'],
                ['bin/bash'],
            ],
            [
                '*.py[co]',
                ['file.pyc', 'file.pyc'],
                ['filexpyc', 'file.pycx', 'file.py'],
            ],
            [
                'dir1/**/dir2/',
                ['dir1/dirA/dir2/', 'dir1/dirA/dirB/dir2/'],
                [],
            ],
            [
                'dir1/*/dir2/',
                ['dir1/dirA/dir2/'],
                ['dir1/dirA/dirB/dir2/'],
            ],
            [
                '/*.php',
                ['file.php'],
                ['one/file.php'],
            ],
            [
                '\#file.txt',
                ['#file.txt'],
                [],
            ],
            [
                '*.php',
                ['one/file.php', 'file.php'],
                ['file.phps', 'file.phps', 'filephps'],
            ],
            [
                'one/cache/',
                ['one/cache/file.txt', 'one/cache/dir1/dir2/file.txt', 'a/one/cache/file.txt'],
                [],
            ],
            [
                '
                #IamComment
                /one/cache/',
                ['one/cache/file.txt', 'one/cache/subdir/ile.txt'],
                ['a/one/cache/file.txt', '#IamComment', 'IamComment'],
            ],
            [
                '
                /one/cache/
                #LastLineIsComment',
                ['one/cache/file.txt', 'one/cache/subdir/ile.txt'],
                ['a/one/cache/file.txt', '#LastLineIsComment', 'LastLineIsComment'],
            ],
            [
                '
                /one/cache/
                \#file.txt
                #LastLineIsComment',
                ['one/cache/file.txt', 'one/cache/subdir/ile.txt', '#file.txt'],
                ['a/one/cache/file.txt', '#LastLineIsComment', 'LastLineIsComment'],
            ],
            [
                '
                /one/cache/
                \#file.txt
                #IamComment
                another_file.txt',
                ['one/cache/file.txt', 'one/cache/subdir/ile.txt', '#file.txt', 'another_file.txt'],
                ['a/one/cache/file.txt', 'IamComment', '#IamComment'],
            ],
        ];
    }
}
