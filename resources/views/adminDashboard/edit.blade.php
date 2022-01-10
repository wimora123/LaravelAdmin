@extends('indexDashboard')

@section('content')

<div class="editMercant">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-center">Edit Merchant</h3>

				<form method="POST" action="{{ route('updateMerchant', $barang->id) }}">
				@csrf
					<div class="form-group">
					    <label>Nama Barang</label>
					    <input type="text" name="namaBarang" class="form-control" placeholder="Nama barang" value="{{ $barang->name_merchant }}">
				    </div>

				    <div class="form-group">
					      <label>Kategori</label>
					      <select name="kategori">
					      	<option value="{{ $barang->id_kategori }}">{{ $barang->name_category }}</option>
					      	@foreach($categories AS $category)
					      	<option value="{{ $category->id }}">{{ $category->name_category }}</option>
					      	@endforeach
					      </select>
				    </div>

					<div class="form-group">
					    <label>Harga Barang</label>
					    <input type="text" name="hargaBarang" class="form-control" placeholder="Harga Barang" min="0" value="{{ $barang->price }}">
				    </div>

					<div class="form-group">
					    <label>Quantity</label>
					    <input type="number" name="qty" class="form-control" placeholder="Quantity" value="{{ $barang->quantity }}">
				    </div>

					<div class="form-group">
					    <label>Description</label>
					    <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $barang->description }}</textarea>
					@if($errors->has('description'))																
						<span class="invalid-feedback">{{ $errors->first('description') }}</span>
					@endif
					</div>

				    <div class="form-group">
						<select name="status">
					      	<option value="{{ $barang->status === 1 ? 'Active' : 'Not Active' }}">{{ $barang->status === 1 ? 'Active' : 'Not Active' }}</option>
					      	<option value="1">Active</option>
							<option value="0">Not Active</option>
					    </select>
				    </div>
				  
	
				    <div class="form-group row col-md-8 offset-md-4">
				  		<button type="submit" class="btn btn-primary">Update</button>
				  	 	<a href="{{ route('listMerchant') }}" class="btn btn-warning ml-2">Back</a>
				    </div>
				</form>

			</div>
		</div>
	</div>
</div>

@endsection