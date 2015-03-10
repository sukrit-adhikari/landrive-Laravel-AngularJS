<?php namespace App\Console\Commands;

use App\Http\Controllers\LandriveStorageController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Contracts\Auth\Registrar;
use App\User;
use DB;

class Installation extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'install';

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

    Artisan::call("migrate", ['--force' => 'y']); // No Confirmation

    $user = [
      'name' => $this->option('name'),
      'email' => $this->option('email'),
      'password' => bcrypt($this->option('password')),
    ];

    User::create($user);

    $landriveStorage = new LandriveStorageController();

    if(!is_dir($landriveStorage->getDefaultLandriveStoragePath().'\public')){
      mkdir($landriveStorage->getDefaultLandriveStoragePath().'\public');
    }

    DB::insert('insert into variable (name, value) values (?, ?)', ['installed', 1]);

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
      ['name', 'Username', InputOption::VALUE_REQUIRED, 'Username', 'admin'],
      ['email', null, InputOption::VALUE_REQUIRED, 'Email', null],
      ['password', null, InputOption::VALUE_REQUIRED, 'Password', 'password'],
    ];
  }

}
