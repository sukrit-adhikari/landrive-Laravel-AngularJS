<?php namespace App\Console\Commands;

use App\Http\Controllers\LandriveStorageController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Services\Registrar;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;

class Installation extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'install:landrive';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Firing this command runs installation scripts.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

    $this->info("Migrating...");
    Artisan::call("migrate", ['--force' => 'y']); // No Confirmation

    $user = [
      'name' => $this->option('name'),
      'email' => $this->option('email'),
      'password' => Hash::make($this->option('password')),
    ];
    $this->info("Creating User...");
    User::create($user);

    $landriveStorage = new LandriveStorageController();
    $this->info("Creating Storage folder...");
    if(!is_dir($landriveStorage->getDefaultLandriveStoragePath().'\public')){
      mkdir($landriveStorage->getDefaultLandriveStoragePath().'\public');
    }

    DB::insert('insert into variable (name, value) values (?, ?)', ['installed', 1]);
    $this->info("Installation Complete...100%");

    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */

 protected function getOptions()
  {
    return [
      ['name', 'Username', InputOption::VALUE_REQUIRED, 'Username', null],
      ['email', null, InputOption::VALUE_REQUIRED, 'Email', ''],
      ['password', null, InputOption::VALUE_REQUIRED, 'Password', null],
    ];
  }

}
