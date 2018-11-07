<?php
namespace Core;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (\App\Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p1>Uncaught exception:'". get_class($exception) . "'</p1>";
            echo "<p1>Message :'". $exception->getMessage() . "'</p1>";
            echo "<p1>Stack trace: '". $exception->getTraceAsString() . "'</p1>";
            echo "<p1>Thrown in : '". $exception->getFile() . "' on line " .
      $exception->getLine() . "</p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);


            $message = "Uncaught exception: '". get_class($exception) . "'";
            $message .= "Message : '". $exception->getMessage() . "'";
            $message .= "Stack trace: '". $exception->getTraceAsString() . "'";
            $message .= "Thrown in : '". $exception->getFile() . "' on line " .
      $exception->getLine() . "";
            error_log($message);
            if ($code == 404) {
                echo "<h1>Page not found</h1>";
            } else {
                echo "<h1>An error occured</h1>";
            }
        }
    }
}
