<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\DivMade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeDiv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $num1;
    protected $num2;
    protected $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($num1, $num2, $userId)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        if($this->num2 == 0){
            $title = 'Erro';
            $description = 'Divisão por zero';

            $user = User::find($this->userId);
            $user->notify(new DivMade($title, $description));

        }else{

            $div = $this->num1 / $this->num2;
            $title = 'Sucesso';
            $description = "Div = $div";
    
            //logger()->info('O maior primo é' . $div);
            
            $user = User::find($this->userId);
            $user->notify(new DivMade($title, $description));
        }
        
    }
}
