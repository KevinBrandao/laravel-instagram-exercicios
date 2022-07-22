<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Notifications\PrimeFound;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MakeSum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $num1;
    protected $num2;
    //protected $userId;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($num1, $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        //$this->userId = $userId;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $soma = $this->num1 + $this->num2;
        logger()->info('Soma = ' . $soma);

        // $user = User::find($this->userId);
        // $user->notify(new PrimeFound($soma, $this->num1,));
    }
}
