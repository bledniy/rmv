<?php

namespace App\Http\Controllers\Admin\Meta;

use App\Http\Controllers\Admin\AdminController;
use App\Traits\Authorizable;
use Illuminate\Http\Request;


class RobotController extends AdminController
{
    use Authorizable;

    protected $tb;

    private $name = 'robots.txt';

    private $controller = 'robots';

    protected $key = 'robots';

    protected $routeKey = 'admin.robots';

    private $robotsPath;

    public function __construct()
    {
        parent::__construct();
        $this->tb = 'other.robots';
        $this->robotsPath = public_path('robots.txt');
        $this->breadCrumbIndex();
        $this->shareViewModuleData();
    }

    protected function breadCrumbIndex(): void
    {
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
    }

    public function index()
    {
        $vars = [];
        if (!file_exists($this->robotsPath)) {
            $this->writeRobots($this->getDefaultRobotsContent());
        }

        $vars['data'] = (string)file_get_contents($this->robotsPath);

        $this->setTitle($this->name);
        $isDefaultContent = ($vars['data'] === $this->getDefaultRobotsContent());
        if (!isLocalEnv() && $isDefaultContent) {
            session()->flash('warning', 'Сайт находится на продакшне, и содержит текст по умолчанию!');
        }
        $data['content'] = view('admin.meta.robots.index', $vars);

        return $this->main($data);
    }

    public function update(Request $request)
    {
        $robots = (string)$request->get('robots');

        $this->writeRobots($robots);

        $this->setMessage('robots.txt успешно изменен!')->setStatus(true);

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    private function getDefaultRobotsContent(): string
    {
        return '
User-agent: *
Allow: /';
    }

    private function isContainsDefaultText()
    {

    }

    private function getRobotsFileContents()
    {

    }

    private function writeRobots(string $string): void
    {
        file_put_contents($this->robotsPath, $string);
    }
}
