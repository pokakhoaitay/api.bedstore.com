<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/15/2016
 * Time: 12:27 PM
 */

set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno)
{
    if (error_reporting() == 0) {
        return;
    }


    $errType = '';
    switch ($severity) {//http://php.net/manual/en/errorfunc.constants.php
        case E_USER_ERROR:
            $errType = 'E_USER_ERROR';
            //exit(1);
            break;

        case E_USER_WARNING:
            $errType = 'E_USER_WARNING';
            break;

        case E_USER_NOTICE:
            $errType = 'E_USER_NOTICE';
            break;
        case E_NOTICE:
            $errType = 'E_NOTICE';
            break;
        default:
            $errType = 'UNKNOWN';
            break;
    }
    $errMesg = '[ ' . $errType . ' ]' . ': ' . $message . ' in ' . $filename . ' on line ' . $lineno . "\n";
    error_log($errMesg);

    /* Don't execute PHP internal error handler */
    return true;

    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
}