<?php

namespace Box\Spout\Reader\Common\Creator;

use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\TestUsingResource;
use PHPUnit\Framework\TestCase;

/**
 * Class ReaderFactoryTest
 */
class ReaderFactoryTest extends TestCase
{
    use TestUsingResource;

    /**
     * @return void
     */
    public function testCreateFromFileCSV()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.csv');
        $reader = ReaderFactory::createFromFile($validCsv);
        $this->assertInstanceOf('Box\Spout\Reader\CSV\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileCSVAllCaps()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.CSV');
        $reader = ReaderFactory::createFromFile($validCsv);
        $this->assertInstanceOf('Box\Spout\Reader\CSV\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileODS()
    {
        $validOds = $this->getResourcePath('csv_test_create_from_file.ods');
        $reader = ReaderFactory::createFromFile($validOds);
        $this->assertInstanceOf('Box\Spout\Reader\ODS\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileXLSX()
    {
        $validXlsx = $this->getResourcePath('csv_test_create_from_file.xlsx');
        $reader = ReaderFactory::createFromFile($validXlsx);
        $this->assertInstanceOf('Box\Spout\Reader\XLSX\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateReaderShouldThrowWithUnsupportedType()
    {
        $this->expectException(UnsupportedTypeException::class);

        ReaderFactory::create('unsupportedType');
    }

    /**
     * @return void
     */
    public function testCreateFromFileUnsupported()
    {
        $this->expectException(UnsupportedTypeException::class);
        $invalid = $this->getResourcePath('test_unsupported_file_type.other');
        $reader = ReaderFactory::createFromFile($invalid);
    }

    /**
     * @return void
     */
    public function testCreateFromFileMissing()
    {
        $this->expectException(IOException::class);
        $invalid = 'thereisnosuchfile.ext';
        $reader = ReaderFactory::createFromFile($invalid);
    }
}
