<div>
    <form action="{{ route('party.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Party Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Party Name"
                class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Party Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="Enter Party Phone Number"
                class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Party Complete Address</label>
            <input type="text" name="address" id="address" placeholder="Enter Party Complete Address"
                class="form-control">
        </div>
        <div class="form-group">
            <label for="type">Select Party Type</label>
            <select name="type" id="type" class="form-control">
                <option value="customer">Customer</option>
                <option value="Vendor">Vendor</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">Add Party</button>
        </div>
    </form>
</div>