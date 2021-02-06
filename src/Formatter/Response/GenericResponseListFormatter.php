<?php

namespace Project88\Zoho\Recruit\Api\Formatter\Response;

use Project88\Zoho\Recruit\Api\Formatter\FormatterInterface;

class GenericResponseListFormatter implements FormatterInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @inheritdoc
     */
    public function formatter(array $data)
    {
        $this->data = array();

        $formatter = new GenericResponseRowFormatter();

        foreach ($data as $item) {
            $this->data[] = $formatter->formatter($item['FL'])->getOutput();
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOutput()
    {
        return $this->data;
    }
}
