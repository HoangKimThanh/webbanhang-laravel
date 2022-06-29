<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviewsNotApproved = Review::getReviewsWithProductName(0);
        $reviewApproved = Review::getReviewsWithProductName(1);

        return view('admin.reviews.index', [
            'reviewsNotApproved' => $reviewsNotApproved,
            'reviewsApproved' => $reviewApproved,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $review = new Review();
        $review->user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : 0;
        $review->fill($request->validated());
        $review->save();

        return redirect()->back()->with('tmpReview', $review);
    }

    public function ajax(Request $request)
    {
        $action = $request->get('action');
        $id = $request->get('id');
        switch ($action) {
            case 'update':
                return $this->update($id);
                break;
            case 'delete':
                return $this->destroy($id);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $review = Review::find($id);
        $review->status = 1;
        $review->save();


        return response()->json(array(
            'review' => $review,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);

        $review->delete();
        return response()->json(array());
    }
}
