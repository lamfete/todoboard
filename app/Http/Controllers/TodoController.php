<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Item as Item;
use App\User as User;
use Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;

class TodoController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function index(Request $request) {
        $search_term = $request->input('search');
        $limit = $request->input('limit')?$request->input('limit'):5;

        if($search_term) {
            $items = Item::orderBy('id', 'DESC')->where('body', 'LIKE', "%$search_term%")->with(
                array('User' => function($query) {
                    $query->select('id', 'name');
                    })
                )->select('id', 'body', 'user_id', 'pic_id', 'status_id')->paginate($limit);

            $items->appends(array(
                'search' => $search_term,
                'limit' => $limit
            ));
        }
        else {
            $items = Item::orderBy('id', 'DESC')->with(
                array('User' => function($query) {
                    $query->select('id', 'name');
                    })
                )->select('id', 'body', 'user_id', 'pic_id', 'status_id')->paginate($limit);

            $items->appends(array(
                'limit' => $limit
            ));
        }

        return Response::json([
            'data' => $this->transformCollection($items)
        ], 200);
    }

    public function show($id) {
        // $item = Item::find($id);
        $item = Item::with(
            array('User' => function($query){
                $query->select('id', 'name');
                })
            )->find($id);

        if(!$item) {
            return Response::json([
                'error' => [
                    'message' => 'Item does not exist'
                ]
            ], 404);
        }

        // get previous item id
        $previous = Item::where('id', '<', $item->id)->max('id');

        // get next item id
        $next = Item::where('id', '<', $item->id)->min('id');

        return Response::json([
            'previous_item_id' => $previous,
            'next_item_id' => $next,
            'data' => $this->transform($item)
        ], 200);
    }

    public function store(Request $request) {
        if(!$request->body or !$request->user_id) {
            return Response::json([
                'error' => [
                    'message' => 'Please provide body, user_id, pic_id, status_id'
                ]
            ], 422);
        }

        $item = Item::create($request->all());

        return Response::json([
            'message' => 'Item created succesfully',
            'data' => $this->transform($item)
        ]);
    }

    public function update(Request $request, $id) {
        if(!$request->user_id) {
            return Response::json([
                'error' => [
                    'message' => 'Please provide body, user_id, pic_id, status_id'
                ]
            ], 422);
        }

        $item = Item::find($id);
        $item->body = $request->body;
        $item->user_id = $request->user_id;
        $item->pic_id = $request->pic_id;
        $item->status_id = $request->status_id;
        $item->updated_at = \Carbon\Carbon::now();
        $item->save();

        return Response::json([
            'message' => 'Item updated succesfully'
        ]);
    }

    public function destroy($id) {
        Item::destroy($id);

        return Response::json([
            'message' => 'Item deleted succesfully'
        ]);
    }

    private function transformCollection($items) {
        // return array_map([$this, 'transform'], $items->toArray());
        $itemsArray = $items->toArray();

        return [
            'total' => $itemsArray['total'],
            'per_page' => intval($itemsArray['per_page']),
            'current_page' => $itemsArray['current_page'],
            'last_page' => $itemsArray['last_page'],
            'next_page_url' => $itemsArray['next_page_url'],
            'prev_page_url' => $itemsArray['prev_page_url'],
            'from' => $itemsArray['from'],
            'to' => $itemsArray['to'],
            'data' => array_map([$this, 'transform'], $itemsArray['data'])
        ];
    }

    private function transform($item) {
        return [
            'item_id' => $item['id'],
            'item_body' => $item['body'],
            'item_created_by_id' => $item['user_id'],
            'item_created_by' => $item['user']['name'],
            'item_pic_id' => $item['pic_id'],
            'item_status_id' => $item['status_id']
        ];
    }
}
