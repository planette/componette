<?php declare(strict_types = 1);

namespace App\Modules\Front\Portal\Home;

use App\Model\Database\ORM\Addon\AddonRepository;
use App\Model\Database\Query\LatestActivityAddonsQuery;
use App\Model\Database\Query\LatestAddedAddonsQuery;
use App\Modules\Front\Portal\Base\BaseAddonPresenter;
use App\Modules\Front\Portal\Base\Controls\AddonList\AddonList;
use App\Modules\Front\Portal\Base\Controls\ReleaseList\IReleaseListFactory;
use App\Modules\Front\Portal\Base\Controls\ReleaseList\ReleaseList;
use App\Modules\Front\Portal\Base\Controls\Search\Search;

final class HomePresenter extends BaseAddonPresenter
{

	/** @var AddonRepository @inject */
	public $addonRepository;

	/** @var IReleaseListFactory @inject */
	public $releaseListFactory;

	protected function createComponentSearch(): Search
	{
		$search = parent::createComponentSearch();
		$search['form']['q']->controlPrototype->autofocus = true;

		return $search;
	}

	protected function createComponentLatestAdded(): AddonList
	{
		return $this->createAddonListControl($this->addonRepository->fetchEntities(new LatestAddedAddonsQuery()));
	}

	protected function createComponentLatestActivity(): AddonList
	{
		return $this->createAddonListControl($this->addonRepository->fetchEntities(new LatestActivityAddonsQuery()));
	}

	protected function createComponentLatestReleases(): ReleaseList
	{
		return $this->releaseListFactory->create();
	}

}
