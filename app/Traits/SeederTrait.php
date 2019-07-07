<?php

namespace App\Traits;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use DB;

trait SeederTrait
{
    private $outputFormat;

    protected $messageTypes = [
        'info'    => 'blue',
        'warn'    => 'yellow',
        'danger'  => 'red',
        'success' => 'green',
    ];

    public function __construct()
    {
        $this->outputFormat = new OutputFormatterStyle;
    }

    /**
     * Write command.
     *
     * @param string $text
     * @param string $type
     *
     * @return void
     */
    public function write(string $text, string $type)
    {
        $color = $this->messageTypes[$type];

        $this->outputFormat->setForeground($color);
        $this->outputFormat->setBackground('default');

        echo $this->outputFormat->apply($text) . "\n";
    }

    /**
     * Write info command.
     *
     * @param string $text
     *
     * @return void
     */
    public function info(string $text)
    {
        $this->write($text, 'info');
    }

    /**
     * Write warnning command.
     *
     * @param string $text
     *
     * @return void
     */
    public function warn(string $text)
    {
        $this->write($text, 'warn');
    }

    /**
     * Write danget command.
     *
     * @param string $text
     *
     * @return void
     */
    public function danger(string $text)
    {
        $this->write($text, 'danger');
    }

    /**
     * Write success command.
     *
     * @param string $text
     *
     * @return void
     */
    public function success(string $text)
    {
        $this->write($text, 'success');
    }

    /**
     * Check is data type exists.
     *
     * @param string $slug
     *
     * @return bool
     */
    public function isDataTypeExists(string $slug)
    {
        return DB::table('data_types')->where('slug', $slug)
            ->count();
    }
}
