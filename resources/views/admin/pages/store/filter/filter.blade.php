
<div class="card-body">

    <form action="{{ route('admin.store.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="name" value="{{ old('name', request()->input('name')) }}" placeholder="Search keyword" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" id="type" name="type">
                        <option value="" >Choose Type</option>
                        <option value="shop" {{ old('type', request()->input('type')) == 'shop' ? 'selected' : '' }}>Shop</option>
                        <option value="store" {{ old('type', request()->input('type')) == 'store' ? 'selected' : '' }}>Store</option>
                    </select>
                </div>
            </div>


            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" id="order_by" name="order_by">
                        <option value="" >Choose Order</option>
                        <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>Ascending{{ old('order_by') == 'asc' ? 'selected' : '' }}</option>
                        <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>


            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" id="limit_by" name="limit_by">
                        <option value="" >Choose Limit</option>
                        <option value="5" {{ old('limit_by', request()->input('limit_by')) == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="15" {{ old('limit_by', request()->input('limit_by')) == '15' ? 'selected' : '' }}>15</option>
                    </select>
                </div>
            </div>


            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-link">Search</button>
                </div>
            </div>
        </div>
    </form>


</div>
