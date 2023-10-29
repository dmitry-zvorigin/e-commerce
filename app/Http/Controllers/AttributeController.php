<?php

namespace App\Http\Controllers;

use App\Models\Group_attribute;
use App\Models\Product_attribute;
use App\Models\Attribute_value;
use App\Models\Product;
use App\Models\Product_characteristic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index() : View
    {
        $groups = Group_attribute::with('product_attribute.attribute_value')->paginate(10);
        // $attributes = Product_attribute::paginate(10);
        // dd($attributes);

        $attributes = Product_attribute::paginate(10);
        return view("attributes.index", ['groups' => $groups, 'attributes' => $attributes]);
    }

    public function createGroup() : View
    {
        return view('attributes.group.create');
    }

    public function storeGroup(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $group = Group_attribute::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.attributes.createGroup')->with('success', 'Группа успешно добавлена');
    }

    // public function createAttribute() : View
    // {
    //     $groups = Group_attribute::all();
    //     return view('attributes.attribute.create', ['groups' => $groups]);
    // }

    public function storeAttribute(Request $request) : RedirectResponse
    {
        $request->validate([
            'attribute_name' => 'required|string|max:255',
            'group_id' => 'required|exists:group_attributes,id',
        ]);

        $attribute = Product_attribute::create([
            'attribute_name' => $request->input('attribute_name'),
            'group_id' => $request->input('group_id'),
        ]);

        return redirect()->route('admin.attributes.createAttribute')->with('success','Атрибут успешно создан');
    }

    // public function createValue() : View
    // {
    //     $attributes = Product_attribute::all();

    //     return view('attributes.value.create', ['attributes' => $attributes]);
    // }

    public function storeValue(Request $request) : RedirectResponse
    {
        $request->validate([
            'attribute_id' => 'required|exists:product_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        $value = Attribute_value::create([
            'attribute_id' => $request->input('attribute_id'),
            'value' => $request->input('value'),
        ]);

        return redirect()->route('admin.attributes.createValue')->with('success','Значение успешно создано');
    }

    public function createGroupAttribute(Request $request)
    {

        $group = new Group_attribute();
        $group->name = $request->input('group_name');
        $group->save();

        return response()->json($group);
    }

    public function createAttribute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:group_attributes,id',
            'attribute_name' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attribute = new Product_attribute();
        $attribute->group_id = $request->input('group_id');
        $attribute->attribute_name = $request->input('attribute_name');

        $attribute->save();

        return response()->json($attribute);
    }

    public function createValue(Request $request)
    {
        $value = new Attribute_value();
        $value->attribute_id = $request->input('attribute_id');
        $value->value = $request->input('value');

        $value->save();

        return response()->json($value);
    }

    public function saveAttributes(Request $request, $product) : RedirectResponse
    {
        // dd($request, $product);
        //TODO
        // dd($request);
        $request->validate([
            'group_id' => 'required|exists:group_attributes,id',
            'attribute_id' => 'required|exists:product_attributes,id',
            'value_id' => 'required|exists:attribute_values,id',
        ]);

        $product = Product::find($product);

        $characteristics = new Product_characteristic();

        $characteristics->product_id = $product->id;
        $characteristics->group_id = $request->input('group_id');
        $characteristics->attribute_id = $request->input('attribute_id');
        $characteristics->value_id = $request->input('value_id');

        $characteristics->save();

        return redirect()->route('admin.products.edit', ['product' => $product->slug])->with('success','Характеристика успешно создана');
    }

    public function createAttributes($slug) : View
    {
        $product = Product::whereSlug($slug)->firstOrFail();

        $groupAttributes = Group_attribute::all();

        return view('attributes.create', ['groupAttributes' => $groupAttributes, 'product' => $product]);
    }

    public function loadAttributes(Request $request)
    {
        $groupId = $request->input('group_id');
        $attributes = Product_attribute::where('group_id', $groupId)->get();

        return response()->json($attributes);
    }

    public function loadValue(Request $request)
    {
        $attributeId = $request->input('attribute_id');
        $values = Attribute_value::where('attribute_id', $attributeId)->get();

        return response()->json($values);
    }
}
