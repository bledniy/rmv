<?php

	namespace Database\Seeders;

	use App\Models\Admin\Admin;
	use App\Repositories\AdminRepository;
	use App\Repositories\UserRepository;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Str;

	class AdminsTableSeeder extends Seeder
	{
		/**
		 * @var UserRepository
		 */
		private $repository;

		public function __construct(AdminRepository $repository)
		{
			$this->repository = $repository;
		}

		public function run()
		{
			$this->repository->create([
				'name'           => 'John Doe',
				'email'          => 'exceptions.manticore@gmail.com',
				'login'          => 'superadmin',
				'password'       => bcrypt(config('permission.passwords.superadmin')),
				'remember_token' => Str::random(10),
				'email_verified_at' => now(),
			]);

			$this->repository->create([
				'name'              => 'Admin',
				'email'             => null,
				'login'             => 'admin',
				'password'          => bcrypt(config('permission.passwords.admin')),
				'remember_token'    => Str::random(10),
				'email_verified_at' => now(),
			]);

		}

	}
