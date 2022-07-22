<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\PrimeFound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FindMaxPrime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $limit;
    protected $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $limit, $userId)
    {
        $this->limit = $limit;//passando as propriedades para ele
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $primo = 1;
        for($num = 1; $num < $this->limit; $num++){//vou passar por todos, ate o limite
            for($div = 2; $div < $num; $div++){
                if($num % $div === 0){//se o resto for 0 então nao é primo
                    break;
                }
                
            }
            if($div === $num){
                $primo = $num;
            }
        }
        $title = 'Sucesso';
        $description = 'O maior primo é:' . $primo;

        logger()->info('O maior primo é' . $primo);
        
        $user = User::find($this->userId);
        $user->notify(new PrimeFound($title, $description));//a model user ja tem esse metodo ai

    }
}
