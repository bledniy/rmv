<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\ContentTypeEnum;
use App\Models\Admin\AdminMenu;
use App\Repositories\Admin\AdminMenuRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class AdminMenuSeeder extends AbstractSeeder
{
	private $adminMenuRepository;

	private $menusByUrl;

	public function __construct(AdminMenuRepository $adminMenuRepository)
	{
		$this->adminMenuRepository = $adminMenuRepository;
		$this->menusByUrl = $this->adminMenuRepository->all()->keyBy('url');
		$this->reguard();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$menus = [
//            $this->getBuilder()->setName('Слайдер')->setUrl('/sliders')->setGateRule('view_sliders')->build(),
            $this->getBuilder()->setName(__('modules.settings.title'))->setIconFont('<i class="material-icons">settings</i>')->setUrl('/settings')->setGateRule('view_settings')->build(),
            $this->getBuilder()->setName('Локализация')->setIconFont('<i class="fa fa-language" aria-hidden="true"></i>')->setUrl('/translate')->setGateRule('view_translate')->build(),
//            $this->getBuilder()->setName('SEO')->setIconFont('<i class="fa fa-google-plus" aria-hidden="true"></i>')->setUrl('/meta')->setGateRule('view_meta')->setChildrens([
//                $this->getBuilder('/redirects')->setName('Redirects')->setIconFont('<i class="fa fa-arrow-right" aria-hidden="true"></i>')->setGateRule('view_redirects')->build(),
//                $this->getBuilder('/sitemap')->setName('Sitemap')->setIconFont('<i class="fa fa-sitemap" aria-hidden="true"></i>')->build(),
//                $this->getBuilder('/robots')->setName('Robots.txt')->setIconFont('<i class="fa fa-android" aria-hidden="true"></i>')->setGateRule('view_robots')->build(),
//            ])->build(),
            $this->getBuilder('/users')->setName('Пользователи')->setIconFont('<i class="fa fa-user" aria-hidden="true"></i>')->setGateRule('view_users')->build(),
            $this->getBuilder('roles')->setName('Роли')->setIconFont('<i class="fa fa-users" aria-hidden="true"></i>')->setGateRule('view_roles')->build(),
            $this->getBuilder('/admin-menus')->setName('Админ меню')->setIconFont('<i class="fa fa-bars" aria-hidden="true"></i>')->setGateRule('view_admin-menus')->build(),
//            $this->getBuilder('/menu')->setName('Меню')->setIconFont('<i class="fa fa-bars" aria-hidden="true"></i>')->setGateRule('view_menu')->build(),
            $this->getBuilder('/logs')->setName('Logs')->setIconFont('<i class="fa fa-history" aria-hidden="true"></i>')->setGateRule('view_logs')->setSort(20)->build(),
//            $this->getBuilder()->setName(__('modules.feedback.title_plural'))->setIconFont('<i class="fa fa-commenting" aria-hidden="true"></i>')->setUrl('/feedback')->setGateRule('view_feedback')->build(),
            $this->getBuilder()->setName('Страницы')->setUrl('/pages')->setGateRule('view_pages')->setIconFont('<i class="fa fa-columns" aria-hidden="true"></i>')->build(),
            $this->getBuilder()->setName('Документы')->setUrl('/documents')->setGateRule('view_documents')->build(),
            $this->getBuilder()->setName(__('modules.news.title_plural'))->setUrl('/news')->setGateRule('view_news')->build(),
            $this->getBuilder()->setName('Факультеты')->setUrl('/faculties')->setGateRule('view_faculties')->build(),
            $this->getBuilder()->setName('Отделы')->setUrl('/departments')->setGateRule('view_departments')->build(),
            $this->getBuilder()->setName('Состав совета')->setUrl('/staffs')->setGateRule('view_staffs')->build(),
            $this->getBuilder()->setName('Сотрудничество')->setUrl('/cooperation')->setGateRule('view_coops')->build(),



//            $this->getBuilder()->setName('Бренды')->setUrl('/' . ContentTypeEnum::BRAND)->setGateRule('view_' . ContentTypeEnum::BRAND)->build(),
//            $this->getBuilder()->setName('Вакансии')->setUrl('/' . ContentTypeEnum::VACANCY)->setGateRule('view_' . ContentTypeEnum::VACANCY)->build(),
		];
		$this->loop($menus);

		Artisan::call('cache:clear');
	}

	private function loop(array $menus, ?AdminMenu $parentMenu = null)
	{
		foreach ($menus as $menu) {
			$menuModel = $this->createMenu($menu, $parentMenu);
			if ($menuModel && Arr::get($menu, 'childrens')) {
				$this->loop(\Arr::wrap(Arr::get($menu, 'childrens')), $menuModel);
			}
		}
	}

	private function createMenu(array $menu, ?AdminMenu $parentMenu = null): ?AdminMenu
	{
		if ($this->isMenuExistsByUrl($menu['url'] ?? '')) {
			return $this->getMenuExistsByUrl($menu['url'] ?? '');
		}
		$menu = array_merge(['active' => 1], $menu);
		if ($parentMenu) {
			$menu['parent_id'] = $parentMenu->getKey();
		}

		return tap($this->adminMenuRepository->create($menu), function ($adminMenu) {
			$this->onCreated($adminMenu);
		});
	}

	private function onCreated(AdminMenu $adminMenu)
	{

	}

	private function isMenuExistsByUrl(?string $url)
	{
		return $this->menusByUrl->offsetExists($url);
	}

	private function getMenuExistsByUrl(?string $url)
	{
		return $this->menusByUrl->get($url);
	}

	private function getBuilder($url = '')
	{
		$builder = new class implements \ArrayAccess {
			private $active = true;

			private $url = '';

			private $gateRule = '';

			private $sort = 0;

			private $name = '';

			private $iconFont = '';

			private $contentProvider = '';

			private $childrens = [];

			public function setName(string $_): self
			{
				$this->name = $_;
				return $this;
			}

			/**
			 * @param string $url
			 */
			public function setUrl(string $url): self
			{
				$this->url = $url;
				return $this;
			}

			/**
			 * @param string $_
			 * @return
			 */
			public function setGateRule(string $_): self
			{
				$this->gateRule = $_;
				return $this;
			}

			public function setSort(int $_): self
			{
				$this->sort = $_;
				return $this;
			}

			/**
			 * @param string $_
			 */
			public function setIconFont(string $_): self
			{
				$this->iconFont = $_;
				return $this;
			}

			/**
			 * @param bool $active
			 */
			public function setActive(bool $active): self
			{
				$this->active = $active;
				return $this;
			}

			/**
			 * @param array $_
			 */
			public function setChildrens(array $_): self
			{
				$this->childrens = $_;
				return $this;
			}

			public function build()
			{
				$menu = [
					'active'           => (int)$this->active,
					'url'              => $this->url,
					'gate_rule'        => $this->gateRule,
					'name'             => $this->name,
					'sort'             => $this->sort,
					'icon_font'        => $this->iconFont,
					'content_provider' => $this->contentProvider,
				];
				if ($this->childrens) {
					$menu['childrens'] = $this->childrens;
				}
				return $menu;
			}

			public function offsetExists($offset)
			{
				return property_exists($this, $offset);
			}

			public function offsetGet($offset)
			{
				return $this->offsetExists($offset) ? $this->{$offset} : null;
			}

			public function offsetSet($offset, $value)
			{
				$method = Str::camel('set' . ucfirst($offset));
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}

			public function offsetUnset($offset)
			{
				if ($this->offsetExists($offset)) {
					$this->{$offset} = null;
				}
			}

			/**
			 * @param string $contentProvider
			 * @return
			 */
			public function setContentProvider(string $contentProvider): self
			{
				$this->contentProvider = $contentProvider;
				return $this;
			}

		};
		return $builder->setUrl($url);
	}
}
