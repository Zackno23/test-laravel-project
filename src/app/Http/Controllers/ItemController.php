<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Http\Response;
use App\Http\Requests\ItemRequest;
class ItemController extends Controller
{
	public function index(Request $request){
		// $query = Item::query();
		// if (isset($request->name)){
		// 	$query->where('name', 'like', '%'.$request->name.'%');
		// }
		// if(isset($request->sex)){
		// 	$query->where('sex', $request->sex);
		// }
		// if(isset($request->memo)){
		// 	$query->where('memo', 'like', '%'.$request->memo.'%');
		// }
		// $items = $query->orderBy('created_at', 'desc')->get();
		
		$items = Item::nameFilter($request->name)
			->sexFilter($request->sex)
			->memoFilter($request->memo)
			->orderBy('created_at','desc')
			// ->get();
			->paginate(3)
			->appends($request->all());
		return view('items.index', [
			'items'=>$items
		]);
	}
	public function create(Request $request){
		return view('items.create');
	}
	public function store(ItemRequest $request){
		$item = new Item();
		$item->name = $request->name;
		$item->age = $request->age;
		$item->sex = $request->sex;
		$item->memo = $request->memo;
		$item->save();
		return redirect()->action('ItemController@index');
	}
	public function show(string $id){
		$item = Item::findOrFail($id);
		return view('items.show')->with('item', $item);
	}
	public function edit(string $id){
		return view('items.edit')->with('item', Item::findOrFail($id));
	}
	public function update(ItemRequest $request, string $id){
		$item = Item::findOrFail($id);
		$item->fill($request->all())->save();
		return redirect()->route('index');
	}
	public function delete(Item $item){
		return view('items.delete')->with('item', $item);
	}	
	public function destroy(Item $item){
		$item->delete();
		return redirect()->route('index');
	}
	


}
