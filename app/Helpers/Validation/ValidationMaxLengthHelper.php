<?php


namespace App\Helpers\Validation;


class ValidationMaxLengthHelper
{

    const TINYINT = 127;
    const TINYINT_UNSIGNED = 255;
    const SMALLINT = 32767;
    const MEDIUMINT = 8388607;
    const MEDIUMINT_UNSIGNED = 16777215;
    const SMALLINT_UNSIGNED = 65535;
    const INT = 2147483647;
    const INT_UNSIGNED = 4294967295;
    const BIGINT = 9223372036854775807;
    const BIGINT_UNSIGNED = 18446744073709551615;
    //
    const CHAR = 256;
    const VARCHAR = 65535;
    const TINYTEXT = 256;
    const TEXT = 65535;
    const MEDIUMTEXT = 16777215;
    const LONGTEXT = 4294967295;


}