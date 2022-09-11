<?php

namespace App\Http\Controllers\Api;

use App\Events\AddBook as EventsAddBook;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookFormRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use App\Notifications\AddBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //code...

        $books=Book::paginate(10);
        if ($books->isEmpty()) {
            return errorResponse(null,__('index.data.notFound'),404);

        }
        return successResponse(BookResource::collection($books),__('index.data.found'),200);
    } catch (\Throwable $th) {
        return errorResponse($th->getMessage(),__('index.data.found'),404);
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookFormRequest $request)
    {
      $data_validated=$request->validated();

      $data_validated['user_id']=$request->user()->id;
      $book=Book::create($data_validated);
      $user=User::where('email','ohyatt@example.com')->first();
      $user->notify(new AddBook($book));
    //   event(new EventsAddBook($book,$user));
return successResponse($book,__('index.data.found'),201);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $book= Book::find($id);
       return response([
        'status'=>true,
        'data'=>$book
    ],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookFormRequest $request, Book $book)
    {
        //
      $update_book=  $book->update($request->validated());
      return response([
        'status'=>true,
        'data'=>$update_book,
        'message'=>"updated successfully"
    ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
       $book->delete();

       return response([
        'status'=>true,
        'data'=>null,
        'message'=>"deleted successfully"
    ],200);
    }

}
