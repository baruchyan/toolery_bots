<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make_admin {--user_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add role admin to user';
    private ?User $user;


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $this->init();

            $this->user->assignRole('admin');

            return 0;
        } catch (\Exception $exception) {

            $this->error($exception->getMessage());

            return 1;
        }
    }

    private function init(): void
    {
        if (empty($this->option('user_id'))) {
            throw new \Exception('Required field user_id');
        }

        $userId = (int)$this->option('user_id');

        $this->user = User::find($userId);

        if (empty($this->user)) {
            throw new \Exception('User not found');
        }

    }
}
