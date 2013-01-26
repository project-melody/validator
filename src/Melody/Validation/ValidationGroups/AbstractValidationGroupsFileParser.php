<?php

namespace Melody\Validation\ValidationGroups;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\Exceptions\InvalidFileException;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
abstract class AbstractValidationGroupsFileParser extends AbstractValidationGroupsParser
{
    protected $file;

    public function __construct($file) {
        if ($this->checkFile($file)) {
            $this->file = pathinfo($file);
        }
    }

    /**
     * @param unknown_type $file
     * @throws \InvalidArgumentException
     */
    protected function checkFile($file)
    {
        if (!file_exists($file) || !is_readable($file)) {
            throw new InvalidFileException("File $file not found or not readable");
        }

        return true;
    }
}
