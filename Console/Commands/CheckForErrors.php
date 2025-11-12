// app/Console/Commands/CheckForErrors.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ErrorAlert;

class CheckForErrors extends Command
{
    protected $signature = 'monitor:check-errors';
    protected $description = 'Check for errors in logs and send alerts';

    public function handle()
    {
        $errorCount = DB::table('logs')
            ->where('level_name', 'ERROR')
            ->where('created_at', '>=', now()->subHour())
            ->count();

        if ($errorCount > 0) {
            Mail::to(env('ADMIN_EMAIL'))
                ->send(new ErrorAlert($errorCount));
        }
    }
}