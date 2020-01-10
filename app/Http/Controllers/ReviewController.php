<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Review;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listReview = Review::getAll()
            ->orderBy(Constant::TABLE_PRODUCT . '.product_id')
            ->paginate(10);

        return view(Constant::PATH_ADMIN_REVIEW_LIST)
            ->with('listReview', $listReview);
    }

    public function deleteReview($reviewId)
    {
        Review::removeByReviewId($reviewId);

        Session::put('msg_delete_success', 'Delete review successfully!');
        return Redirect::to(Constant::URL_ADMIN_REVIEW . '/read');
    }
}
