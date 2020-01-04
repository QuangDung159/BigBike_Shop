<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Constant;
use App\Image;
use App\Product;
use App\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @param int $productId
     * @return Factory|View
     */
    public function showProductDetailPage($productId)
    {
        $product = Product::getByIdClient($productId);

        $listImage = Image::getListImageByProductIdClient($productId);

        $listReview = (array)Review::getReviewByProductId($productId);

        return view(Constant::PATH_PRODUCT_DETAIL)
            ->with('product', $product)
            ->with('listImage', $listImage)
            ->with('listReview', $listReview);
    }

    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listProduct = Product::getAll()
            ->orderBy(Constant::TABLE_PRODUCT . '.product_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::where(
            Constant::TABLE_ADMIN . '.admin_is_deleted',
            '=',
            0
        )->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_PRODUCT_LIST)
            ->with('listProduct', $listProduct)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    /**
     * @param int $productId
     * @param int $status
     * @return RedirectResponse
     */
    public function changeStatus($productId, $status)
    {
        $data = [];
        if ($status == 0) {
            $data['product_status'] = 1;
        } else {
            $data['product_status'] = 0;
        }

        $data['product_updated_at'] = time();
        $data['product_updated_by'] = Session::get('admin_id');

        Product::updateByProductId($productId, $data);

        Session::put('msg_update_success', 'Update product successfully!');
        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function deleteProduct($productId)
    {
        $data = [
            Constant::TABLE_PRODUCT . '.product_is_deleted' => 1,
            Constant::TABLE_PRODUCT . '.product_updated_at' => time(),
            Constant::TABLE_PRODUCT . '.product_updated_by' => Session::get('admin_id'),
        ];

        Product::updateByProductId($productId, $data);

        Session::put('msg_delete_success', 'Delete product successfully!');

        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
    }
}
