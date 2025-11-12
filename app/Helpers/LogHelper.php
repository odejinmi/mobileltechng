// app/Helpers/LogHelper.php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class LogHelper
{
    public static function airtime($message, array $context = [], $level = 'info')
    {
        self::log('airtime', $level, $message, $context);
    }

    public static function security($message, array $context = [], $level = 'warning')
    {
        self::log('security', $level, $message, $context);
    }

    public static function api($message, array $context = [], $level = 'info')
    {
        self::log('api', $level, $message, $context);
    }

    protected static function log($channel, $level, $message, array $context = [])
    {
        $context = array_merge([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
            'url' => request()->fullUrl(),
        ], $context);

        Log::channel($channel)->$level($message, $context);
    }
}