<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Page;
use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class CheckoutComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $termConditionPageUrl = '#';

        $user = Auth::user();

        $pageId = Configuration::getConfiguration('general_term_condition_page');

        if (null !== $pageId) {
            $page = Page::find($pageId);
            $termConditionPageUrl = route('page.show', $page->slug);
        }

        $cartProducts = Session::get('cart');
        $view->with('cartProducts', $cartProducts)
            ->with('user', $user)
            ->with('termConditionPageUrl', $termConditionPageUrl);
    }
}
