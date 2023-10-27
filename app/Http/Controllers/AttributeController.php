<?php

namespace App\Http\Controllers;

use App\Models\Group_attribute;
use App\Models\Product_attribute;
use App\Models\Attribute_value;
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
            'attribute_name' => 'required|string|max:20'
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
}
