<?php

namespace Melody\Validation\ValidationGroups;

use Melody\Validation\ValidationGroups\AbstractValidationGroupsParser;
use Melody\Validation\Exceptions\InvalidFileTypeException;
use Symfony\Component\Yaml\Yaml;

class PHPParserStrategy extends AbstractValidationGroupsFileParser
{
    /**
     * @return \Melody\Validation\ValidationGroups
     */
    public function parse()
    {
        $configuration = require $this->file['dirname'].'/'.$this->file['basename'];

        return $this->parseCofiguration($configuration);
    }
}
