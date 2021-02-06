<?php

namespace Project88\Zoho\Recruit\Api\Formatter;

use Project88\Zoho\Recruit\Api\Formatter\Response\ErrorResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\GenericResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\GetFieldsResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\GetModulesResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\MessageResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\DownloadFileResponseFormatter;
use Project88\Zoho\Recruit\Api\Formatter\Response\NoDataResponseFormatter;

class ResponseFormatter extends AbstractFormatter implements FormatterInterface
{
    /**
     * @inheritdoc
     */
    public function formatter(array $data)
    {
        $this->originalData = $data;

        if (isset($data['download'])) {
            $this->setFormatter(new DownloadFileResponseFormatter());
        } elseif (isset($data['response']['nodata'])) {
            $this->setFormatter(new NoDataResponseFormatter());
        } elseif (isset($data['response']['result']['message']) || isset($data['response']['success']['message'])) {
            $this->setFormatter(new MessageResponseFormatter());
        } elseif (isset($data['response']['error'])) {
            $this->setFormatter(new ErrorResponseFormatter());
        } elseif ($this->isMethod('getFields')) {
            $this->setFormatter(new GetFieldsResponseFormatter());
        } elseif ($this->isMethod('getModules')) {
            $this->setFormatter(new GetModulesResponseFormatter());
        } elseif (in_array($this->getMethod(), array(
            'getRecords',
            'getRecordById',
            'getNoteTypes',
            'getRelatedRecords',
            'getAssociatedJobOpenings',
            'getAssociatedCandidates',
            'getSearchRecords',
        ))) {
            $this->setFormatter(new GenericResponseFormatter());
        }

        if ($this->getFormatter() instanceof FormatterInterface) {
            $this->getFormatter()->formatter(array(
                'module' => $this->getModule(),
                'method' => $this->getMethod(),
                'data'   => $this->getOriginalData(),
                'params' => isset($data['params']) ? $data['params'] : null,
            ));
        }

        return $this;
    }
}
