@extends('indexDashboard')

@section('content')

    <!-- Begin Page Content -->
    <div class="dashboardSection">
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-12">
					@if($message = Session::get('success'))
					<div class="alert alert-success">{{ $message }}</div>
					@endif
                    <h3 class="text-center">List of Merchants</h3>
					<a href="{{ route('createMerchant') }}" class="btn btn-info href mt-2 mb-2">Add Merchant</a>

                    <table class="table table-bordered table-responsive">
                    	<thead>
                    		<tr>
                    			<th>Nomor</th>
                    			<th>Nama barang</th>
                    			<th>Kategori</th>
                    			<th>Quantity</th>
                    			<th>Harga barang</th>
								<th>Description</th>
                    			<th>Status</th>
                    			<th colspan="2" class="text-center">Action</th>
                    		</tr>
                    	</thead>

                    	<tbody>
                    	@if(count($barang)>0)
                    		@foreach($barang AS $key => $brg)
                    		<tr>
                    			<td>{{ $barang->firstItem()+$key }}</td>
                    			<td>{{ $brg->name_merchant }}</td>
                    			<th>{{ $brg->name_category }}</th>
                    			<td>{{ $brg->quantity}}</td>
                    			<td>{{ $brg->price }}</td>
								<td>{{ $brg->description }}</td>
								
								<td><input data-idbarang="{{ $brg->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Not Active" {{ $brg->status ? 'checked' : '' }}></td>
                    			<td><a href="{{ route('editMerchant', $brg->id) }}" class="btn btn-success">Update</a></td>
                    			<td><form method="POST" action="{{ route('deleteMerchant', $brg->id) }}">
                    				@csrf
                    				<button class="btn btn-danger" type="submit" onclick="return confirm('Delete?')">Delete</button>
                    			</form></td>
                    		</tr>
                    		@endforeach

                    		<tr>
                    			<td colspan="9">Showing {{ $barang->firstItem() }} to {{ $barang->lastItem() }}</td>
                    		</tr>
                    		<tr>
                    			<td colspan="9">{{ $barang->links() }}</td>
                    		</tr>

                    	@else
                    	<tr>
                    		<td colspan="8"><p class="alert alert-danger text-center">Barang kosong</p></td>
                    	</tr>
                    	@endif
                    	</tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection

