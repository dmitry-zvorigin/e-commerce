<div class="card mt-4">
    <form method="get" action="{{ route('catalog.product', ['category' => $category, 'product' => $product->slug]) }}">
        <div class="d-flex">

            <input name="search" type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Поиск</button>
            <select class="form-select" id="sorting-select" name="sorting">
                <option value="">-- Выберите сортировку --</option>
                <option value="sortingDate" @selected(request('sorting') =='sortingDate')>По дате</option>
                <option value="sortingRating" @selected(request('sorting') == 'sortingRating')>По рейтингу</option>
                <option value="sortingPopularity" @selected(request('sorting') == 'sortingPopularity')>По популярности</option>
                <option value="sortingEdit" @selected(request('sorting') == 'sortingEdit')>По дате изменения</option>
            </select>
        </div>

        <div class="d-flex mt-4">
            <div class="form-check ms-4">
                {{-- <input name="rating_5" class="form-check-input" type="checkbox" value="" id="flexCheckChecked"> --}}
                <input name="ratings[]" class="form-check-input" type="checkbox" value="5" id="flexCheckChecked5" @checked(in_array(5, request('ratings', [])))>
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </label>
            </div>
            <div class="form-check ms-4">
                <input name="ratings[]" class="form-check-input" type="checkbox" value="4" id="flexCheckChecked4" @checked(in_array(4, request('ratings', [])))>
                <label class="form-check-label" for="flexCheckChecked">
                    </i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </label>
            </div>
            <div class="form-check ms-4">
                <input name="ratings[]" class="form-check-input" type="checkbox" value="3" id="flexCheckChecked3" @checked(in_array(3, request('ratings', [])))>
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </label>
            </div>
            <div class="form-check ms-4">
                <input name="ratings[]" class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2" @checked(in_array(2, request('ratings', [])))>
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                </label>
            </div>
            <div class="form-check ms-4">
                <input name="ratings[]" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked1" @checked(in_array(1, request('ratings', [])))>
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa fa-star"></i>
                </label>
            </div>
        </div>
    </form>
</div>