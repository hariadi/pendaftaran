<?php

namespace App\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

class BootstrapPresenter extends BootstrapThreePresenter
{
	public function render()
	{
		if (!$this->hasPages()) {
			return '';
		}

		return sprintf(
			'<ul class="pagination pagination-sm no-margin pull-right">%s %s %s</ul>',
			$this->getPreviousButton(),
			$this->getLinks(),
			$this->getNextButton()
		);
	}
}
