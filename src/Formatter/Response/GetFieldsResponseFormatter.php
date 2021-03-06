<?php

namespace Project88\Zoho\Recruit\Api\Formatter\Response;

use Project88\Zoho\Recruit\Api\Formatter\FormatterInterface;

class GetFieldsResponseFormatter implements FormatterInterface
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
        $this->data = $data['data'][$data['module']]['section'];

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
