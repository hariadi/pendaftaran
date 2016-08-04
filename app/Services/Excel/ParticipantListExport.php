<?php

namespace App\Services\Excel;

use Maatwebsite\Excel\Files\NewExcelFile;

/**
 * Class ParticipantListExport
 * @package App\Http
 */
class ParticipantListExport extends NewExcelFile
{
    public function getFilename()
    {
        return 'participants';
    }
}
