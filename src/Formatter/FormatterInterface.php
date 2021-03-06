<?php

namespace Project88\Zoho\Recruit\Api\Formatter;

interface FormatterInterface
{
    /**
     * @param  array $data
     *
     * @return FormatterInterface
     */
    public function formatter(array $data);

    /**
     * @return array
     */
    public function getOutput();
}
